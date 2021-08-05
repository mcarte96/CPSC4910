<html>
   <head>
      <title>Connecting MySQL Server</title>
   </head>
   <body>
    <?php
//phpinfo();

         $dbhost = 'database4910.cz6dbibz7hku.us-east-1.rds.amazonaws.com';
         $dbuser = 'database4910';
         $dbpass = 'database4910';
         $conn = new mysqli($dbhost, $dbuser, $dbpass);

         if($conn ->connect_error ) {
            die('Could not connect: ' . $conn->connect_error);
         }
         echo 'Connected successfully';

      ?>
   </body>
</html>
