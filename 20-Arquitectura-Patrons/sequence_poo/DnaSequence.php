<?php
require_once 'GeneticSequence.php';

class DnaSequence extends GeneticSequence {
    
    const VALID_VALUES = 'ACGT';
    const TYPE = 'DNA';

    public function __construct(string $id=NULL, string $elements=NULL) {
        parent::__construct($id, $elements, self::VALID_VALUES);
    }
    
    public function transcription(string $id): GeneticSequence {
        $rnaElements=str_replace(parent::REPLACEMENT[0], parent::REPLACEMENT[1], parent::getElements());
        
        $objRnaSequence=new RnaSequence($id, $rnaElements);
        
        return $objRnaSequence;
    }
    
    public function __toString(): string {
        return sprintf("%s; type=%s; valid_values=%s}",
            parent::__toString(),
            self::TYPE,
            parent::getValidValues());
    }   
    
}