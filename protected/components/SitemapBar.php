<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class SitemapBar extends CWidget {
 
    public $menus = array();
    public $view = 'SitemapBarView';
    public $Lang='az';
	public $level=2,$active=false,$jsvoid,$includes=true;
 
    public function run() {
		// if ($this->includes){
		// 	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/assets/javascripts/jqueryslidemenu.js');
		// 	Yii::app()->clientScript->registerCSSFile(Yii::app()->baseUrl.'/assets/css/jqueryslidemenu.css');
		// }
        $this->render($this->view,array('menuArr'=>$this->menus,'item'=>$this->menus,'level'=>2,'lang'=>$this->Lang,'jsvoid'=>$this->jsvoid));
    }
	public function crawlformenu($menuArr,$level,$jsvoid){
        return $this->render($this->view,array('menuArr'=>$menuArr,'level'=>$level,'lang'=>$this->Lang,'jsvoid'=>$jsvoid),true);
	
	}
}
?>
