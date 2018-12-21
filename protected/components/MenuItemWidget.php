<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class MenuItemWidget extends CWidget {
 
    public $menu = array();
    public $Lang='az';
	public $level=1,$active,$jsvoid,$includes=true;
 
    public function run() {
        $this->render('MenuItemWidgetView',array('lang'=>$this->Lang,'item'=>$this->menu));
    }
}
?>
