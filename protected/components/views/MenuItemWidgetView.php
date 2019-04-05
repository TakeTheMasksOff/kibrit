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

    <?php if ($item->hasActiveChildren && ($item->keyword == 'company')):?>
    <ul>
        <?php foreach($item->activeChildren as $child):?>
        <?php $item_name = $child->getTranslation($this->Lang)->name;?>
        <?php if ($item_name!='' && $child->keyword!=''):?>
        <li
            class='<?php echo (strtolower($child->keyword) == strtolower(Yii::app()->controller->action->id)?'active ':'')?>'>
            <?php echo CHtml::link( $item_name ,
            Yii::app()->controller->createUrl($item->keyword == 'services' ? $this->Lang.'/services/'.$child->getTranslation($this->Lang)->getLink($this->Lang,$item->id) : 
            $child->getTranslation($this->Lang)->getLink($this->Lang,$item->id)), array('language'=>$this->Lang));?>

        </li>
        <?php endif;?>
        <?php endforeach;?>
    </ul>
    <?php endif;?>

    <?php if ($item->keyword == 'services'):?>
    <ul>
        <?php $output['model'] = $this->active = Menus::model()->findByAttributes(array('keyword'=>'services'));?>
        <?php foreach($output['model']->articles(array('order'=>'articles.sort asc','scopes'=>array('active'))) as $element):?>
        <li>
            <?php $detail = Cleanurls::getUrlOrSave($element,$element->getTranslation($this->Lang)->name?$element->getTranslation($this->Lang)->name:'',$this->Lang);?>
            <?php echo CHtml::link(  $element->getTranslation($this->Lang)->name, Yii::app()->controller->createUrl('site/services',array('language'=>Yii::app()->controller->Lang,'detail'=>$detail)));?>
        </li>
        <?php endforeach;?>
    </ul>
    <?php endif;?>
</li>