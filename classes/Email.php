<?php 
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token){

        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
        
    }

    public function enviarConfirmacion(){

        //Crear el objeto de email
        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = 'smtp.gmail.com';
        $email->SMTPAuth = true;
        $email->Port = 587;
        $email->Username = 'textilesotore@gmail.com';
        $email->Password = 'egrfsodvonwirjve';  //contrasenia porporcionala por la gestion de contrasenias de google para apps
        $email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;


        $email->setFrom('textilesotore@gmail.com', 'Gestion de Cuentas Textile Store'); //direccion proporcionada en mailtrap para practicas de desarrollo
        $email->addAddress($this->email, 'TextileStore.com');
        $email->Subject = 'Confirmar Cuenta';

        //Se utilizara ktml
        $email->isHTML(TRUE);
        $email->CharSet= 'UTF-8';

        // envio el token por peticion get a la pagina confirmar cuenta
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre."</strong> para confirmar la creacion de la cuenta en TextileStore
        debe Confirmar --></p>";
        $contenido.= "<form method='POST' action='https://whispering-temple-36485.herokuapp.com/confirmarCuenta'>";
        $contenido.= "<input type='hidden' name='token' value=" . $this->token ." >";
        $contenido.="<button type='submit'><strong>Confirmar</strong></button>";
        $contenido.="</form>";
     //   <!-- <a href='https://whispering-temple-36485.herokuapp.com/confirmar-cuenta?token=  
     //   ". $this->token ."'>Confirmar Cuenta</a> </p>"; -->


        $contenido.= "<p><strong>Si no has solicitado la cuenta, ignora el mensaje</strong></p>";
        $contenido.= "</html>";

        //Agrego el contenido construido al cuerpo 
        $email->Body= $contenido;

        //Enviar el email
        $email->send(); 

    }

    public function enviarInstrucciones(){

        //Crear el objeto de email
        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = 'smtp.gmail.com';
        $email->SMTPAuth = true;
        $email->Port = 587;
        $email->Username = 'textilesotore@gmail.com';
        $email->Password = 'egrfsodvonwirjve';  //contrasenia porporcionala por la gestion de contrasenias de google para apps
        $email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;



        $email->setFrom('textilesotore@gmail.com', 'Gestion de Cuentas Textile Store'); //direccion proporcionada en mailtrap para practicas de desarrollo
        $email->addAddress($this->email, 'TextileStore.com');      
        $email->Subject = 'Restablecer Contraseña';

        //Se utilizara ktml
        $email->isHTML(TRUE);
        $email->CharSet= 'UTF-8';

        // envio el token por peticion get a la pagina confirmar cuenta
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre."</strong> para restablecer la contraseña de la cuenta en TextileStore
        debe confirmar</p>";
        $contenido.= "<form method='POST' action='https://whispering-temple-36485.herokuapp.com/missAcount'>";
        $contenido.= "<input type='hidden' name='token' value=" . $this->token ." >";
        $contenido.="<button type='submit'><strong>Restablecer</strong></button>";
        $contenido.="</form>";
        $contenido.= "<p>Si no has solicitado la recuperación de el password, ignora el mensaje</p>";
        $contenido.= "</html>";

        //Agrego el contenido construido al cuerpo 
        $email->Body= $contenido;

        //Enviar el email
        $email->send(); 

    }


}





