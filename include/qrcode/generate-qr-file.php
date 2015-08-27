<?php 

    include('phpqrcode/qrlib.php'); 
    $param=$_GET['param']; 
    // outputs image directly into browser, as PNG stream 
    QRcode::png($param);