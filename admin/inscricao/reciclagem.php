<?php

include_once('../includes/header-sub.php');

?>
<div class="container-fluid">

   

    </div>
    <div class="card o-hidden border-0 shadow-lg my-1">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-3 mt-5">
                        <div class="text-left">
                            <h1 class="h4 text-gray-900 mb-2 font-weight-bold" style="text-transform: uppercase">Todas
                                inscrições canceladas</h1>

                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nome do candidato</th>
                                    <th scope="col">Curso</th>
                                    <th scope="col">Data de inscrição</th>
                                    <th scope="col">Data de edição</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                                include_once('../../model/inscricao.php');
                                                include_once('../../controller/crud-inscricao.php');
                                                $select = new CrudInscricao();
                                                $dados;

                                                if(isset($_GET['search'])) {
                                                    $search = $_GET['search'];
                                                    if($search != null) {
                                                        $dados = $select->search($search);
                                                    } else {
                                                        $dados = $select->selectDisable();
                                                    }
                                                } else {
                                                    $dados = $select->selectDisable();
                                                }
                                                foreach ($dados as $key => $value) {
                                                    echo '<tr>
                                                            <td>'.$value->getNomeCand().'</td>
                                                            <td>'.$value->getCurso().'</td>
                                                            <td>'.$value->getDtCriacao().'</td>
                                                            <td>'.$value->getDtEdicao().'</td>
                                                            
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


 
        $select = new CrudInscricao();
        $dados  = $select->selectDisable();
        foreach ($dados as $key => $value) {

            # MODAL PARA ELIMINAR O CURSO
            echo '
                <div class="modal fade" id="recuperar'.$value->getId().'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">'.$value->getNomeCand().'</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Tens certeza que deseja eliminar permanentemente ou recuperar esta inscrição ?</div>
                        <div class="modal-footer">
                            <form action="recuperar.php" method="post">
                                <input type="hidden" name="id" value="'.$value->getId().'">
                                <button type="submit" class="btn btn-danger" name="enable">Recuperar</button>
                                <button type="submit" class="btn btn-danger" name="delete">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>    
            ';

        }
?>