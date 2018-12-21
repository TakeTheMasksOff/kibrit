<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class MenuBar extends CWidget {
 
    public $menus = array();
    public $view = 'MenuBarView';
    public $Lang='az';
	public $level=1,$active=false,$jsvoid,$includes=true;
 
    public function run() {
        $this->render($this->view,array('menuArr'=>$this->menus,'item'=>$this->menus,'level'=>1,'lang'=>$this->Lang,'jsvoid'=>$this->jsvoid));
    }

	public function crawlformenu($menuArr,$level,$jsvoid){
        return $this->render($this->view,array('menuArr'=>$menuArr,'level'=>$level,'lang'=>$this->Lang,'jsvoid'=>$jsvoid),true);
	}
}
?>
