<?php


# INCLUIDO A CLASS DE CONEXÃO PARA USAR NA FILTRAGEM DOS DADOS NO BANCO DE DADOS


class Clear extends Conexao {

    # FUNÇÃO PARA LIMPAR OS CARACTERES ESPECIAL
    public function specialChars($name) {
        $var              = filter_input(INPUT_POST, $name, FILTER_SANITIZE_SPECIAL_CHARS);
        $html             = htmlspecialchars($var);   
        $varClean         = mysqli_escape_string($this->conexao, $html);
        return $varClean;
    }

    # FUNÇÃ PARA LIMPAR UM EMAIL
    public function email($name) {
        $var               = filter_input(INPUT_POST, $name, FILTER_SANITIZE_EMAIL);
        $html              = htmlspecialchars($var);
        $varClean          = mysqli_escape_string($this->conexao, $html);
        return $varClean;
    }

    # FUNÇÃO PARA LIMPAR UM INTERIO
    public function int($name) {
        $var                = filter_input(INPUT_POST, $name, FILTER_SANITIZE_NUMBER_INT);
        $varClean           = mysqli_escape_string($this->conexao, $var);
        return $varClean;
    }

    #Função para Limpar a tag script
    public function script($var) {
        $tag_open            = str_replace("<script>", ".", $var);
        $varClean            = str_replace("</script>", "." , $tag_open);
        return $varClean;
    }


    # ::::::::::::::::::::::::::: PARA OS GET :::::::::::::::::::::::::::::::::::

    # FUNÇÃO PARA LIMPAR OS CARACTERES ESPECIAL
    public function specialCharsGET($name) {
        $var              = filter_input(INPUT_GET, $name, FILTER_SANITIZE_SPECIAL_CHARS);
        $html             = htmlspecialchars($var);   
        $varClean         = mysqli_escape_string($this->conexao, $html);
        return $varClean;
    }


    # FUNÇÃO PARA LIMPAR UM INTERIO
    public function intGET($name) {
        $var                = filter_input(INPUT_GET, $name, FILTER_SANITIZE_NUMBER_INT);
        $varClean           = mysqli_escape_string($this->conexao, $var);
        return $varClean;
    }
}


