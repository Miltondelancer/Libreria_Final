<?php
require_once 'conexion.php';
$totalLibros  = $pdo->query("SELECT COUNT(*) FROM titulos")->fetchColumn();
$totalAutores = $pdo->query("SELECT COUNT(*) FROM autores")->fetchColumn();
?>
<?php include 'includes/header.php'; ?>

<div class="hero">
    <span class="hero-badge"><i class="bi bi-stars me-1"></i>Bienvenido</span>
    <h1>Tu Libreria Online</h1>
    <p>Explora nuestro catalogo de libros y conoce a los autores que los escribieron.</p>
    <div class="d-flex gap-3 flex-wrap mt-3">
        <a href="/libreria/libros.php" class="btn-accent btn">
            <i class="bi bi-journal-text me-2"></i>Ver Libros
        </a>
        <a href="/libreria/autores.php" class="btn btn-outline-light rounded-pill">
            <i class="bi bi-people me-2"></i>Ver Autores
        </a>
    </div>
    <div class="stat-bar">
        <div class="stat-item">
            <div class="stat-num"><?= $totalLibros ?></div>
            <div class="stat-label">Libros</div>
        </div>
        <div class="stat-item">
            <div class="stat-num"><?= $totalAutores ?></div>
            <div class="stat-label">Autores</div>
        </div>
    </div>
</div>

<h2 class="page-title">Libros Recientes</h2>
<div class="section-divider"></div>
<div class="row g-4">
<?php
$stmt = $pdo->query("SELECT * FROM titulos ORDER BY fecha_pub DESC LIMIT 6");
foreach ($stmt as $libro):
?>
    <div class="col-sm-6 col-lg-4">
        <div class="book-card">
            <div class="book-icon"><i class="bi bi-book"></i></div>
            <span class="badge-tipo"><?= htmlspecialchars($libro['tipo']) ?></span>
            <h6 class="mt-2 mb-1 fw-bold"><?= htmlspecialchars($libro['titulo']) ?></h6>
            <p class="text-muted small mb-2"><?= htmlspecialchars(substr($libro['notas'], 0, 80)) ?>...</p>
            <?php if($libro['precio']): ?>
                <span class="precio">$<?= number_format($libro['precio'], 2) ?></span>
            <?php else: ?>
                <span class="text-muted small">Precio no disponible</span>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>
</div>

<div class="text-center mt-4">
    <a href="/libreria/libros.php" class="btn-accent btn">Ver todos los libros</a>
</div>

<?php include 'includes/footer.php'; ?>
