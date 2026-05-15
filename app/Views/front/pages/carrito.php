<?= $this->extend('layout/main') ?>

<?= $this->section('extra-css') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/pages/carrito.css?v=2.0') ?>">
    <style>
        .cart-item-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.5);
            padding: 1.75rem;
            margin-bottom: 1.5rem;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            display: flex;
            align-items: center;
            gap: 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }
        
        .cart-item-card:hover {
            box-shadow: 0 15px 40px rgba(62, 39, 35, 0.08);
            transform: translateY(-5px);
            border-color: var(--cva-gold);
        }

        @media (max-width: 767.98px) {
            .cart-item-card {
                flex-direction: column;
                text-align: center;
                padding: 1.5rem;
                align-items: center;
            }
            
            .cart-item-card .d-flex.flex-column {
                order: 2;
                margin-top: 1rem;
            }

            .cart-img-wrapper {
                order: 1;
                width: 100%;
                height: 180px;
            }

            .cart-item-card .flex-grow-1 {
                order: 3;
                width: 100%;
            }

            .cart-item-card .d-flex.justify-content-between.align-items-start {
                flex-direction: column;
                align-items: center !important;
                gap: 1rem;
            }

            .cart-item-card .d-flex.justify-content-between.align-items-center.mt-4 {
                flex-direction: column;
                gap: 1.5rem;
            }
        }

        .cart-img-wrapper {
            width: 130px;
            height: 130px;
            background: #fff;
            border-radius: 1.5rem;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #f0e6d6;
            box-shadow: inset 0 2px 10px rgba(0,0,0,0.02);
            transition: transform 0.3s ease;
        }

        .cart-item-card:hover .cart-img-wrapper {
            transform: scale(1.05);
        }

        .cart-img-wrapper img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            filter: drop-shadow(0 5px 15px rgba(0,0,0,0.08));
        }

        .cart-summary-card {
            background: white;
            border-radius: 2.5rem;
            border: 1px solid #eeebe6;
            padding: 2.5rem;
            position: sticky;
            top: 110px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.03);
        }

        .cart-qty-btn {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            border: 1.5px solid #eeebe6;
            background: white;
            color: var(--cva-brown);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-weight: 800;
            transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .cart-qty-btn:hover {
            background: var(--cva-brown);
            border-color: var(--cva-brown);
            color: var(--cva-gold);
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .cart-qty-btn:active {
            transform: scale(0.95);
        }

        .btn-trash-artisan {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            color: #e74c3c;
            background: rgba(231, 76, 60, 0.05);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-trash-artisan:hover {
            background: #e74c3c;
            color: white;
            transform: rotate(10deg);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
        }

        .cart-item-checkbox {
            width: 24px;
            height: 24px;
            cursor: pointer;
            border-radius: 6px;
            border: 2px solid #ddd;
            transition: all 0.3s ease;
        }

        .cart-item-checkbox:checked {
            background-color: var(--cva-gold);
            border-color: var(--cva-gold);
        }

        .cart-total-final .amount {
            font-size: 2.25rem;
            font-weight: 900;
            color: var(--cva-brown);
            font-family: var(--font-heading);
            letter-spacing: -1px;
        }

        /* NEW: Header Styling */
        .cart-header-badge {
            background: var(--cva-brown);
            color: var(--cva-gold);
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 2px;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .cart-title-main {
            font-size: 3rem;
            font-weight: 900;
            color: var(--cva-brown);
            margin-bottom: 0.5rem;
            line-height: 1;
        }

        /* NEW: Notepad style for observations */
        .specifications-box {
            background: #fffbef;
            border-left: 4px solid var(--cva-gold);
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .specifications-box textarea {
            background: transparent;
            border: none;
            border-bottom: 1px dashed #dcd3be;
            border-radius: 0;
            padding: 0;
            color: #5d4037;
            resize: none;
        }

        .specifications-box textarea:focus {
            box-shadow: none;
            background: transparent;
            border-bottom-color: var(--cva-gold);
        }

        .btn-checkout-artisan {
            background: var(--cva-brown);
            color: var(--cva-gold);
            border: 2px solid var(--cva-gold);
            padding: 1.25rem;
            border-radius: 50px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 20px rgba(45, 27, 25, 0.2);
        }

        .btn-checkout-artisan:hover {
            background: var(--cva-gold);
            color: white;
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 15px 30px rgba(229, 160, 13, 0.3);
        }

        .btn-checkout-artisan:active {
            transform: scale(0.98);
        }

        /* Glassmorphism for the left section */
        .carrito-wrapper {
            background: linear-gradient(135deg, var(--cva-sand) 0%, #e8e2d8 100%);
            min-height: 80vh;
        }

        .summary-divider {
            border: 0;
            border-top: 1px solid #eeebe6;
            margin: 1.5rem 0;
        }

        .cart-item-label-badge {
            background: #f0ece2;
            color: #7d6b5d;
            padding: 2px 10px;
            border-radius: 4px;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
        }
        .cart-total-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem; /* Increased spacing */
            font-weight: 600;
            color: #7d6b5d;
        }

        .cart-total-final {
            border-top: 2px dashed #eeebe6;
            margin-top: 2rem;
            padding-top: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: baseline;
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="carrito-wrapper py-5">
    <div class="container">
        <!-- Header -->
        <div class="mb-5 text-center text-lg-start">
            <span class="cart-header-badge">ESTUDIO DE CARPINTERÍA</span>
            <h1 class="cart-title-main">Mi Carrito</h1>
            <p class="text-muted fs-5">Piezas artesanales seleccionadas para tu espacio personal.</p>
            <div style="width: 100px; height: 4px; background: var(--cva-gold); border-radius: 2px;"></div>
        </div>



        <?php if (empty($cart)): ?>
            <div class="empty-cart-state bg-white rounded-5 p-5 shadow-sm text-center border">
                <div class="mb-4">
                    <i class="bi bi-cart-x display-1 text-gold opacity-25"></i>
                </div>
                <h3 class="fw-bold text-cva-brown">Tu selección está vacía</h3>
                <p class="text-muted mb-4">Explora nuestro catálogo para encontrar la pieza perfecta para tu hogar.</p>
                <a href="<?= base_url('productos') ?>" class="btn btn-brown rounded-pill px-5 py-3 fw-bold text-gold">
                    EXPLORAR CATÁLOGO
                </a>
            </div>
        <?php else: ?>
            <div class="row g-5">
                <!-- Listado de Productos -->
                <div class="col-lg-8">
                    <form id="cart-form" action="<?= base_url('carrito_comprar') ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <?php $gran_total = 0; ?>
                        <?php foreach ($cart as $item): ?>
                            <?php $gran_total += $item['price'] * $item['qty']; ?>
                            <div class="cart-item-card">
                                    <div class="d-flex flex-column align-items-center">
                                        <input class="form-check-input item-checkbox cart-item-checkbox" type="checkbox" name="selected_items[]" value="<?= $item['rowid'] ?>" checked 
                                               data-price="<?= $item['price'] ?>" data-qty="<?= $item['qty'] ?>" data-subtotal="<?= $item['subtotal'] ?>">
                                        <span class="x-small text-muted mt-2 fw-bold" style="font-size: 0.6rem;">PEDIR</span>
                                    </div>
                                    <div class="cart-img-wrapper">
                                        <img src="<?= base_url('assets/uploads/' . $item['imagen']) ?>" alt="<?= esc($item['name']) ?>">
                                    </div>
                                    
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <span class="cart-item-label-badge mb-1 d-inline-block">Pieza Única</span>
                                                <h5 class="fw-bold text-cva-brown mb-1"><?= esc($item['name']) ?></h5>
                                                <p class="small text-muted mb-0">Colección Artesanal CVA</p>
                                            </div>
                                            <button type="button" onclick="submitAction('<?= base_url('carrito_elimina/' . $item['rowid']) ?>', '¿Quitar este producto del carrito?')" 
                                                    class="btn btn-trash-artisan" title="Quitar del carrito">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </div>
                                
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <button type="button" class="cart-qty-btn ajax-qty" data-url="<?= base_url('carrito_resta/' . $item['rowid']) ?>" data-rowid="<?= $item['rowid'] ?>">-</button>
                                        <span class="fw-bold text-cva-brown qty-display" id="qty-<?= $item['rowid'] ?>"><?= esc($item['qty']) ?></span>
                                        <button type="button" class="cart-qty-btn ajax-qty" data-url="<?= base_url('carrito_suma/' . $item['rowid']) ?>" data-rowid="<?= $item['rowid'] ?>">+</button>
                                    </div>
                                    
                                    <div class="text-end">
                                        <p class="small text-muted mb-0">Precio Unitario: $<?= number_format($item['price'], 0, ',', '.') ?></p>
                                        <p class="fw-bold text-cva-brown fs-5 mb-0" id="subtotal-<?= $item['rowid'] ?>">$<?= number_format($item['subtotal'], 0, ',', '.') ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                        <div class="mt-4">
                            <a href="<?= base_url('productos') ?>" class="text-decoration-none text-brown fw-bold">
                                <i class="bi bi-arrow-left me-2"></i> SEGUIR VIENDO PRODUCTOS
                            </a>
                        </div>
                    </div>

                    <!-- Resumen de Compra -->
                    <div class="col-lg-4">
                        <div class="cart-summary-card">
                            <h5 class="fw-bold text-cva-brown mb-4">Finalizar Pedido</h5>
                            
                            <div class="specifications-box mb-4">
                                <label class="cart-section-label mb-2"><i class="bi bi-pencil-square me-2"></i>Tus especificaciones:</label>
                                <textarea name="observaciones" class="form-control" rows="3" placeholder="Ej: Quiero la madera en tono roble oscuro..."></textarea>
                                <p class="x-small text-muted mt-2 mb-0 italic">Añade medidas o detalles técnicos.</p>
                            </div>

                            <hr class="summary-divider">
                        <span class="cart-section-label">Resumen de Orden</span>
                        
                        <div class="cart-total-line">
                            <span>Subtotal Obras</span>
                            <span class="text-cva-brown fw-bold">$<?= number_format($gran_total, 0, ',', '.') ?></span>
                        </div>
                        <div class="cart-total-line">
                            <span>Logística / Envío</span>
                            <span class="text-gold fw-bold">A convenir</span>
                        </div>
                        <div class="cart-total-line">
                            <span>IVA / Impuestos</span>
                            <span class="text-muted">Bonificado</span>
                        </div>

                        <div class="cart-total-final">
                            <span class="fw-bold text-cva-brown">TOTAL</span>
                            <div class="amount">$<?= number_format($gran_total, 0, ',', '.') ?></div>
                        </div>

                            <div class="mt-5">
                                <button type="submit" class="btn btn-checkout-artisan w-100 mb-3">
                                    <i class="bi bi-hammer me-2"></i> SOLICITAR PEDIDO
                                </button>
                                <a href="<?= base_url('borrar') ?>" class="btn btn-link text-danger w-100 text-decoration-none fw-bold x-small opacity-50 hover-opacity-100 transition-all">
                                    VACIAR CARRITO
                                </a>
                            </div>
                        </form>

                        <div class="mt-4 p-3 bg-light rounded-4 text-center">
                            <p class="x-small text-muted mb-0">
                                <i class="bi bi-shield-lock-fill me-1 text-gold"></i> Pago seguro y garantizado
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.item-checkbox');
        const summarySubtotal = document.querySelector('.cart-total-line span:last-child');
        const summaryTotal = document.querySelector('.amount');
        
        function formatCurrency(amount) {
            return new Intl.NumberFormat('es-AR', { 
                style: 'currency', 
                currency: 'ARS', 
                minimumFractionDigits: 0 
            }).format(amount);
        }

        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.item-checkbox').forEach(cb => {
                if (cb.checked) {
                    total += parseFloat(cb.dataset.subtotal);
                }
            });
            const formatted = formatCurrency(total);
            if (summarySubtotal) summarySubtotal.textContent = formatted;
            if (summaryTotal) summaryTotal.textContent = formatted;
        }

        // AJAX Quantity Updates
        document.querySelectorAll('.ajax-qty').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.dataset.url;
                const rowid = this.dataset.rowid;
                
                fetch(url, {
                    headers: { "X-Requested-With": "XMLHttpRequest" }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Find the item in the returned cart
                        const item = Object.values(data.cart).find(i => i.rowid === rowid);
                        if (item) {
                            // Update Qty display
                            document.getElementById(`qty-${rowid}`).textContent = item.qty;
                            // Update Item subtotal
                            document.getElementById(`subtotal-${rowid}`).textContent = formatCurrency(item.subtotal);
                            // Update Checkbox data
                            const cb = document.querySelector(`.item-checkbox[value="${rowid}"]`);
                            cb.dataset.qty = item.qty;
                            cb.dataset.subtotal = item.subtotal;
                            
                            updateTotal();
                            
                            // Update Navbar Badge if exists
                            const badge = document.querySelector('.navbar .badge');
                            if (badge) badge.textContent = data.totalItems;
                        } else {
                            // Item removed (resta to 0)
                            location.reload(); 
                        }
                    } else if (data.status === 'error') {
                        alert(data.message);
                    }
                })
                .catch(err => console.error(err));
            });
        });
        
        checkboxes.forEach(cb => {
            cb.addEventListener('change', updateTotal);
        });
        
        updateTotal();
    });
</script>
<?= $this->endSection() ?>
