<?php

require_once "controller/MenuController.php";

$menuController = new MenuController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    if ($action === 'crear') {
        $resultado = $menuController->crear($_POST['nombre'], $_POST['descripcion'], $_POST['menuPadre'] ?: null);
        if ($resultado) {
            $_SESSION['mensaje'] = ['tipo' => 'success', 'texto' => 'Menú creado exitosamente.'];
        } else {
            $_SESSION['mensaje'] = ['tipo' => 'danger', 'texto' => 'Error al crear el menú.'];
        }
    } elseif ($action === 'editar') {
        $resultado = $menuController->editar($_POST['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['menuPadre'] ?: null);
        if ($resultado) {
            $_SESSION['mensaje'] = ['tipo' => 'success', 'texto' => 'Menú editado exitosamente.'];
        } else {
            $_SESSION['mensaje'] = ['tipo' => 'danger', 'texto' => 'Error al editar el menú.'];
        }
    } elseif ($action === 'eliminar') {
        $resultado = $menuController->eliminar($_POST['id']);
        if ($resultado) {
            $_SESSION['mensaje'] = ['tipo' => 'success', 'texto' => 'Menú eliminado exitosamente.'];
        } else {
            $_SESSION['mensaje'] = ['tipo' => 'danger', 'texto' => 'Error al eliminar el menú.'];
        }
    }
    header("Location: index.php"); // Redirige después de realizar la acción
    exit;
}


$menus = $menuController->listar();
include "vistas/menu/listar.php";
?>