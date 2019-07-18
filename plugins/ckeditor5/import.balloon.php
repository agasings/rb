<?php
if(!defined('__KIMS__')) exit;
?>

<div class="rb-article">
	<div data-role="loader">
		<div class="d-flex justify-content-center align-items-center border text-muted bg-white" style="height:215px">
			<div class="spinner-border mr-2" role="status"></div>
		</div>
	</div>
	<div data-role="editor" class="d-none">
		<input type="hidden" name="content" value="">
		<div id="ckeditor_textarea" class="border">
			<?php echo getContents($R['content'],$R['html'],'')?>
		</div>
	</div>
</div>

<?php
getImport('ckeditor5','balloon/build/ckeditor','12.2.0','js');
getImport('ckeditor5','balloon/build/translations/ko','12.2.0','js');
?>

<script src="<?php echo $g['s'] ?>/plugins/ckeditor5/_main.js" ></script>

<script>

let editor;

BalloonEditor
.create( document.querySelector( '#ckeditor_textarea' ),{
	language: 'ko',
	extraPlugins: [rbUploadAdapterPlugin],
	image: {
			// You need to configure the image toolbar, too, so it uses the new style buttons.
			toolbar: [ 'imageStyle:alignLeft', 'imageStyle:full', 'imageStyle:alignRight' ],

			styles: [
					// This option is equal to a situation where no style is applied.
					'full',

					// This represents an image aligned to the left.
					'alignLeft',

					// This represents an image aligned to the right.
					'alignRight'
			]
	}
} )
.then( newEditor => {
	editor = newEditor;
	$('[data-role="loader"]').addClass('d-none') //로더 제거
	$('[data-role="editor"]').removeClass('d-none')
})
.catch( error => {
		console.error( error );
} );

</script>
