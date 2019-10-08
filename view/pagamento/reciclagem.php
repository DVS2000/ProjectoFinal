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

        <a href="#" class="ml-auto btn btn-sm btn-primary shadow-sm">
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
                                    <th scope="col">Candidato</th>
                                    <th scope="col">Curso</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">Forma de Pagamento</th>
                                    <th scope="col">Tempo</th>
                                    <th scope="col">Data de pagamento</th>
                                    <th scope="col">Data de edição</th>
                                   
                                    <th></th>
                                    <th></th>
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
                                                  } else if($value->getEstado() == 0) {
                                                    echo '<tr>
                                                            <td>'.$value->getNomeCand().'</td>
                                                            <td>'.$value->getCurso().'</td>
                                                            <td>'.$value->getPreco().' Kzs</td>
                                                            <td>'.$value->getFormPag().'</td>
                                                            <td>'.$value->getTempo().'</td>
                                                            <td>'.$value->getDtPagamento().'</td>
                                                            <td>'.$value->getDtEdicao().'</td>
                                                            <td>
                                                                <a  href="#" title="Cofirnmar pagamento." data-toggle="modal" data-target="#confir'.$value->getId().'" class="btn btn-outline-warning"><i class="fas fa-check"></i>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href="#" data-toggle="modal" data-target="#edit'.$value->getId().'" class="btn btn-outline-secondary"><i class="fas fa-pen"></i></a>
                                                            </td>
                                                            
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

            # MODAL PARA ELIMINAR O CURSO
            echo '
                <div class="modal fade" id="confir'.$value->getId().'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmar</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Tens certeza que deseja confirmar este pagamento ?</div>
                        <div class="modal-footer">
                            <form action="confirm.php" method="post">
                                <input type="hidden" name="id" value="'.$value->getId().'">
                                <button data-dismiss="modal" class="btn btn-danger">Não</button>
                                <button type="submit" class="btn btn-outline-secondary" name="cofirm">Sim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>    
            ';


             # MODAL PARA EDITAR O PAGAMENTO
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
                            <input type="hidden" name="id" value="'.$value->getId().'">
                                 <select class="custom-select" name="formPag" id="">';

                                 include_once('../../controller/crud-formPag.php');

                                 $getFormPag = new CrudFormPag();
                                 $formPag = $getFormPag->select();

                                 foreach ($formPag as $key => $valuePag) {
                                     echo $valuePag;
                                 }
                               echo '</select>
                            
                         </div>
                         <div class="modal-footer">
                             <button type="submit" class="btn btn-secondary">Editar</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>    
         ';


            
        }


       
        ?>
