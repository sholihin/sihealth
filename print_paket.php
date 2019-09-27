<?php

//function data
require "functions.php";
$all = getTrxPaket($_GET[trx_id]);
$list = $all['list'];
$totalTagihan = $all['bill']['totalTagihan'];
$totalBayar = $all['bill']['totalBayar'];
$sisaTagihan = $all['bill']['sisaTagihan'];
$tanggal = getNewDate();
$customer_name = $all['bill']['customer_name'];
$customer_address = $all['bill']['customer_address'];

$path = "vendor/invoice/";
require $path."invoicr.php";
$invoice = new Invoicr();


$invoice->set("company", [
	$path . "logo-small.png", 
	$path . "logo-small.png", 
	"Jl.Roda Pembangunan No 18, Kp.Ciparengga Desa No.Rt 003/05, Cimandala, Kec.Sukaraja, Bogor, Jawa Barat 16810",
	"Telpon: (0251) 7505183",
	"https://rumahstrokebogor.com"
]);

$invoice->set("invoice", [
	["Invoice #", "INV".$_GET[trx_id]],
	["Due Date", $tanggal]
]);

$invoice->set("billto", [
	$customer_name,
	$customer_address
]);

// $invoice->set("shipto", [
// 	"Customer Name",
// 	"Street Address"
// ]);

$items = $list;
foreach ($items as $i) { $invoice->add("items", $i); }

$invoice->set("totals", [
	["Total Tagihan", $totalTagihan],
	["Sudah Bayar ", $totalBayar],
	["Sisa Tagihan", $sisaTagihan]
]);

$invoice->set("notes", [
	"Terimakasih,",
	"Semoga lekas sembuh."
]);


$invoice->template("simple");

/*****************************************************************************/
// 3B - OUTPUT IN HTML
// DEFAULT DISPLAY IN BROWSER | 1 DISPLAY IN BROWSER | 2 FORCE DOWNLOAD | 3 SAVE ON SERVER
//  $invoice->outputHTML();
// $invoice->outputHTML(1);
// $invoice->outputHTML(2, "invoice.html");
// $invoice->outputHTML(3, __DIR__ . DIRECTORY_SEPARATOR . "invoice.html");
/*****************************************************************************/
// 3C - PDF OUTPUT
// DEFAULT DISPLAY IN BROWSER | 1 DISPLAY IN BROWSER | 2 FORCE DOWNLOAD | 3 SAVE ON SERVER
$invoice->outputPDF();
// $invoice->outputPDF(1);
// $invoice->outputPDF(2, "invoice.pdf");
// $invoice->outputPDF(3, __DIR__ . DIRECTORY_SEPARATOR . "invoice.pdf");
/*****************************************************************************/
// 3D - DOCX OUTPUT
// DEFAULT FORCE DOWNLOAD| 1 FORCE DOWNLOAD | 2 SAVE ON SERVER
// $invoice->outputDOCX();
// $invoice->outputDOCX(1, "invoice.docx");
// $invoice->outputDOCX(2, __DIR__ . DIRECTORY_SEPARATOR . "invoice.docx");
/*****************************************************************************/
?>