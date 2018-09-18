<?php
class Seguranca{
  public static function criptografar($v){
    return md5('Aula'.$v.'PHP');
  }
}

/*
  insert into usuario(idUsuario,login,senha, tipo)
  values(null,"viniciusandrade", "062e7f4d26c74898081959eaa8fd9f4b", "adm");
*/
