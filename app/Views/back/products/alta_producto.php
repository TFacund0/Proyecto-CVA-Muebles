<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('breadcrumbs') ?>
    <li class="breadcrumb-item"><a href="<?= base_url('/crud-productos') ?>" class="text-decoration-none text-muted">CATÁLOGO</a></li>
    <li class="breadcrumb-item active text-gold fw-bold" aria-current="page">NUEVO PRODUCTO</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row mb-5 align-items-center">
    <div class="col-md-7">
        <div class="d-flex align-items-center gap-4">
            <div class="dashboard-icon-main bg-brown text-gold shadow">
                <i class="bi bi-hammer"></i>
            </div>
            <div>
                <h1 class="display-5 fw-bold text-cva-brown mb-1">Nueva Obra</h1>
                <p class="text-muted mb-0"><i class="bi bi-pencil-square text-gold me-1"></i> Registra una pieza única en el catálogo digital.</p>
            </div>
        </div>
    </div>
    <div class="col-md-5 text-md-end">
        <a href="<?= base_url('/crud-productos') ?>" class="btn btn-outline-dark rounded-pill px-4 py-2 x-small fw-bold border-2">
            <i class="bi bi-arrow-left me-2"></i> VOLVER AL LISTADO
        </a>
    </div>
</div>

<!-- Mensajes de Estado -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 p-4 animate__animated animate__fadeInUp" role="alert" style="background: #f0fff4; border-left: 5px solid #48bb78 !important;">
        <div class="d-flex align-items-center">
            <div class="bg-success text-white p-2 rounded-circle me-3">
                <i class="bi bi-check-lg fs-5"></i>
            </div>
            <div>
                <div class="fw-bold text-success">¡Pieza Registrada!</div>
                <div class="small text-dark text-opacity-75"><?= session()->getFlashdata('success') ?></div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('fail')): ?>
    <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 p-4 animate__animated animate__shakeX" role="alert" style="background: #fff5f5; border-left: 5px solid #f56565 !important;">
        <div class="d-flex align-items-center">
            <div class="bg-danger text-white p-2 rounded-circle me-3">
                <i class="bi bi-exclamation-triangle fs-5"></i>
            </div>
            <div>
                <div class="fw-bold text-danger">Atención</div>
                <div class="small text-dark text-opacity-75"><?= session()->getFlashdata('fail') ?></div>
            </div>
        </div>
    </div>
<?php endif; ?>

