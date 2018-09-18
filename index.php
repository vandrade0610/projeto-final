<?php
session_start();
ob_start();
include_once "modelo/usuario.class.php";
include_once "dao/usuariodao.class.php"; //AQUI
include_once "util/padronizacao.class.php";
include_once "util/helper.class.php";
include_once "util/validacao.class.php";
include_once "util/seguranca.class.php";

if(isset($_SESSION['privateUser'])){
  $u = unserialize($_SESSION['privateUser']);

}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Catálogo de Jogos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="codes/teste.css">
  <script type="text/javascript" src="codes/teste.js"></script>
</head>

<body>
  <div id="sse1">
  <div id="sses1">
    <ul>
      <li><a href="index.php">HOME</a></li>
      <li><a href="cadastro-personagem.php">CADASTRO DE PERSONAGEM</a></li>
      <li><a href="cadastro-jogo.php">CADASTRO DE JOGO</a></li>
      <li><a href="consulta-personagem.php">CONSULTA DE PERSONAGENS</a></li>
      <li><a href="consulta-jogo.php">CONSULTA DE JOGOS</a></li>
    </ul>
  </div>
</div>
<?php
    if(isset($_SESSION['privateUser'])){
      if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
      }
      echo "<h2>Olá, {$u->login}. Seja bem vindo!<h2>";
      unset($_SESSION['msg']);
    ?>

    <form name="logout" method="post" action="">
      <input type="submit" name="deslogar" value="Deslogar" class="btn btn-primary">
    </form>
    <?php
      if(isset($_POST['deslogar'])){
        unset($_SESSION['privateUser']);
        header("location:index.php");
      }
    }else{
    ?>
    <div class="login">
    <form name="login" method="post" action="">
      <div class="form-group">
        <input type="text" name="txtlogin" placeholder="Login" class="form-control">
      </div>
      <div class="form-group">
        <input type="password" name="txtsenha" placeholder="Senha" class="form-control">
      </div>
      <div class="form-group">
        <select name="seltipo" class="form-control">
          <option value="adm">Administrador</option>
          <option value="comum">Comum</option>
        </select>
      </div>
      <div class="form-group">
        <input type="submit" name="entrar" value="Entrar" class="btn btn-outline-light text-dark">
        <input type="reset" name="Limpar" value="Limpar" class="btn btn-danger">
      </div>
    </form>
  </div>
    <?php
     }//só para fechar a chave... e não aparecer o form qdo logado
    ?>

    <?php
    if(isset($_POST['entrar'])){
        $usu = new Usuario();
        $usu->login = Padronizacao::padronizarMainMin($_POST['txtlogin']);
        $usu->senha = Seguranca::criptografar($_POST['txtsenha']);
        $usu->tipo = $_POST['seltipo'];
        echo $usu;
        echo '<br>senha cripto.: '.$usu->senha;
        $usuDAO = new UsuarioDAO();
        $usuario = $usuDAO->verificarUsuario($usu);
        if($usuario !=null){
          /*var_dump($usuario);
          Helper::alert("Usuário logado com sucesso!");*/
          $_SESSION['privateUser'] = serialize($usuario);
          $_SESSION["msg"] = "Usuário logado com sucesso!";
          header("location:index.php");
        }else{
          Helper::alert("Usuário/senha(s) inválido(s)!");
        }
        unset($_POST);
    }//fecha if
    ?>
</body>
</html>
