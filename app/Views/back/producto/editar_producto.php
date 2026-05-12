<!-- 
  =============================================
  ARTISAN PRODUCT EDITOR - DASHBOARD PRO
  =============================================
-->

<div class="edit-product-wrapper py-5">
    <div class="container">
        
        <!-- Cabecera de Edición -->
        <div class="edit-header p-4 p-md-5 text-white rounded-5 shadow-lg mb-5" style="background: linear-gradient(135deg, #3e2723 0%, #5d4037 100%);">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="badge bg-gold-artisan px-3 py-2 text-uppercase">Edición de Catálogo</span>
                        <span class="opacity-75">|</span>
                        <span class="small opacity-75">ID Producto: #<?= $producto['id_producto'] ?></span>
                    </div>
                    <h1 class="display-5 fw-bold font-lora mb-0">Modificar <?= esc($producto['nombre_prod']) ?></h1>
                </div>
                <div class="col-md-4 text-md-end mt-4 mt-md-0">
                    <a href="<?= base_url('/crud-productos') ?>" class="btn btn-outline-light rounded-pill px-4 btn-sm">
                        <i class="bi bi-arrow-left me-2"></i> VOLVER AL LISTADO
                    </a>
                </div>
            </div>
        </div>

        <?php if(session()->getFlashData('success')) { ?>
            <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashData('success'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <form method="POST" action="<?= base_url('/modificar-producto/' . $producto['id_producto']) ?>" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="row g-4">
                <!-- COLUMNA IZQUIERDA: VISUALES -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-5 overflow-hidden mb-4">
                        <div class="card-header bg-artisan-cream border-0 py-3 text-center">
                            <h6 class="mb-0 fw-bold text-brown">IMAGEN ACTUAL</h6>
                        </div>
                        <div class="card-body p-4 text-center">
                            <div class="img-container-main shadow-sm rounded-4 mb-3 overflow-hidden border">
                                <img src="<?= base_url('assets/uploads/' . $producto['imagen']) ?>" 
                                     class="img-fluid w-100" style="height: 300px; object-fit: cover;" alt="Imagen actual">
                            </div>
                            <p class="small text-muted">Esta es la imagen que los clientes ven actualmente en el catálogo.</p>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-5 bg-artisan-cream">
                        <div class="card-body p-4">
                            <h6 class="fw-bold text-brown mb-3 text-uppercase small">Subir Nueva Foto</h6>
                            <input type="file" name="imagen" class="form-control artisan-input-sm mb-3" 
                                   id="imagen" accept="image/png, image/jpg, image/jpeg" onchange="mostrarVistaPrevia(event)">
                            
                            <!-- Vista Previa Dinámica -->
                            <div id="preview-container" class="d-none mt-3">
                                <small class="d-block text-success fw-bold mb-2 text-center">VISTA PREVIA DE NUEVA IMAGEN</small>
                                <img id="preview" class="img-fluid rounded-4 shadow border w-100" style="height: 200px; object-fit: cover;" alt="Vista previa">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- COLUMNA DERECHA: FORMULARIO -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-5">
                        <div class="card-body p-4 p-md-5">
                            
                            <!-- Sección 1: Identidad -->
                            <div class="form-section mb-5">
                                <h5 class="fw-bold text-brown border-bottom pb-2 mb-4"><i class="bi bi-info-circle me-2 text-gold"></i> Información Principal</h5>
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label class="form-label small fw-bold">NOMBRE DEL PRODUCTO</label>
                                        <input type="text" name="nombre_producto" class="form-control artisan-input-lg" 
                                               value="<?= esc($producto['nombre_prod']) ?>" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">CATEGORÍA</label>
                                        <select name="categoria_id" class="form-select artisan-input-lg" required>
                                            <?php foreach ($categorias as $categoria): ?>
                                                <option value="<?= $categoria['id_categoria'] ?>" <?= $producto['categoria_id'] == $categoria['id_categoria'] ? 'selected' : '' ?>>
                                                    <?= esc($categoria['descripcion']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Sección 2: Finanzas y Stock -->
                            <div class="form-section mb-5">
                                <h5 class="fw-bold text-brown border-bottom pb-2 mb-4"><i class="bi bi-tags me-2 text-gold"></i> Valores y Existencias</h5>
                                <div class="row g-3 text-center">
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold">COSTO ($)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">$</span>
                                            <input type="number" name="precio" class="form-control artisan-input border-start-0" value="<?= esc($producto['precio']) ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold">P. VENTA ($)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 fw-bold text-success">$</span>
                                            <input type="number" name="precio-vta" class="form-control artisan-input border-start-0 fw-bold" value="<?= esc($producto['precio_vta']) ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold">STOCK ACTUAL</label>
                                        <input type="number" name="stock" class="form-control artisan-input text-center fw-bold" value="<?= esc($producto['stock']) ?>" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold">S. MÍNIMO</label>
                                        <input type="number" name="stock-min" class="form-control artisan-input text-center text-danger fw-bold" value="<?= esc($producto['stock_min']) ?>" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Sección 3: Ficha Técnica -->
                            <div class="form-section mb-5">
                                <h5 class="fw-bold text-brown border-bottom pb-2 mb-4"><i class="bi bi-file-earmark-text me-2 text-gold"></i> Ficha Técnica Detallada</h5>
                                <div class="mb-3">
                                    <textarea name="descripcion" class="form-control artisan-notebook-textarea" rows="8" 
                                              placeholder="Ingresa medidas exactas, materiales, tipo de madera, tiempo de fabricación..."><?= esc($producto['descripcion']) ?></textarea>
                                </div>
                                <p class="small text-muted"><i class="bi bi-lightbulb me-1"></i> Esta información se muestra al cliente en la ficha de producto para resolver sus dudas técnicas.</p>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="d-flex flex-column flex-md-row gap-3 pt-4 border-top">
                                <button type="submit" class="btn btn-artisan-dark w-100 py-3 fw-bold fs-5 shadow">
                                    <i class="bi bi-check2-circle me-2"></i> GUARDAR CAMBIOS
                                </button>
                                <a href="<?= base_url('/crud-productos') ?>" class="btn btn-outline-danger w-100 py-3 fw-bold fs-5">
                                    <i class="bi bi-x-circle me-2"></i> CANCELAR
                                </a>
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
    .bg-artisan-cream { background-color: var(--artisan-cream); }
    .text-brown { color: var(--artisan-dark); }
    .text-gold { color: var(--artisan-gold); }
    .bg-gold-artisan { background-color: var(--artisan-gold); color: white; }
    
    .artisan-input-lg { height: 50px; border-radius: 12px; border: 1px solid #d7ccc8; }
    .artisan-input { border-radius: 10px; border: 1px solid #d7ccc8; }
    .artisan-input-sm { border-radius: 8px; border: 1px solid #d7ccc8; font-size: 0.9rem; }

    .btn-artisan-dark { background-color: var(--artisan-dark); color: white; border-radius: 12px; transition: all 0.3s; }
    .btn-artisan-dark:hover { background-color: var(--artisan-gold); color: white; transform: translateY(-3px); }

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
    function mostrarVistaPrevia(event) {
        const input = event.target;
        const previewContainer = document.getElementById('preview-container');
        const preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.classList.remove('d-none');
                previewContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            previewContainer.classList.add('d-none');
        }
    }
</script>