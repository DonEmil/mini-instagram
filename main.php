
<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="index.css">
        <title>Mini Instagram</title>
    </head>
    <body>
    <center>
        
        <div id="fullscreen_bg_white" class="fullscreen_bg_white"/>

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

        if($_SESSION["view_user"] == "show_all"){

            foreach ($directories as $directory) {
                $dirname = "uploads/" . $directory . '/';
                $tempimages = glob($dirname . "*.{jpg,jpeg,gif,png,JPG,JPEG,GIF,PNG}", GLOB_BRACE);
                foreach ($tempimages as $image) {

                    if(pathinfo($image, PATHINFO_EXTENSION) == "jpg" ||
                        pathinfo($image, PATHINFO_EXTENSION) == "jpeg" ||
                        pathinfo($image, PATHINFO_EXTENSION) == "JPG" ||
                        pathinfo($image, PATHINFO_EXTENSION) == "JPEG"){
                    image_fix_orientation($image);
                    }
                    
                    array_push($images2display, $image);

                }
            }

        } else {
            $dirname = "uploads/" . $_SESSION["view_user"] . '/';
                $tempimages = glob($dirname . "*.{jpg,jpeg,gif,png,JPG,JPEG,GIF,PNG}", GLOB_BRACE);
                foreach ($tempimages as $image) {
                    array_push($images2display, $image);
                }
        }

        foreach ($images2display as $file) {
            $images2displayWithKeys[filectime($file)] = $file;
        }


        krsort($images2displayWithKeys);

        foreach ($images2displayWithKeys as $image) {
            $parent = basename(dirname($image));
            echo "<p>This image was uploaded by user: $parent</p>";
            echo '<img src="' . $image . '"class="img-circle" height="420" width="420" /><br />';
            echo "<br /> <br />";
        }
        

        foreach ($directories as $directory) {
            echo '  <form action="/mini-instagram/userclicked.php" method="post" >
                    <input " type="submit" value="' . $directory . '" name="submit">
                    </form>';
            echo "<br />";
        }
        echo '  <form action="/mini-instagram/userclicked.php" method="post" >
                    <input " type="submit" value="show_all" name="submit">
                    </form>';
        echo "<br />";
        
echo "</center>";


function image_fix_orientation($filename) {

  $exif = exif_read_data($filename);

  if (!empty($exif['Orientation'])) {

    $image = imagecreatefromjpeg($filename);

    switch ($exif['Orientation']) {
      case 3:
        $image = imagerotate($image, 180, 0);
        break;

      case 6:
        $image = imagerotate($image, -90, 0);
        break;

      case 8:
        $image = imagerotate($image, 90, 0);
        break;
    }

    imagejpeg($image, $filename, 100);

  }

}

        ?>
        
    </body>
</html>
