<?php
$filename="INFORME DE STOCK.pdf"; 
//==========================================================================================================
require_once "../../vendor/autoload.php";

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    ob_start(); 
    include "../../modules/stock_inventory/stock.php";
    $content = ob_get_clean();
    $html2pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF'
ese es el boton de imprimir

<html xmlns="http://www.w3.org/1999/xhtml"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>INFORME DE STOCK DE MEDICAMENTOS</title>
        <link rel="stylesheet" type="text/css" href="../../assets/css/laporan.css" />
    </head>
    <body>
        <div id="title">
           STOCK DE MEDICAMENTOS
        </div>
        
        <hr><br>

        <div id="isi">
            <table width="100%" border="0.3" cellpadding="0" cellspacing=
este es la vista a imprimir
se llama stock.php