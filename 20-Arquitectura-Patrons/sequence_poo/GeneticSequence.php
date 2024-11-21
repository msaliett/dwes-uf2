<?php
require_once 'SequenceInterface.php';

abstract class GeneticSequence implements SequenceInterface {
    
    private $id;            // sequence identifier
    private $elements;      // elements composing the sequence 
    private $validValues;   // valid values for $elements attribute
    
    const REPLACEMENT = array('T', 'U');

    public function __construct(string $id=NULL, string $elements=NULL, string $validValues=NULL) {
        $this->id=$id;
        $this->elements=$elements;
        $this->validValues=$validValues;
    }

    public function __toString(): string {
        return sprintf("GeneticSequence: {id=%s; elements=%s}", 
            $this->id, 
            $this->elements); 
            //$this->validValues);
    }
    
    abstract public function transcription(string $id): GeneticSequence;

    public function countBases(): array {
        $bases=array();

        for ($i=0; $i<strlen($this->elements); $i++) {
            if (array_key_exists($this->elements[$i], $bases)) {
                $bases[$this->elements[$i]]++;
            }
            else {
                $bases[$this->elements[$i]]=1;
            }                
        }

        return $bases;
    }    
    
    public function validate(): bool {
        return !preg_match("/[^$this->validValues]/i", $this->elements);
             
    }    
    
    public function getId(): string {
        return $this->id;
    }

    public function getElements(): string {
        return $this->elements;
    }

    public function setElements(string $elements) {
        $this->elements = $elements;
    }    
    
    public function getValidValues(): string {
        return $this->validValues;
    }

    public function setId(string $id) {
        $this->id = $id;
    }

    public function setValidValues(string $validValues) {
        $this->validValues = $validValues;
    }
    
}
