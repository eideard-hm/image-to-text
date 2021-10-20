<?php
$source = 'documento.pdf';
$target= "converted.png";
$response = exec("/usr/local/bin/convert $source -colorspace RGB –res");

echo $response ? 'Convetido' : 'Error';