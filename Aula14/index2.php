<?php
require_once "usuario.php";
require_once "sessao.php";

$sessao = new session();
if($sessao->getstatus()==1){
    $ususario = new usuario("jenifer",
                             "jeniferkamile",
                             "senha123" );
    $sessao->setusuariosessao($ususario);
    $sessao->salvasessao();
}