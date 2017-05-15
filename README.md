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

Start he webserver, and the website will be available at localhost/mini-instagram, but it will not work without a database.

 - Create a new database in MySQL called instagram, and a new table called "users"
 - "users" have 4 columns called:
 	- email varchar(30)
 	- username varchar(30)
 	- password varchar(72)
 	- confirm-password varchar(72)
 
 - Create a new user account for the database with access to the "users" table
 - username: usersweb and password: turtledove

 - Grant usersweb access to INSERT, DELETE, SELECT and UPDATE on the instagram database

The database will now work as well, and the website can be used in full.