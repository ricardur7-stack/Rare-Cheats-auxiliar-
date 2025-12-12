<?php
// Conex���o
require_once 'DB.php';
include 'info.php';

// Sess���o
session_start();

// Bot���o enviar
if(isset($_POST['btn-entrar'])):
  $erros = array();
  $login = mysqli_escape_string($conn, $_POST['login']);
  $senha = mysqli_escape_string($conn, $_POST['senha']);

  if(isset($_POST['lembrar-senha'])):

    setcookie('login', $login, time()+3600);
    setcookie('senha', md5($senha), time()+3600);
  endif;

  if(empty($login) or empty($senha)):
    $erros[] = "";
  else:
    // 105 OR 1=1 
      // 1; DROP TABLE teste

    $sql = "SELECT login FROM usuarios WHERE login = '$login'";
    $resultado = mysqli_query($conn, $sql);   

    if(mysqli_num_rows($resultado) > 0):
    $senha = md5($senha);       
    $sql = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'";



    $resultado = mysqli_query($conn, $sql);

      if(mysqli_num_rows($resultado) == 1):
        $dados = mysqli_fetch_array($resultado);
        mysqli_close($conn);
        $_SESSION['logado'] = true;
        $_SESSION['id_usuario'] = $dados['id'];
        header('Location: dashboard.php');
      else:
        $erros[] = "<li> Usuário não existe </li>";
      endif;

    else:
      $erros[] = "<li> Usuario Incorreto </li>";
    endif;

  endif;

endif;
?>


<!DOCTYPE html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<title>Painel Admin</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
<style>
    .button {
        
        border-color: transparent;
        background-color: transparent;
       position: relative;
    display: inline-block;
    padding: 10px 20px;
    color: #FF0000;
    font-size: 16px;
    text-decoration: none;
    text-transform: uppercase;
    overflow: hidden;
    transition: .5s;
    margin-top: 40px;
    letter-spacing: 4px
    }
    
     .button:hover {
    background: #FF0000;
    color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 5px #FF0000,
                0 0 25px #FF0000,
                0 0 50px #FF0000,
                0 0 100px #FF0000;
  }
  
  .button span {
    position: absolute;
    display: block;
  }
  
  .button span:nth-child(1) {
    top: 0;
    left: -100%;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent,#FF0000);
    animation: btn-anim1 1s linear infinite;
  }
  
  @keyframes btn-anim1 {
    0% {
      left: -100%;
    }
    50%,100% {
      left: 100%;
    }
  }
  
  .button span:nth-child(2) {
    top: -100%;
    right: 0;
    width: 2px;
    height: 100%;
    background: linear-gradient(180deg, transparent,#FF0000);
    animation: btn-anim2 1s linear infinite;
    animation-delay: .25s
  }
  
  @keyframes btn-anim2 {
    0% {
      top: -100%;
    }
    50%,100% {
      top: 100%;
    }
  }
  
  .button span:nth-child(3) {
    bottom: 0;
    right: -100%;
    width: 100%;
    height: 2px;
    background: linear-gradient(270deg, transparent,#FF0000);
    animation: btn-anim3 1s linear infinite;
    animation-delay: .5s
  }
  
  @keyframes btn-anim3 {
    0% {
      right: -100%;
    }
    50%,100% {
      right: 100%;
    }
  }
  
  .button span:nth-child(4) {
    bottom: -100%;
    left: 0;
    width: 2px;
    height: 100%;
    background: linear-gradient(360deg, transparent,#FF0000);
    animation: btn-anim4 1s linear infinite;
    animation-delay: .75s
  }
  
  @keyframes btn-anim4 {
    0% {
      bottom: -100%;
    }
    50%,100% {
      bottom: 100%;
    }
  }
    
</style>
    <body>
<div class="login-box">
    <h2>GreenPower Login</h2>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="login100-form validate-form" >

<?php 
if(!empty($erros)):
  foreach($erros as $erro):
    echo $erro;
  endforeach;
endif;
?>

    	<form action="#" method="POST">
      <div class="user-box">
        <input type="text" name="login" placeholder="Usuario" value="">
        <label></label>
      </div>
      <div class="user-box">
        <input type="password" name="senha" placeholder="Password" value="" >
        <label></label>
    
        
    </div>
     <button class="button" type="submit" name="btn-entrar"> <span></span>
        <span></span>
        <span></span>
        <span></span> 
							Entrar
						</button>
    </form>
  </div> 
  

</html>