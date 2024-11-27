<?php
    //Conexión
    const SERVER="localhost";   //servidor
    const DB="prestamos";       //base de datos
    const USER="root";          //usuario
    const PASS="";              //contraseña
    const SGBD="mysql:host=".SERVER.";dbname=".DB;  //parámetros de conexión
    
    //Encriptación en caso de error
    const METHOD="AES-256-CBC";     //método a utlizar para procesar el hash
    const SECRET_KEY='$PRESTAMOS@2024';     //llave secreta
    const SECRET_IV='12345';        //identificador único