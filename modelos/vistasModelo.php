<?php
    class vistasModelo{
        //Modelo para obtener vistas
        protected static function obtener_vistas_modelo($vistas){
            //Array de datos
            $listaBlanca=["client-list", "client-new", "client-search", "client-update", "company", "home", "item-list", 
                "item-new", "item-search", "item-update", "reservation-list", "reservation-new", "reservation-pending", 
                "reservation-search", "reservation-reservation", "user-list", "user-new", "user-search", "user-update"];
            //Comprobar que el archivo existe
            if(in_array($vistas, $listaBlanca)){    //in_array(lo que tengo, lo que busco)
                if(is_file("./vistas/contenidos/".$vistas."-view.php")){    //comprobamos que el archivo exista is_file(url)
                    $contenido="./vistas/contenidos/".$vistas."-view.php";
                }else{
                    $contenido="404";
                }
            }elseif($vistas=="login"||$vistas=="index"){ //o estamos en login o index
                $contenido="login";
            }else{  //no existe la lista dada
                $contenido="404";
            }
            return $contenido;
        }
    }