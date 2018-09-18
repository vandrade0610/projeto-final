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
<div class="grid-container">
    <form name="cadpersonagem" method="post" action="">
      <div class="form-group">
        <input type="text" name="txtnome" placeholder="Nome do Personagem" class="form-control">
      </div>
      <div class="form-group">
        <input type="text" name="txtcriador" placeholder="Criador" class="form-control">
      </div>
      <div class="form-group">
        <input type="text" name="txtjogo" placeholder="Nome do Jogo" class="form-control">
      </div>
      <div class="form-group">
        <input type="number" min="1960" max="2018" step="1" name="txtdatacriacao" placeholder="Data de Criação" class="form-control">
      </div>
      <div class="form-group">
        <input type="text" name="txtpaisorigem" placeholder="País de Origem" class="form-control">
      </div>
      <div class="form-group">
        <select name="selgenero" class="form-control">
          <option value=""selected>Selecione</option>
          <option value="Ação">Ação</option>
          <option value="Aventura">Aventura</option>
          <option value="RPG">RPG</option>
          <option value="Esporte">Esporte</option>
          <option value="Corrida">Corrida</option>
          <option value="Luta">Luta</option>
        </select>
      </div>
      <div class="form-group">
        <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary">
        <input type="reset" name="Limpar" value="Limpar" class="btn btn-danger">
      </div>
    </form>
  </div>
  <?php
    if(isset($_POST['cadastrar'])){
      include_once "modelo/personagem.class.php";
      include_once "dao/personagemdao.class.php";
      include_once "util/helper.class.php";
      include_once "util/padronizacao.class.php";
      include_once "util/validacao.class.php";

      $qtdErros = 0;

        if(!Validacao::validarTitulo($_POST['txtnome'])){
          $qtdErros++;
          Helper::alert("Título inválido");
        }

        if($qtdErros == 0){

        $person = new Personagem();
        $person->nome = Padronizacao::padronizarMainMin($_POST['txtnome']);
        $person->criador = Padronizacao::padronizarMainMin($_POST['txtcriador']);
        $person->jogo = Padronizacao::padronizarMainMin($_POST['txtjogo']);
        $person->dataCriacao = $_POST['txtdatacriacao'];
        $person->paisOrigem = $_POST['txtpaisorigem'];
        $person->categoria = $_POST['selgenero'];
        $perDAO = new PersonagemDAO();
        $perDAO->cadastrarPersonagem($person);
        unset($_POST);

        Helper::alert("Personagem cadastrado com sucesso!");
      //header("location:cadastro-personagem.php");
      }//fecha if
    }
  ?>
</body>
</html>
