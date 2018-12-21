<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Highlighteds extends CWidget {
 
    public $items = array();
    public $Lang='az';
 
    public function run() {	
        $this->render('Highlighteds',array('items'=>$this->items));
    }
 
}
?>
