<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="/stylesheets/default.css" type="text/css">
</head>
<body>a
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