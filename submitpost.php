<?php
	session_start();
	require_once "res/db_config.php";

	if (!isset($_SESSION['uid'])) {
		$_SESSION['err'] = "You need to be logged in to submit a new post!";
		header("Location: /login/");
	} else if ($_SESSION['addpost'] == 0) {
		$_SESSION['err'] = "You don't have permission to add posts!";
		header("Location: /failed/");
	} else if (isset($_POST['submit'])) {
		require_once("res/db_config.php");
		unset($_SESSION['success_title'], $_SESSION['success_content'], $_SESSION['err']);

		// Grab the session and form variables being used to post this item
		$uid = $_SESSION['uid'];
		$title = $_POST['title'];
		$content = $_POST['content'];

		$query = "INSERT INTO posts (uid, date, title, content) VALUES (
					$uid,
			    	NOW(),
			    	'$title',
			    	'$content')";
		$result = mysql_query($query, $db_link);
		$errno = mysql_errno($db_link);

		if ($errno == 0) {
			$query = "SELECT pid FROM posts WHERE uid='$uid'";
			$result = mysql_query($query, $db_link);
			$row = mysql_fetch_array($result);
			$pid = $row['pid'];
			header("Location: /post/$pid/");
		} else {
			$_SESSION['err'] = "Unknown error...<br>" . mysql_error();
			header("Location: /failed/");
		}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="/stylesheets/default.css" type="text/css">
    <link rel="stylesheet" href="/tinyeditor.css" type="text/css">
    <script src="/tiny.editor.packed.js"></script>
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
				<textarea name="content" id="content" style="width: 620px; height: 310px; padding-left: 10px;" ></textarea><br>
				<script>
					var editor = new TINY.editor.edit('editor', {
					id: 'content',
					width: 637,
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
				<input name="submit" type="submit" value="Add Post" onclick="editor.post();" />
			</form>
			</article>
		</section>
	</section>
	<!-- END OF MAIN CONTENT -->

	<!-- JAVASCRIPT WYSIWYG EDITOR -->
    <?php include "rest.php"; ?>
</body>
</html>