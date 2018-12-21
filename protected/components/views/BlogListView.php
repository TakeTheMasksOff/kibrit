            <?php foreach($this->items as $item):?>
                    <?php echo ($this->itemWrapTag?CHtml::tag($this->itemWrapTag,$this->itemWrapHtmlOptions,false,false):'');?>
                            <a href="<?php echo Yii::app()->controller->createUrl('site/blog',array('id'=>$item->id,'language'=>Yii::app()->controller->Lang));?>">
                                <img src="/site/uploads/articles/blogs/<?php echo $item->getPhotoItem(0)->pic_name;?>" alt="">
                            </a>
                            <h6>
                                <a href="<?php echo Yii::app()->controller->createUrl('site/blog',array('id'=>$item->id,'language'=>Yii::app()->controller->Lang));?>">
                                    <?php echo $item->getTranslation(Yii::app()->controller->Lang)->name;?>
                                </a>
                            </h6>
                            <div class="teaser">
                                <?php echo $item->getTranslation(Yii::app()->controller->Lang)->summary;?>
                            </div>
                    <?php echo ($this->itemWrapTag?CHtml::closeTag($this->itemWrapTag):'');?>
            <?php endforeach;?>
