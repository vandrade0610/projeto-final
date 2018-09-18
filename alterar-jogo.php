<?php
if(isset($_GET['id'])){
  include_once 'dao/jogodao.class.php';
  include_once 'modelo/jogo.class.php';
  //echo $_GET['id'];
  $jogDAO = new JogoDAO();
  $query = "where idJogo = ".$_GET['id'];
  $jogos = $jogDAO->filtrarJogo($query);
  $jogo = $jogos[0]; //pegando só o objeto jogo
  //var_dump($jogo);
}else{
  header("location:index.php");
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


    

    <div class="tabelas">
        <form name="cadjogo" method="post" action="">
          <div class="form-group">
            <input type="text" name="txtnome" placeholder="Nome" class="form-control"
            value="<?php echo $jogo->nome; ?>">
          </div>
          <div class="form-group">
            <input type="text" name="txtempresa" placeholder="Empresa" class="form-control"
            value="<?php echo $jogo->empresa; ?>">
          </div>
          <div class="form-group">
            <select name="selgenero" class="form-control">
              <option value="Ação" <?php if($jogo->genero == 'Ação') echo "selected='selected'"; ?>>Ação</option>
              <option value="Aventura" <?php if($jogo->genero == 'Aventura') echo "selected='selected'"; ?>>Aventura</option>
              <option value="RPG" <?php if($jogo->genero == 'RPG') echo "selected='selected'"; ?>>RPG</option>
              <option value="Esporte" <?php if($jogo->genero == 'Esporte') echo "selected='selected'"; ?>>Esporte</option>
              <option value="Corrida" <?php if($jogo->genero == 'Corrida') echo "selected='selected'"; ?>>Corrida</option>
              <option value="Luta" <?php if($jogo->genero == 'Luta') echo "selected='selected'"; ?>>Luta</option>
            </select>
          </div>
          <div class="form-group">
            <input type"number" name="txtanolanc" placeholder="Ano Lançamento" class="form-control"
            value="<?php echo $jogo->anoLanc; ?>">
          </div>
          <div class="form-group">
            <input type"text" name="txtplataforma" placeholder="Plataforma" class="form-control"
            value="<?php echo $jogo->plataforma; ?>">
          </div>

          <div class="form-group">
            <input type"text" name="txtmotor" placeholder="Motor" class="form-control"
            value="<?php echo $jogo->motor; ?>">
          </div>

          <div class="form-group">
            <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
            <input type="reset" name="Limpar" value="Limpar" class="btn btn-danger">
          </div>
        </form>
        <!-- FALTA CÓDIGO -->
        <?php
        //AQUI....
        if(isset($_POST['alterar'])){
          include_once "modelo/jogo.class.php";
          include_once "dao/jogodao.class.php";
          include_once "util/helper.class.php";
          include_once "util/padronizacao.class.php";
          include_once "util/validacao.class.php";

          $qtdErros=0;

          if(!Validacao::validarTitulo($_POST['txtnome'])){
            $qtdErros++;
            Helper::alert("Nome inválido!");
          }
          //demais ifs
          if($qtdErros == 0){
            $jog = new Jogo();
            $jog->idJogo = $jogo->idJogo;
            $jog->nome = Padronizacao::padronizarMainMin($_POST['txtnome']);
            $jog->empresa = Padronizacao::padronizarMainMin($_POST['txtempresa']);
            $jog->genero = Padronizacao::padronizarMainMin($_POST['selgenero']);
            $jog->anoLanc = $_POST['txtanolanc'];
            $jog->plataforma = $_POST['txtplataforma'];
            $jog->motor = $_POST['motor'];
            $jogDAO = new JogoDAO();
            $jogDAO->alterarJogo($jog);
            unset($_POST);
            $_SESSION['msg'] = "Jogo alterado com sucesso!";
            header("location:consulta-jogo.php");
          }//fecha if validacao
        }//fecha if isset
        ?>
      </div>
    </div>
  </body>
</html>
