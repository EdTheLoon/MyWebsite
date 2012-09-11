<?php
    // RewriteRule ^validate/([a-z0-9]+)/([a-z0-9]+)/?$ validate.php?user=$1&key=$2 [L,NC]
    session_start();
    unset ($_SESSION['err'], $_SESSION['success']);
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
                $_SESSION['success'] = "You're email address is validated! You
                                        can now login and use the site!";
                header("Location: /login/");
            } else {
                die("Oops! " . mysql_error());
            }
        }
    }
?>