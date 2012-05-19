<!doctype html>
<html>
<head>
    <title>Ed the Loon [DOT] com</title>
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
            <section class="post">
                <article>
                    <header>
                        <h1>Welcome!</h1>
                    </header>
                    <hr>
                    Welcome to my website! This is the third site I'm constructing
                    entirely by hand! If you happen to stumble across this site
                    then please bare with my as there may be bugs and it doesn't
                    yet have full functionality!<br><br><h2>Thank you!</h2>
                </article>
            </section>
        </section>
        <!-- END OF MAIN CONTENT -->
        
        <!-- SIDEBAR -->
        <aside id="sidebar">
            <!-- USER CONTROLS -->
            <section class="sidebox">
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
            </section>
            <!-- END OF USER CONTROLS -->
            
            <!-- WHO IS ONLINE -->
            <section class="sidebox">
                <header>
                    <h1>Who's online</h1>
                </header>
                <hr>
                <ul>
                    <li>Adrian</li>
                    <li>Daz</li>
                    <li>Steve</li>
                </ul>
            </section>
            <!-- END OF WHO IS ONLINE -->
            
            <!-- ADVERTISEMENT -->
            <section class="sidebox" style="height: 600px;">
                <header>
                    <h1>Advertisement</h1>
                </header>
                <hr>
            </section>
            <!-- END OF ADVERTISEMENT -->
        </aside>
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
        function hideComments() {
            var comments = document.getElementsByClassName('comments');
            var len = comments.length;
            for (i = 0; i < len; i++) {
                comments[i].style.display = 'none';
            }
        }
        function showHide(elid) {
            var el = document.getElementById(elid);
            if (el.style.display == 'none')
            {
                el.style.display = 'block';                
            } else {
                el.style.display = 'none';
            }
        }
        window.onload=hideComments();
    </script>
    <!-- END OF JAVASCRIPT -->
</body>
</html>