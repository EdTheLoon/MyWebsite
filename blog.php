<?php
    session_start();
	require_once "res/db_config.php";

	// Grab post details
	$query = "SELECT posts.pid, posts.title, posts.content, posts.date, users.user, users.uid
		FROM posts, users
		WHERE posts.uid = users.uid
		ORDER BY date DESC
		LIMIT 10";
	$result = mysql_query($query, $db_link);
	$errno = mysql_errno($db_link);

	if ($errno != 0) {
		$_SESSION['err'] = "Unknown error<br>" . mysql_error();
		header("Location: /failed/");
		exit;
	} else {
		$posts = "";
		while($row = mysql_fetch_array($result)){
			$puid = $row['uid'];
			$ppid = $row['pid'];
			$author = $row['user'];
			$title = $row['title'];
			$content = $row['content'];
			$date = $row['date'];

			$posts = $posts . "
			<section class=\"post\">
				<article>
				<header>
					<h1><a href=\"/post/$ppid/\">$title</a></h1><div id=\"info\">Posted on $date by <a href=\"#\">$author</a></div>
				</header>
				<hr>
				$content
				</article>
			</section>
			";
		}
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
			<?php echo $posts; ?>
	</section>
	<!-- END OF MAIN CONTENT -->
	<?php include "rest.php"; ?>

    <!-- JAVASCRIPT -->
    <script type="text/javascript">
        function hideComments() {
            var comments = document.getElementsByClassName('comments');
            var len = comments.length;
            for (i = 0; i < len; i++) {
                comments[i].style.display = 'none';
            }
        }
        function showHide(elid) {
            var el = document.getElementById(elid);
            if (el.style.display == 'none')
            {
                el.style.display = 'block';
            } else {
                el.style.display = 'none';
            }
        }
        window.onload=hideComments();
    </script>
    <!-- END OF JAVASCRIPT -->
</body>
</html>