<?php

require_once '../controllers/indexController.php';
require_once '../inc/config.php';

$p = new Index($dbname, $host, $user, $password);

$isValid = null;
$message = '';

if(isset($_POST['user_register'])){

    if (!isset($_POST['name']) || !isset($_POST['born_in']) || !isset($_POST['sex']) || !isset($_POST['cpf']) || !isset($_POST['password'])) {

        $isValid = false;
        $message = "Dados incompletos!";

    }elseif (empty($_POST['name']) || empty($_POST['born_in']) || empty($_POST['sex']) || empty($_POST['cpf']) || empty($_POST['password'])) {

        $isValid = false;
        $message = "Dados incompletos!";

    }else{

      $response = $p->userRegister($_POST['name'], $_POST['born_in'], $_POST['sex'], $_POST['cpf'], $_POST['password']);
    
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
    <form id="user_register" name="user_register" class="form" action="userRegister.php" method="post">
        
    <h1>Registrar</h1>
        
    <label>Nome: </label>
    <input name="name" id="name" type="text" size="20" maxlength="100">

    
    <label>Data de Nascimento: </label>
    <input name="born_in" id="born_in" type="date" size="20" maxlength="100">
    
    <label for="sex">Sexo: </label>
    <select id="sex" name="sex">
        <option value="Masculino">Masculino</option>
        <option value="Feminino">Feminino</option>
        <option value="Outro">Outro</option>
    </select>
    
    <label>CPF: </label>
    <input name="cpf" id="cpf" type="text" size="20" maxlength="100">

    <label>Senha: </label>
    <input name="password" id="password" type="password" size="20" maxlength="100">

    <?php if(!empty($message) and !$isValid) echo "<div id='error-message'>".$message."</div>" ?>

    <?php if(!empty($message) and $isValid) echo "<div id='registered-message'>".$message."</div>" ?>

    <input type="submit" id="user_register" name="user_register" value="Registrar">

    <a href="login.php">Logar</a>
    </form>
</div>
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

      #registered-message{
        width: 80%;
        color: white;
        background-color: green;
        opacity: 0.5;
        color: white;
        text-align: center;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }

      input[type=text],[type=date],[type=number], [type=password], select {
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
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }
      
      input[type=submit]:hover {
        color: #000000;
        background-color: white;
      }
      
      button {
        color: #ffffff;
        background-color: #1f2937;
        font-size: 15px;
        border: 1px solid #000000;
        padding: 10px 40px;
        border-radius: 5px;
        margin: 10px;
        cursor: pointer
        }
        button:hover {
            color: #000000;
            background-color: #6b7280;
        }
      div {
        border-radius: 5px;
        background-color: #6b7280;
        padding: 20px;
      }
      
      form{
        width: 220px;
        height: 570px;
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