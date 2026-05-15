<?= $this->extend('layout/main') ?>

<?= $this->section('extra-css') ?>
<style>
    .fav-header {
        background: linear-gradient(rgba(45, 27, 25, 0.9), rgba(45, 27, 25, 0.7)), url('<?= base_url('assets/img/ui/backgrounds/artisan_fav_bg.png') ?>');
        background-size: cover; background-position: center;
        padding: 100px 0; color: white; margin-bottom: 50px;
    }
    .fav-card {
        border: none; border-radius: 2rem; overflow: hidden;
        transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
        background: white; box-shadow: 0 15px 35px rgba(62, 39, 35, 0.05);
        position: relative; height: 100%;
    }
    .fav-card:hover { transform: translateY(-10px); box-shadow: 0 30px 60px rgba(62, 39, 35, 0.12); }
    .fav-img-wrapper { height: 280px; overflow: hidden; position: relative; }
    .fav-img-wrapper img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s; }
    .fav-card:hover .fav-img-wrapper img { transform: scale(1.1); }
    
    .remove-fav-btn {
        position: absolute; top: 15px; right: 15px;
        width: 40px; height: 40px; border-radius: 50%;
        background: rgba(255,255,255,0.9); border: none;
        color: #e74c3c; display: flex; align-items: center; justify-content: center;
        transition: all 0.3s; z-index: 10; backdrop-filter: blur(5px);
    }
    .remove-fav-btn:hover { background: #e74c3c; color: white; transform: rotate(90deg); }
    
    .price-tag-fav {
        background: var(--cva-gold); color: white;
        padding: 5px 15px; border-radius: 10px;
        font-weight: 800; font-size: 0.9rem;
    }
    .empty-state-fav { padding: 100px 0; }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<header class="fav-header text-center">
    <div class="container animate-fade-in">
        <span class="text-gold fw-bold text-uppercase x-small" style="letter-spacing: 4px;">Tu Selección Personal</span>
        <h1 class="display-3 fw-bold font-lora mt-2">Mis Favoritos</h1>
        <div class="mx-auto mt-3" style="width: 60px; height: 4px; background: var(--cva-gold); border-radius: 2px;"></div>
    </div>
</header>

<div class="container mb-5 pb-5">
    <?php if (empty($favoritos)): ?>
        <div class="empty-state-fav text-center">
            <div class="mb-4">
                <i class="bi bi-heart-break text-muted opacity-25" style="font-size: 6rem;"></i>
            </div>
            <h2 class="font-lora text-cva-brown fw-bold">Tu lista está vacía</h2>
            <p class="text-muted mb-5">Parece que aún no has encontrado esa pieza especial.</p>
            <a href="<?= base_url('productos') ?>" class="btn btn-vivid px-5 py-3 rounded-pill fw-bold shadow">EXPLORAR CATÁLOGO</a>
        </div>
    <?php else: ?>
        <div class="row g-4" id="fav-container">
            <?php foreach ($favoritos as $fav): ?>
                <div class="col-lg-4 col-md-6 fav-item">
                    <div class="fav-card">
                        <div class="fav-img-wrapper">
                            <img src="<?= base_url('assets/uploads/' . $fav['imagen']) ?>" alt="<?= $fav['nombre_prod'] ?>">
                            <button onclick="toggleFav(<?= $fav['producto_id'] ?>, this)" class="remove-fav-btn shadow-sm" title="Quitar de favoritos">
                                <i class="bi bi-trash3-fill"></i>
                            </button>
                        </div>
                        <div class="p-4 d-flex flex-column" style="min-height: 200px;">
                            <div class="mb-2">
                                <span class="x-small fw-bold text-gold text-uppercase" style="letter-spacing: 2px;">Pieza de Autor</span>
                            </div>
                            <h4 class="font-lora fw-bold text-cva-brown mb-3"><?= $fav['nombre_prod'] ?></h4>
                            <p class="small text-muted mb-4"><?= substr($fav['descripcion'], 0, 100) ?>...</p>
                            
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="price-tag-fav">$<?= number_format($fav['precio_vta'], 0, ',', '.') ?></span>
                                <a href="<?= base_url('producto/detalle/' . $fav['producto_id']) ?>" class="btn btn-sm btn-outline-brown rounded-pill px-4 fw-bold">DETALLE</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script>
function toggleFav(id, btn) {
    if(!confirm('¿Quitar este mueble de tus favoritos?')) return;
    
    fetch('<?= base_url('favoritos/toggle/') ?>' + id, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'removed') {
                const item = btn.closest('.fav-item');
                item.style.opacity = '0';
                item.style.transform = 'scale(0.8)';
                setTimeout(() => {
                    item.remove();
                    if (document.querySelectorAll('.fav-item').length === 0) {
                        location.reload();
                    }
                }, 400);
            }
        })
        .catch(err => console.error('Error:', err));
}
</script>
<?= $this->endSection() ?>
