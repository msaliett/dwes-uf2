<?php

require_once 'GeneticSequence.php';

class RnaSequence extends GeneticSequence {
    
    const VALID_VALUES = 'ACGU';
    const TYPE = 'RNA'; 

    public function __construct(string $id=NULL, string $elements=NULL) {
        parent::__construct($id, $elements, self::VALID_VALUES);
    }

    public function transcription(string $id) : GeneticSequence{
        $dnaElements=str_replace(parent::REPLACEMENT[1], parent::REPLACEMENT[0], parent::getElements());
        
        $objDnaSequence=new DnaSequence($id, $dnaElements);
        
        return $objDnaSequence;
    }
    
    public function __toString(): string {
        return sprintf("%s; type=%s; valid_values=%s}",
            parent::__toString(),
            self::TYPE,
            parent::getValidValues());
    }

    
}