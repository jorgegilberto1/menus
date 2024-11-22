<?php
$title = "Crear Nuevo Menú";
require_once "../../controller/MenuController.php";
$menuController = new MenuController();
$menus = $menuController->listar();

ob_start();
?>
<form action="../../index.php" method="post">
    <div class="form-group">
        <label for="menuPadre">Menú Padre</label>
        <select class="form-control" name="menuPadre" id="menuPadre">
            <option value="">Ninguno</option>
            <?php foreach ($menus as $menu): ?>
                <option value="<?= $menu['id'] ?>"><?= $menu['nombre'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="nombre">Nombre del Menú</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
    </div>
    <input type="hidden" name="action" value="crear">
    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="../../index.php" class="btn btn-secondary">Cancelar</a>
</form>
<?php
$content = ob_get_clean(); 
include '../layout.php'; // Incluye la plantilla