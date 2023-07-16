<h1 class="nombre-pagina">Olvide Mi Password</h1>
<p class="descripcion-pagina"> Escribe el email registrado para recuperar el password </p>

<?php 
        include_once __DIR__.'/../templates/alertas.php';
?>

<form class="formulario, centrar" method="POST" action="/missPassword">

    <div class="campo">      
        
        <label for="nombre">Email</label>  <!--El name es lo que vamos a enviar al metodo post -->
        <br/>
        <input type="text" 
        id="email" 
        name="email" 
        placeholder="Tu Email"/> <!--con esto mantengo los datos en la vista a pesar de tener objeto en memoria y actualizar -->
        
    </div>
    <input type="submit" value="Enviar" class="boton-login" />
    

</form>

<div class="acciones">
    <a href="/"> Ya tienes una cuenta? Iniciar Sesión</a>
    <a href="/createAccount"> Aun no tienes una cuenta ? Crear una</a>
</div>