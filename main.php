<html>
	<head>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="bootstrap.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="index.css">
		<title>Mini Instagram</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>

	<body>
		
		<div id="fullscreen_bg_white" class="fullscreen_bg_white"/>
		
			<header>
	   
			<!-- Log Out button -->
			<form id="log_out" action="/mini-instagram/index.php">
				<button class="button2" type="submit" value="Log out">Log out</button>
			</form>
			
			<!-- Header text -->
			<h1 class="form-signin-heading" id="mainheader">Mini Instagram</h1>
			
			</header>
		
			<div id="leftmenu">
		
				<!-- Upload box -->
				<div id="upload">
					
					<div class="boxtitle">
					<b>Upload an image</b>
					</div>
					
					<form action="upload.php" method="post" enctype="multipart/form-data">
						
						<input id="choose_file" type="file" name="fileToUpload" id="fileToUpload">
						<button id="upload_image" type="submit" value="Upload" name="submit">Upload</button>
					</form>
				</div>
		
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
				
		/* List of users */
		echo '<div class="userlist">';
		echo '<div class="boxtitle"><b>View images uploaded by</b></div>';
		
		echo '<div class="scrollbox">';
		echo "<br/>";
	
		foreach ($directories as $directory) {
			echo '  <form action="/mini-instagram/userclicked.php" method="post" >
					<button class="button1" " type="submit" value="' . $directory . '" name="submit">'. $directory .'</button>
					</form>';
			echo "<br/>";
		}
		
		echo '<form action="/mini-instagram/userclicked.php" method="post">
					<button class="button1" " type="submit" value="show_all" name="submit">All users</button>
					</form>';
		echo "<br/>";
		echo "</div>";
		echo "</div>";
			
		echo "</div>";

		/* Image feed */
				
		echo "<center>";
		
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

					if(pathinfo($image, PATHINFO_EXTENSION) == "jpg" ||
						pathinfo($image, PATHINFO_EXTENSION) == "jpeg" ||
						pathinfo($image, PATHINFO_EXTENSION) == "JPG" ||
						pathinfo($image, PATHINFO_EXTENSION) == "JPEG"){
						image_fix_orientation($image);
						}
						
					array_push($images2display, $image);
				}
		}

		foreach ($images2display as $file) {

			$filecreationtime = check_ctime(filectime($file), $images2displayWithKeys);
			
			$images2displayWithKeys[$filecreationtime] = $file;
		}


		krsort($images2displayWithKeys);

		echo '<div class="imagefeed">';
		
		foreach ($images2displayWithKeys as $image) {
			$parent = basename(dirname($image));
			
			echo '<div class="imagebox">';
			echo "<br/>";
			echo "<p>$parent uploaded</p>";
			echo '<img src="' . $image . '"class="img-circle" height="420" width="420"/><br/>';
			echo "<br /> <br />";
			echo "</div>";
			echo "<br/>";
			
			
		}
		echo "</div>";    
		echo "</center>";
		


function image_fix_orientation($filename) {

  @$exif = exif_read_data($filename);
	

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

function check_ctime($ctime, $array) {


	if(array_key_exists ($ctime, $array)) {
		$ctime++;
		return check_ctime($ctime, $array);
	} else {
		return $ctime;
	}

}

		?>
		
	</body>
</html>
