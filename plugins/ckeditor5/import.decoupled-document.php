<?php
if(!defined('__KIMS__')) exit;
?>

<style>
/* 툴바 감추기 설정 - 게시판 테마 */
<?php if (!$d['theme']['show_edittoolbar']): ?>
#cke_1_top {display: none}
<?php endif; ?>

<style>
.document-editor {
    border: 1px solid var(--ck-color-base-border);
    border-radius: var(--ck-border-radius);

    /* Set vertical boundaries for the document editor. */
    max-height: 500px;

    /* This element is a flex container for easier rendering. */
    display: flex;
    flex-flow: column nowrap;
}
.document-editor__toolbar {
    /* Make sure the toolbar container is always above the editable. */
    z-index: 1;

    /* Create the illusion of the toolbar floating over the editable. */
    box-shadow: 0 0 5px hsla( 0,0%,0%,.2 );

    /* Use the CKEditor CSS variables to keep the UI consistent. */
    border-bottom: 1px solid var(--ck-color-toolbar-border);

}

/* Adjust the look of the toolbar inside the container. */
.document-editor__toolbar .ck-toolbar {
    border: 0;
    border-radius: 0;
}
/* Make the editable container look like the inside of a native word processor application. */
.document-editor__editable-container {
    padding: calc( 2 * var(--ck-spacing-large) );
    background: var(--ck-color-base-foreground);

    /* Make it possible to scroll the "page" of the edited content. */
    overflow-y: scroll;
}

.document-editor__editable-container .ck-editor__editable {
    /* Set the dimensions of the "page". */
    width: 20.8cm;
    min-height: 21cm;

    /* Keep the "page" off the boundaries of the container. */
    padding: 1cm 2cm 2cm;

    border: 1px hsl( 0,0%,82.7% ) solid;
    border-radius: var(--ck-border-radius);
    background: white;

    /* The "page" should cast a slight shadow (3D illusion). */
    box-shadow: 0 0 5px hsla( 0,0%,0%,.1 );

    /* Center the "page". */
    margin: 0 auto;
}
/* Set the default font for the "page" of the content. */
.document-editor .ck-content,
.document-editor .ck-heading-dropdown .ck-list .ck-button__label {
    font: 16px/1.6 "Helvetica Neue", Helvetica, Arial, sans-serif;
}
/* Adjust the headings dropdown to host some larger heading styles. */
.document-editor .ck-heading-dropdown .ck-list .ck-button__label {
    line-height: calc( 1.7 * var(--ck-line-height-base) * var(--ck-font-size-base) );
    min-width: 6em;
}

/* Scale down all heading previews because they are way too big to be presented in the UI.
Preserve the relative scale, though. */
.document-editor .ck-heading-dropdown .ck-list .ck-button:not(.ck-heading_paragraph) .ck-button__label {
    transform: scale(0.8);
    transform-origin: left;
}

/* Set the styles for "Heading 1". */
.document-editor .ck-content h2,
.document-editor .ck-heading-dropdown .ck-heading_heading1 .ck-button__label {
    font-size: 2.18em;
    font-weight: normal;
}

.document-editor .ck-content h2 {
    line-height: 1.37em;
    padding-top: .342em;
    margin-bottom: .142em;
}

/* Set the styles for "Heading 2". */
.document-editor .ck-content h3,
.document-editor .ck-heading-dropdown .ck-heading_heading2 .ck-button__label {
    font-size: 1.75em;
    font-weight: normal;
    color: hsl( 203, 100%, 50% );
}

.document-editor .ck-heading-dropdown .ck-heading_heading2.ck-on .ck-button__label {
    color: var(--ck-color-list-button-on-text);
}

/* Set the styles for "Heading 2". */
.document-editor .ck-content h3 {
    line-height: 1.86em;
    padding-top: .171em;
    margin-bottom: .357em;
}

/* Set the styles for "Heading 3". */
.document-editor .ck-content h4,
.document-editor .ck-heading-dropdown .ck-heading_heading3 .ck-button__label {
    font-size: 1.31em;
    font-weight: bold;
}

.document-editor .ck-content h4 {
    line-height: 1.24em;
    padding-top: .286em;
    margin-bottom: .952em;
}

