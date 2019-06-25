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
		.catch( error => {
				console.error( error );
		} );
})
</script>
