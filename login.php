<html>
    <head>
        <link rel="stylesheet" href="index.css">
        <title>Add User</title>
    </head>
    <body>
        
        <div id="fullscreen_bg" class="fullscreen_bg"/>
        
        <?php
        if (isset($_POST['login'])) {

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
                    $_user = $_check_username->fetch_assoc();
                    if(password_verify($_POST['password'], $_user['password'])){

                        header("location: main.html");

                    } else {

                        echo '<span style="color:#FF0000;text-align:center;">Incorrect password<br /></span>';
                        $data_missing[] = 'Password';
                    }
                } else {
                    echo '<span style="color:#FF0000;text-align:center;">A user does not exist with this username<br /></span>';                        
                    $data_missing[] = 'Username';
                }
            }

            if (empty($_POST['password'])) {
                echo '<span style="color:#FF0000;text-align:center;">You need to provide a password<br /></span>';   
                // Adds password to array
                $data_missing[] = 'Password';

            }


            if (!empty($data_missing)) {
                echo '<span style="color:#FF0000;text-align:center;">You need to enter the following data correctly<br /></span>';                

                foreach ($data_missing as $missing) {
                    echo '<span style="color:#FF0000;text-align:center;">' . $missing . '<br /></span>';
                }
            } 
        }
        ?>
        
        <form action="http://localhost/mini-instagram/index.html">
        <input type="submit" value="Go back to login page" />
        </form>
    </body>
</html>