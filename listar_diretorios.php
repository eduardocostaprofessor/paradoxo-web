<?php
function getBigImagePath( $smallImagePath ){

    $arPath      = explode('/', $smallImagePath);
    $smallFile   = end($arPath);
    $arrFile     = explode('.', $smallFile);
    // $bigFile     = "$arrFile[0]g.$arrFile[1]";
    $bigFile     = "$arrFile[0].$arrFile[1]";
    $bigFilePath = substr($smallImagePath, 0, strpos($smallImagePath, 'thumbs')) . $bigFile;
   
    return $bigFilePath;
}

function getImagesPath(){

    $pasta = 'images/trabalhos/thumbs/';
    
    if(is_dir($pasta)) { 
        $arrImagens = [];
        $diretorio = dir($pasta); 
        while(($arquivo = $diretorio->read()) !== false) { 
            if ($arquivo !== '.' && $arquivo !== '..' && $arquivo !== '.DS_Store') {
                
                $thumbPath = $pasta.$arquivo;
                $bigImagePath = getBigImagePath( $thumbPath );
                
                $arrImagens[] = [$thumbPath,$bigImagePath];

                // $arrImagens['thumbsPath'][] = $thumbPath;
                // $arrImagens['imagesPath'][] = $bigImagePath;
            }
        } 
        
        $diretorio->close();
        // sort($arrImagens['thumbsPath']);
        // sort($arrImagens['imagesPath']);
        
        return $arrImagens;
    }
    
    return 'A pasta não existe.';
}