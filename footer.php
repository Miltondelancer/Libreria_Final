</div><

<footer class="footer mt-5 py-4">
    <div class="container text-center">
        <p class="mb-1 fw-bold" style="font-family: 'Playfair Display', serif; font-size:1.1rem;">
            <i class="bi bi-book-half me-2"></i>Libreria Online
        </p>
        <p class="mb-0 text-muted small">&copy; <?= date('Y') ?> Creado por Milton De Lancer.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    
    const links = document.querySelectorAll('.nav-link');
    links.forEach(link => {
        if (link.href === window.location.href) {
            link.classList.add('active');
        }
    });
</script>
</body>
</html>
