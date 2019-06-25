<?php
if(!defined('__KIMS__')) exit;
?>

<style>
/* 툴바 감추기 설정 - 게시판 테마 */
<?php if (!$d['theme']['show_edittoolbar']): ?>
#cke_1_top {display: none}
<?php endif; ?>
</style>

<div class="rb-article">
	<div data-role="loader">
		<div class="d-flex justify-content-center align-items-center border text-muted bg-white" style="height:215px">
			<div class="spinner-border mr-2" role="status"></div>
		</div>
	</div>
	<textarea name="content" class="form-control ckeditor d-none" id="ckeditor_textarea"><?php echo $__SRC__?></textarea>
</div>

<?php
getImport('ckeditor5','ckeditor','12.2.0','js');
getImport('ckeditor5','translations/ko','12.2.0','js');
?>


<script>

function InserHTMLtoEditor(type,sHTML) {
	CKEDITOR.instances['ckeditor_textarea'].insertHtml(sHTML);
}

$(function() {
	ClassicEditor
		.create( document.querySelector( '#ckeditor_textarea' ),{
			language: 'ko',
		} )
		.then( editor => {
			$('[data-role="loader"]').addClass('d-none') //로더 제거
		})
		.catch( error => {
				console.error( error );
		} );
})
</script>
