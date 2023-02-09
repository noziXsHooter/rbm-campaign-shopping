<?php

include '../layouts/dashboardHeader.php';

require_once '../controllers/indexController.php';

$p = new Index('shopping_campaign', 'localhost', 'root', '');


if(!isset($_SESSION['logged']) and !$_SESSION['logged']){

  header( 'Location: login.php');

}

?>

<html>
<head>
    <title>
        Campanha Shopping Independência - Dashboard
    </title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<?php

include 'usersWrapper.php';

?>

</body>
<style>
      
body{
  margin: 0;
  background-color: #1f2937
}

</style>
</html>