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
		if(!$_SESSION['uid'] == $puid) {
			$_SESSION['err'] = "You cannot ediot a post that is not yours!";
			header("Location: /failed/");
			exit;
		}

		// If all the checks are fine then update the post
		$query = "";
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
		if(!$_SESSION['uid'] == $puid) {
			$_SESSION['err'] = "You cannot ediot a post that is not yours!";
			header("Location: /failed/");
			exit;
		}

		// Check that the user can edit this post if it's not their own
		if ($_SESSION['editpost'] == 0) {
			$_SESSION['err'] = "You need to be logged in to do that!<br>
								<a href=\"/login/\">Login here</a>";
			header("Location: /failed/");
			exit;
		}

		// If all the checks above go through fine then we can load the post details
	}
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="/stylesheets/default.css" type="text/css">
</head>
<body>
	<?php include "top.php"; ?>
    <!-- MAIN CONTENT -->
	<section id="main">
		<section class="post">
			<article>
				<header>
					<h1>Title</h1>
				</header>
				<hr>
				Content
			</article>
		</section>
	</section>
	<!-- END OF MAIN CONTENT -->
    <?php include "rest.php"; ?>
</body>
</html>