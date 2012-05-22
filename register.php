<?php
    session_start();
    if (isset($_POST["submit"])) {
        require "res/db_config.php";
        unset($_SESSION["success"], $_SESSION["err"]);
        
        $user = $_POST["username"];
        $pass = $_POST["password"];
        $email = $_POST["email"];
        $to = $email;
        $ip = $_SERVER["REMOTE_ADDR"];
        
        $err = array();
        
        if (strlen($user) < 1 || strlen($user) > 32)
        {
            $err[] = "Your username must be between 1 and 32 characters";
        }
        
        if (preg_match("/[^a-z0-9]+/i", $user))
        {
            $err[] = "Your username can only contain letters a-z and numbers 0-9";
        }
        
        if(!preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $email))
        {
            $err[] = "Your email address is not valid";
        }
        
        $user = mysql_real_escape_string($user);
        $email = mysql_real_escape_string($email);
        $pass = md5($pass, false);
        $key = substr(md5($pass, false),0,6);
        
        if(!count($err))
        {
            $query = "INSERT INTO users (user, pass, email, ip, dt, validkey) VALUES (
                    '$user',
                    '$pass',
                    '$email',
                    '$ip',
                    NOW(),
                    '$key')";
            $result = mysql_query($query, $db_link);
            
            if($result) {
                $subject = "Confirm Email for www.edtheloon.com";
                
                $emailbody = "
                <html>
                <head><title>Confirm your email address</title></head>
                <body>
                You or someone else used your email to register on
                <a href='www.edtheloon.com'>www.edtheloon.com</a>. In order to
                use the site you must activate your account by clicking the link
                below.<br><a href='http://www.edtheloon.com/validate.php?user=$user&key=$key/'>http://www.edtheloon.com/validate/user=$user&key=$key/</a>
                <br>If the above link does not work simply copy and paste it into
                your browser.<br><br>www.edtheloon.com
                </body>
                </html>";
                          
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers = $headers . "Content-type:text/html;charset=iso-8859-1" . "\r\n";
                $headers = $headers . "From: Ed the Loon <noreply@edtheloon.com>" . "\r\n";
                if (mail($to, $subject, $emailbody, $headers))
                {
                    $_SESSION["success"] = "The last step is to confirm your email address. Please check your inbox and spam folders";
                } else {                    
                    $err[] = "There was a problem in sending you a validation link";
                }
            } else {
                $err[] = "There was a problem adding your data to the database<br>" . mysql_error();
            }
        }
        
        if(count($err))
        {
            $_SESSION["err"] = implode("<br>", $err);
        }
        
        header("Location: /register/");
        exit;
    }
?>
<!--  END OF PHP CONTENT -->
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
                    if (isset($_SESSION["success"]))
                    {
                        ?>
                            <article>
                                <header>
                                    <h1>Success!</h1>
                                </header>
                                <?php
                                    echo $_SESSION["success"];
                                ?>
                            </article>
                        <?php
                    }
                    if ($_SESSION["err"])
                    {
                        echo "<header><h1>Oops!</h1></header>";
                        echo $_SESSION["err"];
                    }
                    if (!isset($_SESSION["success"]))
                    {
                        ?><header><hgroup><h1>Register</h1><h2>Use the form below to register</h2></hgroup></header>
                        <form action="/register/" method="post">
                            <input name="username" type="text" placeholder="Username" maxlength="32" /><br>
                            <input name="email" type="email" placeholder="youremail@example.com" maxlength="255" /><br>
                            <input name="password" type="password" placeholder="Password" maxlength="32" /><br>
                            <input name="confirmpassword" type="password" placeholder="Confirm Password" maxlength="32" /><br>
                            <input name="submit" type="submit" value="Register" style="width: 158px; height: 30px;" onclick="return validateForm()" />
                        </form>
                        <?php
                    }
                    unset($_SESSION["err"], $_SESSION["success"]);
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
    
    <!-- JAVASCRIPT -->
    <script type="text/javascript">
        function onFocus(el) {
            if (el.value==el.defaultValue) {
                el.value = el.defaultValue;
            }
        }
        
        function onBlur(el) {
            if (el.value=='') {
                el.value = el.defaultValue;
            }
        }
        
        function validateForm() {
            var user = document.getElementsByName("username").item(0).value;
            var email = document.getElementsByName("email").item(0).value;
            var pass1 = document.getElementsByName("password").item(0).value;
            var pass2 = document.getElementsByName("confirmpassword").item(0).value;
            if (pass1 != pass2) {
                alert("The passwords you have entered do not match!");
                    el1[0].focus();
                    el1[0].select();
                    return false;
            } else {
                return true;
            }
        }
    </script>
    <!-- END OF JAVASCRIPT -->
</body>
</html>