<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalen Pedidos</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="build/css/app.css">
    <script src="https://kit.fontawesome.com/984da8b724.js" crossorigin="anonymous"></script>
</head>
        <body>

                <div class="app">                                      
                                
                        <?php echo $contenido; ?>            
                
                </div>  
        

 

        <?php 
        echo $script ?? " ";  
        ?>
        <!-- //Puedo imprimir script en cualquier otra pagina por q el layout va a imprimir lo que yp coloque en la carpeta 
        de scrit en la parte inferiorpara escapar los errore en el html si no encuentra alguna varible -->
         <!-- //DONDE ESTE CREADA LA VARIABLE DE SCRIPT EN LAS PAGINAS VA A IMPRIMIRLA Y SI NO IMPRIME UN STRIG VAVIO        -->
        </body>
</html>