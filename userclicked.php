<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="index.css">
        <title>Mini Instagram</title>
    </head>
    <body>

        <div id="fullscreen_bg" class="fullscreen_bg"/>

        <?php
            session_start();
            echo "TEST1";
            if (isset($_POST['submit'])) {
                
                $_SESSION["view_user"] = $_POST['submit'];
                echo "TEST2"; 
                echo "<p> the value of the post was:" . $_POST['submit'] . "</p>";
                header("location: main.php");
            }


        ?>

    </body>
</html>