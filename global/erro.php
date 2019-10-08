<?php

 class Erro {
     public static function Erros($tipoErro, $descricao) {
        echo "
        <div class='text-center'>
            <div class='error mx-auto' data-text='$tipoErro'>$tipoErro</div>
            <p class='lead text-gray-800 mb-1' style='text-transform: uppercase'>$descricao</p>
            <a href='../'>&larr; Voltar para Página Inicial</a>
        </div>
        ";
    }
}