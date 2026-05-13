<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('breadcrumbs') ?>
    <li class="breadcrumb-item"><a href="<?= base_url('/crud-productos') ?>" class="text-decoration-none text-muted">CATÁLOGO</a></li>
    <li class="breadcrumb-item active small fw-bold text-gold" aria-current="page">EDITAR PRODUCTO</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Encabezado Estilo Artisan -->
<div class="row mb-5 align-items-center">
    <div class="col-md-8">
        <div class="d-flex align-items-center gap-4">
            <div class="dashboard-icon-main bg-brown text-gold shadow">
                <i class="bi bi-pencil-square"></i>
            </div>
            <div>
                <h1 class="display-5 fw-bold text-cva-brown mb-1">Modificar Producto</h1>
                <p class="text-muted mb-0">Actualiza los detalles técnicos, precios y stock del catálogo artesanal.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 text-md-end">
        <div class="badge bg-gold-soft text-gold px-4 py-2 rounded-pill fs-6 fw-bold border border-gold shadow-sm">
            ID PRODUCTO: #<?= $producto['id_producto'] ?>
        </div>
    </div>
</div>

<?php if(session()->getFlashData('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 shadow-sm border-0 bg-success text-white" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashData('success'); ?>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<form method="POST" action="<?= base_url('/modificar-producto/' . $producto['id_producto']) ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>
    
    <div class="row g-5">
        <!-- COLUMNA IZQUIERDA: GESTIÓN DE IMAGEN -->
        <div class="col-lg-4">
            <div class="admin-card-v2 p-0 overflow-hidden shadow-sm border-0 mb-4 sticky-top" style="top: 20px;">
                <div class="bg-brown p-3 text-center">
                    <h6 class="mb-0 fw-bold text-gold small text-uppercase tracking-wider">Imagen en Catálogo</h6>
                </div>
                <div class="p-4">
                    <div class="product-preview-container mb-4 position-relative">
                        <img src="<?= base_url('assets/uploads/' . $producto['imagen']) ?>" 
                             class="img-fluid rounded-4 shadow-sm w-100" 
                             style="height: 350px; object-fit: cover; border: 4px solid white;" 
                             id="main-preview" alt="Producto">
                        <div class="position-absolute bottom-0 end-0 p-3">
                            <span class="badge bg-gold px-3 py-2 rounded-pill shadow-sm">Vista Actual</span>
                        </div>
                    </div>

                    <div class="upload-zone p-4 border-2 border-dashed rounded-4 text-center bg-light position-relative" style="border-color: #d7ccc8 !important;">
                        <i class="bi bi-cloud-arrow-up fs-2 text-gold mb-2 d-block"></i>
                        <span class="d-block small fw-bold text-muted mb-3 text-uppercase">Cambiar Fotografía</span>
                        <input type="file" name="imagen" class="stretched-link opacity-0" 
                               id="input-file" accept="image/*" onchange="previewImage(event)">
                        <p class="x-small text-muted mb-0">Formatos: JPG, PNG. Tamaño recomendado: 800x800px</p>
                    </div>

                    <div id="new-badge-indicator" class="d-none mt-3 animate__animated animate__fadeIn">
                        <div class="alert alert-warning x-small fw-bold py-2 px-3 rounded-pill text-center border-0 mb-0">
                            <i class="bi bi-info-circle me-1"></i> Nueva imagen seleccionada
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- COLUMNA DERECHA: INFORMACIÓN Y PRECIOS -->
        <div class="col-lg-8">
            <div class="admin-card-v2 p-4 p-md-5 shadow-sm border-0">
                
                <!-- SECCIÓN 1: IDENTIDAD -->
                <div class="mb-5">
                    <div class="d-flex align-items-center gap-3 mb-4 border-bottom pb-3">
                        <div class="p-2 bg-gold-soft rounded-3 text-gold">
                            <i class="bi bi-info-circle-fill fs-4"></i>
                        </div>
                        <h5 class="fw-bold text-cva-brown mb-0">Información del Producto</h5>
                    </div>
                    
                    <div class="row g-4">
                        <div class="col-md-8">
                            <label class="x-small fw-bold text-muted text-uppercase mb-2">Nombre Comercial</label>
                            <input type="text" name="nombre_producto" class="form-control admin-control py-2 fs-5 fw-bold text-cva-brown" 
                                   value="<?= esc($producto['nombre_prod']) ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label class="x-small fw-bold text-muted text-uppercase mb-2">Categoría</label>
                            <select name="categoria_id" class="form-select admin-control py-2 fw-bold" required>
                                <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?= $categoria['id_categoria'] ?>" <?= $producto['categoria_id'] == $categoria['id_categoria'] ? 'selected' : '' ?>>
                                        <?= esc($categoria['descripcion']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- SECCIÓN 2: VALORES Y STOCK -->
                <div class="mb-5">
                    <div class="d-flex align-items-center gap-3 mb-4 border-bottom pb-3">
                        <div class="p-2 bg-success-soft rounded-3 text-success">
                            <i class="bi bi-currency-dollar fs-4"></i>
                        </div>
                        <h5 class="fw-bold text-cva-brown mb-0">Finanzas y Existencias</h5>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6 col-lg-3">
                            <label class="x-small fw-bold text-muted text-uppercase mb-2">Precio Costo</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-white border-end-0 text-muted">$</span>
                                <input type="number" step="0.01" name="precio" class="form-control border-start-0 py-2 fw-bold" 
                                       value="<?= esc($producto['precio']) ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <label class="x-small fw-bold text-muted text-uppercase mb-2">Precio Venta</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-gold-soft border-end-0 text-gold fw-bold">$</span>
                                <input type="number" step="0.01" name="precio-vta" class="form-control border-start-0 py-2 fw-bold text-gold" 
                                       value="<?= esc($producto['precio_vta']) ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <label class="x-small fw-bold text-muted text-uppercase mb-2">Stock Actual</label>
                            <input type="number" name="stock" class="form-control admin-control py-2 text-center fw-bold fs-5" 
                                   value="<?= esc($producto['stock']) ?>" required>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <label class="x-small fw-bold text-muted text-uppercase mb-2">Aviso Stock Mín.</label>
                            <input type="number" name="stock-min" class="form-control admin-control py-2 text-center fw-bold text-danger border-danger border-opacity-25" 
                                   value="<?= esc($producto['stock_min']) ?>" required>
                        </div>
                    </div>
                </div>

                <!-- SECCIÓN 3: FICHA TÉCNICA -->
                <div class="mb-5">
                    <div class="d-flex align-items-center gap-3 mb-4 border-bottom pb-3">
                        <div class="p-2 bg-info-soft rounded-3 text-info">
                            <i class="bi bi-file-earmark-text-fill fs-4"></i>
                        </div>
                        <h5 class="fw-bold text-cva-brown mb-0">Ficha Técnica y Descripción</h5>
                    </div>
                    <div class="mb-3">
                        <textarea name="descripcion" class="form-control admin-control p-4" rows="8" 
                                  placeholder="Detalla materiales, medidas exactas, tiempos de entrega..."
                                  style="line-height: 1.6; font-size: 0.95rem;"><?= esc($producto['descripcion']) ?></textarea>
                    </div>
                    <div class="d-flex align-items-center gap-2 p-3 bg-light rounded-4 border border-opacity-10 border-dark">
                        <i class="bi bi-magic text-gold fs-5"></i>
                        <span class="x-small text-muted italic">Consejo: Describe la madera y el acabado para resaltar el valor artesanal del mueble.</span>
                    </div>
                </div>

                <!-- BOTONES DE ACCIÓN -->
                <div class="row g-3 pt-4">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-admin-gold w-100 py-3 fw-bold fs-5 shadow-sm rounded-4">
                            <i class="bi bi-cloud-check me-2"></i> ACTUALIZAR CATÁLOGO
                        </button>
                    </div>
                    <div class="col-md-4">
                        <a href="<?= base_url('/crud-productos') ?>" class="btn btn-outline-dark w-100 py-3 fw-bold rounded-4">
                            CANCELAR
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>

<style>
    .dashboard-icon-main {
        width: 60px; height: 60px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 1.2rem;
        font-size: 1.8rem;
    }
    .bg-gold-soft { background: #fff9f0; }
    .bg-success-soft { background: #f0fff4; }
    .bg-info-soft { background: #f0f7ff; }
    .tracking-wider { letter-spacing: 1.5px; }
    
    .upload-zone {
        transition: all 0.3s ease;
        border-style: dashed !important;
    }
    .upload-zone:hover {
        background: #fdfaf5 !important;
        border-color: var(--cva-gold) !important;
    }
    
    .admin-control:focus {
        border-color: var(--cva-gold);
        box-shadow: 0 0 0 4px rgba(184, 134, 11, 0.08);
    }
    
    .form-select.admin-control {
        background-position: right 1rem center;
    }

    .btn-admin-gold {
        background: var(--cva-brown);
        color: var(--cva-gold);
        border: 2px solid var(--cva-gold);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }
    .btn-admin-gold:hover {
        background: var(--cva-gold);
        color: white;
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 10px 20px rgba(184, 134, 11, 0.2) !important;
    }
    .btn-admin-gold:active {
        transform: translateY(-2px);
    }
</style>

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('main-preview');
        const indicator = document.getElementById('new-badge-indicator');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.add('animate__animated', 'animate__pulse');
                indicator.classList.remove('d-none');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?= $this->endSection() ?>
