<!-- Se debe incluir el temlate de las alertas para que se muestresn  -->

<div class="contenedor-app">

        <div class="imagen">             

        </div> 

        <div class="app">  
        
        <h1 class="nombre-pagina"> MontesApp  </h1>
        <P class="descripcion-pagina">Diseños a Tu Nivel</P>
        <br/>
        <!-- <p class="descripcion-pagina">Inicia Sesion </p> -->
        
        <div class="centrar">
            <div class="icono-login">
                <i class="fa-solid fa-user fa-2xl"></i>
            </div>       
        </div>
            

        <?php 
        include_once __DIR__.'/../templates/alertas.php';
        ?>

            <form class="formulario" method="POST" action="/">
                <div class="centrar">
                    <div class="campo">
                        <!-- <label for="email">Email</label>  el for es el atributo para los label para atarlo a un input --> 
                        <br/>
                        <input type="email" 
                        id="email" 
                        placeholder="email" 
                        name="email"
                        value="<?php echo s($auth->email); ?>"/>  <!--el Id es el atributo para atarlo al label  -->
                    </div>                                                                <!--el name es el que permite leer el valor con el post -> $_POST['email'] muy importante -->          

                    <div class="campo">
                        <!-- <label for="password">Password</label> -->
                        <br/>
                        <input type="password" 
                        id="password" 
                        placeholder="Password" 
                        name="password"
                        value="<?php echo s($auth->password); ?>"/>                    
                    </div>

                </div>


                <div class="acciones">
                    <a href="/createAccount"> Aun no tienes una cuenta ? Crear Cuenta</a>
                    <a href="/missPassword"> Olvidaste tu password ? Recuperar Password</a>
                 </div>

                <div class="div-boton_login">
                    <input type="submit" class="boton-login" value="Iniciar Sesion">
                </div>
               
                
            </form>


       </div>

</div> 