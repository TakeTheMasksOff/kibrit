<li class='<?php echo ($item->keyword == strtolower(Yii::app()->controller->action->id)?'active ':'');?>'>

  <?php// if ($item->keyword == 'services'):?>
      <?php //echo CHtml::link( $item->getTranslation($this->Lang)->name, "#");?>
  <?php// else:?>
      <?php echo CHtml::link( $item->getTranslation($this->Lang)->name,
               $item->getTranslation($this->Lang)->getLink($this->Lang,$item->id));?>
  <?php// endif;?>

  <ul class="subMenu">
    <?php if ($item->keyword === 'blog'): ?>
    <?php
    $output = array();
    $output['parent'] = $this->active = Menus::model()->findByAttributes(array('keyword'=> $item->keyword));

    $crit = new CDbCriteria();
    $crit->with = array(
        'parent'=>array(
            'together'=>true,
            'with'=>array(
                'getparent'=>array(
                    'together'=>true,
                    'with'=>array(
                        'getparent'=>array(
                            'alias'=>'getparent2',
                            'together'=>true,
                            'with'=>array(
                                'getparent'=>array(
                                    'alias'=>'getparent3',
                                    'together'=>true
                                )
                            )
                        )
                    )
                )
            )
        )
    );
    $parent = $output['parent']->id;

    $crit->addCondition("t.parent_id=$parent or parent.parent_id=$parent or getparent.parent_id=$parent or getparent2.parent_id=$parent",'AND');

    $crit->compare('t.parent_id',$output['model']->parent_id);
    $output['news'] = Articles::Model()->with()->articles()->active()->findAll($crit);

    $blogs = $output['news'];
    foreach( $blogs as $row )
    {
        $element = Articles::model()->cache(3600)->with(array('translations'=>array('alias'=>'translations', 'together'=>true)))->findByPk($row->id);
        $article = Cleanurls::getUrlOrSave($element,$element->getTranslation($this->Lang)->name?$element->getTranslation($this->Lang)->name:'',$this->Lang);
        $item_n = $row->getTranslation($this->Lang)->name;
          ?>
        <li><?php echo CHtml::link( $item_n ,Yii::app()->controller->createUrl('site/blog', array('article'=>$article,'language'=>$this->Lang)));?>
        </li>
    <?php } ?>
    <?php endif;?>


    <?php foreach($item->activeChildren as $child):?>
       <?php $item_name = $child->getTranslation($this->Lang)->name;?>
        <?php if (strpos($item->getTranslation($this->Lang)->getLink($this->Lang,$item->id), 'products') || 
                  strpos($item->getTranslation($this->Lang)->getLink($this->Lang,$item->id), 'works') ||
                  strpos($item->getTranslation($this->Lang)->getLink($this->Lang,$item->id), 'services') ):?>

                <?php if ($child->getContentTranslation($this->Lang)->body!=""):?>
                  <li class='<?php echo (strtolower($child->keyword) == strtolower(Yii::app()->controller->action->id)?'active ':'')?>'>
                    <?php echo CHtml::link( $item_name,
                          $item->getTranslation($this->Lang)->getLink($this->Lang,$item->id)."#!".$child->getTranslation($this->Lang)->getLink($this->Lang,$item->id));?>
                  </li>
                <?php endif;?> 

            <?php elseif ($item_name!='' && $child->keyword!=''): ?>
              <li class='<?php echo (strtolower($child->keyword) == strtolower(Yii::app()->controller->action->id)?'active ':'')?>'>
              <?php echo CHtml::link( $item_name ,
                    $child->getTranslation($this->Lang)->getLink($this->Lang,$item->id));?>
              </li>
            <?php endif;?> 
    <?php endforeach;?>
  </ul>
</li>