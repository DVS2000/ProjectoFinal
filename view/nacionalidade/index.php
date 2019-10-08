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
                                    <form class="user" method="POST" id="form">
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



<script>
    $(document).ready(function() {

        aviso = $(".aviso");

        $("#form").validate({
        rules: {
            nome: {
                required: true,
                minlength:4
            },
        },
        submitHandler: function(_form) {
            var form = new FormData($("#form")[0]);
            nome = $("#nome");

            $.ajax({
                url:            'action.php',
                type:           'post',
                dataType:       'json',
                cache:          false,
                processData:    false,
                contentType:    false,
                data:           form,
                timeout:        8000,
                success:         function(resultado) {
                    nome.val('');
                    aviso.append(resultado);
                }   
            });
        }
    });
    });
</script>