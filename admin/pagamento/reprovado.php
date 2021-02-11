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

       

    </div>
    <div class="card o-hidden border-0 shadow-lg my-3">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-3 mt-5">
                        <div class="text-left">
                            <h1 class="h4 text-gray-900 mb-2 font-weight-bold" style="text-transform: uppercase">Todos
                                Pagamentos Não CONFIRMADO</h1>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Candidato</th>
                                    <th scope="col">Curso</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Comprovativo</th>
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
                                                        $dados = $select->select('Não Aprovado');
                                                    }
                                                } else {
                                                    $dados = $select->select('Não Aprovado');
                                                }
                                                foreach ($dados as $key => $value) {
                                                    echo '<tr>
                                                            <td>'.$value->getNomeCand().'</td>
                                                            <td>'.$value->getCurso().'</td>
                                                            <td>'.$value->getPreco().' Kzs</td>
                                                            <td>'.$value->getEstado().'</td>
                                                            <td>
                                                                <a target="_blanck" href="http://localhost/inscricaoonline/'.$value->getComprovativo().'" title="Ver o comprativo." class="btn btn-outline-success"><i class="fas fa-file-pdf"></i></a>
                                                            </td>
                                                            <td>'.$value->getDtPagamento().'</td>
                                                            <td>'.$value->getDtEdicao().'</td>

                                                            <td>
                                                                <a href="#"  data-toggle="modal" data-target="#edit'.$value->getId().'" class="btn btn-outline-secondary"><i class="far fa-edit"></i></a>
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

 


        #  INCLUIDO O FOOTER
        include_once('../includes/footer-sub.php');
        ?> 



<?php

        $select = new CrudPagamento();
        $dados  = $select->select('Não Aprovado');
        foreach ($dados as $key => $value) {


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

                               <input type="hidden" name="idPagamento" value="'.$value->getId().'">
                                    <select class="custom-select" name="estado" id="">;
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


            


            
        }


        if(isset($_POST['cofirm'])) {
            
            $id = $_POST['id'];
            
            $select->delete($id);
        }
        ?>
