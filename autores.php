<?php
require_once 'conexion.php';
$stmt   = $pdo->query("SELECT * FROM autores ORDER BY apellido ASC");
$autores = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total   = count($autores);
?>
<?php include 'includes/header.php'; ?>

<h1 class="page-title"><i class="bi bi-people me-2"></i>Nuestros Autores</h1>
<p class="page-subtitle">Total registrados: <strong><?= $total ?></strong> autores</p>
<div class="section-divider"></div>

<div class="search-wrap">
    <input type="text" id="buscador" placeholder="Buscar autor...">
    <button><i class="bi bi-search"></i></button>
</div>

<div class="row g-4" id="listaAutores">
<?php foreach ($autores as $autor): ?>
    <div class="col-sm-6 col-lg-4 autor-item">
        <div class="author-card">
            <div class="author-icon"><i class="bi bi-person-circle"></i></div>
            <h6 class="fw-bold mb-0"><?= htmlspecialchars($autor['apellido']) ?>, <?= htmlspecialchars($autor['nombre']) ?></h6>
            <p class="text-muted small mb-2"><?= htmlspecialchars($autor['ciudad']) ?>, <?= htmlspecialchars($autor['pais']) ?></p>
            <hr class="my-2">
            <div class="small text-muted">
                <div><i class="bi bi-telephone me-2"></i><?= htmlspecialchars($autor['telefono']) ?></div>
                <div class="mt-1"><i class="bi bi-geo-alt me-2"></i><?= htmlspecialchars($autor['direccion']) ?></div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>

<script>
document.getElementById('buscador').addEventListener('input', function(){
    const q = this.value.toLowerCase();
    document.querySelectorAll('.autor-item').forEach(item => {
        item.style.display = item.innerText.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>

<?php include 'includes/footer.php'; ?>
