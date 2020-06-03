<?php
header('Access-Control-Allow-Origin: *');

include_once './listar_diretorios.php';

$imagePaths = getImagesPath();

echo json_encode($imagePaths);