<?php
include "FilePersist.php";

try {
    // read.
    $file1 = "prova.txt";
    echo "<p>filename: $file1</p>";
    $filePersist = new FilePersist($file1);
    $filePersist->open("rb");
    $lineArray = $filePersist->readToArrayOfLines(true);
    $filePersist->close();
    echo "<pre>"; var_dump($lineArray);   echo "</pre>"; 
    
    //write
    $file2 = "prova2.txt";
    echo "<p>filename2: $file2</p>";
    $filePersist2 = new FilePersist($file2);
    echo "open: ".$filePersist2->open("wb");
    var_dump($filePersist2);
    $linesWritten = $filePersist2->writeFromArrayOfLines($lineArray);
    echo "Línies escrites: $linesWritten";
//    $fp=fopen("./prova2.txt", "wb") or die(print_r(error_get_last(),true));
//    fwrite($fp, "hola");
//    fclose($fp);
    
} catch (Exception $e) {
    echo $e->getMessage();
}
