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

        <a href="../../util/relatorio/relatorio-pagamento.php" class="ml-auto btn btn-sm btn-primary shadow-sm">
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
                                Pagamentos</h1>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nome do Candidato</th>
                                    <th scope="col">Curso</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">Forma de Pagamento</th>
                                    <th scope="col">Tempo</th>
                                    <th scope="col">Data de pagamento</th>
                                    <th scope="col">Data de edição</th>
                                   
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                                include_once('../../model/pagamento.php');
                                                include_once('../../controller/crud-pagamento.php');
                                                include_once('../../controller/crud-inscricao.php');

                                                $inscricao = new CrudInscricao();
                                                $select = new CrudPagamento();
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

                                                  if((date('d-m-Y') == $value->getTempo()) || (date('d-m-Y') > $value->getTempo())) {
                                                      $select->delete($value->getId());
                                                      $inscricao->delete($value->getIdInscricao());
                                                  } else if($value->getEstado() == 1) {
                                                    echo '<tr>
                                                            <td>'.$value->getNomeCand().'</td>
                                                            <td>'.$value->getCurso().'</td>
                                                            <td>'.$value->getPreco().' Kzs</td>
                                                            <td>'.$value->getFormPag().'</td>
                                                            <td>'.$value->getTempo().'</td>
                                                            <td>'.$value->getDtPagamento().'</td>
                                                            <td>'.$value->getDtEdicao().'</td>
                                                            
                                                        </tr>';
                                                  }
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

 


        #  INCLUIDO O FOOTER
        include_once('../includes/footer-sub.php');
        ?> 



<?php

        $select = new CrudPagamento();
        $dados  = $select->select();
        foreach ($dados as $key => $value) {

            # MODAL PARA ELIMINAR O PAGAMENTO
            echo '
                <div class="modal fade" id="delete'.$value->getId().'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Tens certeza que deseja eliminar este pagamento ?</div>
                        <div class="modal-footer">
                            <form action="" method="post">
                                <input type="hidden" name="id" value="'.$value->getId().'">
                                <button data-dismiss="modal" class="btn btn-danger">Não</button>
                                <button type="submit" class="btn btn-outline-secondary" name="cofirm">Sim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>    
            ';


            


            
        }


        if(isset($_POST['cofirm'])) {
            
            $id = $_POST['id'];
            
            $select->delete($id);
        }
        ?>
