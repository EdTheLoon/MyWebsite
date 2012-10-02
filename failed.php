<?php
session_start();
if (!isset($_SESSION['err'])) {
	$_SESSION['err'] = "Something went wrong!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Oops!</title>
    <link rel="stylesheet" href="/stylesheets/default.css" type="text/css">
</head>
<body>
	<?php include "top.php"; ?>
    <!-- MAIN CONTENT -->
	<section id="main">
		<section class="post" style="text-align: center;">
			<article>
				<header>
					<h1>Oops!</h1>
				</header>
				<hr>
				<?php echo $_SESSION['err']; ?>
			</article>
		</section>
	</section>
	<!-- END OF MAIN CONTENT -->
    <?php
    	include "rest.php";
    	unset($_SESSION['err']);
    ?>
</body>
</html>