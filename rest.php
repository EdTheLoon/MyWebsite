	<!-- SIDEBAR -->
	<section id="sidebar">
		<!-- USER CONTROLS -->
		<nav class="sidebox">
			<header>
				<h1>User Controls</h1>
			</header>
			<hr>
			<ul>
				<?php
					if (isset($_SESSION['uid'])) {
						echo "<li><a href=\"/edit/profile/\">Edit Profile</a></li>";							
						if ($_SESSION['addpost'] == 1) {
							echo "<li><a href=\"/submit/post/\">Submit Post</a></li>";
						}
						if ($_SESSION['edituser'] == 1) {
							echo "<li><a href=\"/edit/users/\">Add/Edit Users</a></li>";
						}						
						echo "<li><a href=\"/logout/\">Logout</a></li>";
					} else {
						echo "<li><a href=\"/login/\">Login</a></li>";
						echo "<li><a href=\"/register/\">Register</a></li>";
					}
				?>
			</ul>
		</nav>
		<!-- END OF USER CONTROLS -->
		
		<!-- WHO IS ONLINE -->
		<div class="sidebox">
			<header>
				<h1>Who's online</h1>
			</header>
			<hr>
			<ul>
				<li>Adrian</li>
				<li>Daz</li>
				<li>Steve</li>
			</ul>
		</div>
		<!-- END OF WHO IS ONLINE -->
		
		<!-- ADVERTISEMENT -->
		<div class="sidebox" style="height: 600px;">
			<header>
				<h1>Advertisement</h1>
			</header>
			<hr>
		</div>
		<!-- END OF ADVERTISEMENT -->
	</section>
	<!-- END OF SIDEBAR -->

	<!-- FOOTER -->
	<footer id="footer">
		Some copyright stuff | Ed the Loon | 2012
	</footer>
	<!-- END OF FOOTER -->

</section>
<!-- END OF WRAPPER -->