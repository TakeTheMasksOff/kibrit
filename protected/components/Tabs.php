<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Tabs extends CWidget {
 
    public $items = array();
    public $Lang='az';
    public $models=null;
    public $category = null;
    public $update='.right-content-region .items-wrap';
    public $ajaxParams = array('itemWrapHtmlOptions'=>array('class'=>'col-sm-3'));
    public $view = 'frontPage';
    public function run() {
        if (!$this->models)
            $this->models = Brands::model()->with(array('itemsCount'=>array('together'=>true)))->findAllByAttributes(array(),array('order'=>'t.sort asc'));
	$this->ajaxParams = CJSON::encode($this->ajaxParams);
        $this->render('Tabs',array('items'=>$this->items));
    }
 
}
?>
