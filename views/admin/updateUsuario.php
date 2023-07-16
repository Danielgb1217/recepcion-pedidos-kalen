
 
<?php 
include_once __DIR__.'/../templates/alertas.php';
include_once __DIR__.'/../templates/cabecera.php';
?>
   <h1 class="nombre-pagina">Modificar Usuario</h1>    

<div class="contenedor-crear_cuenta, centrar">

    <form class="formulario, centrar" method="POST" action="/updateUsuario">
        <div class="campo-crear_cuenta">
            <div class="id-update_user">   
                <input type="text" 
                id="id" 
                name="id" 
                value="<?php echo s($usuario->id); ?>"/> <!--con esto mantengo los datos en la vista a pesar de tener objeto en memoria y actualizar -->
            </div>
        
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

            <div class="campo-crear">
                <label for="password">Password</label>  <!--El name es lo que vamos a enviar al metodo post -->
                <input type="password" 
                id="password" 
                name="password" 
                placeholder="Tu Password"
                value="<?php echo s($usuario->password); ?>"/>
            </div >    
            <div class="campo-crear">
                <label for="telefono">Telefono</label>  <!--El name es lo que vamos a enviar al metodo post -->
                <input type="tel" 
                id="telefono" 
                name="telefono" 
                placeholder="Tu Telefono"
                value="<?php echo s($usuario->telefono); ?>"/>
            </div>


            <div class="<?php 
            
            echo($display); ?>">            
                      
                <div class="campo-crear">
                    <label for="admin">Perfil</label>  <!--El name es lo que vamos a enviar al metodo post -->
                    <br/>
                    <select name="admin" id="admin"> 
                        <option selected value="<?php echo s($usuario->admin);?>">Selecciona el Perfil</option>        
                            <option value="1">Administrador</option>
                            <option value="2">Vendedor</option>
                            <option value="0">Usuario</option>        
                    </select>

                </div>

                <div class="campo-crear">
                    <label for="confirmado">Confirmacion de Cuenta</label>  <!--El name es lo que vamos a enviar al metodo post -->
                    <br/>
                    <select name="confirmado" id="confirmado"> 
                        <option selected value="<?php echo s($usuario->confirmado); ?>">Confirma la Cuenta</option>        
                            <option value="0">No Confirmado</option>
                            <option value="1">Confirmado</option>                               
                    </select>

                </div>
            </div>
        </div>   

        <div>
            <input type="submit" name="opcion" value="Actualizar" class="boton-login" />
        </div>    
       
    </form>

</div>