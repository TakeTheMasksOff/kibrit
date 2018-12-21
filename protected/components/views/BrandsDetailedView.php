<?php $controller = Yii::app()->controller;?>
<?php echo ($this->wrapTag?CHtml::tag($this->wrapTag,$this->wrapHtmlOptions,false,false):'');?>
    <?php foreach($this->items as $item):?>
            <?php echo ($this->itemWrapTag?CHtml::tag($this->itemWrapTag,$this->itemWrapHtmlOptions,false,false):'');?>
                <div class="brands-block-inner">
                    <div class="brands-image col-sm-4">
                        <div class="brands-image-inner">
                            <?php echo (CHtml::image('/uploads/brands/'.$item->logo, '',array('class'=>'img-responsive')));?>
                        </div>
                    </div>
                    <?php if ($item->getTranslation($this->Lang)->body!=''):?>
                        <div class="brands-info col-sm-8">
                            <div class="brands-summary">
                                <?php echo $item->getTranslation($this->Lang)->summary;?>
                            </div>
                            <div>
                                <?php echo CHtml::link(Utilities::uppercase(Utilities::t('READ MORE')),$controller->createUrl('site/brand',array('language'=>$controller->Lang,'id'=>$item->id)),array('class'=>'btn btn-black '.($this->readMore?'':'only')));?>
                            </div>
                        </div>
                    <?php endif;?>
                    <div class="clearfix"></div>
                </div>
            <?php echo ($this->itemWrapTag?CHtml::closeTag($this->itemWrapTag):'');?>
    <?php endforeach;?>
    <div class="clearfix"></div>
<?php echo ($this->wrapTag?CHtml::closeTag($this->wrapTag):'');?>
