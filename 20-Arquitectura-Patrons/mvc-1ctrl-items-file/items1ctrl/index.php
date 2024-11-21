<?php
    //require_once 'model/persist/ItemArrayDao.php';
    session_start();
    //session is used here to simulate data persistance (only needed for array persistance).
   
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);   
    ini_set('error_reporting', E_ALL);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>MVC example: Item manager</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css"> 
  </head>
  <body>
      <?php
        include "views/topmenu.html";
      ?>
      <h2>MVC example: Item manager</h2>
      <?php
        //dynamic html content generated here by controller.
        require_once 'controllers/MainController.php';
        (new MainController())->processRequest();
      ?>
  </body>
</html>
