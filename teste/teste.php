<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form id="form" method="post">
<input type="text" name="nome" id="">
<input type="submit" value="Enviar">
</form>
    
<script src="../src/jquery/jquery.js"></script>
<script src="../src/js/sb-admin-2.min.js"></script>
    <script src="../src/jquery/jquery.validate.min.js"></script>
    <script src="../src/jquery/additional-methods.min.js"></script>
    <script src="../src/jquery/localization/messages_pt_PT.js"></script>

    <script>
        $(document).ready(function() {

         
            $("#form").validate({
                rules: {
                    nome: {
                        required: true,
                       
                    },
                    
                },
                submitHandler: function(forms) {

                    var form = new FormData($("#form")[0]);
                       $.ajax({
                        url: '../outro.php',
                        type:           'post',
                        dataType:       'json',
                        cache:          false,
                        processData:    false,
                        contentType:    false,
                        data:           form,
                        timeout:        8000,
                        success: function(resultado) {
                            alert(resultado);
                        }
                       });
                    }
            });
        });


        baguetteBox.run('.tz-gallery');
    </script>
</body>
</html>