
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

        <form action="/mini-instagram/index.php">
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



        $path = 'uploads/';
        $results = scandir($path);
        $directories = array();
        $images2display = array();
        $images2displayWithKeys = array();


        foreach ($results as $result) {
            if ($result === '.' or $result === '..')
                continue;

            if (is_dir($path . '/' . $result)) {
                array_push($directories, $result);
            }
        }

        foreach ($directories as $directory) {
            $dirname = "uploads/" . $directory . '/';
            $tempimages = glob($dirname . "*.{jpg,jpeg,gif,png}", GLOB_BRACE);
            foreach ($tempimages as $image) {
                array_push($images2display, $image);
            }
        }

        foreach ($images2display as $file) {
            $images2displayWithKeys[filectime($file)] = $file;
        }

        krsort($images2displayWithKeys);

        foreach ($images2displayWithKeys as $image) {
            echo '<img src="' . $image . '"class="img-rounded"" height="420" width="420" /><br />';
        }
        ?>


    </body>
</html>
