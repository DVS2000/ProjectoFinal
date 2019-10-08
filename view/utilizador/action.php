<?php
  include_once('../../model/utilizador.php');
  include_once('../../controller/crud-utilizador.php');

  # INCLUIDO O FICHEIRO QUE VAI FAZER A LIMPEZA DAS VARIAVEL
  include_once('../../Util/clear-var.php');

   $clean = new Clear();


  if(isset($_POST['guardar'])) {

        # LIMPANDO AS VARIAVÉIS
        $nome               = $clean->specialChars('nome');
        $email              = $clean->email('email');
        $telefone           = $clean->int('telefone');
        $senha              = $clean->specialChars('senha');
        $sexo               = $clean->int('sexo');
        $tipoUtilizador     = $clean->int('tipoutilizador');
        $estado             = $clean->int('estado');

        $model = new Utilizador();
        $model->setNome($nome);
        $model->setEmail($email);
        $model->setTelefone($telefone);
        $model->setSenha(md5($senha));
        $model->setIdSexo($sexo);
        $model->setIdTipoUtilizador($tipoUtilizador);
        $model->setIdEstado($estado);
        $model->setDtCriacao(date('Y-m-d H:s'));
        $model->setDtEdicao(date('Y-m-d H:s'));

        $insert = new CrudUtilizador();
        echo json_encode($insert->insert($model));

    } else if(isset($_POST['editar'])) {

        # LIMPANDO AS VARIAVÉIS
       $id                 = $clean->int('id');
       $nome               = $clean->specialChars('nome');
       $email              = $clean->email('email');
       $telefone           = $clean->int('telefone');
       $senha              = $clean->specialChars('senha');
       $sexo               = $clean->int('sexo');
       $tipoUtilizador     = $clean->int('tipoutilizador');
       $estado             = $clean->int('estado');

       $model = new Utilizador();
       $model->setId($id);
       $model->setNome($nome);
       $model->setEmail($email);
       $model->setTelefone($telefone);
       $model->setSenha(md5($senha));
       $model->setIdSexo($sexo);
       $model->setIdTipoUtilizador($tipoUtilizador);
       $model->setIdEstado($estado);
       $model->setIdEstado($_POST['estado']);
       $model->setDtEdicao(date('Y-m-d H:s'));

       $update = new CrudUtilizador();
       echo json_encode($update->update($model));
       
 }
     ?>