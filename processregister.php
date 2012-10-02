<?php
    session_start();
    if (isset($_POST['submit'])) {
        require "res/db_config.php";
        unset($_SESSION['success'], $_SESSION['err']);

        $user = $_POST['username'];
        $pass = $_POST['password'];
        $email = $_POST['email'];
        $ip = $_SERVER['REMOTE_ADDR'];

        $err = array();

        if (strlen($user) < 1 || strlen($user) > 32)
        {
            $err[] = "Your username must be between 1 and 32 characters";
        }

        if (preg_match("/[^a-z0-9\-\_\.]+/i", $user))
        {
            $err[] = "Your username can only contain letters a-z, numbers 0-9 and the symbols ._-";
        }

        if(!preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $email))
        {
            $err[] = "Your email address is not valid";
        }

    	if (strlen($pass) < 1) {
    		$err[] = "You can't have a blank password";
    	}

        $user = mysql_real_escape_string($user);
        $email = mysql_real_escape_string($email);

        if(!count($err))
        {
            $query = "INSERT INTO users (user, pass, email, ip, dt) VALUES (
                    '$user',
                    '$pass',
                    '$email',
                    '$ip',
                    NOW())";
            $result = mysql_query($query, $db_link);

            if ($result)
            {
                $_SESSION['success'] = "The last step is to confirm your email address. Please check your inbox and spam folders";
            } else {
                $err[] = "The username or email you used is already taken";
            }
        }

        if(count($err))
        {
            $_SESSION['err'] = implode("<br>", $err);
        }
        header("Location: /register/");
        exit;
    } else {
        die("POST['Submit'] is broken");
    }
?>