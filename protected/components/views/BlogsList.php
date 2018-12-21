<?php $controller = Yii::app()->controller;?>
<?php echo ($this->wrapTag?CHtml::tag($this->wrapTag,$this->wrapHtmlOptions,false,false):'');?>
            <?php foreach($this->items as $item):?>
                    <?php echo ($this->itemWrapTag?CHtml::tag($this->itemWrapTag,$this->itemWrapHtmlOptions,false,false):'');?>
                        <div class="blog-block-inner">
                            <div class="blog-image pull-left">
                                <?php echo CHtml::link(CHtml::image($item->getPhotoItem(0)->getPath('blogWidget'), '',array('class'=>'img-responsive')), $controller->createUrl('site/blog', array('id'=>$item->id,'language'=>$this->Lang)));?>
                            </div>
                            <div class="blog-info pull-left">
                                    <div class="blog-caption">
                                        <?php echo CHtml::link(($item->getTranslation($this->Lang)->name), $controller->createUrl('site/blog', array('id'=>$item->id,'language'=>$this->Lang)));?>
                                    </div>
                                    <div class="blog-fbottom">
                                        <div class="blog-date pull-left">
                                            <?php echo date('d.m.Y',  strtotime($item->date));?>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    <?php echo ($this->itemWrapTag?CHtml::closeTag($this->itemWrapTag):'');?>
            <?php endforeach;?>
            <div class="clearfix"></div>
<?php echo ($this->wrapTag?CHtml::closeTag($this->wrapTag):'');?>
<?php 
$js = <<<JS

$('.js-masonry').imagesLoaded(function(){
    $('.js-masonry').masonry();
});
        
JS;
 Yii::app()->clientscript->registerScript('masonryInit',$js,  CClientScript::POS_READY);
?>

