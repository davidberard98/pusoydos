<?php
class card {
  public $rank;
  public $suite; // 'c', 's', 'h', 'd'

  function __construct($strval){
    if(isset($strval))
    {
      $this->suite = substr($strval, strlen($strval)-1);
      $this->rank = intval(substr($strval, 0, strlen($strval)-1));
    }
  }

}


?>
