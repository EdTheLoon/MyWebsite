<?php
	session_start();
	require_once "res/db_config.php";
	if (isset($_GET['pid'])) {
		$pid = $_GET['pid'];
	} else {
		$query = "SELECT pid FROM posts ORDER BY pid DESC LIMIT 1";
		$result = mysql_query($query, $db_link);
		$row = mysql_fetch_array($result);
		$pid = $row['pid'];
	}

	$query = "SELECT posts.title, posts.content, posts.date
	FROM posts
	WHERE posts.pid = $pid
	LIMIT 1";
	$result = mysql_query($query, $db_link);
	$errno = mysql_errno($db_link);

	if ($errno != 0) {
		$_SESSION['err'] = "Unknown error<br>" . mysql_error();
		header("Location: /failed/");
	} else {
		$row = mysql_fetch_array($result);
		$puid = $row['uid'];
		$title = $row['title'];
		$content = $row['content'];
		$date = $row['date'];
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
					<h1><?php echo $title; ?></h1>
				</header>
				<hr>
				<?php echo $content; ?>
			</article>
		</section>
	</section>
	<!-- END OF MAIN CONTENT -->
    <?php include "rest.php"; ?>
</body>
</html>