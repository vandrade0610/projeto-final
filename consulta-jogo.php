<?php
session_start();
require_once "dao/jogodao.class.php";
require_once "modelo/jogo.class.php";
require_once "util/helper.class.php";
$jogDAO = new jogoDAO();
$jogos = $jogDAO->buscarJogo();
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
  <form name="filtrojogo" method="post" action="">

    <div class="form-group col-md-6">
      <input type="text" name="txtfiltro" placeholder="Digite a sua pesquisa" class="form-control">
    </div>
    <div class="form-group col-md-6">
      <select name="selfiltro" class="form-control">
        <option value="">Selecione</option>
        <option value="codigo">Código</option>
        <option value="nome">Nome </option>
        <option value="empresa">Empresa</option>
        <option value="genero">Gênero</option>
        <option value="anoLanc">Ano Lançamento</option>
        <option value="plataforma">Plataforma</option>
        <option value="motor">Motor</option>
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
      $jogos = $jogDAO->buscarJogo();
      $qtdErros++;
    }

    if($qtdErros == 0){
     $query = "";
     if($filtro == 'codigo'){
       $query = "where idJogo like '%".$pesquisa."%'";
     }else if($filtro == 'nome'){
       $query = "where nome = '".$pesquisa."'";
     }else if($filtro == 'empresa'){
       $query = "where empresa = '".$pesquisa."'";
     }else if($filtro == 'genero'){
       $query = "where genero like '%".$pesquisa."%'";
     }else if($filtro == 'anoLanc'){
       $query = "where anoLanc = ".$pesquisa;
     }else if($filtro == 'plataforma'){
       $query = "where plataforma = '".$pesquisa."'";
     }else if($filtro == 'motor'){
       $query = "where motor = '".$pesquisa."'";
     }
     //echo $query;
     $jogos= $jogDAO->filtrarJogo($query);
     //var_dump($personagens);

   }//fecha if qtdErros

  }//pesquisar

  if(count($jogos) == 0){
    Helper::alert("Não há jogos cadastrados!");
    Helper::h2("Não há jogos cadastrados!");
    die();
  }//alert
?>
<div class="table">
  <table class="table table-striped table-borderer table-hover table-condensed">
<thead>
  <tr>
    <th>Código</th>
    <th>Nome</th>
    <th>Empresa</th>
    <th>Gênero</th>
    <th>Ano Lançamento</th>
    <th>Plataforma</th>
    <th>Motor</th>
    <th>Excluir</th>
    <th>Alterar</th>
  </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Código</th>
        <th>Nome</th>
        <th>Empresa</th>
        <th>Gênero</th>
        <th>Ano Lançamento</th>
        <th>Plataforma</th>
        <th>Motor</th>
        <th>Excluir</th>
        <th>Alterar</th>
      </tr>
    </tfoot>
    <tbody>
      <?php
      foreach($jogos as $j){
        echo "<tr>";
          echo "<td>$j->idJogo</td>";
          echo "<td>$j->nome</td>";
          echo "<td>$j->empresa</td>";
          echo "<td>$j->genero</td>";
          echo "<td>$j->anoLanc</td>";
          echo "<td>$j->plataforma</td>";
          echo "<td>$j->motor</td>";
          echo "<td><a href='consulta-jogo.php?id=$j->idJogo' class='btn btn-danger'>Excluir</a></td>";
          echo "<td><a href='alterar-jogo.php?id=$j->idJogo' class='btn btn-warning'>Alterar</a></td>";
        echo "</tr>";
      }//fecha foreach
       ?>
    </tbody>
      </div>
        <?php
          if(isset($_GET['id'])){
            $jogDAO->deletarJogo($_GET['id']);
            $_SESSION['msg'] = "Jogo excluído com sucesso!";
            header("location:consulta-jogo.php");
          }
        ?>
      </div>
</body>
</html>
