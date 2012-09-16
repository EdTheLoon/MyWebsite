<?php
session_start();
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