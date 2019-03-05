<?php $this->pageTitle = array($model->getContentTranslation($this->Lang)->name);?>
<?php
    $this->breadcrumbs = array(
        (string) $model->getTranslation($this->Lang)->name,
    );
?>
<div class='main'>

    <div class="container-fluid assets-block">
        <div class="row justify-content-center title-block mx-md-3">
            <div class="col-md-9 col-lg-12">
                <div class="title">
                    <h1><?php echo Utilities::uppercase($model->getTranslation($this->Lang)->name);?></h1>
                    <hr class="orange" />
                </div>
                <div class="pull-right d-none d-md-block">
                    <div id="breadCrumb">
                        <?php if(isset($this->breadcrumbs)):?>
                        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                            'links'=>$this->breadcrumbs,
                            'tagName'   =>'ol itemscope itemtype="http://schema.org/BreadcrumbList"', // container tag
                            'htmlOptions' =>array(), // no attributes on container
                            'separator'=>' <li><span class="delimeter"></span></li>',
                            'homeLink'    =>'<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                             <a class="text-white" itemprop="item" href="/"><span itemprop="name">Kibrit</span></a>
                                             <meta itemprop="position" content="1" /></li>', // home link template
                            'activeLinkTemplate'  =>'<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                                     <a class="text-white" itemprop="item" href="{url}"><span itemprop="name">{label}</span></a></li>', //active link template
                            'inactiveLinkTemplate'  =>'<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="selected"><a itemprop="item" > <span itemprop="name">{label}</span></a></li>', // in-active link template
                        )); ?>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>

        <div class='row mt-4 justify-content-center mx-md-3'>
            <div class="col-md-3 col-lg-4">
                <p class="mr-lg-5"><?php echo $model->getContentTranslation($this->Lang)->body;?></p>
            </div>
            <div class="col-md-6 col-lg-8" id="outer">
                <div class="row justify-content-end bbq-link mb-5">
                    <?php if (count($sidebar)):?>
                    <?php $i=1;foreach($sidebar as $menu):?>
                    <div class="col-12 col-md-9 col-lg-6 thumb bbq-nav bbq-nav-top works <?php echo $i%2?'':'third';?>">

                        <?php if ($menu->getContentTranslation($this->Lang)->body!=""):?>

                        <?php echo CHtml::ajaxLink( ' <img src="'.$menu->getCoverPhoto()->getPath().'" alt="'.trim($menu->getTranslation($this->Lang)->name)." ".Utilities::t("developedBy").'" title="'.$menu->getTranslation($this->Lang)->name.'" class="img-responsive w-100">', 
                                array($this->Lang.'/works'),
                                array(
                                    'type' => 'GET',
                                    'data'=>array('keyword'=> $menu->getTranslation($this->Lang)->getLink($this->Lang,$menu->id)),
                                    'success' => '
                                        function(html){
                                        $("#content-block").html(html);
                                        history.pushState(null,null,"'.Yii::app()->createUrl($this->Lang."/works#!".$menu->getTranslation($this->Lang)->getLink($this->Lang,$menu->id)).'");
                                        changeMetaTags( window.location.href,
                                        "'.htmlspecialchars($menu->getContentTranslation($this->Lang)->summary)." - ".Utilities::t("developedBy"). '",
                                        "'.$menu->getContentTranslation($this->Lang)->description.'"
                                        );
                                    }',
                                    ),
                                array(
                                    'class'=>'showRightBlock '.$menu->getTranslation($this->Lang)->getLink($this->Lang,$menu->id),
                                    'href' => Yii::app()->createUrl($this->Lang."/works#!".$menu->getTranslation($this->Lang)->getLink($this->Lang,$menu->id))
                                    )
                                );?>

                        <?php echo CHtml::ajaxLink( Utilities::t('Read more'), 
                                array($this->Lang.'/works'),
                                array(
                                    'type' => 'GET',
                                    'data'=>array('keyword'=> $menu->getTranslation($this->Lang)->getLink($this->Lang,$menu->id)),
                                    'success' => '
                                        function(html){
                                        $("#content-block").html(html);
                                        history.pushState(null,null,"'.Yii::app()->createUrl($this->Lang."/works#!".$menu->getTranslation($this->Lang)->getLink($this->Lang,$menu->id)).'");

                                        changeMetaTags( window.location.href,
                                        "'.htmlspecialchars($menu->getContentTranslation($this->Lang)->summary)." - ".Utilities::t("developedBy"). '",
                                        "'.$menu->getContentTranslation($this->Lang)->description.'"
                                        );
                                    }',
                                    ),
                                array(
                                    'class'=>'showRightBlock read_more '.$menu->getTranslation($this->Lang)->getLink($this->Lang,$menu->id),
                                    'href' => Yii::app()->createUrl($this->Lang."/works#!".$menu->getTranslation($this->Lang)->getLink($this->Lang,$menu->id))
                                    )
                                );?>

                        <?php else:?>
                        <img src="<?php echo $menu->getCoverPhoto()->getPath()?>"
                            alt="<?php echo trim($menu->getTranslation($this->Lang)->name);?> - Kibrit"
                            title="<?php echo $menu->getTranslation($this->Lang)->name?>" class="img-responsive w-100">
                        <?php endif;?>

                        <div class="summary">
                            <?php echo Utilities::uppercase($menu->getTranslation($this->Lang)->name) ?></div>
                        <p><?php echo $menu->getContentTranslation($this->Lang)->summary?></p>

                    </div>
                    <?php if (!($i%2)):?>
                    <div class="clearfix"></div>
                    <?php endif;?>
                    <?php $i++;endforeach;?>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="rightBlock" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeRightBlock()"><i class="icon-close"
            aria-hidden="true"></i></a>
    <div class="info-content">
        <div id="content-block" class="mb20">
            <?php $this->renderPartial('_works', array(
                      'blockContent' => $blockContent,
                  ))?>
        </div>

    </div>
</div>