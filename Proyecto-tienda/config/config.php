<?php 

define("KEY_TOKEN","APR.wqc-354*");
define("MONEDA","$");
session_start();

$num_card = 0;
if(isset($_SESSION['carrito']['productos'])) {
    $num_card= count($_SESSION['carrito']['productos']);

}

