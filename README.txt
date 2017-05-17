Mini-Instagram

Authors:

Emil Åberg - naberg14@student.aau.dk
Markus Berthold - mbert14@student.aau.dk
Christine Ingerslev - cinger14@student.aau.dk

Instructions:

 - This project requires the XAMPP stack in order to run. Please install:
  	- MySQL, PHP, Apache webserver

 - Place the "mini-instagram" folder under the "htdocs" folder under "xamppfiles"
 - Place the "mysqli_connect.php" file next to "mini-instagram", under the "htdocs" folder.
 - Place the "uploadpermissions.sh" file next to the "mini-instagram", under the "htdocs" folder.

Start the webserver and the website will be available at localhost/mini-instagram, but it will not work without a database.

 - Create a new database called "instagram"
 - Import the database from instagram.sql

There might be a permission issue when uploading files to the webserver, there is a file included in this project called "uploadpermissions.sh"
 - Please run this file by right clicking and select "Open with", open the file with Termial or Windows Powershell.
 - The file will change permissions for the "uploads" folder and any subfolders.

The database will now work as well, and the website can be used in full.