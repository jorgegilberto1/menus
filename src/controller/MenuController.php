<?php

namespace App\Controller;

use App\Model\MenuModel;
use App\Controller\BaseController;

class MenuController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new MenuModel();
    }

    public function listar()
    {
        try {
            return $this->model->listarMenus();
        } catch (\Exception $e) {
            // Registrar error o manejar la excepción según sea necesario
            return false;
        }
    }

    public function crear($nombre, $descripcion, $menuPadre)
    {
        try {
            return $this->model->crearMenu($nombre, $descripcion, $menuPadre);
        } catch (\Exception $e) {
            // Registrar error o manejar la excepción según sea necesario
            return false;
        }
    }

    public function editar($id, $nombre, $descripcion, $menuPadre)
    {
        try {
            return $this->model->editarMenu($id, $nombre, $descripcion, $menuPadre);
        } catch (\Exception $e) {
            // Registrar error o manejar la excepción según sea necesario
            return false;
        }
    }

    public function eliminar($id)
    {
        try {
            return $this->model->eliminarMenu($id);
        } catch (\Exception $e) {
            // Registrar error o manejar la excepción según sea necesario
            return false;
        }
    }

    public function obtener($id)
    {
        try {
            return $this->model->obtenerMenu($id);
        } catch (\Exception $e) {
            // Registrar error o manejar la excepción según sea necesario
            return false;
        }
    }

    public function obtenerMenusPrincipales()
    {
        try {
            return $this->model->obtenerMenusPrincipales();
        } catch (\Exception $e) {
            // Registrar error o manejar la excepción según sea necesario
            return false;
        }
    }

    public function obtenerSubmenus($menuPadreId)
    {
        /* return $this->model->obtenerSubmenus($menuPadreId); */
        try {
            return $this->model->obtenerSubmenus($menuPadreId);
        } catch (\Exception $e) {
            // Registrar error o manejar la excepción según sea necesario
            return false;
        }
    }
}
