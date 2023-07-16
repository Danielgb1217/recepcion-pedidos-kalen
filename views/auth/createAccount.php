
    <h1 class="nombre-pagina">Crear Cuenta</h1>
    <p class="descripcion-pagina"> Formulario para crear una nueva cuenta </p>

<?php 
include_once __DIR__.'/../templates/alertas.php';
?>

<div class="contenedor-crear_cuenta, centrar">

    <form class="formulario, centrar" method="POST" action="/createAccount">
        <div class="campo-crear_cuenta">
            <div>   
                <label for="nombre">Nombre</label>  <!--El name es lo que vamos a enviar al metodo post -->
                <input type="text" 
                id="nombre" 
                name="nombre" 
                placeholder="Tu nombre"
                value="<?php echo s($usuario->nombre); ?>"/> <!--con esto mantengo los datos en la vista a pesar de tener objeto en memoria y actualizar -->
            </div>
            <div>
                <label for="apellido">Apellido</label>  <!--El name es lo que vamos a enviar al metodo post -->
                <input type="text" 
                id="apellido" 
                name="apellido" p
                placeholder="Tu apellido"
                value="<?php echo s($usuario->apellido); ?>"/>
            </div>
        </div>

        <div class="campo-crear">
            <label for="email">Email</label>  <!--El name es lo que vamos a enviar al metodo post -->
            <input type="email" 
            id="email" 
            name="email" 
            placeholder="Tu Email"
            value="<?php echo s($usuario->email); ?>"/>
        </div>

        <div class="campo-crear_cuenta">

            <div>
                <label for="cedula">Cedula</label>  <!--El name es lo que vamos a enviar al metodo post -->
                <input type="text" 
                id="cedula" 
                name="cedula" p
                placeholder="cedula"
                value="<?php echo s($usuario->cedula); ?>"/>
            </div>

            <div>
                <label for="telefono">Telefono</label>  <!--El name es lo que vamos a enviar al metodo post -->
                <input type="tel" 
                id="telefono" 
                name="telefono" 
                placeholder="Tu Telefono"
                value="<?php echo s($usuario->telefono); ?>"/>
            </div>

        </div>

        <div class="campo-crear">
            <label for="password">Password</label>  <!--El name es lo que vamos a enviar al metodo post -->
            <input type="password" 
            id="password" 
            name="password" 
            placeholder="Tu Password"/>
        </div>       

        <div class="acciones">
            <a href="/"> <strong>Ya tienes una cuenta? Iniciar Sesion</strong></a>
            <input type="submit" value="Crear Cuenta" class="boton-login" />
            <a href="/missPassword"><strong> Olvidaste tu password ? Recuperar Password</strong></a>
        </div>    
       
    </form>

</div>