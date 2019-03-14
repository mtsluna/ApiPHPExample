<?php

class OperationsController {
    
    private $v1;
    private $v2;
    
    public function __construct($body) {
        $this->v1 = $body['fieldOne'];
        $this->v2 = $body['fieldTwo'];
    }
    
    public function sum(){
        return $this->v1 + $this->v2;
    }
    
    public function substraction(){
        return $this->v1 - $this->v2;
    }
    
    public function multiplication(){
        return $this->v1 * $this->v2;
    }
    
    public function division(){
        if($this->v2 == 0){
            return "Can't divide by 0.";
        }
        else{
            return $this->v1 / $this->v2;
        }        
    }
    
}
