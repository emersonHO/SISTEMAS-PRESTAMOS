<?php
    //Se ejecuta la aplicación
    require_once "./config/app.php";    //obtenemos las configuraciones de app.php
    require_once "./controladores/vistasControlador.php";   //obtener controlador de vistas

    $plantilla = new vistasControlador();   //instanciamos el controlador
    $plantilla -> obtener_plantilla_controlador();  //se incluye la plantilla