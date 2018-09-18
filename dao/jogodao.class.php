<?php
require_once "conexaobanco.class.php";
class JogoDAO{

  private $conexao = null;

  public function __construct(){
    $this->conexao = ConexaoBanco::getInstance();
  }

  public function __destruct(){}

  public function cadastrarJogo($jogo){ //objeto Jogo
    try{

      $stat = $this->conexao->prepare("insert into jogo(idJogo,nome,empresa,genero,anoLanc,plataforma,motor)values(null,?,?,?,?,?,?)");

      $stat->bindValue(1, $jogo->nome);
      $stat->bindValue(2, $jogo->empresa);
      $stat->bindValue(3, $jogo->genero);
      $stat->bindValue(4, $jogo->anoLanc);
      $stat->bindValue(5, $jogo->plataforma);
      $stat->bindValue(6, $jogo->motor);
      $stat->execute();

    }catch(PDOException $e){
      echo "Erro ao cadastrar jogo! ".$e;
    }//catch
  }//cadastrarJogo

  public function buscarJogo(){
      try{
        $stat = $this->conexao->query("select * from jogo");
        $array = $stat->fetchAll(PDO::FETCH_CLASS,'Jogo');
        return $array;
      }catch(PDOException $e){
        echo "Erro ao buscar jogo! ".$e;
      }//catch
  }//buscarJogo

  public function deletarJogo($id){
    try{
      $stat = $this->conexao->prepare("delete from jogo where idJogo = ?");
      $stat->bindValue(1, $id);
      $stat->execute();
    }catch(PDOException $e){
      echo "Erro ao excluir jogo! ".$e;
    }//fecha catch
  }//deletarLivro

  public function filtrarJogo($query){
    try{
      $stat = $this->conexao->query("select * from jogo ".$query);
      $array=$stat->fetchAll(PDO::FETCH_CLASS,'Jogo');
      return $array;
    }catch(PDOException $e){
      echo "Erro ao filtrar jogo! ".$e;
    }//catch
  }//filtrar

  public function alterarJogo($jogo){ //objeto Jogo
    try{
      $stat = $this->conexao->prepare("update jogo set nome=?, empresa=?, genero=?, anoLanc=?, plataforma=?, motor=? where idJogo=?");

      $stat->bindValue(1, $jogo->nome);
      $stat->bindValue(2, $jogo->empresa);
      $stat->bindValue(3, $jogo->genero);
      $stat->bindValue(4, $jogo->anoLanc);
      $stat->bindValue(5, $jogo->plataforma);
      $stat->bindValue(6, $jogo->motor);
      $stat->bindValue(7, $jogo->idJogo);
      $stat->execute();
    }catch(PDOException $e){
      echo "Erro ao alterar jogo! ".$e;
    }//catch
  }//cadastrarJogo

}//fecha classe
