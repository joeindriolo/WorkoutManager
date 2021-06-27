<?php
class WorkoutObject {
    public $exercise;
    public $amount;
    public $type;
    public $lbs;
    public $repAmount;
    public $args;

    function __construct() {
         $this->args = func_get_args();
        switch(sizeof(func_get_args())) {
            case 3:
                $this->exercise=$this->args[0];
                $this->amount=$this->args[1];
                $this->type=$this->args[2];
                break;
            case 4:
                $this->exercise=$this->args[0];
                $this->amount=$this->args[1];
                $this->type=$this->args[2];
                $this->lbs=$this->args[3];
                break;
            case 5:
                $this->exercise=$this->args[0];
                $this->amount=$this->args[1];
                $this->type=$this->args[2];
                $this->repAmount=$this->args[3];
                $this->lbs=$this->args[4];
                break;
            default:
                break;
        }
    }

    public function toString() {
        switch(sizeof($this->args)) {
            case 3:
                return (string) $this->exercise . " ". $this->amount. " ". $this->type;
                break;
            case 4:
                return (string) $this->exercise. " ". $this->amount. " ". $this->type. ", ". $this->lbs."lbs";
                break;
            case 5:
                return (string) $this->exercise. " ". $this->amount. " ". $this->type. " Of ". $this->repAmount. ", ".$this->lbs."lbs";
                break;
        }
        return 'test';
    }
}

