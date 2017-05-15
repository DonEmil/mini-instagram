<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="index.css">
        <title>Mini Instagram | Sign In</title>
    </head>
    <body>
        <form action="/mini-instagram/login.php" method="post">


            <div id="fullscreen_bg" class="fullscreen_bg">

            <div class="container">

                <form class="form-signin">
                    <h1 class="form-signin-heading text-muted" >Sign In</h1><br>
                    
                    <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus=""><br>

                    <input type="password" class="form-control" name="password" placeholder="Password" required=""><br>
                
                    <button class="btn btn-lg btn-primary btn-block" name="login" value="Send" type="submit">            
                        Sign In
                    </button>        
                </form>
                
                <form class="switch-form" action="/mini-instagram/register.html">
                <input type="submit" value="Register new user"/>
            </form>

            </div>


        </form>
    </body>
</html>