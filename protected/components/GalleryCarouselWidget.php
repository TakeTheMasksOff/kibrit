<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class GalleryCarouselWidget extends CWidget {
 
    public $items = array();
    public $Lang='az';
    public $containerHtmlOptions=array('class'=>' insiderview-carousel');
    public function run() {
        if (!isset($this->containerHtmlOptions['id']))
            $this->containerHtmlOptions['id'] = 'carousel_'.(isset($this->items[0])?$this->items[0]->type.$this->items[0]->parent_id:rand());
        if (count($this->items)>1){
            $js = <<<JS
 
                 $("#galleryCarousel{$this->id}").owlCarousel({
                    navigation : true, // Show next and prev buttons
                    singleItem:true
                     
                });
 
JS;
            Yii::app()->clientscript->registerScript('galleryCarouselJS'.$this->id,$js,  CClientScript::POS_READY);
            $this->render('GalleryCarouselView',array('lang'=>$this->Lang));
        }
    }
}
?>
