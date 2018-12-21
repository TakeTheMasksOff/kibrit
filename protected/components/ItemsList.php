<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class ItemsList extends CWidget {
 
    public $menus = array();
    public $Lang;
    public $wrapTag='div', $wrapHtmlOptions=array('class'=>'items-container');
    public $itemWrapTag='div',$itemWrapHtmlOptions = array('class'=>'col-sm-4 col-md-3 col-lg-2');
    public $gridSizes = array('xs'=>12,'sm'=>4,'md'=>3,'lg'=>2);
    public $items = array();
    public $hover=1;
    public function run() {
        $this->Lang = Yii::app()->controller->Lang;
        if ($this->hover){
            if (!isset($this->itemWrapHtmlOptions['class']))
                $this->itemWrapHtmlOptions['class'] = '';
            $this->itemWrapHtmlOptions['class'] = $this->itemWrapHtmlOptions['class'] .' needhover';
        }
        $this->render('ItemsListView',array('lang'=>$this->Lang));
    }
}
?>
