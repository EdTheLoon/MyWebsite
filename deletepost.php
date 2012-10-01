<?php
	session_start();

	// Check that the user is logged in
	if(!isset($_SESSION['uid'])) {
		$_SESSION['err'] = "You need to be logged in to do that!<br>
							<a href=\"/login/\">Login here</a>";
		header("Location: /failed/");
		exit;
	}

	// Check that a PID was provided
	if(!isset($_GET['pid'])) {
		$_SESSION['err'] = "You didn't specify a post to delete!";
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
	}
	// Finally check if the user editing is the post's original author
	if($_SESSION['uid'] != $puid) {
		if($_SESSION['editpost'] == 0) {
			$_SESSION['err'] = "You cannot delete a post that is not yours!";
			header("Location: /failed/");
			exit;
		}
	}

	// If all the checks are fine then delete the post
	$query = "DELETE FROM posts WHERE pid=$pid";
	$result = mysql_query($query, $db_link);
	$errno = mysql_errno($db_link);
	if ($errno == 0) {
		$_SESSION['success_title'] = "";
		$_SESSION['success_content'] = "";
		header("Location: /success/");
		exit;
	} else {
		$_SESSION['err'] = "Unknown error ($errno)<br>" . mysql_error();
		header("Location: /failed/");
		exit;
	}
?>