<?php
$title = "Listado de Menús";
ob_start();
?>

<?php if (!empty($_SESSION['mensaje'])): ?>
    <div class="alert alert-<?= $_SESSION['mensaje']['tipo'] ?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['mensaje']['texto'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php unset($_SESSION['mensaje']); // Limpia el mensaje después de mostrarlo ?>
<?php endif; ?>
<div class="text-center my-4">
    <a href="/menus/vermenus.php" target="_blank" class="btn btn-primary">Ver Menús</a>
</div>
<a href="vistas/menu/crear.php" class="btn btn-success mb-3">Crear Nuevo Menú</a>
<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Menú Padre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($menus as $menu): ?>
            <tr>
                <td><?= $menu['id'] ?></td>
                <td><?= $menu['nombre'] ?></td>
                <td><?= $menu['descripcion'] ?></td>
                <td><?= $menu['nombre_menu_padre'] ? $menu['nombre_menu_padre'] : 'Ninguno' ?></td>
                <td>
                    <a href="./vistas/menu/editar.php?id=<?= $menu['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                    <form action="index.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $menu['id'] ?>">
                        <input type="hidden" name="action" value="eliminar">
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
$content = ob_get_clean();
include './vistas/layout.php';
?>