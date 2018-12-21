<?php $controller = Yii::app()->controller;?>
<?php echo ($this->wrapTag?CHtml::tag($this->wrapTag,$this->wrapHtmlOptions,false,false):'');?>
            <?php $i=1; foreach($this->items as $item):?>
                    <?php echo ($this->itemWrapTag?CHtml::tag($this->itemWrapTag,$this->itemWrapHtmlOptions,false,false):'');?>
                            <div class="remove removeFromCompare">
                                    <a href="<?php echo $controller->createAbsoluteUrl('private/removeFromCompare',array('id'=>$item->id,'language'=>$lang));?>"><img src="/assets/images/filter-close.png" width=16 alt=""></a>
                            </div>
                            <div class="col-xs-3 image">
                                            <?php echo CHtml::link(CHtml::image($item->getPhotoItem(0)->getPath('compareSidebar'),$item->name,array('class'=>'img-responsive')), 
                                                        $controller->createAbsoluteUrl('site/item',array('id'=>$item->id,'language'=>$lang)));?>
                            </div>
                            <div class="col-xs-9 info">
                                    <div class="brand">
                                            <?php echo $item->brand?CHtml::link($item->brand->name, $controller->createAbsoluteUrl('site/brand',array('id'=>$item->brands_id,'language'=>$lang))):'';?>                                    
                                    </div> 
                                    <div class="model">
                                            <?php echo CHtml::link($item->name, $controller->createAbsoluteUrl('site/item',array('id'=>$item->id,'language'=>$lang)));?>
                                    </div>
                            </div>
                            <div class="clearfix"></div>

                    <?php echo ($this->itemWrapTag?CHtml::closeTag($this->itemWrapTag):'');?>
            <?php $i++; endforeach;?>
            <div class="filter-submit mb30">
                    <?php echo CHtml::link(Yii::t('frontend.strings','Compare'),$controller->createUrl('private/compare',array('language'=>$controller->Lang)),array('class'=>'btn btn-warning col-xs-12'));?>
                    <?php echo CHtml::link(Yii::t('frontend.strings','Reset Compare'),$controller->createUrl('private/resetCompare',array('language'=>$controller->Lang)),array('class'=>'reset-compare btn '));?>
                    <div class="clearfix"></div>
            </div>
<?php echo ($this->wrapTag?CHtml::closeTag($this->wrapTag):'');?>
