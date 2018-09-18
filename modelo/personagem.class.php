<?php
class Personagem{

  private $idPersonagem;
  private $nome;
  private $criador;
  private $jogo;
  private $dataCriacao;
  private $categoria;
  private $paisOrigem;

  public function __construct(){}
  public function __destruct(){}

  public function __get($a){return $this->$a;}
  public function __set($a, $v){$this->$a = $v;}

  public function __toString(){
    return nl2br("
                  Código: $this->$idPersonagem
                  Nome: $this->$nome
                  Criador: $this->$criador
                  Jogo: $this->$jogo
                  Data de Criação: $this->$dataCriacao
                  Categoria: $this->$categoria
                  País de Origem: $this->$paisOrigem");


  }//fecha toString;
}//fecha classe;
