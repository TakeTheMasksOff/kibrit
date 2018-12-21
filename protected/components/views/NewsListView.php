<?php $controller = Yii::app()->controller;?>
<?php echo ($this->wrapTag?CHtml::tag($this->wrapTag,$this->wrapHtmlOptions,false,false):'');?>
            <?php foreach($this->items as $item):?>
                    <?php echo ($this->itemWrapTag?CHtml::tag($this->itemWrapTag,$this->itemWrapHtmlOptions,false,false):'');?>
                        <div class="news-block-inner">
<!--                             <div class="news-image pull-left">
                                <?php // echo CHtml::link(CHtml::image( (Yii::app()->controller->id=='site' && Yii::app()->controller->action->id=='index') ? $item->getPhotoItem(0)->getPath('blogthumb') : $item->getPhotoItem(0)->getPath('blogthumbdetail') , '',array('class'=>'img-responsive thumb')), $controller->createUrl('site/blog', array('id'=>$item->id,'language'=>$this->Lang)));?>

                                <?php //if ($this->category_block):?>
                                    <div class="news-category <?php // echo $item->parent?Utilities::str2url($item->parent->keyword):'';?>">
                                            <?php // echo CHtml::link(Utilities::uppercase($item->parent->getTranslation($controller->Lang)->name),$controller->createUrl('site/news',array('language'=>$controller->Lang,'id'=>$item->parent->id)));?>
                                    </div>
                                <?php //endif;?>
                            </div> -->
                            <div class="news-info">
                                    <div class="news-topic">
                                        <?php $article = Cleanurls::getUrlOrSave($item,$item->getTranslation($lang)->name?$item->getTranslation($lang)->name:'',$lang);?>
                                        <?php echo CHtml::link(($item->getTranslation($this->Lang)->name), $controller->createUrl('site/blog', array('article'=>$article,'language'=>$this->Lang)));?>
                                    </div>

                                    <div class="news-date pull-left">
                                        <?php 
                                            $formatter = Yii::app()->getDateFormatter();
                                            $format = Yii::app()->getLocale()->getDateFormat('medium'); // use built-in
                                            $format = (Yii::app()->controller->id=='site' && Yii::app()->controller->action->id=='index') ? 'd MMMM, y' : 'd.M.y';
                                             echo $formatter->format($format, $item->date);?>
                                    </div>
                                    <br />

                                    <div class="news-summary">
                                        <p><?php echo ($item->getTranslation($this->Lang)->summary);?></p>
                                    </div>

                                    <div class="news-fbottom">
                                        <div class="pull-left">
                                        <?php $article = Cleanurls::getUrlOrSave($item,$item->getTranslation($lang)->name?$item->getTranslation($lang)->name:'',$lang);?>
                                            <?php echo CHtml::link(Utilities::t('READ MORE').'<svg class="icon-angle-right small"><use xlink:href="#icon-angle-right"></use></svg>',$controller->createUrl('site/blog',array('language'=>$controller->Lang,'article'=>$article)),array('class'=>'green_col '.($this->readMore?'':'only')));?>
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
/*
$js = <<<JS

$('.js-masonry').imagesLoaded(function(){
    $('.js-masonry').masonry();
});
        
JS;
 Yii::app()->clientscript->registerScript('masonryInit',$js,  CClientScript::POS_READY);
 */
?>

