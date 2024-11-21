<?php

interface SequenceInterface {

    public function validate(): bool;
    public function transcription(string $id): GeneticSequence;
    public function countBases(): array;
    
}
