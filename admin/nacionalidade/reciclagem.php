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
                                            <h1 class="h4 text-gray-900 mb-2 font-weight-bold"
                                                style="text-transform: uppercase">NACIONALIDADES DESACTIVADAS</h1>

                                        </div>
                                        <table class="table table-striped">
                                        <thead>
                                                <tr>
                                                    <th scope="col">Nome</th>
                                                    <th scope="col">Data de criação</th>
                                                    <th scope="col">Data de edição</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include_once('../../model/nacionalidade.php');
                                                include_once('../../controller/crud-nacionalidade.php');
                                                $select = new CrudNacionalidade();
                                                $dados  = $select->selectDesactivado();
                                                foreach ($dados as $key => $value) {
                                                    echo '<tr>
                                                            <td>'.$value->getDescricao().'</td>
                                                            <td>'.$value->getDtCriacao().'</td>
                                                            <td>'.$value->getDtEdicao().'</td>
                                                            
                                                            <td>
                                                                <a href="#"  data-toggle="modal" data-target="#delete'.$value->getId().'" class="btn btn-outline-danger"><i class="fas fa-trash-restore-alt"></i></a>
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

        $select = new CrudNacionalidade();
        $dados  = $select->selectDesactivado();
        foreach ($dados as $key => $value) {

            # MODAL PARA ELIMINAR E RECUPERAR O CURSO
            echo '
                <div class="modal fade" id="delete'.$value->getId().'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                <button type="submit" class="btn btn-danger" name="delete">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>    
            ';
        }
        ?>