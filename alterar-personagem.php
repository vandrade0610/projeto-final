<?php
if(isset($_GET['id'])){
  include_once 'dao/personagemdao.class.php';
  include_once 'modelo/personagem.class.php';
  //echo $_GET['id'];
  $perDAO = new PersonagemDAO();
  $query = "where idPersonagem = ".$_GET['id'];
  $personagens = $perDAO->filtrarPersonagem($query);
  $personagem = $personagens[0]; //pegando só o objeto Personagem
  //var_dump($personagem);
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
        <form name="cadpersonagem" method="post" action="">
          <div class="form-group">
            <input type="text" name="txtnome" placeholder="Nome" class="form-control"
            value="<?php echo $personagem->nome; ?>">
          </div>
          <div class="form-group">
            <input type="text" name="txtcriador" placeholder="Criador" class="form-control"
            value="<?php echo $personagem->criador; ?>">
          </div>
          <div class="form-group">
            <input type="text" name="txtjogo" placeholder="Jogo" class="form-control"
            value="<?php echo $personagem->jogo; ?>">
          </div>
          <div class="form-group">
            <input type"number" name="txtdatacriacao" placeholder="Data Criação" class="form-control"
            value="<?php echo $personagem->dataCriacao; ?>">
          </div>
          <div class="form-group">
            <select name="selgenero" class="form-control">
              <option value="Ação" <?php if($personagem->categoria == 'Ação') echo "selected='selected'"; ?>>Ação</option>
              <option value="Aventura" <?php if($personagem->categoria == 'Aventura') echo "selected='selected'"; ?>>Aventura</option>
              <option value="RPG" <?php if($personagem->categoria == 'RPG') echo "selected='selected'"; ?>>RPG</option>
              <option value="Esporte" <?php if($personagem->categoria == 'Esporte') echo "selected='selected'"; ?>>Esporte</option>
              <option value="Corrida" <?php if($personagem->categoria == 'Corrida') echo "selected='selected'"; ?>>Corrida</option>
              <option value="Luta" <?php if($personagem->categoria == 'Luta') echo "selected='selected'"; ?>>Luta</option>
            </select>
          </div>
          <div class="form-group">
            <input type"number" name="txtpaisorigem" placeholder="País Origem" class="form-control"
            value="<?php echo $personagem->paisOrigem; ?>">
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
          include_once "modelo/personagem.class.php";
          include_once "dao/personagemdao.class.php";
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
            $person = new Personagem();
            $person->idPersonagem = $personagem->idPersonagem;
            $person->nome = Padronizacao::padronizarMainMin($_POST['txtnome']);
            $person->criador = Padronizacao::padronizarMainMin($_POST['txtcriador']);
            $person->jogo = Padronizacao::padronizarMainMin($_POST['txtjogo']);
            $person->dataCriacao = $_POST['txtdatacriacao'];
            $person->paisOrigem = $_POST['txtpaisorigem'];
            $person->categoria = $_POST['selgenero'];
            $perDAO = new PersonagemDAO();
            $perDAO->alterarPersonagem($person);
            unset($_POST);
            $_SESSION['msg'] = "Personagem alterado com sucesso!";
            header("location:consulta-personagem.php");
          }//fecha if validacao
        }//fecha if isset
        ?>
      </div>
    </div>
  </body>
</html>
