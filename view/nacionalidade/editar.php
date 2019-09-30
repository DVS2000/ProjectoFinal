<?php

if(isset($_GET['id'])) {

    include_once('../../model/nacionalidade.php');
    include_once('../../controller/crud-nacionalidade.php');

    # INCLUIDO O FICHEIRO QUE VAI FAZER A LIMPEZA DAS VARIAVEL
    include_once('../../Util/clear-var.php');
    $clean = new Clear();

    $id = $clean->intGET('id');
        if($id != null) {
            $selectNacional = new CrudNacionalidade();
            $nacional  = $selectNacional->getById($id);
            if($nacional->getId() == null) {
                header('Location: ../index.html');
            }

        } else {
            header('Location: ../index.html');
        } 
    
    } else {
        header('Location: ../index.html');
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
                                Nacionalidade</h1>
                            <hr>
                        </div>
                        <form class="user" method="POST">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control " id="nome" placeholder="Nome"
                                        required="required" name="nome"
                                        value="<?php echo $nacional->getDescricao(); ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label>Estado</label>
                                    <select class="custom-select" required="required" name="estado">
                                        <?php

                                                        include_once('../../controller/crud-estado.php');
                                                        $select = new CrudEstado();
                                                        $select->select($nacional->getIdEstado());

                                                        ?>
                                    </select>
                                </div>

                            </div>


                            <?php
                                          include_once('../../model/nacionalidade.php');
                                          include_once('../../controller/crud-nacionalidade.php');
                                          if(isset($_POST['editar'])) {

                                                # LIMPANDO AS VARIAVÉL
                                                $descricao          = $clean->specialChars('nome');
                                                $estado             = $clean->int('estado');

                                                $model = new Nacionalidade();
                                                $model->setId($id);
                                                $model->setDescricao($descricao);                                               
                                                $model->setIdEstado($estado);
                                                $model->setDtEdicao(date('Y-m-d'));
                                                $insert = new CrudNacionalidade();
                                                $insert->update($model);
                                          }
                                          ?>


                            <button class="btn btn-primary ml-auto mt-2" name="editar">
                                EDITAR
                            </button>


                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<?php
                include_once('../includes/footer-sub.php');
                ?>