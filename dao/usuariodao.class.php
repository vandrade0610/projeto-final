<?php
require_once "conexaobanco.class.php";
class UsuarioDAO{

  private $conexao = null;

  public function __construct(){
    $this->conexao = ConexaoBanco::getInstance();
  }

  public function __destruct(){}

  public function cadastrarUsuario($usu){ //objeto livro
    try{
      $stat = $this->conexao->prepare("insert into usuario(idusuario, login, senha, tipo)values(null,?,?,?)");

      $stat->bindValue(1, $liv->login);
      $stat->bindValue(2, $liv->senha);
      $stat->bindValue(3, $liv->tipo);
      $stat->execute();

    }catch(PDOException $e){
      echo "Erro ao cadastrar usuário! ".$e;
    }//catch
  }//cadastrarUsuario

  public function buscarUsuario(){
    try{
      $stat = $this->conexao->query("select * from usuario");
      $array = $stat->fetchAll(PDO::FETCH_CLASS,'Usuario');
      return $array;
    }catch(PDOException $e){
      echo "Erro ao buscar usuários! ".$e;
    }
  }//buscarUsuarios

  public function verificarUsuario($u){
    try{
      $stat = $this->conexao->prepare(
        "select * from usuario where login=? and senha=? and tipo=?");
      $stat->bindValue(1, $u->login);
      $stat->bindValue(2, $u->senha);
      $stat->bindValue(3, $u->tipo);
      $stat->execute();
      $usuario = null;
      $usuario = $stat->fetchObject('Usuario');
      return $usuario;
    }catch(PDOException $e){
      echo "Erro ao verificar usuário! ".$e;
    }
  }

}
