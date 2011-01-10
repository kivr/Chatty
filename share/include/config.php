<?php
//=========================================================================================
// Upload Folder Path
// -------------------
// It can be relative or absolute depends your OS and Web server.
$path = "./uploads";
//====================================/////////////////=====================================

//=========================================================================================
// Application Access Security
// -------------------
// Allow remote machines to access or not the application
// Tipo: Define security Level
// Tipo = 0 No Restriction
// Tipo = 1 List (Listado) shows Allowed Machines
// Tipo = 2 List (Listado) shows Not Allowed Machines
$Tipo = 0;

// Listado: Define an array with Machine Name or IP Address
$Listado = "maquina1,maquina2,192.168.0.15";
//====================================/////////////////=====================================

//=========================================================================================
// Template Definition
// -------------------
// Define Template used by the application.
// Template must to be in the images/template folder. 
// For more info about temmpate creation read documentation.
$Template = "grey";
//====================================/////////////////=====================================

//=========================================================================================
// Application Language
// -------------------
// Define Language Library to use. Library must to be located into include/language Folder
$LANG = "EN_US";
//====================================/////////////////=====================================



//=========================================================================================
// Links Effect JSFX_LinkFader2
// -------------------
// Active JSFX_LinkFader2 Links Effect (if performance problems, turn it off)
$JSFX_LinkFader2 = true;
//====================================/////////////////=====================================
$FILE_LIST = "list.txt";
//-- (c) 2001 - 2007 Diego Guevara
?>
