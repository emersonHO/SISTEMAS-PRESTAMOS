<?php
    require_once "./modelos/vistasModelo.php";  //incluimos el archivo vistasModelo.php

    class vistasControlador extends vistasModelo{   //vCont hereda de vModel
        //Controlador para obtener plantilla
        public function obtener_plantilla_controlador(){    //devuelve la plantilla
            return require_once "./vistas/plantilla.php";
        }

        //Controlador para obtener vistas
        public function obtener_vistas_controlador(){
            if(isset($_GET['views'])){  //comprobar si viene definido la variable
                $ruta=explode("/", $_GET['views']); //(lo que separa, lo que queremos separar)
                $respuesta=vistasModelo::obtener_vistas_modelo($ruta[0]);
            }else{
                $respuesta="login";
            }
            return $respuesta;
        }
    }