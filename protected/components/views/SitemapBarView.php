<?php $controller = Yii::app()->controller;?>
<nav id="" class="navbar pull-left" role="navigation">
    <ul class="sitemap">
        <?php $i=0;?>
        <?php foreach($menuArr as $item):?>
            <?php if ($item->keyword !='highlight4'):?>
                <?php  $this->widget('application.components.SitemapBar',array('Lang'=>$controller->Lang,'view'=>'SitemapItemWidgetView','menus'=>$item,'level'=>$this->level-1));?>
            <?php endif;?>
        <?php endforeach;?>
    </ul>
<div class="clearfix"></div>
</nav>

