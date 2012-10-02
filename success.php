<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $_SESSION['success_title']; ?></title>
    <link rel="stylesheet" href="/stylesheets/default.css" type="text/css">
</head>
<body>
	<?php include "top.php"; ?>
    <!-- MAIN CONTENT -->
	<section id="main">
		<section class="post">
			<article style="text-align: center;">
				<header>
					<h1><?php echo $_SESSION['success_title']; ?></h1>
				</header>
				<hr>
				<?php echo $_SESSION['success_content']; ?>
			</article>
		</section>
	</section>
	<!-- END OF MAIN CONTENT -->
    <?php
    	include "rest.php";
    	unset($_SESSION['success_title'], $_SESSION['success_content']);
	?>
</body>
</html>