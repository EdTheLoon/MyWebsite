<?php
	session_start();
	require_once "res/db_config.php";
	require_once "res/bbcode.php";

	if (isset($_GET['pid'])) {
		$pid = $_GET['pid'];
	} else {
		$query = "SELECT pid FROM posts ORDER BY pid DESC LIMIT 1";
		$result = mysql_query($query, $db_link);
		$row = mysql_fetch_array($result);
		$pid = $row['pid'];
	}

	// Grab post details
	$query = "SELECT posts.pid, posts.title, posts.content, posts.date, users.user, posts.uid
	FROM posts, users
	WHERE posts.pid = $pid
	AND posts.uid = users.uid
	LIMIT 1";
	$result = mysql_query($query, $db_link);
	$errno = mysql_errno($db_link);

	if ($errno != 0) {
		$_SESSION['err'] = "Unknown error<br>" . mysql_error();
		header("Location: /failed/");
		exit;
	} else {
		$row = mysql_fetch_array($result);
		$puid = $row['uid'];
		$ppid = $row['pid'];
		$author = $row['user'];
		$title = $row['title'];
		$content = $row['content'];
		$datetime = strtotime($row['date']);
		$date = date("j/m/y \a\\t H:i", $datetime);

		// Convert BBCode to HTML
		$content = bbcode::tohtml($content,TRUE);
		$content = stripslashes($content);
		$content = html_entity_decode($content);
	}

	// Grab post comments

/*
$query = "SELECT users.uid, users.user, date, content
	FROM comments, users
	WHERE comments.uid = users.uid
	AND comments.pid = $ppid";
	$result = mysql_query($query, $db_link);
	$errno = mysql_errno($db_link);

	if ($errno != 0) {
		$_SESSION['err'] = "Unknown comments error<br>" . mysql_error();
		header("Location: /failed/");
		exit;
	}
*/
 // Do an else if here when ready to add comments capability
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo "$title - $author"; ?></title>
    <link rel="stylesheet" href="/stylesheets/default.css" type="text/css">
</head>
<body>
	<?php include "top.php"; ?>
    <!-- MAIN CONTENT -->
	<section id="main">
		<section class="post">
			<article>
				<header>
					<?php echo "<h1><a href=\"/post/$ppid/\">$title</a></h1><div id=\"info\">Posted on $date by <a href=\"#\">$author</a></div>"; ?>
				</header>
				<hr>
				<?php
					echo $content;
					if ($_SESSION['uid'] == $puid) {
						echo "<p style=\"text-align:right; font-size:10px;\"><a href=\"/edit/post/$ppid/\">[EDIT]</a> | <a href=\"/delete/post/$ppid/\"> [DELETE]</a></p>";
					} else if ($_SESSION['editpost'] == 1) {
						echo "<p style=\"text-align:right; font-size:10px;\"><a href=\"/edit/post/$ppid/\">[EDIT]</a> | <a href=\"/delete/post/$ppid/\"> [DELETE]</a></p>";
					}
				?>
			</article>
			<details class="comments" id ="<?php echo "comments$pid"; ?>">
				<summary>
					Comments
				</summary>
				<article>
                        <header>
                            <a href="#">Daz</a> on <time datetime=
                            "2012-05-02T14:03:25+00:00">2nd May 2012</time>
                        </header>
                        WOOOOOOOOOOO!
                    </article>
                    <article>
                        <header>
                            <a href="#">Steve</a> on <time datetime=
                            "2012-05-02T14:03:25+00:00">2nd May 2012</time>
                        </header>
                        OH MY GOSH!
                    </article>
                    <article>
                        <header>
                            <a href="#">Daz</a> on <time datetime=
                            "2012-05-02T14:03:25+00:00">2nd May 2012</time>
                        </header>
                        BOOOHOOO!
                    </article>
			</details>
		</section>
	</section>
	<!-- END OF MAIN CONTENT -->
    <?php include "rest.php"; ?>
</body>
</html>