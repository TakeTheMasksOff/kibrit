<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class BlogList extends CWidget {
 
    public $menus = array();
    public $Lang='az';
    public $wrapTag='ul', $wrapHtmlOptions=array('class'=>'items');
    public $itemWrapTag='div',$itemWrapHtmlOptions = array('class'=>'article col-sm-6 col-md-4 col-lg-3');
    public $items = array();
    public function run() {
        $this->render('BlogListView',array('lang'=>$this->Lang));
    }
}
?>
