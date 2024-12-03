<?php
require_once 'sistema.class.php';
$app = new sistema();
$app->sendMail('oscarpacon321@gmail.com','Prueba','Prueba de libreria de correo en php');