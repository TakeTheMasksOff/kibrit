<?php $controller = Yii::app()->controller;?>
<nav id="cssmenu" class="navbar" role="navigation">
    <ul>
        <?php $i=0;?>
        <?php foreach($menuArr as $item):?>
            <?php if ($item->keyword !='catalogue-insert-menu'):?>
                <?php  $this->widget('application.components.MenuBar',array('Lang'=>$controller->Lang,'view'=>'MenuItemWidgetView','menus'=>$item,'level'=>$this->level-1));?>
            <?php else:?>
                <?php 
                    $categories = Category::model()->with()->findAll(array('condition'=>'t.active=1 and t.deleted=0 and t.parent_id=-1'));
                    foreach($categories as $category){
                         $this->widget('application.components.MenuBar',array('Lang'=>$controller->Lang,'view'=>'MenuItemWidgetView','menus'=>$category,'level'=>$this->level-1));
                        echo $this->render('MenuItemWidgetView',array('language'=>$controller->Lang,'item'=>$category,'i'=>$i++));
                    }
                ?>
            <?php endif;?>
        <?php endforeach;?>
    </ul>
<div class="clearfix"></div>
</nav>
