<html>
<head>
<title>Add User</title>
</head>
<body>
<?php
 
if(isset($_POST['submit'])){
    
    $data_missing = array();
    
    if(empty($_POST['username'])){
 
        // Adds username to array
        $data_missing[] = 'Username';
 
    } else {
 
        // Trim white space from the username and store the username
        $_username = trim($_POST['username']);
 
    }
 
    if(empty($_POST['email'])){
 
        // Adds email to array
        $data_missing[] = 'E-mail';
 
    } else{
 
        // Trim white space from the email and store the email
        $_email = trim($_POST['email']);
 
    }

    if(empty($_POST['password'])){
 
        // Adds password to array
        $data_missing[] = 'Password';
 
    } else{
 
        // Trim white space from the password and store the password
        $_password = trim($_POST['password']);
 
    }

    if(empty($_POST['confirm_password'])){
 
        // Adds confirm_password to array
        $data_missing[] = 'Confirm Password';
 
    } else{
 
        // Trim white space from the confirm_password and store the confirm_password
        $_confirm_password = trim($_POST['confirm_password']);
 
    }    
    
    if ($_password != $_confirm_password){
        //I add 'Confirm Password' to our missing data to make sure that we won't continue the process of registering this user.
        $data_missing[] = 'Confirm Password';
        echo 'Your password is not matching your confirmed password<br />';
    } else {
        //Password and confirmed password matched, and we can now encrypt the password.
        $password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
    }
    
    if(empty($data_missing)){
        
        require_once('../mysqli_connect.php');
        
        $query = "INSERT INTO users (username, email, password, confirm_password) VALUES (?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($dbc, $query);
        
        mysqli_stmt_bind_param($stmt, "ssss", $_username, $_email, $_password, $_confirm_password);
        
        mysqli_stmt_execute($stmt);
        
        $affected_rows = mysqli_stmt_affected_rows($stmt);
        
        if($affected_rows == 1){
            
            echo 'User Entered';
            
            mysqli_stmt_close($stmt);
            
            mysqli_close($dbc);

            header("Location: main.html");
            die();
            
        } else {
            
            echo 'Error Occurred<br />';
            echo mysqli_error();
            
            mysqli_stmt_close($stmt);
            
            mysqli_close($dbc);
            
        }
        
    } else {
        
        echo 'You need to enter the following data<br />';
        
        foreach($data_missing as $missing){
            
            echo "$missing<br />";
            
        }
        
    }
    
}
 
?>
</body>
</html>