<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Extralinks extends CWidget {
 
    public $items = array();
    public $Lang='az';
 
    public function run() {	
        $this->render('Extralinks',array('items'=>$this->items));
    }
 
}
?>
