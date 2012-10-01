<?php
	session_start();
	require_once "res/db_config.php";

	// Check if we're updating a post or showing the editor...
	if(isset($_POST['submit'])) {
		// Check that a PID was provided
		if(!isset($_POST['pid'])) {
			$_SESSION['err'] = "You didn't specify a post to edit!";
			header("Location: /failed/");
			exit;
		}

		// Check that the user is logged in
		if(!isset($_SESSION['uid'])) {
			$_SESSION['err'] = "You need to be logged in to do that!<br>
								<a href=\"/login/\">Login here</a>";
			header("Location: /failed/");
			exit;
		}

		// Retrieve the PID provided
		$pid = $_POST['pid'];

		// Retrieve the post's author's UID to see if they can edit their own post
		$query = "SELECT uid FROM posts WHERE pid=$pid";
		$result = mysql_query($query, $db_link);
		$errno = mysql_errno($db_link);
		if ($errno == 0) {
			$row = mysql_fetch_array($result);
			$puid = $row['uid'];
		} else {
			$_SESSION['err'] = "Unknown error ($errno)<br>" . mysql_error();
		}
		// Finally check if the user editing is the post's original author
		if($_SESSION['uid'] != $puid) {
			if($_SESSION['editpost'] == 0) {
				$_SESSION['err'] = "You cannot edit a post that is not yours!";
				header("Location: /failed/");
				exit;
			}
		}

		// If all the checks are fine then update the post
		$title = htmlentities($_POST['title']);
		$content = addslashes($_POST['content']);
		$content = htmlentities($content);
		$query = "UPDATE posts SET title='$title', content='$content'
					WHERE pid=$pid";
		$result = mysql_query($query, $db_link);
		$errno = mysql_errno($db_link);
		if ($errno == 0) {
			header("Location: /post/$pid/");
			exit;
		} else {
			$_SESSION['err'] = "Unknown error ($errno)<br>" . mysql_error();
			header("Location: /failed/");
			exit;
		}
	} else {
		// Check that a PID was provided
		if(!isset($_GET['pid'])) {
			$_SESSION['err'] = "You didn't specify a post to edit!";
			header("Location: /failed/");
			exit;
		}

		// Check that the user is logged in
		if(!isset($_SESSION['uid'])) {
			$_SESSION['err'] = "You need to be logged in to do that!<br>
								<a href=\"/login/\">Login here</a>";
			header("Location: /failed/");
			exit;
		}

		// Retrieve the PID provided
		$pid = $_GET['pid'];

		// Retrieve the post's author's UID to see if they can edit their own post
		$query = "SELECT uid FROM posts WHERE pid=$pid";
		$result = mysql_query($query, $db_link);
		$errno = mysql_errno($db_link);
		if ($errno == 0) {
			$row = mysql_fetch_array($result);
			$puid = $row['uid'];
		} else {
			$_SESSION['err'] = "Unknown error ($errno)<br>" . mysql_error();
			header("Location: /failed/");
			exit;
		}
		// Finally check if the user editing is the post's original author
		if($_SESSION['uid'] != $puid) {
			if($_SESSION['editpost'] == 0) {
				$_SESSION['err'] = "You cannot edit a post that is not yours!";
				header("Location: /failed/");
				exit;
			}
		}

		// Check that the user can edit this post if it's not their own
		if (($_SESSION['editpost'] == 0) && ($_SESSION['uid'] != $puid)) {
			$_SESSION['err'] = "You don't have the authority to do that!";
			header("Location: /failed/");
			exit;
		}

		// If all the checks above go through fine then we can load the post details
		$query = "SELECT title, content FROM posts WHERE pid=$pid";
		$result = mysql_query($query, $db_link);
		$errno = mysql_errno($db_link);
		if ($errno == 0) {
			$row = mysql_fetch_array($result);
			$title = $row['title'];
			$content = stripslashes($row['content']);
			$content = html_entity_decode($content);
		} else {
			$_SESSION['err'] = "Unknown error ($errno)<br>" . mysql_error();
			header("Location: /failed/");
			exit;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Post - <?php echo $title; ?></title>
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
					<input name="title" type="text" value="<?php echo $title; ?>" placeholder="Title of your post" maxlength="50" style="width: 636px;" /><br>
				</header>
				<hr>
				<textarea name="content" id="content" style="width: 638px; height: 270px; padding-left: 10px;" ><?php echo $content; ?></textarea>
				<input type="hidden" name="pid" value="<?php echo $pid; ?>" />
				<input name="submit" type="submit" value="Update Post" />
			</form>
			</article>
		</section>
	</section>
	<!-- END OF MAIN CONTENT -->
    <?php include "rest.php"; ?>
</body>
</html>