/* Set the styles for "Paragraph". */
.document-editor .ck-content p {
    font-size: 1em;
    line-height: 1.63em;
    padding-top: .5em;
    margin-bottom: 1.13em;
}
/* Make the block quoted text serif with some additional spacing. */
.document-editor .ck-content blockquote {
    font-family: Georgia, serif;
    margin-left: calc( 2 * var(--ck-spacing-large) );
    margin-right: calc( 2 * var(--ck-spacing-large) );
}
</style>

</style>

<div class="rb-article">
	<div data-role="loader">
		<div class="d-flex justify-content-center align-items-center border text-muted bg-white" style="height:215px">
			<div class="spinner-border mr-2" role="status"></div>
		</div>
	</div>

	<div class="border">
		<div class="document-editor__toolbar"></div>
		<div class="document-editor">
		    <div class="document-editor__toolbar"></div>
		    <div class="document-editor__editable-container">
		        <div class="document-editor__editable">
		            <?php echo $__SRC__?>
		        </div>
		    </div>
		</div>
	</div>


</div>

<?php
getImport('ckeditor5','decoupled-document/ckeditor','12.2.0','js');
getImport('ckeditor5','decoupled-document/translations/ko','12.2.0','js');
?>


<script>

var attach_file_saveDir = '<?php echo $g['path_file']?>bbs/';// 파일 업로드 폴더
var attach_module_theme = '_desktop/bs4-simple';// attach 모듈 테마

class rbUploadAdapter {
	constructor( loader ) {
		this.loader = loader;
	}

	upload() {
		return this.loader.file
			.then( file => new Promise( ( resolve, reject ) => {

				this._initRequest();
				this._initListeners( resolve, reject, file );
				this._sendRequest( file );
			} ) );
	}

	// Aborts the upload process.
	abort() {
		if ( this.xhr ) {
			this.xhr.abort();
		}
	}

	// Initializes the XMLHttpRequest object using the URL passed to the constructor.
	_initRequest() {
		const xhr = this.xhr = new XMLHttpRequest();
		xhr.open( 'POST', rooturl+'/?r='+raccount+'&m=mediaset&a=upload', true );
		xhr.responseType = 'json';
	}

	// Initializes XMLHttpRequest listeners.
	_initListeners( resolve, reject, file ) {
		const xhr = this.xhr;
		const loader = this.loader;
		const genericErrorText = `업로드 에러.: ${ file.name }.`;

		xhr.addEventListener( 'error', () => reject( genericErrorText ) );
		xhr.addEventListener( 'abort', () => reject() );
		xhr.addEventListener( 'load', () => {
			const response = xhr.response;
			if ( !response || response.error ) {
				return reject( response && response.error ? response.error.message : genericErrorText );
			}
			resolve( {
				default: response.url
			} );

			//첨부 목록에 삽입
			const attach_type  = response.type;
			const attach_item  = response.preview_default;

			if (attach_type=='photo') {
				$('[data-role="attach-preview-photo"]').append(attach_item)
			}
		} );

		if ( xhr.upload ) {
			xhr.upload.addEventListener( 'progress', evt => {
				if ( evt.lengthComputable ) {
					loader.uploadTotal = evt.total;
					loader.uploaded = evt.loaded;
				}
			} );
		}
	}

	_sendRequest( file ) {
		const data = new FormData();
		data.append( 'files', file );
		data.append( 'saveDir', attach_file_saveDir );
		data.append( 'theme', attach_module_theme );
		data.append( 'hidden', 1 );  // 본문삽입의 경우 첨부목록에서 숨김
		this.xhr.send( data );
	}
}


function rbUploadAdapterPlugin( editor ) {
	editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
		return new rbUploadAdapter( loader );
	};
}

function InserHTMLtoEditor( type,html,src,caption ) {
	const content = html;
	const viewFragment = editor.data.processor.toView( content );
	const modelFragment = editor.data.toModel( viewFragment );
	editor.model.insertContent( modelFragment );
}

DecoupledEditor
	.create( document.querySelector( '.document-editor__editable' ),{
		language: 'ko',
    extraPlugins: [rbUploadAdapterPlugin]
	} )
	.then( editor => {
		$('[data-role="loader"]').addClass('d-none') //로더 제거
		const toolbarContainer = document.querySelector( '.document-editor__toolbar' );
		toolbarContainer.appendChild( editor.ui.view.toolbar.element );
		window.editor = editor;
	})
	.catch( error => {
			console.error( error );
	} );

</script>
