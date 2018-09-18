<?php
session_start();
require_once "dao/personagemdao.class.php";
require_once "modelo/personagem.class.php";
require_once "util/helper.class.php";
$perDAO = new PersonagemDAO();
$personagens = $perDAO->buscarPersonagem();
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

<body background="imagem/back1.jpg">
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
<form name="filtroPersonagem" method="post" action="">

    <div class="form-group col-md-6">
      <input type="text" name="txtfiltro" placeholder="Digite a sua pesquisa" class="form-control">
    </div>
    <div class="form-group col-md-6">
      <select name="selfiltro" class="form-control">
        <option value="">Selecione</option>
        <option value="codigo">Código</option>
        <option value="nome">Nome </option>
        <option value="criador">Criador</option>
        <option value="jogo">Nome Jogo</option>
        <option value="dataCriacao">Data Criação</option>
        <option value="categoria">Categoria</option>
        <option value="paisOrigem">País Origem</option>
      </select>
      </div>

    <div class="form-group">
      <input type="submit" name="pesquisar" value="Pesquisar" class="form-control">
    </div>

</form>
<?php
  if(isset($_SESSION['msg'])){
      Helper::alert($_SESSION['msg']);
      unset($_SESSION['msg']);
  }//msg

  if(isset($_POST['pesquisar'])){
    //var_dump($_POST);
    $filtro=$_POST['selfiltro'];
    $pesquisa = $_POST['txtfiltro'];
    $qtdErros=0;
    if($filtro =="" || $pesquisa==""){
      $personagens = $perDAO->buscarPersonagem();
      $qtdErros++;
    }

    if($qtdErros == 0){
     $query = "";
     if($filtro == 'codigo'){
       $query = "where idPersonagem like '%".$pesquisa."%'";
     }else if($filtro == 'nome'){
       $query = "where nome = '".$pesquisa."'";
     }else if($filtro == 'criador'){
       $query = "where criador = '".$pesquisa."'";
     }else if($filtro == 'jogo'){
       $query = "where jogo like '%".$pesquisa."%'";
     }else if($filtro == 'dataCriacao'){
       $query = "where dataCriacao = ".$pesquisa;
     }else if($filtro == 'categoria'){
       $query = "where categoria = '".$pesquisa."'";
     }else if($filtro == 'paisOrigem'){
       $query = "where paisOrigem = '".$pesquisa."'";
     }
     //echo $query;
     $personagens= $perDAO->filtrarPersonagem($query);
     //var_dump($personagens);

   }//fecha if qtdErros

  }//pesquisar

  if(count($personagens) == 0){
    Helper::alert("Não há personagens cadastrados!");
    Helper::h2("Não há personagens cadastrados!");
    die();
  }//alert
?>
<div class="table">
  <table class="table table-striped table-borderer table-hover table-condensed">
<thead>
  <tr>
    <th>Código</th>
    <th>Nome</th>
    <th>Criador</th>
    <th>Jogo</th>
    <th>Data Criação</th>
    <th>Categoria</th>
    <th>País Origem</th>
    <th>Excluir</th>
    <th>Alterar</th>
  </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Código</th>
        <th>Nome</th>
        <th>Criador</th>
        <th>Jogo</th>
        <th>Data Criação</th>
        <th>Categoria</th>
        <th>País Origem</th>
        <th>Excluir</th>
        <th>Alterar</th>
      </tr>
    </tfoot>
    <tbody>
      <?php
      foreach($personagens as $p){
        echo "<tr>";
          echo "<td>$p->idPersonagem</td>";
          echo "<td>$p->nome</td>";
          echo "<td>$p->criador</td>";
          echo "<td>$p->jogo</td>";
          echo "<td>$p->dataCriacao</td>";
          echo "<td>$p->categoria</td>";
          echo "<td>$p->paisOrigem</td>";
          echo "<td><a href='consulta-personagem.php?id=$p->idPersonagem' class='btn btn-danger'>Excluir</a></td>";
          echo "<td><a href='alterar-personagem.php?id=$p->idPersonagem' class='btn btn-warning'>Alterar</a></td>";
        echo "</tr>";
      }//fecha foreach
       ?>
    </tbody>
      </div>
        <?php
          if(isset($_GET['id'])){
            $perDAO->deletarPersonagem($_GET['id']);
            $_SESSION['msg'] = "Personagem excluído com sucesso!";
            header("location:consulta-personagem.php");
          }
        ?>
      </div>
</body>
</html>
