<?php

require_once __DIR__ . "/conexion.php";

class MenuModel {
    var $conexion;

    function __construct() {
        $con = new Conexion();
        $this->conexion = $con->conectar();
    }

    function __destruct() {
        $this->conexion = null;
    }

    public function listarMenus() {
        $stmt = $this->conexion->prepare("SELECT m.*, mp.nombre AS nombre_menu_padre
                                            FROM menus m
                                            LEFT JOIN menus mp ON m.menu_padre = mp.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearMenu($nombre, $descripcion, $menuPadre) {
        $stmt = $this->conexion->prepare("INSERT INTO menus (nombre, descripcion, menu_padre) VALUES (:nombre, :descripcion, :menuPadre)");
        $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(":menuPadre", $menuPadre, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function obtenerMenu($id) {
        $stmt = $this->conexion->prepare("SELECT * FROM menus WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editarMenu($id, $nombre, $descripcion, $menuPadre) {
        $stmt = $this->conexion->prepare("UPDATE menus SET nombre = :nombre, descripcion = :descripcion, menu_padre = :menuPadre WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(":menuPadre", $menuPadre, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function eliminarMenu($id) {
        $stmt = $this->conexion->prepare("DELETE FROM menus WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    public function obtenerMenusPrincipales() {
        $stmt = $this->conexion->prepare("SELECT * FROM menus WHERE menu_padre IS NULL");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function obtenerSubmenus($menuPadreId) {
        $stmt = $this->conexion->prepare("SELECT * FROM menus WHERE menu_padre = :menuPadreId");
        $stmt->bindParam(":menuPadreId", $menuPadreId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>