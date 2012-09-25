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
		$title = htmlentities($_POST['title']);
		$content = addslashes($_POST['content']);

		$query = "INSERT INTO posts (uid, date, title, content) VALUES (
					$uid,
			    	NOW(),
			    	'$title',
			    	'$content')";
		$result = mysql_query($query, $db_link);
		$errno = mysql_errno($db_link);

		if ($errno == 0) {
			$query = "SELECT pid FROM posts WHERE uid='$uid' ORDER BY date DESC LIMIT 1";
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
    <title>Add a blog post</title>
    <link rel="stylesheet" href="/stylesheets/default.css" type="text/css">
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <link rel="stylesheet" href="/sceditor/minified/jquery.sceditor.min.css" type="text/css" media="all" />
	<script type="text/javascript" src="/sceditor/minified/jquery.sceditor.min.js"></script>
	<script type="text/javascript" src="/sceditor/languages/en.js"></script>
	<script>
	$(document).ready(function() {
		$("textarea").sceditorBBCodePlugin({
			locale: "en-GB",
			emoticonsCompat: true,
			resizeMinWidth: 638,
			resizeMinHeight: 270,
			resizeMaxWidth: 638,
			resizeMaxHeight: -1,
			dateFormat: "day-month-year",
		});
	});
</script>
</head>
<body>
	<?php include "top.php"; ?>
    <!-- MAIN CONTENT -->
	<section id="main">
		<section class="post">
			<article>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="text-align: center;">
				<header>
					<input name="title" type="text" placeholder="Title of your post" maxlength="50" style="width: 636px;" /><br>
				</header>
				<hr>
				<textarea name="content" id="content" style="width: 638px; height: 270px; padding-left: 10px;" ></textarea>
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