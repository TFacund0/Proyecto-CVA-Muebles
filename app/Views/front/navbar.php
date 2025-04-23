

<!--BARRA DE NAVEGACION-->
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">

        <!-- Logo de la barra de navegacion -->
        <div class="content-logo">
          <img src="assets/img/logo/cva2.png" alt="" width="50px" class="logo me-3 ms-3">
        </div>
        
        <a class="navbar-brand" href="#"><span class="titulo-logo">CVA Muebles</span></a>

        <!-- Botón para dispositivos pequeños -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
          aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenedor del menú -->
        <div class="collapse navbar-collapse justify-content-between me-lg-5" id="navbarContent">
          
          <!-- Menú centrado -->
          <ul class="navbar-nav mx-auto text-lg-center text-end content-list">
            <li class="nav-item">
              <a class="btn btn-beige text-dark mx-1" href="<?= base_url('/')?>">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-beige text-dark mx-1" href="#">Productos</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-beige text-dark mx-1" href="<?= base_url('comercializacion')?>">Comercializacion</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-beige text-dark mx-1" href="<?= base_url('quienesSomos')?>">Quienes Somos</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-beige text-dark mx-1" href="<?= base_url('informacionContacto')?>">Contacto</a>
            </li>
          </ul>
          
                
          <!-- Links a la derecha -->
          <div class="d-flex content-account position-relative ">
            <a class="btn btn-beige text-dark mx-1" href="#">
              <img src="assets/img/iconos/cart-check.svg" alt="" class="icono">
            </a>
            
            <a class=" btn btn-beige text-dark mx-1" href="#">
              <img src="assets/img/iconos/person.svg" alt="" class="icono">
            </a>

          </div>
        </div>

      </div>
    </nav>