<form method="post" id="form-alta-producto" action="<?= base_url('/enviar-alta-producto') ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>
    
    <div class="row g-4">
    <div class="row g-4">
        <!-- Columna de Información Principal -->
        <div class="col-lg-8">
            <div class="admin-card-v2 mb-4 border-0 shadow-sm overflow-hidden">
                <div class="bg-light p-4 border-bottom">
                    <h5 class="mb-1 fw-bold text-cva-brown d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle text-gold"></i> Información General
                    </h5>
                    <p class="x-small text-muted mb-0">Identifica y describe la pieza para el catálogo.</p>
                </div>
                <div class="p-4">
                    <div class="row g-4">
                        <div class="col-md-8">
                            <label class="x-small fw-bold text-muted text-uppercase mb-2 tracking-wider">Nombre de la Pieza</label>
                            <input type="text" name="nombre_producto" class="form-control border-0 bg-light py-3 px-4 rounded-3 shadow-sm" placeholder="Ej: Mesa de Comedor Minimalista" required style="height: 58px;">
                        </div>
                        <div class="col-md-4">
                            <label class="x-small fw-bold text-muted text-uppercase mb-2 tracking-wider">Categoría</label>
                            <select name="categoria_id" class="form-select border-0 bg-light py-3 px-4 rounded-3 shadow-sm" required style="height: 58px;">
                                <option selected disabled>Seleccionar...</option>
                                <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?= $categoria['id_categoria'] ?>"><?= esc($categoria['descripcion']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="x-small fw-bold text-muted text-uppercase mb-2 tracking-wider">Descripción Técnica</label>
                            <textarea name="descripcion" class="form-control border-0 bg-light py-3 px-4 rounded-3 shadow-sm" rows="5" placeholder="Detalles de construcción, maderas utilizadas y dimensiones..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="admin-card-v2 border-0 shadow-sm overflow-hidden">
                <div class="bg-light p-4 border-bottom">
                    <h5 class="mb-1 fw-bold text-cva-brown d-flex align-items-center gap-2">
                        <i class="bi bi-tag-fill text-gold"></i> Gestión de Inventario
                    </h5>
                    <p class="x-small text-muted mb-0">Configura valores y disponibilidad actual.</p>
                </div>
                <div class="p-4">
                    <div class="row g-4 align-items-end">
                        <div class="col-md-3">
                            <div style="min-height: 40px;" class="d-flex align-items-end mb-2">
                                <label class="x-small fw-bold text-muted text-uppercase mb-0">Costo ($)</label>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-0 text-muted shadow-sm" style="border-radius: 10px 0 0 10px;">$</span>
                                <input type="number" step="0.01" name="precio" id="costo" class="form-control border-0 bg-light py-3 shadow-sm" style="border-radius: 0 10px 10px 0; height: 58px;" placeholder="0.00" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div style="min-height: 40px;" class="d-flex align-items-end mb-2">
                                <label class="x-small fw-bold text-muted text-uppercase mb-0">Precio Venta ($)</label>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-0 text-gold fw-bold shadow-sm" style="border-radius: 10px 0 0 10px;">$</span>
                                <input type="number" step="0.01" name="precio-vta" id="venta" class="form-control border-0 py-3 fw-bold text-cva-brown shadow-sm" style="background: #fffdf5; border-radius: 0 10px 10px 0; height: 58px;" placeholder="0.00" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div style="min-height: 40px;" class="d-flex align-items-end mb-2">
                                <label class="x-small fw-bold text-muted text-uppercase mb-0">Stock</label>
                            </div>
                            <input type="number" name="stock" class="form-control border-0 bg-light py-3 shadow-sm" style="border-radius: 10px; height: 58px;" placeholder="0" required>
                        </div>
                        <div class="col-md-3">
                            <div style="min-height: 40px;" class="d-flex align-items-end mb-2">
                                <label class="x-small fw-bold text-muted text-uppercase mb-0">Visibilidad</label>
                            </div>
                            <select name="eliminado" class="form-select border-0 py-3 shadow-sm fw-bold text-uppercase" style="font-size: 0.75rem; border-radius: 10px; height: 58px; background-color: #f8fafc;">
                                <option value="NO">Activo</option>
                                <option value="SI">Archivado</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Widget de Margen de Ganancia Premium -->
                    <div class="mt-5 p-4 rounded-4 border-0 shadow-sm overflow-hidden position-relative bg-white border-gold-glow">
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-gold-soft opacity-25"></div>
                        <div class="position-relative d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-4">
                                <div class="bg-white p-3 rounded-circle shadow-sm border border-gold border-opacity-25">
                                    <i class="bi bi-graph-up-arrow fs-4 text-gold"></i>
                                </div>
                                <div>
                                    <span class="d-block x-small text-uppercase fw-bold text-muted mb-1">Rendimiento Estimado</span>
                                    <h3 id="margen-porcentaje" class="fw-bold text-cva-brown mb-0">0%</h3>
                                </div>
                            </div>
                            <div class="text-end border-start ps-4">
                                <span class="d-block x-small text-uppercase fw-bold text-muted mb-1">Ganancia por Pieza</span>
                                <h2 id="margen-dinero" class="fw-bold text-success mb-0 tracking-tight">$0.00</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna de Media / Acciones -->
        <div class="col-lg-4">
            <div class="admin-card-v2 mb-4 border-0 shadow-sm overflow-hidden">
                <div class="bg-light p-4 border-bottom">
                    <h5 class="mb-1 fw-bold text-cva-brown d-flex align-items-center gap-2">
                        <i class="bi bi-camera-fill text-gold"></i> Fotografía
                    </h5>
                    <p class="x-small text-muted mb-0">Sube la imagen principal de la obra.</p>
                </div>
                <div class="p-4 text-center">
                    <label for="image" class="dropzone-premium-v2 mb-0 w-100 position-relative overflow-hidden rounded-4 d-flex align-items-center justify-content-center" style="height: 380px; cursor: pointer;">
                        <img id="preview-image" src="" class="img-fluid w-100 h-100" style="display:none; object-fit: cover;">
                        <div id="placeholder-text" class="p-4 w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                            <div class="upload-icon-container mb-3">
                                <i class="bi bi-cloud-upload-fill display-3 text-gold"></i>
                            </div>
                            <h6 class="fw-bold text-cva-brown mb-1">Sube tu creación</h6>
                            <p class="x-small text-muted px-4">Haz click aquí para seleccionar la mejor fotografía del mueble</p>
                            <div class="mt-3 d-flex gap-2">
                                <span class="badge bg-white text-muted border px-2 py-1 x-small">JPG</span>
                                <span class="badge bg-white text-muted border px-2 py-1 x-small">PNG</span>
                                <span class="badge bg-white text-muted border px-2 py-1 x-small">WEBP</span>
                            </div>
                        </div>
                    </label>
                    <input type="file" name="image" id="image" class="d-none" accept="image/*" required>
                </div>
            </div>

            <div class="d-grid gap-3 mt-4">
                <button type="submit" class="btn btn-admin-primary py-4 rounded-pill shadow-gold justify-content-center animate__animated animate__pulse animate__infinite infinite">
                    <i class="bi bi-check2-all fs-4"></i>
                    <span class="fs-5 fw-bold ms-2">PUBLICAR OBRA</span>
                </button>
                <button type="reset" class="btn btn-link text-muted text-decoration-none x-small fw-bold text-uppercase tracking-widest">
                    <i class="bi bi-trash3 me-2"></i> Borrar Todo
                </button>
            </div>
        </div>
    </div>
