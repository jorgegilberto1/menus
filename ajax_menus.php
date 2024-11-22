<?php
// /ajax_menus.php

session_start();

// Configurar el encabezado para JSON
header('Content-Type: application/json');

// Incluir los controladores necesarios
require_once "./controller/MenuController.php";

// Crear instancia del controlador de menús
$menuController = new MenuController();

// Verificar la acción solicitada
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'getMenuDescription' && isset($_POST['id'])) {
        $menuId = $_POST['id'];

        // Obtener el menú seleccionado
        $menu = $menuController->obtener($menuId);

        if ($menu) {
            // Preparar la respuesta
            $response = [
                'success' => true,
                'menu_nombre' => $menu['nombre'],
                'descripcion' => $menu['descripcion']
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Menú no encontrado.'
            ];
        }
        echo json_encode($response);
        exit;
    }

    if ($action === 'getSubmenuDescription' && isset($_POST['id'])) {
        $submenuId = $_POST['id'];

        // Obtener el submenú seleccionado
        $submenu = $menuController->obtener($submenuId);

        if ($submenu) {
            // Preparar la respuesta
            $response = [
                'success' => true,
                'menu_nombre' => $submenu['nombre'],
                'descripcion' => $submenu['descripcion']
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Submenú no encontrado.'
            ];
        }
        echo json_encode($response);
        exit;
    }
}

// Si no se cumple ninguna acción, devolver error
echo json_encode([
    'success' => false,
    'message' => 'Acción inválida.'
]);