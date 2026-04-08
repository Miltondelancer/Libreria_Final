<?php
require_once 'conexion.php';

$pdo->exec("CREATE TABLE IF NOT EXISTS `contacto` (
    `id`         INT(11) NOT NULL AUTO_INCREMENT,
    `fecha`      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `nombre`     VARCHAR(100) NOT NULL,
    `correo`     VARCHAR(100) NOT NULL,
    `asunto`     VARCHAR(150) NOT NULL,
    `comentario` TEXT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

$exito = false;
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre     = trim($_POST['nombre']     ?? '');
    $correo     = trim($_POST['correo']     ?? '');
    $asunto     = trim($_POST['asunto']     ?? '');
    $comentario = trim($_POST['comentario'] ?? '');

    if (empty($nombre))     $errores[] = 'El nombre es obligatorio.';
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) $errores[] = 'Correo no valido.';
    if (empty($asunto))     $errores[] = 'El asunto es obligatorio.';
    if (empty($comentario)) $errores[] = 'El comentario es obligatorio.';

    if (empty($errores)) {
        $sql = "INSERT INTO contacto (nombre, correo, asunto, comentario) VALUES (:nombre, :correo, :asunto, :comentario)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre'     => $nombre,
            ':correo'     => $correo,
            ':asunto'     => $asunto,
            ':comentario' => $comentario
        ]);
        $exito = true;
    }
}
?>
<?php include 'includes/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <h1 class="page-title"><i class="bi bi-envelope me-2"></i>Contacto</h1>
        <p class="page-subtitle">Envianos un mensaje y te responderemos a la brevedad.</p>
        <div class="section-divider"></div>

        <?php if ($exito): ?>
            <div class="alert-exito">
                <i class="bi bi-check-circle-fill fs-4"></i>
                <div>
                    <strong>Mensaje enviado con exito.</strong><br>
                    <small>Gracias por contactarnos. Te responderemos pronto.</small>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($errores)): ?>
            <div class="alert alert-danger rounded-3">
                <ul class="mb-0">
                    <?php foreach ($errores as $e): ?>
                        <li><?= htmlspecialchars($e) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="contact-card">
            <form method="POST" action="/libreria/contacto.php" novalidate>
                <div class="mb-3">
                    <label class="form-label">Nombre completo</label>
                    <input type="text" name="nombre" class="form-control"
                           placeholder="Tu nombre"
                           value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Correo electronico</label>
                    <input type="email" name="correo" class="form-control"
                           placeholder="tucorreo@ejemplo.com"
                           value="<?= htmlspecialchars($_POST['correo'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Asunto</label>
                    <input type="text" name="asunto" class="form-control"
                           placeholder="Asunto del mensaje"
                           value="<?= htmlspecialchars($_POST['asunto'] ?? '') ?>">
                </div>
                <div class="mb-4">
                    <label class="form-label">Comentario</label>
                    <textarea name="comentario" class="form-control" rows="5"
                              placeholder="Escribe tu mensaje aqui..."><?= htmlspecialchars($_POST['comentario'] ?? '') ?></textarea>
                </div>
                <button type="submit" class="btn-accent btn w-100 py-2">
                    <i class="bi bi-send me-2"></i>Enviar Mensaje
                </button>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
