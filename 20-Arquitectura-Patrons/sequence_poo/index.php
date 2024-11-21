<?php
require_once 'GeneticSequence.php';
require_once 'DnaSequence.php';
require_once 'RnaSequence.php';
require_once 'SequenceUtil.php';

echo "Testing validate...<br/>";

$objDnaSequence = new DnaSequence("SEQ_DNA","ACGTACGTACGT");

echo "ID: " . $objDnaSequence->getId();
echo "<br/>";
echo " ELEMENTS: " . $objDnaSequence->getElements();
echo "<br/>";
echo "Is valid?";

if ($objDnaSequence->validate()) {
    echo "VALID</p>";
}
else {
    echo "INVALID</p>";
}

echo "Testing transcription...<br/>";
$objRnaSequence=$objDnaSequence->transcription("SEQ_RNA");

echo "ID: " . $objRnaSequence->getId();
echo "<br/>";
echo " ELEMENTS: " . $objRnaSequence->getElements();
echo "<br/><br/>";


$objDnaSequenceNew=$objRnaSequence->transcription("SEQ_DNA_NEW");

echo "ID: " . $objDnaSequenceNew->getId();
echo "<br/>";
echo " ELEMENTS: " . $objDnaSequenceNew->getElements();
echo "<br/><br/>";

echo "Testing countBases...<br/>";
print_r($objDnaSequenceNew->countBases());
echo "<br/><br/>";

echo "Testing toString...<br/>";
echo $objDnaSequenceNew;
echo "<br/><br/>";

echo "Testing generateRandomSequence...<br/>";
echo SequenceUtil::generateRandomSequence("ACGT", 10);

