<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class FilterNSearch extends CWidget {
 
    public $Lang='az';
    public $update='.right-content-region .items-wrap';
    public $category_id = '';
    public function run() {
        $this->render('FiltersView',array('lang'=>$this->Lang));
    }
}
?>
