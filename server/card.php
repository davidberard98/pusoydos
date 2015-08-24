<?php
class card {
  public $rank;
  public $suite; // 'c', 's', 'h', 'd'

  function __construct($strval){
    if(isset($strval))
    {
      if(strlen($strval) == 1) {
        $this->rank = intval((ord($strval)-65)/4)+1;
        $suiteint = (ord($strval)-65)%4;
        if($suiteint == 0)
          $this->suite = 'c';
        else if($suiteint == 1)
          $this->suite = 's';
        else if($suiteint == 2)
          $this->suite = 'h';
        else if($suiteint == 3)
          $this->suite = 'd';
      }
      else {
        $this->suite = substr($strval, strlen($strval)-1);
        $this->rank = intval(substr($strval, 0, strlen($strval)-1));
      }
    }
  }

}


?>
