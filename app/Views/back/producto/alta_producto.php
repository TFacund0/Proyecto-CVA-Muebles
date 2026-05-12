<!-- 
  =============================================
  ARTISAN PRODUCT CREATOR - DASHBOARD PRO
  =============================================
-->

<div class="edit-product-wrapper py-5">
    <div class="container">
        
        <!-- Cabecera de Creación -->
        <div class="edit-header p-4 p-md-5 text-white rounded-5 shadow-lg mb-5" style="background: linear-gradient(135deg, #3e2723 0%, #5d4037 100%);">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="badge bg-gold-artisan px-3 py-2 text-uppercase">Nuevo Registro</span>
                        <span class="opacity-75">|</span>
                        <span class="small opacity-75"><i class="bi bi-hammer me-1"></i> Creando nueva obra artesanal</span>
                    </div>
                    <h1 class="display-5 fw-bold font-lora mb-0">Alta de Producto</h1>
                </div>
                <div class="col-md-4 text-md-end mt-4 mt-md-0">
                    <a href="<?= base_url('/crud-productos') ?>" class="btn btn-outline-light rounded-pill px-4 btn-sm">
                        <i class="bi bi-arrow-left me-2"></i> CANCELAR Y VOLVER
                    </a>
                </div>
            </div>
        </div>

        <?php $validation = \Config\Services::validation(); ?>

        <!-- Mensajes de Estado -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('fail')): ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-4 mb-4 shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= session()->getFlashdata('fail') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        <?php endif; ?>

        <form method="post" id="form-alta-producto" action="<?= base_url('/enviar-alta-producto') ?>" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="row g-4">
                <!-- COLUMNA IZQUIERDA: IMAGEN -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-5 overflow-hidden mb-4 bg-white">
                        <div class="card-header bg-artisan-cream border-0 py-3 text-center">
                            <h6 class="mb-0 fw-bold text-brown">VISTA PREVIA DEL MUEBLE</h6>
                        </div>
                        <div class="card-body p-4 text-center">
                            <div class="img-preview-box shadow-sm rounded-4 mb-3 d-flex align-items-center justify-content-center border" 
                                 style="height: 300px; background-color: #fcfaf7; position: relative; overflow: hidden;">
                                <img id="preview-image" src="" class="img-fluid w-100 h-100" style="display:none; object-fit: cover;" alt="Vista previa">
                                <div id="placeholder-text" class="text-muted">
                                    <i class="bi bi-camera fs-1 d-block mb-2"></i>
                                    <span class="small">Sin imagen seleccionada</span>
                                </div>
                            </div>
                            
                            <label for="image" class="btn btn-gold-artisan w-100 py-2 fw-bold rounded-3 mb-2" style="cursor: pointer;">
                                <i class="bi bi-upload me-2"></i> SELECCIONAR FOTO
                            </label>
                            <input type="file" name="image" class="form-control d-none" id="image" accept="image/png, image/jpg, image/jpeg" required>
                            
                            <?php if($validation->getError('image')): ?>
                                <div class="text-danger small fw-bold mt-2"><i class="bi bi-x-circle me-1"></i> <?= $validation->getError('image') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- COLUMNA DERECHA: FORMULARIO -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-5 bg-white">
                        <div class="card-body p-4 p-md-5">
                            
                            <!-- Sección 1: Identidad -->
                            <div class="form-section mb-5">
                                <h5 class="fw-bold text-brown border-bottom pb-2 mb-4"><i class="bi bi-pencil-square me-2 text-gold"></i> Identidad del Producto</h5>
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label class="form-label small fw-bold">NOMBRE COMERCIAL</label>
                                        <input type="text" name="nombre_producto" class="form-control artisan-input-lg" 
                                               placeholder="Ej: Mesa de Roble Nórdica" required>
                                        <?php if($validation->getError('nombre_producto')): ?>
                                            <div class="text-danger small mt-1"><?= $validation->getError('nombre_producto') ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">CATEGORÍA</label>
                                        <select name="categoria_id" class="form-select artisan-input-lg" required>
                                            <option selected disabled>Seleccionar...</option>
                                            <?php foreach ($categorias as $categoria): ?>
                                                <option value="<?= $categoria['id_categoria'] ?>"><?= esc($categoria['descripcion']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Sección 2: Finanzas y Stock -->
                            <div class="form-section mb-5">
                                <h5 class="fw-bold text-brown border-bottom pb-2 mb-4"><i class="bi bi-wallet2 me-2 text-gold"></i> Precios y Existencias</h5>
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold">COSTO ($)</label>
                                        <input type="number" name="precio" class="form-control artisan-input" placeholder="0.00" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold">P. VENTA ($)</label>
                                        <input type="number" name="precio-vta" class="form-control artisan-input fw-bold text-success" placeholder="0.00" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold">STOCK INICIAL</label>
                                        <input type="number" name="stock" class="form-control artisan-input" placeholder="0" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold">S. MÍNIMO</label>
                                        <input type="number" name="stock-min" class="form-control artisan-input text-danger" placeholder="0" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Sección 3: Descripción -->
                            <div class="form-section mb-5">
                                <h5 class="fw-bold text-brown border-bottom pb-2 mb-4"><i class="bi bi-layout-text-sidebar-reverse me-2 text-gold"></i> Ficha Técnica del Mueble</h5>
                                <textarea name="descripcion" class="form-control artisan-notebook-textarea" rows="6" 
                                          placeholder="Detalla medidas, materiales (Pino, Roble, etc.), tipo de acabado y cualquier detalle que el cliente deba saber..."></textarea>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="row g-3 pt-4 border-top">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success w-100 py-3 fw-bold fs-5 shadow-sm">
                                        <i class="bi bi-cloud-arrow-up me-2"></i> REGISTRAR PRODUCTO
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <button type="reset" class="btn btn-outline-secondary w-100 py-3 fw-bold fs-5">
                                        <i class="bi bi-eraser me-2"></i> LIMPIAR
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <a href="<?= base_url('/crud-productos') ?>" class="btn btn-outline-danger w-100 py-3 fw-bold fs-5">
                                        <i class="bi bi-x-circle me-2"></i> SALIR
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&family=Lora:wght@700&display=swap');

    :root {
        --artisan-dark: #3e2723;
        --artisan-gold: #b8860b;
        --artisan-cream: #fdfaf5;
    }

    .edit-product-wrapper { background-color: #f8f5f0; font-family: 'Outfit', sans-serif; min-height: 100vh; }
    .font-lora { font-family: 'Lora', serif; }
    .text-brown { color: var(--artisan-dark); }
    .text-gold { color: var(--artisan-gold); }
    .bg-gold-artisan { background-color: var(--artisan-gold); color: white; }
    .bg-artisan-cream { background-color: var(--artisan-cream); }
    
    .artisan-input-lg { height: 50px; border-radius: 12px; border: 1px solid #d7ccc8; }
    .artisan-input { border-radius: 10px; border: 1px solid #d7ccc8; }
    
    .btn-gold-artisan { background-color: var(--artisan-gold); color: white; border: none; transition: all 0.3s; }
    .btn-gold-artisan:hover { background-color: #9c7b0a; transform: translateY(-2px); }

    .artisan-notebook-textarea {
        background-color: #fff;
        background-image: linear-gradient(#f0f0f0 .1em, transparent .1em);
        background-size: 100% 1.5em;
        line-height: 1.5em;
        padding: 1.5em;
        border: 1px solid #e0d5c5;
        border-radius: 12px;
        color: #5d4037;
    }
</style>

<script>
    const imageInput = document.getElementById('image');
    const preview = document.getElementById('preview-image');
    const placeholder = document.getElementById('placeholder-text');
    const form = document.getElementById('form-alta-producto');

    imageInput.addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        } else {
            preview.style.display = 'none';
            placeholder.style.display = 'block';
        }
    });

    form.addEventListener('reset', function() {
        preview.style.display = 'none';
        placeholder.style.display = 'block';
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>
