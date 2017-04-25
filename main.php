
<html>
    <head>
        <title>Mini Instagram</title>
    </head>
    <body>
        here you can view some photos

        <form action="http://localhost/mini-instagram/index.html">
            <input type="submit" value="Log out" />
        </form>

        <form action="upload.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
        </form>

        <?php
        session_start();
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }

        if (!is_dir('uploads/' . $_SESSION["current_user"])) {
            mkdir('uploads/' . $_SESSION["current_user"], 0777, true);
        }


        
        $dirname = "uploads/" . $_SESSION["current_user"] . '/';
        $images = glob($dirname."*.{jpg,gif,png}",GLOB_BRACE);


        foreach ($images as $image) {
            echo '<img src="' . $image . '" height="420" width="420" /><br />';
        }
        ?>


    </body>
</html>
