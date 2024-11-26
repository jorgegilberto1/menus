<?php

namespace App\Model;

interface MenuModelInterface
{
    public function listarMenus();
    public function crearMenu($nombre, $descripcion, $menuPadre);
    public function obtenerMenu($id);
    public function editarMenu($id, $nombre, $descripcion, $menuPadre);
    public function eliminarMenu($id);
    public function obtenerMenusPrincipales();
    public function obtenerSubmenus($menuPadreId);
}
