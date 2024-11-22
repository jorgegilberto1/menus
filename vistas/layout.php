<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Gestión de Menús' ?></title>
    <!-- Incluir Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center"><?= $title ?? 'Gestión de Menús' ?></h1>
        <?= $content ?? '' ?>
    </div>
    <!-- Incluir jQuery (versión completa) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Incluir Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Incluir Bootstrap 4 JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Scripts personalizados -->
    <?= $scripts ?? '' ?>
</body>
</html>