<html>
    <head>
        <link rel="stylesheet" href="index.css">
        <title>Add User</title>
    </head>
    <body>
        
        <div id="fullscreen_bg" class="fullscreen_bg"/>
        
        <?php
        if (isset($_POST['submit'])) {

            $data_missing = array();

            if (empty($_POST['username'])) {

                // Adds username to array
                $data_missing[] = 'Username';
            } else {

                require_once('../mysqli_connect.php');

                // Trim white space from the username and store the username
                $_username = trim($_POST['username']);
                $_check_username = $dbc->query("SELECT * FROM users WHERE username='$_username'"); // or die($mysqli->error());
                // We know username exists if the rows returned are more than 0
                if ($_check_username->num_rows > 0) {
                    // great, a user exists with the given username
                } else {
                    echo '<span style="color:#FF0000;text-align:center;">A user does not exist with this username<br /></span>';                        
                    $data_missing[] = 'Username';
                }
            }

            if (empty($_POST['password'])) {
                echo '<span style="color:#FF0000;text-align:center;">You need to provide a password<br /></span>';   
                // Adds password to array
                $data_missing[] = 'Password';

            } else {

                // Trim white space from the password and store the password
                $_password = trim($_POST['password']);
            }


            if (/*if password is in the same entry as the username*/) {
                //success
            } else {
                echo '<span style="color:#FF0000;text-align:center;">provided username and password do not match<br /></span>'; 
            }

            if (empty($data_missing)) {

                $query = "INSERT INTO users (username, email, password, confirm_password) VALUES (?, ?, ?, ?)";

                $stmt = mysqli_prepare($dbc, $query);

                mysqli_stmt_bind_param($stmt, "ssss", $_username, $_email, $_password, $_confirm_password);

                mysqli_stmt_execute($stmt);

                $affected_rows = mysqli_stmt_affected_rows($stmt);

                if ($affected_rows == 1) {

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

                echo '<span style="color:#FF0000;text-align:center;">You need to enter the following data correctly<br /></span>';                

                foreach ($data_missing as $missing) {
                    echo '<span style="color:#FF0000;text-align:center;">' . $missing . '<br /></span>';
                }
            }
        }
        ?>
        
        <form action="http://localhost/mini-instagram/login.html">
        <input type="submit" value="Go back to login page" />
        </form>
    </body>
</html>