<?php
require_once 'conexion.php';
$stmt  = $pdo->query("SELECT * FROM titulos ORDER BY titulo ASC");
$libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total  = count($libros);
?>
<?php include 'includes/header.php'; ?>

<h1 class="page-title"><i class="bi bi-journal-text me-2"></i>Catalogo de Libros</h1>
<p class="page-subtitle">Total disponible: <strong><?= $total ?></strong> libros</p>
<div class="section-divider"></div>

<div class="search-wrap">
    <input type="text" id="buscador" placeholder="Buscar libro...">
    <button><i class="bi bi-search"></i></button>
</div>

<div class="row g-4" id="listaLibros">
<?php foreach ($libros as $libro): ?>
    <div class="col-sm-6 col-lg-4 libro-item">
        <div class="book-card h-100">
            <div class="d-flex align-items-start gap-3">
                <div class="book-icon"><i class="bi bi-book"></i></div>
                <div class="flex-grow-1">
                    <span class="badge-tipo"><?= htmlspecialchars($libro['tipo']) ?></span>
                    <h6 class="mt-1 fw-bold"><?= htmlspecialchars($libro['titulo']) ?></h6>
                </div>
            </div>
            <p class="text-muted small my-2"><?= htmlspecialchars(substr($libro['notas'], 0, 100)) ?>...</p>
            <div class="d-flex justify-content-between align-items-center mt-auto">
                <?php if($libro['precio']): ?>
                    <span class="precio">$<?= number_format($libro['precio'], 2) ?></span>
                <?php else: ?>
                    <span class="text-muted small">—</span>
                <?php endif; ?>
                <small class="text-muted">
                    <i class="bi bi-graph-up me-1"></i><?= number_format($libro['total_ventas'] ?? 0) ?> ventas
                </small>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>

<script>
document.getElementById('buscador').addEventListener('input', function(){
    const q = this.value.toLowerCase();
    document.querySelectorAll('.libro-item').forEach(item => {
        item.style.display = item.innerText.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>

<?php include 'includes/footer.php'; ?>
