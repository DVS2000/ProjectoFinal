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

        <a href="<?php echo isset($_GET['search']) ? "../../util/relatorio/relatorio-inscricao.php?search=".$_GET['search'] : "../../util/relatorio/relatorio-inscricao.php"; ?>" class="ml-auto btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50">

            </i> Gerar relatório</a>

    </div>
    <div class="card o-hidden border-0 shadow-lg my-1">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-3 mt-5">
                        <div class="text-left">
                            <h1 class="h4 text-gray-900 mb-2 font-weight-bold" style="text-transform: uppercase">Todas
                                inscrições | Aprovados</h1>

                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nome do candidato</th>
                                    <th scope="col">Curso</th>
                                    <th>Estado</th>
                                    <th scope="col">Data de inscrição</th>
                                    <th scope="col">Data de edição</th>
                                    <th></th>
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
                                                        $dados = $select->search($search, 'Aprovado');
                                                    } else {
                                                        $dados = $select->select('Aprovado');
                                                    }
                                                } else {
                                                    $dados = $select->select('Aprovado');
                                                }
                                                foreach ($dados as $key => $value) {
                                                    echo '<tr>
                                                            <td>'.$value->getNomeCand().'</td>
                                                            <td>'.$value->getCurso().'</td>
                                                            <td>'.$value->getEstadoInscricao().'</td>
                                                            <td>'.$value->getDtCriacao().'</td>
                                                            <td>'.$value->getDtEdicao().'</td>
                                                            <td>
                                                                <a  href="#" title="Ver requisitos."  data-toggle="modal" data-target="#outros'.$value->getId().'" class="btn btn-outline-success"><i class="fas fa-eye    "></i></a>
                                                            </td>
                                                            
                                                            <td>
                                                                <a href="#"  data-toggle="modal" data-target="#edit'.$value->getId().'" class="btn btn-outline-secondary"><i class="far fa-edit"></i></a>
                                                            </td>
                                                            <td>
                                                                <a href="#"  data-toggle="modal" data-target="#delete'.$value->getId().'" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></a>
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
        $dados  = $select->select('Aprovado');
        foreach ($dados as $key => $value) {

            # MODAL PARA ELIMINAR A INSCRIÇÃO
            echo '
                <div class="modal fade" id="delete'.$value->getId().'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">'.$value->getNomeCand().'</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Tens certeza que deseja eliminar permanentemente ou cancelar esta inscrição ?</div>
                        <div class="modal-footer">
                            <form action="deletar.php" method="post">
                                <input type="hidden" name="id" value="'.$value->getId().'">
                                <button type="submit" class="btn btn-danger" name="disable">Cancelar</button>
                                <button type="submit" class="btn btn-danger" name="delete">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>    
            ';


            # MODAL PARA EDITAR A INSCRIÇÃO
            echo '
                <div class="modal fade" id="edit'.$value->getId().'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">'.$value->getNomeCand().'</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="update.php" method="post">
                            <div class="modal-body">
                               <input type="hidden" name="idInscricao" value="'.$value->getId().'">
                                    <select class="custom-select" name="estado_inscricao" id="">;
                                    <option value="1">Pendente</option>
                                    <option value="2">Aprovado</option>
                                    <option value="3">Não Aprovado</option>
                                  </select>
                               
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-secondary">Editar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>    
            ';


            # MODAL PARA EDITAR A INSCRIÇÃO
            echo '
                <div class="modal fade" id="outros'.$value->getId().'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Outros Dados</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="update.php" method="post">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12 mb-2">
                                    <a target="_blank" href="http://localhost/inscricaoonline/'.$value->getFoto().'" class="btn btn-primary btn-lg">Abrir Fotográfia</a>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                    <a target="_blank" href="http://localhost/inscricaoonline/'.$value->getCertificado().'" class="btn btn-primary btn-lg">Abrir Certificado</a>
                                    </div>
                                    <div class="col-sm-12">
                                    <a target="_blank" href="http://localhost/inscricaoonline/'.$value->getBilheteFile().'" class="btn btn-primary btn-lg">Abrir Bilhete de Identidade</a>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" data-toggle="modal" data-target="outros'.$value->getId().'" class="btn btn-secondary">Fechar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>    
            ';

        }



       
?>