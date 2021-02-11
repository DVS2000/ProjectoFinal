<?php


include_once('../../model/inscricao.php');
include_once('../../controller/crud-inscricao.php');
include_once('../../Util/clear-var.php');

include_once('../../Util/email/enviar.php');

# INCLUINDO O MODEL DO CANDIDATO
include_once('../../model/candidato.php');

# INCLUINDO O CONTROLLER DO CANDIDATO
include_once('../../controller/crud-candidato.php');

# INCLUINDO O MODEL DO CANDIDATO
include_once('../../model/curso.php');

# INCLUINDO O CONTROLLER DO CANDIDATO
include_once('../../controller/crud-curso.php');

# INCLUINDO O MODEL DA INSCRIÇÃO
include_once('../../model/inscricao.php');

# INCLUINDO O CONTROLLER DA INSCRICAO
include_once('../../controller/crud-inscricao.php');

$sendEmail = new SendEmail();

$clean = new Clear();

$estadoInscricao  = $clean->int('estado_inscricao');
$idInscri         =  $clean->int('idInscricao');
$inscricao = new Inscricao();

$inscricao->setId($idInscri);
$inscricao->setEstadoInscricao($estadoInscricao);

$edit = new CrudInscricao();
echo $edit->update($inscricao);

$inscricaoById = $edit->getById($inscricao->getId());

$controllerCandidato = new CrudCandidato();
$candidato = $controllerCandidato->getById($inscricaoById->getIdCandidato());

$controllerCurso = new CrudCurso();
$curso = $controllerCurso->getById($inscricaoById->getIdCurso());

$cursoNome = $curso->getDescricao();

if($estadoInscricao == 2) {
    $emailCand = $candidato->getEmail();
    $nomeCand = $candidato->getNome();
    $sendEmail->sendCustomEmail($emailCand, $nomeCand, "Inscrição efetuada com sucesso no curso de $cursoNome", "INSCRIÇÃO REALIZADA COM SUCESSO");
}

if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}
