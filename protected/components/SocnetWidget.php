<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class SocnetWidget extends CWidget {
 
    public $Lang='az';
    public function run() {
        $this->render('SocnetWidgetView',array('lang'=>$this->Lang));
    }
}
?>
