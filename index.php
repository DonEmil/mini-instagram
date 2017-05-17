<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="index.css">
        <title>Mini Instagram | Sign In</title>
    </head>

    <body>
        
        <div id="fullscreen_bg" class="fullscreen_bg">
        <div class="container">
            
        <h1 class="form-signin-heading">Mini Instagram</h1>
        
        <form action="/mini-instagram/login.php" method="post">
            
            <div class="form-container">

                <form class="form-signin">
                    
                    <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus=""><br>

                    <input type="password" class="form-control" name="password" placeholder="Password" required=""><br>
                
                    <button class="btn btn-lg btn-primary btn-block" name="login" value="Send" type="submit">            
                        Sign In
                    </button>
                    
                </form>
                
            </div>
            
                <form class="switch-form" action="/mini-instagram/register.html">
                    <button class="button2" type="submit" value="Register new user">Register new user</button>
                </form>

        </form>
        
            
        </div>  
        </div>
    
    </body>
</html>