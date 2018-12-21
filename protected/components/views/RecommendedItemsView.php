<div class="accessories-container">
            <?php foreach($this->items as $item):?>
                    <li class="col col-md-4 col-lg-3 col-sm-6 col-xs-12">
                            <div class="row">
                                <h4><?php echo $item->name;?></h4>
                            </div>
                            <div class="discount">
                                50%
                            </div>
                            <div class="row">
                                <?php echo CHtml::link(Yii::t('frontend.strings','Add to compare'), Yii::app()->controller->createUrl('site/add2Compare',array('id'=>$item->id,'language'=>$lang)));?> -
                                <?php echo CHtml::link(Yii::t('frontend.strings','Details'), Yii::app()->controller->createUrl('site/item',array('id'=>$item->id,'language'=>$lang)));?>
                            </div>
                            <div class="row picture"><img src="<?=$item->getPhoto(0);?>" alt="" class="img-responsive"></div>
                            <div class="row">
                                <div class="price">
                                    <span><?php echo $item->price;?></span><img src="/assets/images/azn-grey.png">
                                        <a href="javascript:addtoCart(<?=$item->id;?>,$(this))" class="cartButton pull-right ">
                                                КУПИТЬ
                                        </a>
                                </div>
                            </div>
                    </li>
            <?php endforeach;?>
</div>