<?php
    session_start();
	if (isset($_POST['submit'])) {
		require_once "res/db_config.php";
		unset($_SESSION['success_title'], $_SESSION['success_content'], $_SESSION['err']);

		// Retrieve information from posted form
		$user = mysql_real_escape_string($_POST['username']);
		$pass = md5($_POST['password'], false);

		$query = "SELECT uid, user, pass, validated FROM users WHERE user = '$user'";
		$result = mysql_query($query, $db_link);

		if ($result) {
			$row = mysql_fetch_array($result);
			$pass2 = $row['pass'];
			$validated = $row['validated'];
			$uid = $row['uid'];

			if ($pass == $pass2) {
				if($validated == 1) {
					$_SESSION['success_title'] = "Welcome back, $user!";
					$_SESSION['success_content'] = 'You\'re now logged in!
						Thank you for coming to visit again!';
					$_SESSION['uid'] = $uid;

					// Get users permissions
					$query = "SELECT edituser, addpost, editpost, addcomment, editcomment FROM users WHERE uid = '$uid'";
					$result = mysql_query($query);
					$row = mysql_fetch_array($result);
					$_SESSION['edituser'] = $row['edituser'];
					$_SESSION['addpost'] = $row['addpost'];
					$_SESSION['editpost'] = $row['editpost'];
					$_SESSION['addcomment'] = $row['addcomment'];
					$_SESSION['editcomment'] = $row['editcomment'];

					header("Location: /success/");
					exit;
				} else {
					$_SESSION['err'] = "You need to activate your account by clicking on the activation link sent to you by email";
					header("Location: /login/");
					exit;
				}
			} else {
				$_SESSION['err'] = "Incorrect username or password";
				header("Location: /login/");
				exit;
			}
		} else {
			$_SESSION['err'] = "Incorrect username or password";
			header("Location: /login/");
			exit;
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
		<section class="post" style="text-align: center;">
			<?php
				if (isset($_SESSION['err'])) {
					echo "<article><header><h1>Oops!</h1></header><hr>" . $_SESSION['err'] . "</article>";
				} else if (isset($_SESSION['success'])) {
					echo "<article><header><h1>Success!</h1></header><hr>" . $_SESSION['success'] . "</article>";
				} else {
					echo "<article><header><h1>Login</h1></header><hr>Please login using the form below</article>";
				}
			?>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<input name="username" type="text" placeholder="Username" maxlength="20" /><br>
				<input name="password" type="password" placeholder="Password" /><br>
				<input type="submit" name="submit" value="Login" style="width: 158px; height: 30px;" />
			</form>
			Don't have an account? <a href="/register/">Create one here!</a>
			<?php
				unset($_SESSION['success'], $_SESSION['err']);
			?>
		</section>
	</section>
	<!-- END OF MAIN CONTENT -->
	<?php include "rest.php" ?>
</body>
</html>