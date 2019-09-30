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
                                            style="text-transform: uppercase">Criar nova Nacionalidade
                                        </h1>
                                        <hr>
                                    </div>
                                    <form class="user" method="POST">
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="nome">Nome</label>
                                                <input type="text" class="form-control " id="nome" placeholder="Nome"
                                                    required="required" name="nome">
                                            </div>

                                            <div class="col-sm-6">
                                                <label>Estado</label>
                                                <select class="custom-select" required="required" name="estado">
                                                    <?php

                                                        include_once('../../controller/crud-estado.php');
                                                        $select = new CrudEstado();
                                                        $select->select();

                                                        ?>
                                                </select>
                                            </div>


                                        </div>

                                        <button class="btn btn-primary ml-auto mt-2" name="guardar">
                                            GUARDAR
                                        </button>

                                        <?php
                                          include_once('../../model/nacionalidade.php');
                                          include_once('../../controller/crud-nacionalidade.php');
                                          # INCLUIDO O FICHEIRO QUE VAI FAZER A LIMPEZA DAS VARIAVEL
                                          include_once('../../Util/clear-var.php');

                                           $clean = new Clear();

                                          if(isset($_POST['guardar'])) {

                                                $nome       = $clean->specialChars('nome');
                                                $estado     = $clean->int('estado');

                                                $model = new Nacionalidade();
                                                $model->setDescricao($nome);
                                                $model->setIdEstado($estado);
                                                $model->setDtCriacao(date('Y-m-d'));
                                                $model->setDtEdicao(date('Y-m-d'));
                                                $insert = new CrudNacionalidade();
                                                $insert->insert($model);
                                          }
                                          ?>

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