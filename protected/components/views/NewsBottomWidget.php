<?php $controller = Yii::app()->controller;?>
<div class="widget news-widget">
        <div class="widget-header">
                <div class="widget-caption">
                    <hr>
                    <div class="widget-title"><h2><?php echo Utilities::t('WHAT\'S NEW');?></h2></div>
                    <div class="widget-controls">
                        <div class="widget-controls-prev pull-left">
                            <a class="" href="<?php echo $controller->createUrl('site/getNews',array('language'=>$controller->Lang));?>"><?php echo Utilities::t('Previous news');?></a>
                        </div>
                        <div class="widget-controls-next pull-right">
                            <a class="" href="<?php echo $controller->createUrl('site/getNews',array('language'=>$controller->Lang));?>"><?php echo Utilities::t('Next news');?></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
        </div>
        <div class="widget-body">
                <?php $this->widget('application.components.NewsList',array(
                            'items'=>$this->items,
                            'Lang'=>$controller->Lang,

                        ));
                ?>
        </div>
</div>
