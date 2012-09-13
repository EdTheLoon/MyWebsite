<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edj the Loon [DOT] com</title>
    <link rel="stylesheet" href="/stylesheets/default.css" type="text/css">
</head>
<body>
    <?php include "top.php"; ?>
	<!-- MAIN CONTENT -->
	<section id="main">
		<?php
			if (isset($_SESSION['success'])) {
				if($_SESSION['success'] = "You're email address is validated! You've been automatically logged in and can now use the site!")
				{
					?>
					<section class="post">
							<article>
								<header>
									<h1>User activated!</h1>
								</header>
								<hr>
								You're user has been successfully activated and
								you're now logged in! You can now enjoy the
								benefits of being a registered user!
							</article>
						</section>
					<?php
				} else {
					?>
					<section class="post">
					<article>
						<header>
							<h1>You are now logged in.</h1>
						</header>
						<hr>
						You have successfully logged into my website. Feel free to take a look around,
						read the blog posts, add your comments should you have any, change your password
						or whatever else it is you want to do!<br>
						<br>
						This site is still under heavy development so if you notice any bugs or have any
						suggestions then please feel free to <a href="">Contact Me</a> so that I can
						resolve any issues and continue to improve my website!<br>
						<br>
						Thanks!
						</article>
					</section>
					<?php
				}
			}
		?>
		<section class="post">
			<article>
				<header>
					<h1>Welcome!</h1>
				</header>
				<hr>
				Welcome to my website! This is the third site I'm constructing
				entirely by hand! If you happen to stumble across this site
				then please bare with me as there may be bugs and it doesn't
				yet have full functionality!<br><br><h2>Thank you!</h2>
			</article>
		</section>
	</section>
	<!-- END OF MAIN CONTENT -->
	<?php include "rest.php" ?>
</body>
</html>