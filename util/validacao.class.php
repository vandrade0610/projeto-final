<?php
class Validacao{

  public static function validarTitulo($v){

    $exp = "/^[a-zA-Z ]{2,100}$/";

    return preg_match($exp,$v);
  }

  public static function antiXSS($v){
    return htmlspecialchars(trim($v));
  }


}//fecha Validacao
