<?php
include ('lib/phpqrcode/phpqrcode.php');
$file_name = './qr/ejemplo.png';
QRcode::png('https://sii.itcelaya.edu.mx/sii/index.php?r=cruge/ui/login',$file_name,2,10,2);
?>