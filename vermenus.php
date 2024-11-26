<?php
// /vermenus.php

session_start();

// Incluir los controladores necesarios
require_once __DIR__ . './vendor/autoload.php';
use App\Controller\MenuController;
// Crear instancia del controlador de menús
$menuController = new MenuController();

// Obtener todos los menús principales (menús sin padre)
$menus = $menuController->obtenerMenusPrincipales();

// Obtener los submenús de cada menú principal sin usar referencias
foreach ($menus as $key => $menu) {
    $menus[$key]['submenus'] = $menuController->obtenerSubmenus($menu['id']);
}
// Ahora $menus es un array de menús, cada uno con un 'submenus' array

$title = ""; // Definir el título de la página
ob_start();
?>

<!-- Comienzo del contenido HTML -->
<ul class="nav nav-pills" id="menuTabs">
    <?php foreach ($menus as $index => $menu): ?>
        <?php if (count($menu['submenus']) > 0): ?>
            <!-- Menú con submenús -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?= $index === 0 ? 'active' : '' ?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?= $menu['nombre'] ?></a>
                <div class="dropdown-menu">
                    <?php foreach ($menu['submenus'] as $submenu): ?>
                        <a class="dropdown-item submenu-link" data-id="<?= $submenu['id'] ?>" href="#"><?= $submenu['nombre'] ?></a>
                    <?php endforeach; ?>
                </div>
            </li>
        <?php else: ?>
            <!-- Menú sin submenús -->
            <li class="nav-item">
                <a class="nav-link <?= $index === 0 ? 'active' : '' ?>" data-id="<?= $menu['id'] ?>" href="#"><?= $menu['nombre'] ?></a>
            </li>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>

<!-- Contenido dinámico -->
<div id="menuContent" class="mt-4">
    <p class="text-center">Seleccione un menú para ver su descripción.</p>
</div>
<!-- Fin del contenido HTML -->

<?php
$content = ob_get_clean();

// Código JavaScript
$scripts = <<<EOT
<script>
$(document).ready(function() {
    // Manejar clics en las pestañas de menú sin submenús
    $('.nav-link').filter(function() {
        return !$(this).hasClass('dropdown-toggle');
    }).click(function(e) {
        e.preventDefault();
        // Remover la clase 'active' de todas las pestañas y submenús
        $('.nav-link').removeClass('active');
        $('.submenu-link').removeClass('active');

        // Agregar la clase 'active' a la pestaña clickeada
        $(this).addClass('active');

        var menuId = $(this).data('id');

        // Realizar solicitud AJAX para obtener la descripción del menú
        $.ajax({
            url: 'ajax_menus.php',
            method: 'POST',
            data: { action: 'getMenuDescription', id: menuId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var html = '<div class="text-center">';
                    html += '<p>' + response.descripcion + '</p>';
                    html += '</div>';
                    $('#menuContent').html(html);
                } else {
                    $('#menuContent').html('<p class="text-center">Error al obtener los datos del menú.</p>');
                }
            },
            error: function() {
                $('#menuContent').html('<p class="text-center">Error en la solicitud AJAX.</p>');
            }
        });
    });

    // Manejar clics en los enlaces de submenús
    $(document).on('click', '.submenu-link', function(e) {
        e.preventDefault();

        // Remover la clase 'active' de todas las pestañas y submenús
        $('.nav-link').removeClass('active');
        $('.submenu-link').removeClass('active');

        // Agregar la clase 'active' al submenú seleccionado
        $(this).addClass('active');
        $(this).closest('.dropdown').find('.dropdown-toggle').addClass('active');

        var submenuId = $(this).data('id');

        // Realizar solicitud AJAX para obtener la descripción del submenú
        $.ajax({
            url: 'ajax_menus.php',
            method: 'POST',
            data: { action: 'getSubmenuDescription', id: submenuId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var html = '<div class="text-center">';
                    html += '<p>' + response.descripcion + '</p>';
                    html += '</div>';
                    $('#menuContent').html(html);
                } else {
                    $('#menuContent').html('<p class="text-center">Error al obtener la descripción del submenú.</p>');
                }
            },
            error: function() {
                $('#menuContent').html('<p class="text-center">Error en la solicitud AJAX.</p>');
            }
        });
    });
});
</script>
EOT;

include 'vistas/layout.php'; // Incluye la plantilla
?>