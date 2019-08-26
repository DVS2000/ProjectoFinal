<?php




# ESTÁ CLASSE SERÁ HERDADO POR TODOS CONTROLLERS
interface Crud {

    # ESTÁ SERÁ A FUNÇÃO SERVIRÁ PARA FAZER O INSERT
    public function insert();

     # ESTÁ SERÁ A FUNÇÃO SERVIRÁ PARA FAZER O UPDATE
    public function update();

     # ESTÁ SERÁ A FUNÇÃO SERVIRÁ PARA FAZER O DELETE
    public function delete();

     # ESTÁ SERÁ A FUNÇÃO SERVIRÁ PARA FAZER O SELECT
    public function select();
    
}