</form>

<style>
    .dashboard-icon-main {
        width: 60px; height: 60px;
        background: #1a0f0d;
        color: var(--cva-gold);
        display: flex; align-items: center; justify-content: center;
        font-size: 2rem;
        border-radius: 1.2rem;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .bg-gold-soft { background: #fff9f0; }
    .icon-circle-bg {
        width: 80px; height: 80px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 50%;
    }
    .dropzone-premium-v2 {
        border: 2px dashed #e2e8f0;
        background: #f8fafc;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .dropzone-premium-v2:hover {
        border-color: var(--cva-gold);
        background: #fffdf9;
        transform: translateY(-2px);
    }
    .upload-icon-container {
        transition: transform 0.3s ease;
    }
    .dropzone-premium-v2:hover .upload-icon-container {
        transform: scale(1.1) translateY(-5px);
    }
    .border-gold-glow {
        border: 1px solid rgba(201, 161, 107, 0.2) !important;
        box-shadow: 0 10px 30px rgba(201, 161, 107, 0.08) !important;
    }
    .admin-control:focus, .form-control:focus, .form-select:focus {
        background: white !important;
        border-color: var(--cva-gold) !important;
        box-shadow: 0 0 0 4px rgba(201, 161, 107, 0.1) !important;
    }
</style>

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<script>
    // Preview de imagen
    const imageInput = document.getElementById('image');
    const preview = document.getElementById('preview-image');
    const placeholder = document.getElementById('placeholder-text');

    imageInput.addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        }
    });

    // Cálculo de Margen
    const costoInput = document.getElementById('costo');
    const ventaInput = document.getElementById('venta');
    const margenD = document.getElementById('margen-dinero');
    const margenP = document.getElementById('margen-porcentaje');

    function calcularMargen() {
        const costo = parseFloat(costoInput.value) || 0;
        const venta = parseFloat(ventaInput.value) || 0;
        
        if (venta > 0) {
            const utilidad = venta - costo;
            const porcentaje = (utilidad / venta) * 100;
            
            margenD.innerText = `$${utilidad.toLocaleString('es-AR', {minimumFractionDigits: 2})}`;
            margenP.innerText = `${porcentaje.toFixed(1)}%`;
            
            if (utilidad < 0) {
                margenD.className = 'h4 fw-bold text-danger mb-0';
                margenP.className = 'fw-bold text-danger';
            } else {
                margenD.className = 'h4 fw-bold text-success mb-0';
                margenP.className = 'fw-bold text-cva-brown';
            }
        } else {
            margenD.innerText = '$0.00';
            margenP.innerText = '0%';
        }
    }

    costoInput.addEventListener('input', calcularMargen);
    ventaInput.addEventListener('input', calcularMargen);

    document.getElementById('form-alta-producto').addEventListener('reset', () => {
        setTimeout(() => {
            preview.style.display = 'none';
            placeholder.style.display = 'block';
            calcularMargen();
        }, 10);
    });
</script>
<?= $this->endSection() ?>
