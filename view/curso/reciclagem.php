<?php

include_once('../includes/header-sub.php');

?>
<div class="container-fluid">

    <div class="card o-hidden border-0 shadow-lg my-1">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-3 mt-5">
                        <div class="text-left">
                            <h1 class="h4 text-gray-900 mb-2 font-weight-bold" style="text-transform: uppercase">Todos
                                Cursos Eliminados</h1>

                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">Data de criação</th>
                                    <th scope="col">Data de edição</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                                include_once('../../model/curso.php');
                                                include_once('../../controller/crud-curso.php');
                                                $select = new CrudCurso();
                                                $dados  = $select->selectDesactivado();
                                                foreach ($dados as $key => $value) {
                                                    echo '<tr>
                                                            <td>'.$value->getDescricao().'</td>
                                                            <td>'.$value->getPreco().' Kzs</td>
                                                            <td>'.$value->getDtCriacao().'</td>
                                                            <td>'.$value->getDtEdicao().'</td>
                                                            <td>
                                                                <a  href="#" title="Ver requisitos."  data-toggle="modal" data-target="#requisitos'.$value->getId().'" class="btn btn-outline-success"><i class="fas fa-eye    "></i></a>
                                                            </td>
                                                            <td>
                                                                <a href="#"  data-toggle="modal" data-target="#recuperar'.$value->getId().'" class="btn btn-outline-danger"><i class="fas fa-trash-restore-alt"></i></a>
                                                            </td>
                                                        </tr>';
                                                }


                                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>







</div>
<?php

include_once('../includes/footer-sub.php');

?>


<?php

        $select = new CrudCurso();
        $dados  = $select->selectDesactivado();
        foreach ($dados as $key => $value) {

            # MODAL PARA ELIMINAR O CURSO
            echo '
                <div class="modal fade" id="recuperar'.$value->getId().'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">'.$value->getDescricao().'</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Tens certeza que deseja recuperar este curso ?</div>
                        <div class="modal-footer">
                            <form action="recuperar.php" method="post">
                                <input type="hidden" name="id" value="'.$value->getId().'">
                                <button type="submit" class="btn btn-danger" name="recuperar">Recuperar</button>
                                <button type="submit" class="btn btn-danger" name="deletar">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>    
            ';


            # MODAL PARA VER OS REQUITOS DO CURSO

            echo '
            <div class="modal fade" id="requisitos'.$value->getId().'" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Requisitos Necessário</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">'.$value->getRequisitos().' <hr></div>
                   
                    <h5 class="modal-title pl-3">Plano de Aula</h5>
                    <div class="modal-body">'.$value->getPlanoAula().'</div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-success" type="button" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>    
        ';
        }
        ?>

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="../js/sb-admin-2.min.js"></script>
<!-- Page level custom scripts -->
<script src="../js/demo/chart-area-demo.js"></script>
</body>

</html>