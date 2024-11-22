<?php
require_once "../../controller/MenuController.php";
$menuController = new MenuController();

// Obtener el 'id' del menú desde la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $menu = $menuController->obtener($id);

    if (!$menu) {
        echo "Menú no encontrado.";
        exit;
    }
} else {
    echo "ID de menú no especificado.";
    exit;
}

// Obtener la lista de menús para el campo "Menú Padre"
$menus = $menuController->listar();
$title = "Editar Menú";
ob_start();
?>
<form action="../../index.php" method="post">
    <input type="hidden" name="id" value="<?= $menu['id'] ?>">
    <div class="form-group">
        <label for="menuPadre">Menú Padre</label>
        <select class="form-control" name="menuPadre" id="menuPadre">
            <option value="">Ninguno</option>
            <?php foreach ($menus as $m): ?>
                <option value="<?= $m['id'] ?>" <?= $m['id'] == $menu['menu_padre'] ? 'selected' : '' ?>>
                    <?= $m['nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="nombre">Nombre del Menú</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $menu['nombre'] ?>" required>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required><?= $menu['descripcion'] ?></textarea>
    </div>
    <input type="hidden" name="action" value="editar">
    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="../../index.php" class="btn btn-secondary">Cancelar</a>
</form>
<?php
$content = ob_get_clean();
include '../layout.php'; // Incluye la plantilla