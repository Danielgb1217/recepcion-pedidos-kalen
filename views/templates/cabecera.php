<div class="compras">
    <a href="/nuestrosProductos"><h1>Textile Store<i class="fa-solid fa-store fa-"></i></h1></a>
    <div class="carrito-compras, centrar">
        <a href=/carritoCompras>Carrito de Compras 
        <i class="fa-solid fa-cart-arrow-down fa-2xl"></i></a>      
    </div>
   
    <?php       //condicion para validar el tipo de usuario logueado y permitir ocultar el panel de administracion
    $tipoUsuario = '';
    if($_SESSION['admin'] === '1'){
        $tipoUsuario = ' Perfil: Administrador';
        $displayAdmin = 'mostrar';
        $displayVentas = 'mostrar';
       // $displayUsuarios = 'ocultar';
    }else if($_SESSION['admin'] === '2'){
        $tipoUsuario = ' Perfil: Vendedor';
        $displayAdmin = 'ocultar';
        $displayVentas = 'mostrar';
        //$displayUsuarios = 'ocultar';
    }else{
        $tipoUsuario = ' Perfil: Cliente';
        $displayAdmin = 'ocultar';
        $displayVentas = 'ocultar';
    }
    ?>
    
    <!-- menu de los productos de gestion del usuario administrador -->
    <div class="menu">
        <div>
            <h2><i class="fa-solid fa-bars fa-xl"></i></h2>
            <ul>
                <div>
                    <li>
                        <a href="/updateUsuario"><i class="fa-solid fa-id-card"></i>
                        <?php 
                            echo($_SESSION['nombre']);
                            echo($tipoUsuario);
                         ?>
                         </a>
                    </li>
                </div> 
                <div class="<?php echo($displayAdmin);?>">
                    <li><a href="/configurarUsuarios">      <i class="fa-regular fa-user"></i>   Administración de Usuarios</a></li> 
                </div>  
                <div class="<?php echo($displayAdmin);?>">
                    <li><a href="/admin"><i class="fa-solid fa-shirt"></i>Administración de Productos</a></li> 
                </div>
                <div class="<?php echo($displayVentas);?>">
                    <li><a href="/buscarVenta"><i class="fa-solid fa-people-roof"></i>Administración de Ventas</a></li> 
                </div>  
                <div>
                    <li><a class="boton-logout" href="/logout"><i class="fa-solid fa-power-off"></i>Cerrar Sesión</a></li>
                </div>                        
            </ul>
        </div> 
    </div>   

</div>


