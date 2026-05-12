<?= $this->extend('layout/main') ?>

<?= $this->section('extra-css') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/admin-panel.css?v=1.0')?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="admin-wrapper py-5">
    <div class="container">
        <div class="card admin-card">
        
        <!-- Cabecera -->
        <div class="admin-card-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="fw-bold"><i class="bi bi-people-fill me-2"></i> Gestión de Usuarios</h2>
                    <p class="small mb-0 opacity-75">Administra los accesos y perfiles del sistema</p>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <a href="<?= base_url('registro') ?>" class="btn btn-admin-gold py-2 px-4 shadow-sm">
                        <i class="bi bi-person-plus-fill me-2"></i> NUEVO USUARIO
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <!-- Barra de Filtros -->
            <form action="<?= base_url('/crud-usuarios'); ?>" method="get" class="admin-filter-bar">
                <div class="row g-3 align-items-end">
                    
                    <!-- Buscador -->
                    <div class="col-md-4">
                        <label class="form-label small fw-bold text-muted text-uppercase">Buscar Usuario</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0 admin-input" 
                                   placeholder="Nombre, email o usuario..." value="<?= $_GET['search'] ?? '' ?>">
                        </div>
                    </div>

                    <!-- Filtro Estado -->
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Estado</label>
                        <select name="vista" class="form-select admin-input">
                            <option value="NO" <?= ($vista == 'NO') ? 'selected' : '' ?>>👤 Usuarios Activos</option>
                            <option value="SI" <?= ($vista == 'SI') ? 'selected' : '' ?>>🚫 Usuarios Eliminados</option>
                        </select>
                    </div>

                    <!-- Límite de Resultados -->
                    <div class="col-md-2">
                        <label class="form-label small fw-bold text-muted text-uppercase">Mostrar</label>
                        <select class="form-select admin-input" name="option">
                            <option value="5" <?= ($select == 5) ? 'selected' : '' ?>>5 filas</option>
                            <option value="10" <?= ($select == 10) ? 'selected' : '' ?>>10 filas</option>
                            <option value="Todos" <?= ($select == 'Todos') ? 'selected' : '' ?>>Todos</option>
                        </select>
                    </div>

                    <!-- Botones -->
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn bg-cva-brown text-white w-100 fw-bold py-2 rounded-3">FILTRAR</button>
                        <?php if(!empty($_GET['search'])): ?>
                            <a href="<?= base_url('/crud-usuarios') ?>" class="btn btn-outline-secondary px-3 py-2">X</a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>

            <!-- Tabla de Usuarios -->
            <div class="admin-table-container">
                <table class="table table-hover admin-table mb-0">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Nombre y Apellido</th>
                            <th>Usuario / Acceso</th>
                            <th>Correo Electrónico</th>
                            <th class="text-center">Perfil</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Fila del usuario actual (Destacada) -->
                        <?php foreach ($usuarios as $usuario): ?>
                            <?php if (session()->get('id_usuario') == $usuario['id_usuario']): ?>
                                <tr class="bg-light">
                                    <td class="text-center fw-bold text-muted"><?= $usuario['id_usuario'] ?></td>
                                    <td>
                                        <div class="fw-bold text-cva-brown"><?= esc($usuario['nombre']) ?> <?= esc($usuario['apellido']) ?></div>
                                        <span class="badge bg-cva-gold badge-admin">TU CUENTA</span>
                                    </td>
                                    <td class="fw-bold"><?= esc($usuario['usuario']) ?></td>
                                    <td><?= esc($usuario['email']) ?></td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill badge-admin <?= ($usuario['perfil'] == 'Admin') ? 'bg-cva-brown' : 'bg-info text-dark' ?>">
                                            <?= esc($usuario['perfil']) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-outline-secondary fw-bold px-3 rounded-pill" href="<?= base_url('/perfil') ?>">MI PERFIL</a>
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
                                        <div class="fw-bold text-cva-brown"><?= esc($usuario['nombre']) ?> <?= esc($usuario['apellido']) ?></div>
                                    </td>
                                    <td><?= esc($usuario['usuario']) ?></td>
                                    <td><?= esc($usuario['email']) ?></td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill badge-admin <?= ($usuario['perfil'] == 'Admin') ? 'bg-cva-brown' : 'bg-info text-dark' ?>">
                                            <?= esc($usuario['perfil']) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a class="btn btn-sm btn-outline-primary rounded-pill px-3" href="<?= base_url('/editar-usuario/' . $usuario['id_usuario']) ?>" title="Cambiar Rango">
                                                <i class="bi bi-shield-lock me-1"></i> Rango
                                            </a>
                                            
                                            <?php if($vista == 'NO'): ?>
                                                <a class="btn btn-sm btn-outline-danger rounded-circle p-2" href="<?= base_url('/delete-usuario/' . $usuario['id_usuario'] . '?vista=' . $vista) ?>" title="Dar de Baja" style="width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center;">
                                                    <i class="bi bi-person-x"></i>
                                                </a>
                                            <?php else: ?>
                                                <a class="btn btn-sm btn-outline-success rounded-circle p-2" href="<?= base_url('/activar-usuario/' . $usuario['id_usuario'] . '?vista=' . $vista) ?>" title="Reactivar" style="width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center;">
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
<?= $this->endSection() ?>
