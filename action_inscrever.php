<?php

# INCLUINDO O MODEL DO CURSO
include_once('model/curso.php');

# INCLUINDO O CONTROLLER DO CURSO
include_once('controller/crud-curso.php');

# INCLUINDO O MODEL DO CANDIDATO
include_once('model/candidato.php');

# INCLUINDO O CONTROLLER DO CANDIDATO
include_once('controller/crud-candidato.php');

# INCLUINDO O FICHEIRO DE LIMPEZA DAS VARIAVEIS
include_once('Util/clear-var.php');

include_once('controller/relatorio-candidato.php');

# INCLUINDO O MODEL DA INSCRIÇÃO
include_once('model/inscricao.php');

# INCLUINDO O CONTROLLER DA INSCRICAO
include_once('controller/crud-inscricao.php');

if(isset($_POST['idFaculdade'])) {

    $idFaculdade = $_POST['idFaculdade'];

    $curso = new CrudCurso();

    $dados = $curso->getByIdFaculdade($idFaculdade);


    echo json_encode($dados);
} else if(isset($_POST['idCurso'])) {

    $idCurso = $_POST['idCurso'];

    $curso = new CrudCurso();

    $dados = $curso->getPrecoByID($idCurso);

    echo json_encode(array("descricao" => $dados->getDescricao(), "preco" => $dados->getPreco(), "planoAula" => $dados->getPlanoAula()));
} else if(isset($_POST['inscrever'])) {

    $files = '';
    $a = 0;
    $nomes = array('foto', 'certificado', 'bilhete');
    $countFiles = 2;
    $namesFiles = array();

    while ($a <= $countFiles) {
       
       $extensao      = pathinfo($_FILES[$nomes[$a]]['name'], PATHINFO_EXTENSION);
       $folder       = "admin/upload/";
       $tempFile     = $_FILES[$nomes[$a]]['tmp_name'];
       $namesFiles[] = $newNAME = uniqid().".$extensao";
       move_uploaded_file($tempFile, $folder.$newNAME);
       $a++;
    }

    $status;
    $candidato = new Candidato();

    $candidato->setId($_POST['id']);
    $candidato->setTelefone($_POST['telefone']);
    $candidato->setEmail($_POST['telEmail']);
    $candidato->setBi($_POST['bi']);
    $candidato->setDtNasc($_POST['dtNasc']);
    $candidato->setIdNacionalidade($_POST['nacionalidade']);
    $candidato->setDtEdicao(date('Y-m-d'));
    $candidato->setMorada($_POST['morada']);
    $candidato->setFoto("admin/upload/$namesFiles[0]");
    $candidato->setCertificado("admin/upload/$namesFiles[1]");
    $candidato->setBilheteFile("admin/upload/$namesFiles[2]");

    $updateCandidado = new CrudCandidato();
    $status = $updateCandidado->updateInInscricao($candidato);

    if($status == 2) {
        $inscrcao = new Inscricao();
        $inscrcao->setIdCurso($_POST['curso']);
        $inscrcao->setIdCandidato($candidato->getId());
        $inscrcao->setDtCriacao(date('Y-m-d'));
        $inscrcao->setDtEdicao(date('Y-m-d'));

        $insertInscricao = new CrudInscricao();
        $status = $insertInscricao->insert($inscrcao);
    }

    

    echo json_encode($status);
    
}
