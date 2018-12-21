<?php $controller = Yii::app()->controller;?>
<?php if ($this->nav):?>
    <div class="brands_abc col-xs-6 col-xs-offset-3 mb20">
        <?php foreach(range('A','Z') as $i):?>
        <div class="brand-letter <?php echo array_key_exists($i, $tmp)?'active':'passive';?>">
                <?php echo CHtml::link($i, '#brand_letter_'.$i);?>
            </div>
        <?php endforeach;?>
    </div>
    <div class="clearfix"></div>
<?php endif;?>
<div class="col-sm-10 col-sm-offset-1">
    <?php foreach($tmp as $key=>$models):?>
        <a name="brand_letter_<?php echo $key;?>"></a>
        <div class="backline">
            <div class="text">
                <?php echo $key;?>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="category-brands">
            <?php foreach($models as $model):?>
                <div class="brand-cell col-xs-6 col-md-3">
                    <?php if ($model->brand->getTranslation($controller->Lang)->body!=''):?>
                        <?php echo CHtml::link($model->brand->name,$controller->createUrl('site/brand',array('language'=>$this->Lang,'id'=>$model->brands_id,'category'=>$model->category_id)));?>
                    <?php else:?>
                        <span><?php echo $model->brand->name;?></span>
                    <?php endif;?>
                </div>
            <?php endforeach;?>
        </div>
        <div class="clearfix"></div>
    <?php endforeach;?>
</div>
<div class="clearfix"></div>
