<h1 class="nombre-pagina, titulo-create">Restablecer Password</h1>
<p class="descripcion-pagina"> Escribe tu nuevo Password</p>

<?php
        include_once __DIR__.'/../templates/alertas.php';
?>

<?php if($error) return null; ?>



<form class="formulario, centrar" method="POST" action="/missAcount">

    <div class="campo">

        <label for="password">Password</label>  <!--El name es lo que vamos a enviar al metodo post -->
        <br/>
        <input type="password"
        id="password"
        name="password"
        placeholder="Nuevo Password"/> <!--con esto mantengo los datos en la vista a pesar de tener objeto en memoria y actualizar -->
    </div>

    <input type="hidden" name="accion" value="miss" />
    <input type="hidden" name="id" value="<?php echo($usuarioId); ?>" />
    <input type="submit" value="Restablecer" class="boton-login" />

</form>

<div class="acciones">
    <a href="/login"> Ya tienes una cuenta? Iniciar Sesion</a>
    <a href="/createAccount"> Aun no tienes una cuenta ? Crear una</a>
</div>