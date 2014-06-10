<?php class MY_Form_validation extends CI_Form_validation {
  
  public function __construct($rules=array()){
    parent::__construct($rules);
  }

  /*   This function will return the error count    */    
  function get_error_count(){
    return count($this->_error_array); 
  }
}

?>