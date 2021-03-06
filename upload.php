<html>
	<head>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="index.css">
		
		<title>Mini Instagram | Upload</title>
	</head>
	<body>

		<div id="fullscreen_bg" class="fullscreen_bg"/>

		<div id="error_msg">

		<?php
		session_start();

		$target_dir = "uploads/" . $_SESSION["current_user"] . '/';
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if (isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if ($check !== false) {
				echo "File is an image - " . $check["mime"] . ". ";
				$uploadOk = 1;
			} else {
				echo "File is not an image. ";
				$uploadOk = 0;
			}
		}
		 // Check if file already exists
		if (file_exists($target_file)) {
			echo "Sorry, file already exists. ";
			$uploadOk = 0;
		}

		// Allow certain file formats
		if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" &&
			$imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF") {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded. ";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded. ";
				header("Location: main.php");
			} else {
				echo "Sorry, there was an error uploading your file. ";
			}
		}
		?>
		
		</div>

	</body>
</html>