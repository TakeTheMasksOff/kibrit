<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class NewsList extends CWidget {
 
    public $menus = array();
    public $Lang;
    public $pagination;
    public $wrapTag='div', 
            $wrapHtmlOptions=array('class'=>'news-container',
//                                    'data-masonry-options'=>'{  "itemSelector": ".news-block","columnWidth": ".news-block" }'
                );
    public $itemWrapTag='div',$itemWrapHtmlOptions = array('class'=>'news-block');
    public $items = array();
    public $category_block = true;
    public $view='NewsListView';
    public $readMore = true;
    public function run() {
        $this->Lang = Yii::app()->controller->Lang;
        if (!$this->items) 
            $this->items = array();
        $this->render($this->view,array('lang'=>$this->Lang));
    }
}
?>
