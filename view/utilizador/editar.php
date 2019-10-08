<?php

if(isset($_GET['id'])) {

    include_once('../../model/utilizador.php');
    include_once('../../controller/crud-utilizador.php');

    # INCLUIDO O FICHEIRO QUE VAI FAZER A LIMPEZA DAS VARIAVEL
    include_once('../../Util/clear-var.php');
    $clean = new Clear();

    $iduser = $clean->intGET('id');
        if($iduser != null) {
            $userData = new CrudUtilizador();
            $user  = $userData->getById($iduser);

           
            if($user == null) {
                header('Location: ../');
            }

        } else {
            header('Location: ../');
        } 
    
    } else {
        header('Location: ../');
    } 



?>



<?php

        include_once('../includes/header-sub.php');

        ?>
<div class="container-fluid">

    <div class="card o-hidden border-0 shadow-lg my-1">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-left">
                            <h1 class="h4 text-gray-900 mb-2 font-weight-bold" style="text-transform: uppercase">Editar
                                utilizador</h1>
                            <hr>
                        </div>
                        <form class="user" method="POST" id="form">
                        <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control " id="nome" placeholder="Nome"
                                        required="required" name="nome" value="<?php echo $user->getNome(); ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email"
                                        required="required" name="email" value="<?php echo $user->getEmail(); ?>">
                                </div>
                            </div>
                            <div class="form-group row">

                                <div
                                    class="<?php echo $utilizador->getIdTipoUtilizador() != 11 ? 'col-sm-3 mb-3 mb-sm-0' : 'col-sm-6 mb-3 mb-sm-0' ?>">
                                    <div class="form-group">
                                        <label for="telefone">Telefone</label>
                                        <input type="tel" class="form-control" id="telefone" placeholder="Telefone"
                                            required="required" name="telefone"
                                            value="<?php echo $user->getTelefone(); ?>">
                                    </div>
                                </div>

                                <?php 

                                    include_once('../../controller/crud-sexo.php');
                                    $select = new CrudSexo();

                                    if($utilizador->getIdTipoUtilizador() != 11) {
                                        echo '<div class="col-sm-3 mb-3 mb-sm-0 ">
                                        <label>Sexo</label>
                                        <select class="custom-select" required="required" name="sexo">';
                                        $select->select($user->getIdSexo());
                                        echo ' </select>
                                        </div>';
                                    }

                                    ?>

                                <div class="col-sm-3 mb-3 mb-sm-0">
                                    <label for="senha">Senha</label>
                                    <input type="password" class="form-control" id="senha" placeholder="Senha"
                                        required="required" name="senha">
                                </div>

                                <div class="col-sm-3 mb-3 mb-sm-0">
                                    <label for="confsenha">Confirmar senha</label>
                                    <input type="password" class="form-control" id="confsenha"
                                        placeholder="Confirmar senha" required="required" name="confsenha">
                                </div>
                            </div>
                            <div class="form-group row">


                                                 <?php 

                                                        include_once('../../controller/crud-sexo.php');
                                                        $select = new CrudSexo();

                                                        if($utilizador->getIdTipoUtilizador() == 11) {
                                                            echo '<div class="col-sm-3 mb-3 mb-sm-0 ">
                                                            <label>Sexo</label>
                                                            <select class="custom-select" required="required" name="sexo">';
                                                            $select->select($user->getIdSexo());
                                                            echo ' </select>
                                                            </div>';
                                                        }
                                                       
                                                     ?>


                                                  <?php

                                                        include_once('../../controller/crud-estado.php');
                                                        $select = new CrudEstado();
                                                        

                                                      if($utilizador->getIdTipoUtilizador() == 11) {
                                                          echo '<div class="col-sm-3 mb-3 mb-sm-0 ">
                                                                  <label>Estado</label>
                                                                    <select class="custom-select" required="required" name="estado">';
                                                                    $select->select($user->getIdEstado());
                                                             echo ' </select>
                                                                 </div>';
                                                      }

                                                        ?>




                                                     <?php

                                                          include_once('../../controller/crud-tipoUser.php');
                                                          $select = new CrudTipoUser();

                                                          if($utilizador->getIdTipoUtilizador() == 11) {
                                                                echo '<div class="col-sm-6 mb-3 mb-sm-0 ">
                                                                <label>Tipo de utilizador</label>
            
                                                                <select class="custom-select" required name="tipoutilizador">';
                                                                    $select->select($user->getIdTipoUtilizador());
                                                                
                                                                echo '</select> </div>';
                                                            
                                                          } 

                                                        ?>



                            </div>
                            <button class="btn btn-primary" name="editar">
                                EDITAR
                            </button>

                                <div class="aviso"></div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
     include_once('../includes/footer-sub.php');
    ?>



<script>
    $(document).ready(function() {

        aviso = $(".aviso");
        $("#form").validate({
            rules: {
                nome: {
                    required: true,
                    minWords: 2,
                    minlength: 2
                },
                email: {
                    required: true,
                    email: true,
                    minlength: 6
                },
                telefone: {
                    required: true,
                    minlength: 9,
                    
                },
                senha: {
                    required: true,
                    minlength: 4,
                    maxlength: 15
                },
                confirsenha: {
                    required: true,
                    minlength: 4,
                    maxlength: 15,
                    equalTo: "#senha"
                }
            },
            submitHandler:      function(_form) {
                var form = new FormData($("#form")[0]);
               // alert('Chegou');
                $.ajax({
                        url:            'action.php',
                        type:           'post',
                        dataType:       'json',
                        cache:          false,
                        processData:    false,
                        contentType:    false,
                        data:           form,
                        timeout:        8000,
                        success:        function(resultado) {
                            if(resultado == 1) {
                                window.location.replace('http://localhost/projectofinal/view/utilizador/vertodos.php');
                            } else {
                                aviso.append(resultado);
                            }
                        }          
                });
            }
        })
    });
</script>