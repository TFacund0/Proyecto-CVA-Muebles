<!-- 
  =============================================
  ARTISAN USER MANAGEMENT - CRUD PRO
  =============================================
-->

<div class="crud-usuarios-wrapper py-4">
    <div class="container card-container">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        
        <!-- Cabecera Premium -->
        <div class="card-header bg-artisan-dark py-4 text-white">
            <div class="row align-items-center px-3">
                <div class="col-md-6">
                    <h2 class="mb-0 fw-bold font-lora"><i class="bi bi-people-fill me-2"></i> Gestión de Usuarios</h2>
                    <p class="small mb-0 opacity-75">Administra los accesos y perfiles del sistema</p>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <a href="<?= base_url('registro') ?>" class="btn btn-gold-artisan py-2 px-4 shadow-sm fw-bold">
                        <i class="bi bi-person-plus-fill me-2"></i> NUEVO USUARIO
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body p-4 bg-light">
            <!-- Barra de Filtros Unificada -->
            <form action="<?= base_url('/crud-usuarios'); ?>" method="get" class="bg-white p-4 rounded-4 shadow-sm border mb-4">
                <div class="row g-3 align-items-end">
                    
                    <!-- Buscador -->
                    <div class="col-md-4">
                        <label class="form-label small fw-bold text-muted text-uppercase">Buscar Usuario</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0 artisan-input" 
                                   placeholder="Nombre, email o usuario..." value="<?= $_GET['search'] ?? '' ?>">
                        </div>
                    </div>

                    <!-- Filtro Estado -->
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Estado</label>
                        <select name="vista" class="form-select artisan-input">
                            <option value="NO" <?= ($vista == 'NO') ? 'selected' : '' ?>>👤 Usuarios Activos</option>
                            <option value="SI" <?= ($vista == 'SI') ? 'selected' : '' ?>>🚫 Usuarios Eliminados</option>
                        </select>
                    </div>

                    <!-- Límite de Resultados -->
                    <div class="col-md-2">
                        <label class="form-label small fw-bold text-muted text-uppercase">Mostrar</label>
                        <select class="form-select artisan-input" name="option">
                            <option value="5" <?= ($select == 5) ? 'selected' : '' ?>>5 filas</option>
                            <option value="10" <?= ($select == 10) ? 'selected' : '' ?>>10 filas</option>
                            <option value="Todos" <?= ($select == 'Todos') ? 'selected' : '' ?>>Todos</option>
                        </select>
                    </div>

                    <!-- Botones -->
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-artisan-dark w-100 fw-bold py-2">FILTRAR</button>
                        <?php if(!empty($_GET['search'])): ?>
                            <a href="<?= base_url('/crud-usuarios') ?>" class="btn btn-outline-secondary px-3 py-2">X</a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>

            <!-- Tabla de Usuarios -->
            <div class="table-responsive bg-white rounded-4 shadow-sm border overflow-hidden">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #fcfaf7;">
                        <tr class="text-brown small text-uppercase">
                            <th class="py-3 px-4 text-center">ID</th>
                            <th class="py-3">Nombre y Apellido</th>
                            <th class="py-3">Usuario / Acceso</th>
                            <th class="py-3">Correo Electrónico</th>
                            <th class="py-3 text-center">Perfil</th>
                            <th class="py-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Fila del usuario actual (siempre visible) -->
                        <?php foreach ($usuarios as $usuario): ?>
                            <?php if (session()->get('id_usuario') == $usuario['id_usuario']): ?>
                                <tr class="bg-artisan-cream">
                                    <td class="text-center fw-bold text-muted"><?= $usuario['id_usuario'] ?></td>
                                    <td>
                                        <div class="fw-bold text-brown"><?= esc($usuario['nombre']) ?> <?= esc($usuario['apellido']) ?></div>
                                        <span class="badge bg-gold-artisan" style="font-size: 0.6rem;">TU CUENTA</span>
                                    </td>
                                    <td class="fw-bold"><?= esc($usuario['usuario']) ?></td>
                                    <td><?= esc($usuario['email']) ?></td>
                                    <td class="text-center">
                                        <?php 
                                            $perfil_style = "background: #3e2723; color: #fff; border: 1px solid #3e2723;"; // Admin (Nogal)
                                            if($usuario['perfil'] != 'Admin') {
                                                $perfil_style = "background: #e3f2fd; color: #0d47a1; border: 1px solid #bbdefb;";
                                            }
                                        ?>
                                        <span class="badge rounded-pill px-3 py-2 text-uppercase" style="<?= $perfil_style ?> font-size: 0.65rem; letter-spacing: 1px;">
                                            <?= esc($usuario['perfil']) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-outline-brown fw-bold px-3" href="<?= base_url('/perfil') ?>">MI PERFIL</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <!-- Resto de usuarios -->
                        <?php 
                        $cant = 0;
                        foreach ($usuarios as $usuario) {
                            if(($select == 'Todos' || $select > $cant) && ($usuario['baja'] == $vista) && (session()->get('id_usuario') != $usuario['id_usuario'])) { ?>
                                <tr>
                                    <td class="text-center text-muted"><?= $usuario['id_usuario'] ?></td>
                                    <td>
                                        <div class="fw-bold text-brown"><?= esc($usuario['nombre']) ?> <?= esc($usuario['apellido']) ?></div>
                                    </td>
                                    <td><?= esc($usuario['usuario']) ?></td>
                                    <td><?= esc($usuario['email']) ?></td>
                                    <td class="text-center">
                                        <?php 
                                            $perfil_style = "background: #e3f2fd; color: #0d47a1; border: 1px solid #bbdefb;"; // Cliente (Azul)
                                            if($usuario['perfil'] == 'Admin') {
                                                $perfil_style = "background: #3e2723; color: #fff; border: 1px solid #3e2723;"; // Admin (Nogal)
                                            }
                                        ?>
                                        <span class="badge rounded-pill px-3 py-2 text-uppercase" style="<?= $perfil_style ?> font-size: 0.65rem; letter-spacing: 1px;">
                                            <?= esc($usuario['perfil']) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a class="btn btn-sm btn-outline-primary" href="<?= base_url('/editar-usuario/' . $usuario['id_usuario']) ?>" title="Cambiar Rango">
                                                <i class="bi bi-shield-lock"></i> Rango
                                            </a>
                                            
                                            <?php if($vista == 'NO'): ?>
                                                <a class="btn btn-sm btn-outline-danger" href="<?= base_url('/delete-usuario/' . $usuario['id_usuario'] . '?vista=' . $vista) ?>" title="Dar de Baja">
                                                    <i class="bi bi-person-x"></i>
                                                </a>
                                            <?php else: ?>
                                                <a class="btn btn-sm btn-outline-success" href="<?= base_url('/activar-usuario/' . $usuario['id_usuario'] . '?vista=' . $vista) ?>" title="Reactivar">
                                                    <i class="bi bi-person-check"></i>
                                                </a> 
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php $cant++; ?>
                            <?php } 
                        } ?>

                        <?php if($cant == 0 && session()->get('perfil_id') == 1 && count($usuarios) <= 1): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">No se encontraron otros usuarios.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&family=Lora:wght@700&display=swap');

    :root {
        --artisan-dark: #3e2723;
        --artisan-gold: #b8860b;
        --artisan-cream: #fdfaf5;
    }

    .font-lora { font-family: 'Lora', serif; }
    .text-brown { color: var(--artisan-dark); }
    .bg-artisan-dark { background-color: var(--artisan-dark); }
    .bg-artisan-cream { background-color: var(--artisan-cream); }
    .bg-gold-artisan { background-color: var(--artisan-gold); color: white; }
    
    .artisan-input { border: 1px solid #d7ccc8; border-radius: 8px; }
    
    .btn-artisan-dark { background-color: var(--artisan-dark); color: white; border-radius: 8px; transition: all 0.3s; }
    .btn-artisan-dark:hover { background-color: var(--artisan-gold); color: white; transform: translateY(-2px); }

    .btn-gold-artisan { background-color: var(--artisan-gold); color: white; border-radius: 8px; transition: all 0.3s; border: none; }
    .btn-gold-artisan:hover { background-color: #9c7b0a; color: white; transform: scale(1.02); }

    .btn-outline-brown { border: 1px solid var(--artisan-dark); color: var(--artisan-dark); border-radius: 8px; font-weight: 600; }
    .btn-outline-brown:hover { background-color: var(--artisan-dark); color: white; }
</style>
