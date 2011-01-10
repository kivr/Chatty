<?
/*=========================================================================================
 File Sharing System
 PHP File Sharing System - release 1.0
 May.20 / 2006
 author: Diego A. Guevara C. - DiG
 -------------------------------------------------------
 GNU GPL
 http://www.gnu.org/copyleft/gpl.html
 -------------------------------------------------------
 DESCRIPCION: fileup.php
 Este modulo se encarga de subir el archvio al servidor, el maximo tamaño de archivo permitido
 para subir depende de la configuracion del WebServer, por ejemplo en Apache el maximo por
 defecto es de 2MB.
 -------------------------------------------------------
 HISTORICO:
 Release 1.0 - May.20 / 2006 - DiG
 Esta aplicacion nace tiempo atras aproximadamente en el año 2004 como un beta pero que
 solo fue creado para resolver la necesidad temporal y especifica de ese momento, por esta
 razon la fecha en la que inicia el release es en la que he retomado el desarrollo para 
 compartirlo y mejorarlo.
 -------------------------------------------------------
====================================/////////////////=====================================*/?>
<?php require_once('include/config.php'); ?>
<?php require_once('include/ls_func.php'); ?>
<?php  $cam = "";
if (isset($_POST['carpeta'])){
$path = $path . "/" . convertPath($_POST['carpeta']);
$cam = "?cam=".$_POST['carpeta'];
}?>
<?php 
$uploaddir = $path ."/";
logentradas($path . " -- ".gethostbyaddr(getenv("REMOTE_ADDR"))." ======== ".$_FILES['userfile']['name'] ." =========> UPLOAD");
if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . md5($_FILES['userfile']['name']))) {
print("<center><b>ERROR NO SE PUEDE COPIAR EL ARCHIVO</b></center>");
}else{
addFileEntry($uploaddir.$FILE_LIST, $_FILES['userfile']['name']);
header("Location: index.php".$cam);
}
?>
