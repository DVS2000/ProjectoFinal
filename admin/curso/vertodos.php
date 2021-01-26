<?php

include_once('../includes/header-sub.php');

?>

<div class="container-fluid">
    <div class="row mx-1">
        <form class="form-inline mr-auto  my-3 my-md-0 mw-100 navbar-search" method="GET">
            <div class="input-group">
                <input type="text" class="form-control bg-white border-1 small" placeholder="Pesquisa por..."
                    name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : "" ?>">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        <a href="../../util/relatorio/relatorio-curso.php" class="ml-auto btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50">

            </i> Gerar relatório</a>

    </div>
    <div class="card o-hidden border-0 shadow-lg my-3">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-3 mt-5">
                        <div class="text-left">
                            <h1 class="h4 text-gray-900 mb-2 font-weight-bold" style="text-transform: uppercase">Todos
                                Cursos</h1>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Preço</th>
                                    <th>Faculdade</th>
                                    <th scope="col">Data de criação</th>
                                    <th scope="col">Data de edição</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                                include_once('../../model/curso.php');
                                                include_once('../../controller/crud-curso.php');
                                                $select = new CrudCurso();
                                                $dados;

                                                if(isset($_GET['search'])) {
                                                    $search = $_GET['search'];
                                                    if($search != null) {
                                                        $dados = $select->search($search);
                                                    } else {
                                                        $dados = $select->select();
                                                    }
                                                } else {
                                                    $dados = $select->select();
                                                }
                                                foreach ($dados as $key => $value) {
                                                    echo '<tr>
                                                            <td>'.$value->getDescricao().'</td>
                                                            <td>'.$value->getPreco().' Kzs</td>
                                                            <td>'.$value->getFaculdade().'</td>
                                                            <td>'.$value->getDtCriacao().'</td>
                                                            <td>'.$value->getDtEdicao().'</td>
                                                            <td>
                                                                <a  href="#" title="Ver requisitos."  data-toggle="modal" data-target="#requisitos'.$value->getId().'" class="btn btn-outline-success"><i class="fas fa-eye    "></i></a>
                                                            </td>
                                                            <td>
                                                                <a  href="http://localhost/inscricaoonline/'.$value->getPlanoAula().'" target="_blanck" title="Ver plano de aula." class="btn btn-outline-success"><i class="fas fa-file-pdf"></i></a>
                                                            </td>
                                                            <td>
                                                                <a href="editar.php?id='.$value->getId().'" class="btn btn-outline-secondary"><i class="fas fa-pen"></i></a>
                                                            </td>
                                                            <td>
                                                                <a href="#"  data-toggle="modal" data-target="#delete'.$value->getId().'" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></a>
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

        $select = new CrudCurso();
        $dados  = $select->select();
        foreach ($dados as $key => $value) {

            # MODAL PARA ELIMINAR O CURSO
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
                        <div class="modal-body">Tens certeza que deseja eliminar permanentemente ou desactivar este curso ?</div>
                        <div class="modal-footer">
                            <form action="deletar.php" method="post">
                                <input type="hidden" name="id" value="'.$value->getId().'">
                                <button type="submit" class="btn btn-danger" name="disable">Desactivar</button>
                                <button type="submit" class="btn btn-danger" name="delete">Eliminar</button>
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
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Requisitos do Curso</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    
                    <div class="containeir-fluid">
                        <div class="row">
                        <div class="col-12">
                        '.$value->getRequisitos().'
                        </div>
                      </div>
                    </div>
                    
                    </div>
                   
                    
                   
                    <div class="modal-footer">
                        <button class="btn btn-outline-success" type="button" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>    
        ';
        }


        #  INCLUIDO O FOOTER
        include_once('../includes/footer-sub.php');
        ?>