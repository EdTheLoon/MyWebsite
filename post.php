<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="/stylesheets/default.css" type="text/css">
    <link rel="stylesheet" href="tinyeditor.css" type="text/css">
    <script src="tiny.editorpacked.js"></script>
</head>
<body>
	<?php include "top.php"; ?>
    <!-- MAIN CONTENT -->
	<section id="main">
		<section class="post">
			<article>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="text-align: center;">
				<header>
					<input name="title" type="text" placeholder="Title of your post" maxlength="50" style="width: 620px;" /><br>
				</header>
				<hr>
				<textarea name="content" id="content" style="width: 620px; height: 310px;" ></textarea><br>
				<script>
					var editor = new TINY.editor.edit('editor', {
					id: 'content',
					width: 620,
					height: 310,
					cssclass: 'tinyeditor',
					controlclass: 'tinyeditor-control',
					rowclass: 'tinyeditor-header',
					dividerclass: 'tinyeditor-divider',
					controls: ['bold', 'italic', 'underline', 'strikethrough', '|', 'subscript', 'superscript', '|',
						'orderedlist', 'unorderedlist', '|', 'outdent', 'indent', '|', 'leftalign',
						'centeralign', 'rightalign', 'blockjustify', '|', 'unformat', '|', 'undo', 'redo', 'n',
						'font', 'size', 'style', '|', 'image', 'hr', 'link', 'unlink', '|', 'print'],
					footer: true,
					fonts: ['Verdana','Arial','Georgia','Trebuchet MS'],
					xhtml: true,
					bodyid: 'editor',
					footerclass: 'tinyeditor-footer',
					toggle: {text: 'source', activetext: 'wysiwyg', cssclass: 'toggle'},
					resize: {cssclass: 'resize'}
				});
				</script>
				<input name="submit" type="submit" value="Add Post" />
			</form>
			</article>
		</section>
	</section>
	<!-- END OF MAIN CONTENT -->

	<!-- JAVASCRIPT WYSIWYG EDITOR -->
    <?php include "rest.php"; ?>
</body>
</html>