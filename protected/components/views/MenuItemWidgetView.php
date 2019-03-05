<li
    class='d-none d-md-block <?php echo ($item->keyword == strtolower(Yii::app()->controller->action->id)?'active ':'').($item->hasAttribute('keyword')?$item->keyword:($item->hasAttribute('name')?$item->name:'')).' '.($item->keyword == 'company'?'has-sub':'');?>'>
    <?php if ($item->keyword == 'company'):?>
    <?php echo CHtml::link( $item->getTranslation($this->Lang)->name, "#");?>
    <?php else:?>
    <?php echo CHtml::link( $item->getTranslation($this->Lang)->name,
                $item->getTranslation($this->Lang)->getLink($this->Lang,$item->id));?>
    <?php endif;?>

    <?php if ($item->hasActiveChildren && $item->keyword == 'company'):?>
    <ul>
        <?php foreach($item->activeChildren as $child):?>
        <?php $item_name = $child->getTranslation($this->Lang)->name;?>
        <?php if ($item_name!='' && $child->keyword!=''):?>
        <li
            class='<?php echo (strtolower($child->keyword) == strtolower(Yii::app()->controller->action->id)?'active ':'')?>'>
            <?php echo CHtml::link( $item_name,
                $child->getTranslation($this->Lang)->getLink($this->Lang,$item->id));?>
        </li>
        <?php endif;?>
        <?php endforeach;?>
    </ul>
    <?php endif;?>
</li>


<li
    class='d-md-none <?php echo ($item->keyword == strtolower(Yii::app()->controller->action->id)?'active ':'').($item->hasAttribute('keyword')?$item->keyword:($item->hasAttribute('name')?$item->name:'')).' '.($item->keyword == 'company' || $item->keyword == 'services'?'has-sub':'');?>'>
    <?php if ($item->keyword == 'company' || $item->keyword == 'services' ):?>
    <?php echo CHtml::link( $item->getTranslation($this->Lang)->name, "#");?>
    <?php else:?>
    <?php echo CHtml::link( $item->getTranslation($this->Lang)->name,
                $item->getTranslation($this->Lang)->getLink($this->Lang,$item->id));?>
    <?php endif;?>

    <?php if ($item->hasActiveChildren && ($item->keyword == 'company' || $item->keyword == 'services')):?>
    <ul>
        <?php foreach($item->activeChildren as $child):?>
        <?php $item_name = $child->getTranslation($this->Lang)->name;?>
        <?php if ($item_name!='' && $child->keyword!=''):?>
        <li
            class='<?php echo (strtolower($child->keyword) == strtolower(Yii::app()->controller->action->id)?'active ':'')?>'>


            <?php echo CHtml::link( $item_name ,
            Yii::app()->controller->createUrl($item->keyword == 'services' ? 'site/services#!'.$child->getTranslation($this->Lang)->getLink($this->Lang,$item->id) : 
            $child->getTranslation($this->Lang)->getLink($this->Lang,$item->id)), array('language'=>$this->Lang));?>

        </li>
        <?php endif;?>
        <?php endforeach;?>
    </ul>

    <?php endif;?>
</li>