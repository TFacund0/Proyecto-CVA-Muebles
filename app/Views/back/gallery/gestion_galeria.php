<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="fw-bold text-cva-brown font-lora">Moderación de Galería</h1>
            <p class="text-muted">Aprobá o rechazá las fotos enviadas por los clientes.</p>
        </div>
        <a href="<?= base_url('galeria') ?>" class="btn btn-outline-brown rounded-pill px-4">VER GALERÍA PÚBLICA</a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="row g-4">
        <?php if (empty($fotos)): ?>
            <div class="col-12 text-center py-5">
                <i class="bi bi-inbox text-muted opacity-25" style="font-size: 5rem;"></i>
                <h4 class="text-muted mt-3">No hay fotos pendientes de revisión</h4>
            </div>
        <?php else: ?>
            <?php foreach ($fotos as $foto): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="position-relative">
                            <img src="<?= base_url('assets/uploads/galeria/' . $foto['imagen']) ?>" class="card-img-top" alt="Foto cliente" style="height: 250px; object-fit: cover;">
                            <?php if ($foto['activo'] == 'NO'): ?>
                                <span class="position-absolute top-0 end-0 m-3 badge bg-warning text-dark">PENDIENTE</span>
                            <?php else: ?>
                                <span class="position-absolute top-0 end-0 m-3 badge bg-success">ACTIVA</span>
                            <?php endif; ?>
                        </div>
                        <div class="card-body p-4">
                            <h6 class="fw-bold text-gold mb-1">Cliente: <?= esc($foto['nombre']) ?></h6>
                            <p class="small text-muted mb-4">"<?= esc($foto['comentario']) ?>"</p>
                            
                            <div class="d-flex gap-2">
                                <?php if ($foto['activo'] == 'NO'): ?>
                                    <a href="<?= base_url('admin/galeria/aprobar/' . $foto['id']) ?>" class="btn btn-success flex-grow-1 rounded-pill fw-bold btn-sm">APROBAR</a>
                                <?php endif; ?>
                                <a href="<?= base_url('admin/galeria/eliminar/' . $foto['id']) ?>" class="btn btn-outline-danger rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;" onclick="return confirm('¿Eliminar esta foto permanentemente?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
