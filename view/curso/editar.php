<?php

  if(isset($_GET['id'])) {

    include_once('../../model/curso.php');
    include_once('../../controller/crud-curso.php');

    # INCLUIDO O FICHEIRO QUE VAI FAZER A LIMPEZA DAS VARIAVEL
    include_once('../../Util/clear-var.php');
    $clean = new Clear();
    $clean->connect();

    $id = $clean->intGET('id');


    if($id != null) {

        $selectCurso = new CrudCurso();
        $curso  = $selectCurso->getById($id);
        if($curso->getId() == null) {
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
                                            <h1 class="h4 text-gray-900 mb-2 font-weight-bold"
                                                style="text-transform: uppercase">Editar
                                                Curso</h1>
                                            <hr>
                                        </div>
                                        <form class="user" method="POST">
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label for="nome">Nome</label>
                                                    <input type="text" class="form-control " id="nome"
                                                        placeholder="Nome" required="required" name="nome" value="<?php echo $curso->getDescricao(); ?>" >
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="preco">Preço</label>
                                                    <input type="number" class="form-control" id="preco"
                                                        placeholder="Preço" required="required" name="preco" value="<?php echo $curso->getPreco(); ?>">
                                                </div>


                                                <div class="col-sm-3">
                                                <label>Estado</label>
                                                    <select class="custom-select" required="required" name="estado">
                                                        <?php

                                                        include_once('../../controller/crud-estado.php');
                                                        $select = new CrudEstado();
                                                        $select->select($curso->getIdEstado());

                                                        ?>
                                                    </select>
                                                </div>


                                            </div>
                                            <div class="form-group row">
                                               <div class="col-sm-12">
                                               <label>Requisitos</label>

                                                <div class="centered">
                                                <textarea name="requisitos" id="editor">
                                                      <?php echo $curso->getRequisitos(); ?> 
                                                 </textarea>
                                                </div>
                                               </div> 
                                            </div>

                                            <div class="form-group row">
                                               <div class="col-sm-12">
                                               <label>Plano de Aula</label>

                                                <div class="centered">
                                                <textarea name="planoAula" id="editor1">
                                                      <?php echo $curso->getPlanoAula(); ?> 
                                                 </textarea>
                                                </div>
                                               </div> 
                                            </div>


                                            <?php
                                          include_once('../../model/curso.php');
                                          include_once('../../controller/crud-curso.php');
                                          

                                          if(isset($_POST['guardar'])) {


                                            if(empty($_POST['requisitos']) || empty($_POST['requisitos'])) {
                                                echo '<div class="alert alert-danger mt-5 alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                  <span class="sr-only">Close</span>
                                                </button>
                                                   <h4 class="alert-heading">Preencha todos os campos.</h4>
                                                </div>';
                                             } else {

                                            # ============LIMPANDO AS VARIÁVEIS============== #
                                            
                                            $nome         = $clean->specialChars('nome');
                                            $preco        = $clean->int('preco');
                                            $estado       = $clean->int('estado');
                                            $resquitos    = $clean->script($_POST['requisitos']);
                                            $planoAula    = $clean->script($_POST['planoAula']);

                                                $model = new Curso();
                                                $model->setId($clean->intGET('id'));
                                                $model->setDescricao($nome);
                                                $model->setPreco($preco);
                                                $model->setIdEstado($estado);
                                                $model->setRequisitos($resquitos);
                                                $model->setPlanoAula($planoAula);
                                                $model->setDtEdicao(date('Y-m-d H:s'));

                                                
                                                $insert = new CrudCurso();
                                                $insert->update($model);

                                             }

                                          }
                                          ?>


                                            <button class="btn btn-primary ml-auto mt-2" name="guardar">
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

        <script src="../../src/ckeditor.js"></script>
        <script>
             ClassicEditor
            .create(document.querySelector('#editor'), {
                     toolbar: [ 
                                'heading',
                                '|',
                                'alignment',                                                 
                                'bold',
                                'italic',
                                'link',
                                'bulletedList',
                                'numberedList',
                                'blockQuote',
                                'undo',
                                'redo'
                        ]
                     })
                      .then(editor => {
                       window.editor = editor;
                     })
                      .catch(err => {
                        console.error(err.stack);
                      });


            ClassicEditor
            .create(document.querySelector('#editor1'), {
                     toolbar: [ 
                                'heading',
                                '|',
                                'alignment',                                                 
                                'bold',
                                'italic',
                                'link',
                                'bulletedList',
                                'numberedList',
                                'blockQuote',
                                'undo',
                                'redo'
                        ]
                     })
                      .then(editor => {
                       window.editor = editor;
                     })
                      .catch(err => {
                        console.error(err.stack);
                      });
             </script>