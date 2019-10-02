<?php

# CRIANDO A CLASE DO LGIN

class Login {
    private $email;
    private $telefone;
    private $senha;


    # CRIANDO O GET E O SET DO E-MAIL DO UTILIZADOR
    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }

    # CRIANDO O GET O SET DO TELEFONE DO UTILIZADOR
    public function getTelefone() { return $this->telefone; }
    public function setTelefone($telefone) { $this->telefone = $telefone; }

    # CRIANDO O GET O SET DA SENHA DO UTILIZADOR
    public function getSenha() { return $this->senha; }
    public function setSenha($senha) { $this->senha = $senha; }
}