<?php
    // RewriteRule ^validate/([a-z0-9]+)/([a-z0-9]+)/?$ validate.php?user=$1&key=$2 [L,NC]
    session_start();
    unset($_SESSION['success_title'], $_SESSION['success_content'], $_SESSION['err']);
    $user = $_GET['user'];
    $user = $_REQUEST['user'];
    $key = $_GET['key'];
    $keylen = strlen($key);
    if ($keylen > 6) {
        $key = substr($key,0,6);
    }
    require "res/db_config.php";

    $query = "SELECT validkey, uid FROM users WHERE user = '$user'";
    $result = mysql_query($query, $db_link);
    if (!$result)
    {
        $_SESSION['err'] = "That username does not exist!<br>" . mysql_error();
        header("Location: /register/");
    } else {
        $row = mysql_fetch_array($result);
        $dbkey = $row['validkey'];
        $uid = $row['uid'];


        // DEBUG
        //echo "UID: '$uid' | ";
        //echo "User: '$user' | ";
        //echo "Key: '$key' | ";
        //echo "Real Key: '$dbkey'";

        if ($dbkey == $key) {
            $query = "UPDATE users SET validated=1 WHERE uid=$uid";
            $result = mysql_query($query, $db_link);
            if ($result) {
                $_SESSION['success_title'] = "User validated!";
            	$_SESSION['success_content'] = 'You\'re user has been validated!
					You can now enjoy the benefits of being a registered user!
					Most of the things you will be using can be found in the
					sidebar to the right.<br><br>Thanks for registering!';
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
            	$errno = mysql_errno($db_link);
                $_SESSION['err'] = "Unknown error ($errno)<br>" . mysql_error();
            	header("Location: /failed/");
            	exit;
            }
        }
    }
?>