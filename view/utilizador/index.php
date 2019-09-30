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
                                                style="text-transform: uppercase">Criar novo
                                                utilizador</h1>
                                            <hr>
                                        </div>
                                        <form class="user" method="POST">
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label for="nome">Nome</label>
                                                    <input type="text" class="form-control " id="nome"
                                                        placeholder="Nome" required="required" name="nome">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email"
                                                        placeholder="Email" required="required" name="email">
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <div class="form-group">
                                                        <label for="telefone">Telefone</label>
                                                        <input type="tel" class="form-control" id="telefone"
                                                            placeholder="Telefone" required="required" name="telefone">
                                                    </div>
                                                </div>

                                                <div class="col-sm-3 mb-3 mb-sm-0">
                                                    <label for="senha">Senha</label>
                                                    <input type="password" class="form-control" id="senha"
                                                        placeholder="Senha" required="required" name="senha">
                                                </div>

                                                <div class="col-sm-3 mb-3 mb-sm-0">
                                                    <label for="confsenha">Confirmar senha</label>
                                                    <input type="password" class="form-control" id="confsenha"
                                                        placeholder="Confirmar senha" required="required"
                                                        name="confsenha">
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <div class="col-sm-3 mb-3 mb-sm-0 ">
                                                    <label>Sexo</label>
                                                    <select class="custom-select" required="required" name="sexo">
                                                        <?php 

                                                        include_once('../../controller/crud-sexo.php');
                                                        $select = new CrudSexo();
                                                        $select->select();

                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3 mb-3 mb-sm-0 ">
                                                    <label>Estado</label>
                                                    <select class="custom-select" required="required" name="estado">
                                                        <?php

                                                        include_once('../../controller/crud-estado.php');
                                                        $select = new CrudEstado();
                                                        $select->select();

                                                        ?>
                                                    </select>
                                                </div>


                                                <div class="col-sm-6 mb-3 mb-sm-0 ">
                                                    <label>Tipo de utilizador</label>

                                                    <select class="custom-select" required name="tipoutilizador">


                                                        <?php
                                                          include_once('../../controller/crud-tipoUser.php');
                                                          $select = new CrudTipoUser();
                                                          $select->select();
                                                        ?>

                                                    </select>
                                                </div>


                                            </div>
                                            <button class="btn btn-primary" name="guardar">
                                                GUARDAR
                                            </button>


                                            <?php
                                          include_once('../../model/utilizador.php');
                                          include_once('../../controller/crud-utilizador.php');

                                          # INCLUIDO O FICHEIRO QUE VAI FAZER A LIMPEZA DAS VARIAVEL
                                          include_once('../../Util/clear-var.php');

                                           $clean = new Clear();


                                          if(isset($_POST['guardar'])) {


                                                # LIMPANDO AS VARIAVÉIS
                                                $nome               = $clean->specialChars('nome');
                                                $email              = $clean->email('email');
                                                $telefone           = $clean->int('telefone');
                                                $senha              = $clean->specialChars('senha');
                                                $sexo               = $clean->int('sexo');
                                                $tipoUtilizador     = $clean->int('tipoutilizador');
                                                $estado             = $clean->int('estado');

                                                $model = new Utilizador();
                                                $model->setNome($nome);
                                                $model->setEmail($email);
                                                $model->setTelefone($telefone);
                                                $model->setSenha(md5($senha));
                                                $model->setIdSexo($sexo);
                                                $model->setIdTipoUtilizador($tipoUtilizador);
                                                $model->setIdEstado($estado);
                                                $model->setDtCriacao(date('Y-m-d H:s'));
                                                $model->setDtEdicao(date('Y-m-d H:s'));

                                                $insert = new CrudUtilizador();
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