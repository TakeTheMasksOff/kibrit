<?php $controller = Yii::app()->controller;?>
<?php echo ($this->wrapTag?CHtml::tag($this->wrapTag,$this->wrapHtmlOptions,false,false):'');?>
            <?php $i=1; foreach($this->items as $item):?>
                    <?php echo ($this->itemWrapTag?CHtml::tag($this->itemWrapTag,$this->itemWrapHtmlOptions,false,false):'');?>
                    <div class="item-block grey-border">
                            <div class="item-header">
                                    <div class="item-brand">
                                            <?php echo $item->brand->name; //CHtml::link($item->brand->name, '#');?>
                                            <?php //echo CHtml::link($item->brand->name, $controller->createAbsoluteUrl('site/brand',array('id'=>$item->brands_id,'language'=>$lang,'url'=>  Utilities::str2url($item->brand->name))));?>
                                    </div>
                                    <div class="item-title">
                                            <?php echo CHtml::link($item->name, $controller->createAbsoluteUrl('site/item',array('id'=>$item->id,'language'=>$lang,'url'=>$item->getCleanurl($lang)->url,'category'=>  Utilities::str2url($item->category?$item->category->getTranslation($lang)->name:''),'brand'=>  Utilities::str2url($item->brand->name))));?>
                                    </div>
                            </div>
                            <div class="item-body">
                                    <div class="item-image">
                                            <?php echo CHtml::link(CHtml::image($item->getPhotoItem(0)->getPath('list'),$item->name,array('class'=>'img-responsive')), 
                                                        $controller->createAbsoluteUrl('site/item',array('id'=>$item->id,'language'=>$lang,'url'=>$item->getCleanurl($lang)->url,'category'=>  Utilities::str2url($item->category?$item->category->getTranslation($lang)->name:''),'brand'=>  Utilities::str2url($item->brand->name))));?>
                                    </div>
                                    <div class="item-price">
                                            <span><?php echo $item->price;?></span><img class="currency" src="/assets/images/azn-grey.png" alt="">
                                            <img class="zoom pull-right" src="/assets/images/zoom-grey-lg.png">
                                    </div>
                                    <?php if ($this->hover):?>
                                        <div class="item-specs">
                                                <ul>
                                                    <?php 
                                                        $paramsArr = array();
                                                        /*foreach($item->paramset as $param){
                                                            $paramsArr[$param->fieldset_id] = $param;
                                                        }*/
                                                        $groups = array();
                                                        foreach($item->category->fields as $field){
                                                            if ($field->group)
                                                                $groups[] = $field;
                                                        }
                                                        //print_r($groups);
                                                    ?>
                                                    <?php foreach($groups as $group):?>
                                                        <?php if(strpos($group->name,'Preview specs',0)!==false):?>
                                                            <?php foreach($group->children as $field):?>
                                                                <?php if (isset($field->value[$item->id]) &&  $field->value[$item->id]->value):?>
                                                                    <li><span><?php echo $field->value[$item->id]->value;?></span></li>
                                                                <?php endif;?>
                                                            <?php endforeach;?>
                                                        <?php endif;?>
                                                    <?php endforeach;?>
                                                </ul>
                                        </div>
                                    <?php endif;?>
                            </div>
                            <div class="item-footer">
                                    <ul>
                                            <li><?php echo CHtml::link(Yii::t('frontend.strings','Details'), $controller->createAbsoluteUrl('site/item',array('id'=>$item->id,'language'=>$lang,'url'=>$item->getCleanurl($lang)->url,'category'=>  Utilities::str2url($item->category?$item->category->getTranslation($lang)->name:''),'brand'=>  Utilities::str2url($item->brand->name))));?></li>
                                            <?php if (isset(Yii::app()->session['compare']) && count(Yii::app()->session['compare']) && in_array($item->id, Yii::app()->session['compare'])):?>
                                                <li><?php echo CHtml::link(Yii::t('frontend.strings','Go to compare')." (".count(Yii::app()->session['compare']).')', $controller->createAbsoluteUrl('private/compare',array('language'=>$lang)),array('class'=>''));?></li>
                                            <?php else:?>
                                                <li><?php echo CHtml::link(Yii::t('frontend.strings','Add to compare'), $controller->createAbsoluteUrl('private/add2compare',array('id'=>$item->id,'language'=>$lang,'url'=>$item->getCleanurl($lang)->url,'category'=>  Utilities::str2url($item->category?$item->category->getTranslation($lang)->name:''),'brand'=>  Utilities::str2url($item->brand->name))),array('class'=>'add2compare'));?></li>
                                            <?php endif;?>
                                    </ul>
                            </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php echo ($this->itemWrapTag?CHtml::closeTag($this->itemWrapTag):'');?>
                    <?php if ($this->gridSizes!=12 && $i%$this->gridSizes['xs']==0):?>
                        <div class="clearfix visible-xs-block"></div>
                    <?php endif;?>
                    <?php if ($i%(Yii::app()->controller->gridColumnSize/$this->gridSizes['sm'])==0):?>
                        <div class="clearfix visible-sm-block"></div>
                    <?php endif;?>
                    <?php if ($i%(Yii::app()->controller->gridColumnSize/$this->gridSizes['md'])==0):?>
                        <div class="clearfix visible-md-block"></div>
                    <?php endif;?>
                    <?php if ($i%(Yii::app()->controller->gridColumnSize/$this->gridSizes['lg'])==0):?>
                        <div class="clearfix visible-lg-block"></div>
                    <?php endif;?>
            <?php $i++; endforeach;?>
            <span class="clearfix"></span>
<?php echo ($this->wrapTag?CHtml::closeTag($this->wrapTag):'');?>
