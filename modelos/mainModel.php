<?php
    //Identificamos si es una petición Ajax
    if($peticionAjax){  //preguntamos si la peticion ajax es verdadera
        require_once "../config/server.php"; //desde ajax
    }else{
        require_once "./config/server.php"; //desde index
    }

    class mainModel{ //clase del modelo principal
        //Función para obtener conectar a la BD
        protected static function conectar(){
            $conexion = new PDO(SGBD, USER, PASS); //conexiona la BD
            $conexion -> exec("SET CHARACTER SET utf8mb4");  //utiliza caracteres utf8
            return $conexion;
        }

        //Función para ejecutar consultas simples a la BD
        protected static function ejecutar_consulta_simple($consulta){
            $sql = self::conectar() -> prepare($consulta);
            //self: llama función de la misma clase
            //prepare: hacemos la consulta
            $sql -> execute(); //execute: ejecutamos la consulta
            return $sql;
        }

        //Encriptar cadenas
        public function encryption($string){
			$output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			return $output;
		}

        //Desencriptar cadenas
		protected static function decryption($string){
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
			return $output;
		}

        //Función generar códigos aleatorios
        protected static function generar_codigo_aleatorio($letra, $longitud, $numero){
            for($i=1; $i<=longitud; $i++){
                $aleatorio = rand(0, 9);
                $letra.= $aleatorio;    //agregamos la letra con los numeros al azar 
            }
            return $letra."-".$numero;
        }

        //Función para limpiar cadenas
        protected static function limpiar_cadena($cadena){
            $cadena = trim($cadena);    //Elimina espacios antes o despues del texto
            $cadena = stripslashes($cadena);    //Elimina las barra invertidas
            $cadena = str_ireplace("<script>", "", $cadena);    //Elimina los "script"
            $cadena = str_ireplace("</script>", "", $cadena);   //Elimina los "/script"
            $cadena = str_ireplace("<script src>", "", $cadena);    //Elimina los "script src"
            //Evitar inyección SQL
            $cadena = str_ireplace("SELECT * FROM", "", $cadena);
            $cadena = str_ireplace("INSERT INTO", "", $cadena);
            $cadena = str_ireplace("DROP TABLE", "", $cadena);
            $cadena = str_ireplace("DROP DATABASE", "", $cadena);
            $cadena = str_ireplace("TRUNCATE TABLE", "", $cadena);
            $cadena = str_ireplace("SHOW TABLES", "", $cadena);
            $cadena = str_ireplace("SHOW DATABASES", "", $cadena);
            //PHP
            $cadena = str_ireplace("<?php", "", $cadena);
            $cadena = str_ireplace("?>", "", $cadena);
            //JS
            $cadena = str_ireplace("--", "", $cadena);
            $cadena = str_ireplace(">", "", $cadena);
            $cadena = str_ireplace("<", "", $cadena);
            $cadena = str_ireplace("]", "", $cadena);
            $cadena = str_ireplace("[", "", $cadena);
            $cadena = str_ireplace("^", "", $cadena);
            $cadena = str_ireplace("==", "", $cadena);
            $cadena = str_ireplace(";", "", $cadena);
            $cadena = str_ireplace("::", "", $cadena);
            $cadena = stripslashes($cadena);
            $cadena = trim($cadena);
            return $cadena;
        }

        //Funcion para verificar datos
        protected static function verificar_datos($filtro, $cadena){
            if(preg_match("/^".$filtro."$/", $cadena)){ //realiza una comparación con una expresión regular
                return false;   //no hay error, aprobó el filtro
            }else{
                return true;    //hay error, no aprobó el filtro
            }
        }

        //Función para verficar fechas
        protected static function verficar_fecha($fecha){
            $valores = explode('-', $fecha);    //separa la fecha por un guion
            if(count($valores)==3 && checkdate($valores[1], $valores[2], $valores[0])){ //verificar que la fecha coincida con el formato
                return false;   //no tiene errores
            }else{
                return true;    //si tiene errores
            }
        }
    }