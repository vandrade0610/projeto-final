<?php
class Jogo{

  private $idJogo;
  private $nome;
  private $empresa;
  private $genero;
  private $anoLanc;
  private $plataforma;
  private $motor;

  public function __construct(){}
  public function __destruct(){}

  public function __get($a){return $this->$a;}
  public function __set($a,$v){$this->$a = $v;}

  public function __toString(){
    return nl2br("
                Código: $this->$idJogo
                Nome: $this->$nome
                Empresa: $this->$empresa
                Gênero: $this->$genero
                Ano de lançamento: $this->$anoLanc
                Plataforma: $this->$plataforma
                Motor: $this->$motor");


}//fecha toString;




}//fecha classe;
