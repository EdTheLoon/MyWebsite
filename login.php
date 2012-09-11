<?php
    session_start();
	if (isset($_POST['submit'])) {
		require_once "res/db_config.php";
		unset($_SESSION['err'], $_SESSION['success']);
		
		// Retrieve information from posted form
		$user = mysql_real_escape_string($_POST['username']);
		$pass = md5($_POST['password'], false);
		
		$query = "SELECT uid, user, pass, validated FROM users WHERE user = '$user'";
		$result = mysql_query($query, $db_link);
		
		if ($result) {
			$row = mysql_fetch_array($result);
			$pass2 = $row['pass'];
			$uid = $row['uid'];
			
			if ($pass == $pass2) {
				$_SESSION['success'] = "You're now logged in!";
				header("Location: /home/");
				exit;
			} else {
				$_SESSION['err'] = "Incorrect password";
				header("Location: /login/");
				exit;
			}
		} else {
			$_SESSION['err'] = "Incorrect username";
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
    <!-- WRAPPER -->
    <section id="wrap">
        
        <!-- BANNER -->
        <section id="banner">
            <header>
                <h2>Banner</h2>
            </header>
            <p>A banner graphic goes here</p>  
        </section>
        <!-- END OF BANNER -->
        
        <!-- NAVIGATION -->
        <nav id="nav">
            <ul>
                <li><a href="/home/">Home</a></li>
                <li><a href="/blog/">Blog</a></li>
                <li><a href="/follow/">Follow</a></li>
                <li><a href="/projects/">Projects</a></li>
                <li><a href="/about/">About</a></li>
            </ul>
        </nav>
        <!-- END OF NAVIGATION -->
        
        <!-- MAIN CONTENT -->
        <section id="main">
            <section class="post" style="text-align: center;">
                <?php
                    if (isset($_SESSION['err'])) {
                        echo "<article><header><h1>Oops!</h1></header>" . $_SESSION['err'] . "</article>";
                    } else {
                        echo "<article><header><h1>Login</h1></header>Please login using the form below</article>";
						echo "Error: " . $_SESSION['err'];
						echo "<br>Success: " . $_SESSION['success'];
                    }
                ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input name="username" type="text" placeholder="Username" maxlength="20" /><br>
                    <input name="password" type="password" placeholder="Password" /><br>
                    <input type="submit" name="submit" value="Login" />
                </form>
				<?php
					unset($_SESSION['success'], $_SESSION['err']);
				?>
            </section>
        </section>
        <!-- END OF MAIN CONTENT -->
        
        <!-- SIDEBAR -->
        <section id="sidebar">
            <!-- USER CONTROLS -->
            <nav class="sidebox">
                <header>
                    <h1>User Controls</h1>
                </header>
                <hr>
                <ul>
                    <li><a href="/login/">Login</a></li>
                    <li><a href="/register/">Register</a></li>
                    <li><a href="/submit/post/">Submit Post</a></li>
                    <li><a href="/edit/profile/">Edit Profile</a></li>
                    <li><a href="/edit/users/">Add/Edit Users</a></li>
                    <li><a href="/logout/">Logout</a></li>
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
</body>
</html>