<?php
    session_start();
	require_once "res/db_config.php";
	require_once "res/bbcode.php";

	// Check to see if we're fetching a certain page
	if(isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	}

	// Do the maths to calculate our starting point for posts
	if ($page == 1) {
		$startat = 0;
	} else {
		$startat = ($page-1)*5;
	}

	// For the purposes of paging, see how many rows we have in our database
	$query = "SELECT pid FROM posts;";
	$result = mysql_query($query, $db_link);
	$numposts = mysql_num_rows($result);

	// Grab post details
	$query = "SELECT posts.pid, posts.title, posts.content, posts.date, users.user, posts.uid
		FROM posts, users
		WHERE posts.uid = users.uid
		ORDER BY date DESC
		LIMIT $startat,5";
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
			$content = bbcode::tohtml($content,TRUE); // Convert BBCode to HTML
			$content = stripslashes($content);
			$content = html_entity_decode($content);
			$datetime = strtotime($row['date']);
			$date = date("j/m/y \a\\t H:i", $datetime);

			$editdelete = "";
			if ($_SESSION['uid'] == $puid) {
				$editdelete = "<p style=\"text-align:right; font-size:10px;\"><a href=\"/edit/post/$ppid/\">[EDIT]</a> | <a href=\"/delete/post/$ppid/\"> [DELETE]</a></p>";
			} else if ($_SESSION['editpost'] == 1) {
				$editdelete = "<p style=\"text-align:right; font-size:10px;\"><a href=\"/edit/post/$ppid/\">[EDIT]</a> | <a href=\"/delete/post/$ppid/\"> [DELETE]</a></p>";
			}

			$posts = $posts . "
			<section class=\"post\">
				<article>
				<header>
					<h1><a href=\"/post/$ppid/\">$title</a></h1><div id=\"info\">Posted on $date by <a href=\"#\">$author</a></div>
				</header>
				<hr>
				$content $editdelete
				</article>
			</section>
			";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ed the Loon's Blog</title>
    <link rel="stylesheet" href="/stylesheets/default.css" type="text/css">
</head>
<body>
	<?php include "top.php"; ?>
	<!-- MAIN CONTENT -->
	<section id="main">
			<!-- BLOG POSTS -->
			<?php echo $posts; ?>

			<!-- PAGE BAR (if there is one) -->
			<div style="text-align: center;">Page Navigation<br>
				<?php
					$maxPage = ceil($numposts/5);
					$pagelinks = "";
					if ($numposts > 5) {
						if ($page > 1) {
							$pagelinks = $pagelinks . "<a href=\"/blog/" . ($page-1) . "/\">Newer</a>";
						}
						if (($page < $maxPage) && ($page> 1)) {
							$pagelinks = $pagelinks . " | ";
						}
						if ($page < $maxPage) {
							$pagelinks = $pagelinks . "<a href=\"/blog/" . ($page+1) . "/\">Older</a>";
						}
						echo $pagelinks . "<br><br>";
					}
				?>
			</div>
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