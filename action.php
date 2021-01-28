<?php


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


session_start();

if (!isset($_SESSION['idCandidato'])) {
    header('Location: index.php');
} else if (!isset($_COOKIE['idCandidato'])) {
    header('Location: index.php');
}

$status = 0;

$dados = new Candidato();
$inscricao = new CrudInscricao();
$clear = new Clear();

if (isset($_POST['criarConta'])) {


    $nome               = $clear->specialChars('nome');
    $email              = $clear->email('email');
    $telefone           = $clear->int('telefone');
    $senha              = $clear->specialChars('senha');
    $confirSenha        = $clear->specialChars('confirSenha');

    /*$anoNasc            = substr($dtNasc, 0, 4);
    $anoActual          = date('Y');

    $idade              = (int)$anoActual - (int)$anoNasc;*/


    if ($senha != $confirSenha) {
        $status = 4;
    } /*else if ($idade < 18) {
        $status = 5;
    }*/ else {
        $candidato = new Candidato();

        $candidato->setNome($nome);
        $candidato->setEmail($email);
        $candidato->setTelefone($telefone);
        $candidato->setSenha(md5($senha));
        $candidato->setDtCriacao(date('Y-m-d'));
        $candidato->setDtEdicao(date('Y-m-d'));

        $insert = new CrudCandidato();
        $status = $insert->insert($candidato);

        if($status == 2) {
            $maxIdAluno = $insert->getMaxId($telefone);

            $dados = $insert->getById($maxIdAluno);
            $_SESSION['idCandidato'] = $dados->getId();
            $_COOKIE['idCandidato']  = $dados->getId();

            $relatorioCandidato = new RelatorioCandidato();
            $relatorioCandidato->UpdateRelatorio();
        }

        echo json_encode($status);
    }
} else if (isset($_POST['entrar'])) {



    $clear = new Clear();

    $telefone           = $clear->int('telEmail');
    $email              = $clear->email('telEmail');
    $senha              = md5($clear->specialChars('senha'));

    $candidato = new Candidato();
    $candidato->setTelefone($telefone);
    $candidato->setEmail($email);
    $candidato->setSenha($senha);

    $login = new CrudCandidato();
    $cand = $login->login($candidato);

    if ($cand->getid() == null) {
        echo json_encode("2");
    } else {
        //  $dadoslogin = $login->getById($cand->getId());
        //  $inscricao = new CrudInscricao();
        //   $inscriCurso = $inscricao->getByCandidato($dados->getId());

        setcookie('idCandidato', $cand->getId(), time() + 36000 * 6);
        $_SESSION['idCandidato'] = $cand->getId();
        echo json_encode("1");
    }
}
