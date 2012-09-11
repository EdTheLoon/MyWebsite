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
					<h1>About this website</h1>
				</header>
				<hr>
				This is a personal website that I, Ed the Loon, work on in my own free time as part of my hobby.
				It is still under quite a lot of heavy development and once I have all the features I would like
				to have implemented I will be then working on giving it a graphic overhaul!<br><br>
				I have coded this website <strong>COMPLETELY BY HAND</strong> using <i>Notepad++</i> as my
				editing software!
			</article>
		</section>
		<section class="post">
			<article>
				<header>
					<h1>About Ed the Loon</h1>
				</header>
				<hr>
				I am just an average guy that likes to programme in my own spare time. I have knowledge of .NET, 
				Java, PHP, mySQL and some small knowledge of C# and C++.
				<br>
				<br>
				I studied HNC Computing: Software Development at Aberdeen College and passed with 100% in my exam. 
				I did go onto do a HND in Computing: Software Development but later decided that computing was not
				what I wanted to do with my career and dropped out. I am now a Team Leader in a highly resputable
				catalogue sales store.
			</article>
		</section>
	</section>
	<!-- END OF MAIN CONTENT -->
    <?php include "rest.php"; ?>
</body>
</html>