<?php
    include_once('../../model/faculdade.php');
    include_once('../../controller/crud-faculdade.php');
    # INCLUIDO O FICHEIRO QUE VAI FAZER A LIMPEZA DAS VARIAVEL
    include_once('../../Util/clear-var.php');

    $clean = new Clear();

    if(isset($_POST['guardar'])) {

    $nome       = $clean->specialChars('nome');
    $estado     = $clean->int('estado');

    $model = new Faculdade();
    $model->setDescricao($nome);
    $model->setIdEstado($estado);
    $model->setDtCriacao(date('Y-m-d'));
    $model->setDtEdicao(date('Y-m-d'));
    $insert = new CrudFaculdade();
    echo json_encode($insert->insert($model));

     } else if(isset($_POST['editar'])) {

       

           # LIMPANDO AS VARIAVÉL
           $id                 = $clean->int('id'); 
           $descricao          = $clean->specialChars('nome');
           $estado             = $clean->int('estado');

          
           $model = new Faculdade();
           $model->setId($id);
           
           $model->setDescricao($descricao);                                               
           $model->setIdEstado($estado);
           $model->setDtEdicao(date('Y-m-d'));
           $update = new CrudFaculdade();
           
           echo json_encode($update->update($model));


           
     }
 ?>