<?php

require_once './controllers/indexController.php';

include './inc/config.php';

$p = new Index($dbname, $host, $user, $password);

$isValid = null;
$message = '';

if(isset($_POST['login'])){

  if (!isset($_POST['cpf']) || !isset($_POST['password'])) {

    $isValid = false;
    $message = "Dados incompletos!";

  }elseif (empty($_POST['cpf']) || empty($_POST['password'])) {

      $isValid = false;
      $message = "Dados incompletos!";

  }else{

      $response = $p->login($_POST['cpf'], $_POST['password']);

      if(empty($response['success'])){

        $isValid = false; 
        $message = $response['message'];

      }
  }

}

?>

<html>
<head>
    <title>
        Campanha Shopping Independência
    </title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="container">

  
  <div>
    <form id="login" name="login" class="form" action="index.php" method="post">
    <h1>Login</h1>
   
    <label>CPF: </label>
    <input name="cpf" id="cpf" type="text" size="20" maxlength="100">
    
    <label>Senha: </label>
    <input name="password" id="password" type="password" maxlength="100">

    <a href="userRegister.php">Registrar</a>
    <input type="submit" id="login" name="login" value="Login">

    <?php if(!empty($message) and !$isValid) echo "<div id='error-message'>".$message."</div>" ?>

  </form>
</div>

</body>
<style>
      
      .container {
          display: flex;
          justify-content: center;
          align-items: center;
          /* text-align: center; */
          min-height: 100vh;
          background-color: #1f2937;
      
      }

      #error-message{
        width: 80%;
        color: white;
        background-color: red;
        color: white;
        opacity: 0.5;
        text-align: center;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }

      input[type=text],[type=password], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
      }

      input[type=submit] {
        width: 100%;
        color: #000000;
        background-color: #1f2937;
        color: white;
        padding: 14px 20px;
        margin: 20px 0px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }
      
      input[type=submit]:hover {
        color: #000000;
        background-color: white;
      }
      
      div {
        border-radius: 5px;
        background-color: #6b7280;
        padding: 20px;
      }
      
      form{
        width: 200px;
          height: 350px;
          padding: 20px;
        background-color: #6b7280;
      }
      a{
            display: flex;
            justify-content: right;
            color: #1f2937;
        }
        a:hover{
            color: white;
        }
      h1{
          color: #1f2937;
          text-align: center;
      }
</style>
</html>