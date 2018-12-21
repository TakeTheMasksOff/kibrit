<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class CompareWidget extends CWidget {
 
    public $menus = array();
    public $Lang;
    public $wrapTag='', $wrapHtmlOptions=array('class'=>'compare-container');
    public $itemWrapTag='div',$itemWrapHtmlOptions = array('class'=>'item-block');
    public $items = array();
    public $hover=1;
    public function run() {
        $this->Lang = Yii::app()->controller->Lang;
        $crit = new CDbCriteria();
        $crit->addInCondition('id',  array_values($this->items));
        $this->items = Items::model()->with()->findAll($crit);
        $str = <<<JAVASCRIPT
        $('.removeFromCompare a').on('click',function(e){
            e.preventDefault();
            $.ajax({
                url:$(this).attr('href'),
                context:this
            }).done(function(data){
                $(this).parents('.item-block').remove();
                //window.location.reload();
                if ($('.compare-widget-left .item-block').length==0) 
                    $('.compare-widget-left').remove();
            });
        });
JAVASCRIPT;
                
        Yii::app()->clientscript->registerScript('removeCompare',$str,CClientScript::POS_READY);
        $this->render('compareWidgetView',array('lang'=>$this->Lang));
    }
}
?>
