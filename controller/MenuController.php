<?php

require_once __DIR__ . "/../model/MenuModel.php";

class MenuController {
    private $model;

    public function __construct() {
        $this->model = new MenuModel();
    }

    public function listar() {
        return $this->model->listarMenus();
    }

    public function crear($nombre, $descripcion, $menuPadre) {
        return $this->model->crearMenu($nombre, $descripcion, $menuPadre);
    }

    public function editar($id, $nombre, $descripcion, $menuPadre) {
        return $this->model->editarMenu($id, $nombre, $descripcion, $menuPadre);
    }

    public function eliminar($id) {
        return $this->model->eliminarMenu($id);
    }

    public function obtener($id) {
        return $this->model->obtenerMenu($id);
    }
    
    public function obtenerMenusPrincipales() {
        return $this->model->obtenerMenusPrincipales();
    }
    
    public function obtenerSubmenus($menuPadreId) {
        return $this->model->obtenerSubmenus($menuPadreId);
    }
}
?>