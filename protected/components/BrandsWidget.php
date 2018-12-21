<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class BrandsWidget extends CWidget {
 
    public $items = array();
    public $Lang;
    public $wrapTag='div', 
            $wrapHtmlOptions=array('class'=>'brands-container');
    public $itemWrapTag='div',$itemWrapHtmlOptions = array('class'=>'brands-block col-sm-4  ');
    public $view='Grid';
    public $readMore = true;
    public function run() {
        $this->Lang = Yii::app()->controller->Lang;
        $this->itemWrapHtmlOptions['class']= 'brands-block '.strtolower(($this->view!='Grid'?'BrandsDetailedView col-sm-12':'BrandsGridView col-sm-4').'');
        $this->render('Brands'.($this->view!='Grid'?'Detailed':'Grid').'View',array('lang'=>$this->Lang));
    }
}
?>
