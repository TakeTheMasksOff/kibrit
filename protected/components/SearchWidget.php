<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class SearchWidget extends CWidget {
 
    public $menus = array();
    public $Lang;
    public $wrapTag='div', $wrapHtmlOptions=array('class'=>'news-container');
    public $itemWrapTag='div',$itemWrapHtmlOptions = array('class'=>'news-block');
    public $items = array();
    public function run() {
        $this->Lang = Yii::app()->controller->Lang;
        $this->render('SearchWidgetView',array('lang'=>$this->Lang));
    }
}
?>
