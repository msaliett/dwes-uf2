<?php

class SequenceUtil {
    
    public static function generateRandomSequence(string $acceptedValues, int $length): string {
        $seq="";
        
        for ($i=0; $i<$length; $i++) {
            $randomNumber=mt_rand(0,strlen($acceptedValues)-1);
            $randomChar=$acceptedValues[$randomNumber];
            $seq .= $randomChar;
        }
        
        return $seq;
    }
    
}
