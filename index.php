
<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="index.css">
<title>Mini Instagram</title>
</head>
<body>
<form action="/mini-instagram/login.php" method="post">

 
<div id="fullscreen_bg" class="fullscreen_bg"/>

<div class="container">

	<form class="form-signin">
		<h1 class="form-signin-heading text-muted">Sign In</h1>
        <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="">
		<!-- <input type="text" class="form-control" name="email" placeholder="E-mail" required=""> -->
		<input type="password" class="form-control" name="password" placeholder="Password" required="">
		<!-- <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required=""> -->
		<button class="btn btn-lg btn-primary btn-block" name="login" value="Send" type="submit">            
			Sign In
		</button>        
	</form>

</div>

 
</form>
    
    <form action="/mini-instagram/register.html">
    <input type="submit" value="Go to register page" />
</form>
</body>
</html>
