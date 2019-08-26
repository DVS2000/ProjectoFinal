<?php

require 'model/utilizador.php';
require 'controller/crud-utilizador.php';


if(isset($_POST['enviar'])) {
    $model = new Utilizador();
    $model->setId(10);
    $model->setNome($_POST['descricao']);
    $model->setEmail("dorivaldo.santos@df.co.ao");
    $model->setTelefone("932098929");
    $model->setSenha("123456");
    $model->setDtCriacao(date('Y-m-d H:i:s'));
    $model->setDtEdicao(date('Y-m-d H:i:s'));
    $model->getDtCriacao();
    $model->getDtEdicao();
    $model->setIdTipoUtilizador(12);
    $model->setIdEstado(1);

    $insert = new CrudUtilizador();
    $users = $insert->select();
    foreach ($users as $key => $value) {
        # code...
       // echo "Id : ".$value->getId()." || Nome : ".$value-getNome()."";
       echo "Id : ".$value->getId()." || Nome : ".$value->getNome()."|| Email : ".$value->getEmail()." ||Telefone : ".$value->getTelefone()."  || Senha : ".$value->getSenha()." || Data de criação : ".$value->getDtCriacao()." || Data de Edição : ".$value->getDtEdicao()." || ID Tipo de User : " .$value->getIdTipoUtilizador()."<hr>";    
    }


}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="teste.php" method="post">
        Tipo do user: <input type="text" name="descricao" id="">
        <input type="submit" value="Enviar" name="enviar">
    </form>
</body>
</html>