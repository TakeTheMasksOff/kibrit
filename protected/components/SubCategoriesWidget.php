<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class SubCategoriesWidget extends CWidget {
 
    public $items = array();
    public $Lang='az';
    public $category = null;
    public $update='.right-content-region .items-wrap';
    public $ajaxParams = array('itemWrapHtmlOptions'=>array('class'=>'col-sm-3'));
    public $view = 'frontPage';
    public $action = 'site/extras';
    public $allLink = 0;
    public $active = 0;
    public function run() {
	$this->ajaxParams = CJSON::encode($this->ajaxParams);
        $this->render('SubCategoriesWidgetView',array('items'=>$this->items));
    }
 
}
?>
