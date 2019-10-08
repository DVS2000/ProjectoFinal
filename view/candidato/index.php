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

        <a href="../../util/relatorio/relatorio-candidato.php" class="ml-auto btn btn-sm btn-primary shadow-sm">
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
                            <h1 class="h4 text-gray-900 mb-2 font-weight-bold" style="text-transform: uppercase">Todos
                                candidatos</h1>

                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">BI</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Telefone</th>
                                    <th scope="col">Data de nascimento</th>
                                    <th scope="col">Sexo</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                                include_once('../../model/candidato.php');
                                                include_once('../../controller/crud-candidato.php');
                                                $select = new CrudCandidato();
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
                                                            <td>'.$value->getNome().'</td>
                                                            <td>'.$value->getBi().'</td>
                                                            <td>'.$value->getEmail().'</td>
                                                            <td>'.$value->getTelefone().'</td>
                                                            <td>'.$value->getDtNasc().'</td>
                                                            <td>'.$value->getSexo().'</td>
                                                        
                                                            <td>
                                                                <a href="#" data-toggle="modal" data-target="#verMais'.$value->getId().'" class="btn btn-outline-success"><i class="fas fa-eye    "></i></a>
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
                ?>



<?php

        $select = new CrudCandidato();
        $dados  = $select->select();
        foreach ($dados as $key => $value) {
            echo '
                <div class="modal fade" id="delete'.$value->getId().'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">'.$value->getNome().'</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Tens certeza que deseja eliminar permanentemente ou desactivar este candidato ?</div>
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



            echo '
                <div class="modal fade" id="verMais'.$value->getId().'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Outros Dados</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                              <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nacionalidade</th>
                                        <th scope="col">Nome do pai</th>
                                        <th scope="col">Nome da Mãe</th>
                                        <th scope="col">Morada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td>'.$value->getNacionalidade().'</td>
                                    <td>'.$value->getNomePai().'</td>
                                    <td>'.$value->getNomeMae().'</td>
                                    <td>'.$value->getMorada().'</td>
                                   
                                  </tr>
                                </tbody>
                             </table>
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
        ?>