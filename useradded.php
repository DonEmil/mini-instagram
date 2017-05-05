<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
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
                    echo '<span style="color:#FF0000;text-align:center;">A user with the username: "' . $_username . '" already exists<br /></span>';
                    //I add the username to the list of missing data, so that the user has to add another.
                    $data_missing[] = 'Username';
                }
            }

            if (empty($_POST['email'])) {

                // Adds email to array
                $data_missing[] = 'E-mail';
            } else {

                // Trim white space from the email and store the email
                $_email = trim($_POST['email']);

                if (filter_var($_email, FILTER_VALIDATE_EMAIL)) {


                    $_check_email = $dbc->query("SELECT * FROM users WHERE email='$_email'"); // or die($mysqli->error());
                    // We know email exists if the rows returned are more than 0
                    if ($_check_email->num_rows > 0) {
                        echo '<span style="color:#FF0000;text-align:center;">A user with the email: "' . $_email . '" already exists<br /></span>';
                        //I add the email to the list of missing data, so that the user has to add another.
                        $data_missing[] = 'E-mail';
                    }
                } else {
                    $data_missing[] = 'E-mail';
                    echo '<span style="color:#FF0000;text-align:center;">The email entered is not a valid email<br /></span>';
                }
            }

            if (empty($_POST['password'])) {

                // Adds password to array
                $data_missing[] = 'Password';
            } else {

                // Trim white space from the password and store the password
                $_password = trim($_POST['password']);
            }

            if (empty($_POST['confirm_password'])) {

                // Adds confirm_password to array
                $data_missing[] = 'Confirm Password';
            } else {

                // Trim white space from the confirm_password and store the confirm_password
                $_confirm_password = trim($_POST['confirm_password']);
            }

            if ($_password != $_confirm_password) {
                //I add 'Confirm Password' to our missing data to make sure that we won't continue the process of registering this user.
                $data_missing[] = 'Confirm Password';
                echo '<span style="color:#FF0000;text-align:center;">Your password is not matching your confirmed password<br /></span>';
            } else {
                //Password and confirmed password matched, and we can now encrypt the password.
                $_password = $dbc->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
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

                    header("Location: index.php");
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

        <form action="/mini-instagram/register.html">
            <input type="submit" value="Go back to register page" />
        </form>
    </body>
</html>