<?php


require 'model/curso.php';
require 'controller/crud-curso.php';



$model = new Curso();
$model->setId(3);
$model->setDescricao("Ligeiro Básico desde a base");
$model->setPreco(90000);
$model->setRequisitos("Sei la eu , sei lá eu, Testa lá");
$model->setIdEstado(1);
$model->setDtCriacao(date("Y-m-d H:s"));
$model->setDtEdicao(date("Y-m-d H:s"));

$controller = new CrudCurso();
$dados = $controller->search("base");

foreach ($dados as $key => $value) {
    echo "Nome : ".$value->getDescricao()."\n";
}
// $model = new Candidato();
// $model->setId(1);
// $model->setNome("Dorivaldo DVS2000");
// $model->setBi("Q1W2E3R4T5Y67");
// $model->setEmail("dorivaldo.santos@digitalfactory.co.ao");
// $model->setTelefone("923218124");
// $model->setDtNasc(date("Y-m-d"));
// $model->setIdNacionalidade(1);
// $model->setIdEstado(1);
// $model->setDtCriacao(date("Y-m-d H:s"));
// $model->setDtEdicao(date("Y-m-d H:s"));
// $model->setNomeMae("Luzia Vicente");
// $model->setNomePai("Jerry Santos");
// $model->setMorada("Samba-Camuxiba");


// $crud = new CrudCandidato();
// $candidatos = $crud->search("dos");

// foreach ($candidatos as $key => $value) {
//     # code...
//     echo $value->getNome()."\n";
// }

// require 'model/nacionalidade.php';
// require 'controller/crud-nacionalidade.php';


// if(isset($_POST['enviar'])) {
//     $model = new Nacionalidade();
//     $model->setDescricao($_POST["descricao"]);

//     $insert = new CrudNacionalidade();
//     $dados = $insert->select();
//     foreach($dados as $key => $value) {
//         echo "<h5>".$value->getDescricao()."</h5>";
//     }


// }

// ?>

