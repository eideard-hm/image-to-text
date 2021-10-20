<?php
if (isset($_FILES['image'])) {

    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($file_tmp, "images/" . $file_name);
    echo "<h3>Image Upload Success</h3>";
    echo '<img src="images/' . $file_name . '" style="width:100%">';

    shell_exec('"C:\\Program Files\\Tesseract-OCR\\tesseract" "C:\\xampp\\htdocs\\image2text\\images\\' . $file_name . '" out');

    echo "<br><h3>OCR after reading</h3><br><pre>";

    $myfile = fopen("out.txt", "r") or die("Unable to open file!");
    $information = fread($myfile, filesize("out.txt"));
    $keyWords = ['tarjeta', 'identidad', 'identificación', 'documento'];
    echo $information . '<br/>';
    $arrInfo = explode(' ', $information);
    foreach ($arrInfo as $info) {
        foreach ($keyWords as $words) {
            if ($info == $words) {
                echo "Se ha encontrado una concordancia, las palabras: " . $info;
            }
        }
    }
    print_r($arrInfo);
    fclose($myfile);
    echo "</pre>";
}
