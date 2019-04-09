<?php $controller = Yii::app()->controller;?>

<?php echo ($this->wrapTag?CHtml::tag($this->wrapTag,$this->wrapHtmlOptions,false,false):'');?>
            <?php foreach($this->items as $item):?>
                    <?php echo ($this->itemWrapTag?CHtml::tag($this->itemWrapTag,$this->itemWrapHtmlOptions,false,false):'');?>
                        <div class="news-block-inner">
                            <div class="news-image float-left">
                                <?php $detail = Cleanurls::getUrlOrSave($item,$item->getTranslation($lang)->name?$item->getTranslation($lang)->name:'',$lang);?>
                                <?php echo CHtml::link(CHtml::image( (Yii::app()->controller->id=='site' && Yii::app()->controller->action->id=='index') ? $item->getPhotoItem(0)->getPath('blogthumb') : $item->getPhotoItem(0)->getPath('blogthumbdetail') , '',array('class'=>'img-responsive thumb')), $controller->createUrl('site/'.$item->parent->keyword, array('detail'=>$detail,'language'=>$this->Lang)));?>
                            </div>
                            <div class="news-info">
                                    <div class="news-topic">
                                        <?php echo CHtml::link(($item->getTranslation($this->Lang)->name), $controller->createUrl('site/'.$item->parent->keyword, array('detail'=>$detail,'language'=>$this->Lang)));?>
                                    </div>

                                    <div class="news-date color-orange float-md-right">
                                        <?php 
                                            $formatter = Yii::app()->getDateFormatter();
                                            $format = Yii::app()->getLocale()->getDateFormat('medium'); // use built-in
                                            $format = (Yii::app()->controller->id=='site' && Yii::app()->controller->action->id=='index') ? 'd MMMM, y' : 'd.M.y';
                                             echo $formatter->format($format, $item->date);?>
                                    </div>

                                    <div class="news-summary">
                                        <p><?php echo ($item->getTranslation($this->Lang)->summary);?></p>
                                    </div>

                                    <div class="news-fbottom">
                                        <div class="readMore">
                                        <?php $detail = Cleanurls::getUrlOrSave($item,$item->getTranslation($lang)->name?$item->getTranslation($lang)->name:'',$lang);?>
                                            <?php echo CHtml::link(Utilities::t('READ MORE').'<img src="/assets/images/arrow-right.png" alt="">',$controller->createUrl('site/'.$item->parent->keyword,array('language'=>$controller->Lang,'detail'=>$detail)),array('class'=>'color-orange '.($this->readMore?'':'only')));?>
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

