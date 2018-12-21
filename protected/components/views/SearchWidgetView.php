<?php $controller = Yii::app()->controller;?>
<?php echo ($this->wrapTag?CHtml::tag($this->wrapTag,$this->wrapHtmlOptions,false,false):'');?>
            <?php foreach($this->items as $item):?>
                    <?php echo ($this->itemWrapTag?CHtml::tag($this->itemWrapTag,$this->itemWrapHtmlOptions,false,false):'');?>
                            <div class="news-image col-sm-3 col-md-2 col-lg-2">
                                    <?php echo CHtml::link(CHtml::image('/site/uploads/articles/newsthumb/'.$item->getPhotoItem(0)->pic_name, '',array('class'=>'img-responsive')), $controller->createUrl('site/news', array('id'=>$item->id,'language'=>$this->Lang)));?>
                            </div>
                            <div class="news-info col-sm-9 col-md-10 col-lg-10">
                                    <div class="news-date">
                                        <?php echo $item->getTranslation($this->Lang)->name;?>
                                    </div>
                                    <div class="news-summary">
                                        <?php echo CHtml::link($item->getTranslation($this->Lang)->summary, $controller->createUrl('site/article', array('id'=>$item->id,'language'=>$this->Lang)));?>
                                    </div>
                            </div>
                            <div class="clearfix"></div>
                    <?php echo ($this->itemWrapTag?CHtml::closeTag($this->itemWrapTag):'');?>
            <?php endforeach;?>
            <div class="clearfix"></div>
<?php echo ($this->wrapTag?CHtml::closeTag($this->wrapTag):'');?>
