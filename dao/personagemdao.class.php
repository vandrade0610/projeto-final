<?php
require_once "conexaobanco.class.php";
class PersonagemDAO{

  private $conexao = null;

  public function __construct(){
    $this->conexao = ConexaoBanco::getInstance();
  }

  public function __destruct(){}

  public function cadastrarPersonagem($per){ //objeto personagem
    try{

      $stat = $this->conexao->prepare("insert into personagem(idPersonagem,nome,criador,jogo,dataCriacao,categoria,paisOrigem)values(null,?,?,?,?,?,?)");

      $stat->bindValue(1, $per->nome);
      $stat->bindValue(2, $per->criador);
      $stat->bindValue(3, $per->jogo);
      $stat->bindValue(4, $per->dataCriacao);
      $stat->bindValue(5, $per->categoria);
      $stat->bindValue(6, $per->paisOrigem);
      $stat->execute();

    }catch(PDOException $e){
      echo "Erro ao cadastrar personagem! ".$e;
    }//catch
  }//cadastrarPersonagem

  public function buscarPersonagem(){
      try{
        $stat = $this->conexao->query("select * from personagem");
        $array = $stat->fetchAll(PDO::FETCH_CLASS,'Personagem');
        return $array;
      }catch(PDOException $e){
        echo "Erro ao buscar Personagem ".$e;
      }//catch
  }//buscarJogo

  public function deletarPersonagem($id){
    try{
      $stat = $this->conexao->prepare("delete from personagem where idPersonagem = ?");
      $stat->bindValue(1, $id);
      $stat->execute();
    }catch(PDOException $e){
      echo "Erro ao excluir personagem! ".$e;
    }//fecha catch
  }//deletarLivro

  public function filtrarPersonagem($query){
    try{
      $stat = $this->conexao->query("select * from personagem ".$query);
      $array=$stat->fetchAll(PDO::FETCH_CLASS,'Personagem');
      return $array;
    }catch(PDOException $e){
      echo "Erro ao filtrar personagens! ".$e;
    }//catch
  }//filtrar

  public function alterarPersonagem($per){ //objeto personagem
    try{
      $stat = $this->conexao->prepare("update personagem set nome=?, criador=?, jogo=?, dataCriacao=?, categoria=?, paisOrigem=? where idPersonagem=?");

      $stat->bindValue(1, $per->nome);
      $stat->bindValue(2, $per->criador);
      $stat->bindValue(3, $per->jogo);
      $stat->bindValue(4, $per->dataCriacao);
      $stat->bindValue(5, $per->categoria);
      $stat->bindValue(6, $per->paisOrigem);
      $stat->bindValue(7, $per->idPersonagem);
      $stat->execute();
    }catch(PDOException $e){
      echo "Erro ao alterar Personagem! ".$e;
    }//catch
  }//cadastrarPersonagem

}//fecha classe
