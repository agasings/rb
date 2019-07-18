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
getImport('ckeditor5','balloon-block/build/ckeditor','12.2.0','js');
getImport('ckeditor5','balloon-block/build/translations/ko','12.2.0','js');
?>

<script src="<?php echo $g['s'] ?>/plugins/ckeditor5/_main.js" ></script>

<script>

let editor;

BalloonEditor
.create( document.querySelector( '#ckeditor_textarea' ),{
	language: 'ko',
	extraPlugins: [rbUploadAdapterPlugin],
	typing: {
			transformations: {
					include: [
							// Use only the 'quotes' and 'typography' groups.
							'quotes',
							'typography',
							'arrowLeft',
							'arrowRight',

							// Plus, some custom transformation.
							{ from: 'CKE', to: 'CKEditor' }
					],

					extra: [
							// Add some custom transformations – e.g. for emojis.
							{ from: ':)', to: '🙂' },
							{ from: ':+1:', to: '👍' },
							{ from: ':tada:', to: '🎉' }
					],
			}
	},
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
