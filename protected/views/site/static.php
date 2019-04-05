<?php $this->pageTitle = array($model->getContentTranslation($this->Lang)->name);?>
<?php
    $this->breadcrumbs = array(
        (string) $model->getTranslation($this->Lang)->name,
    );
?>

<div class='main <?php if ($this->route === 'site/philosophy'):?>philosophy<?php endif;?>'>
    <div class="container-fluid">
        <div class="row title-block">
            <div class="col-md-2 col-lg-2"></div>
            <?php if ($this->route === 'site/history'):?>
            <div class="col-md-6 col-lg-6">
                <?php else: ?>
                <div class="col-md-8 col-lg-8"><?php endif;?>
                    <div class="title">
                        <h1><?php echo Utilities::uppercase($model->getTranslation($this->Lang)->name);?></h1>
                        <hr class="green" />
                    </div>

                    <div class="pull-right d-none d-md-block">
                        <div id="breadCrumb">
                            <?php if(isset($this->breadcrumbs)):?>
                            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                            'links'=>$this->breadcrumbs,
                            'tagName'   =>'ol itemscope itemtype="http://schema.org/BreadcrumbList"', // container tag
                            'htmlOptions' =>array(), 
                            'separator'=>' <li><span class="delimeter"></span></li>',
                            'homeLink'    =>'<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                             <a class="text-white" itemprop="item" href="/"><span itemprop="name">Kibrit</span></a>
                                             <meta itemprop="position" content="1" /></li></li>', // home link template
                            'activeLinkTemplate'  =>'<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                                     <a class="text-white" itemprop="item" href="{url}"><span itemprop="name">{label}</span></a>
                                                     <meta itemprop="position" content="{itemcount}" /></li>', //active link template
                            'inactiveLinkTemplate'  =>'<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="selected"><a itemprop="item" > <span itemprop="name">{label}</span></a>
                                        <meta itemprop="position" content="{itemcount}" /></li>', // in-active link template
                        )); ?>
                            <?php endif;?>
                        </div>
                    </div>

                </div>
                <div class="col-md-2 col-lg-2"></div>
            </div>

            <div class='row'>
                <div class="col-md-2 col-lg-2 order-1"></div>
                <div class="col-md-2 col-lg-2 order-md-3 text-md-right">
                    <?php echo ($model->getContentTranslation($this->Lang)->summary!='')?$model->getContentTranslation($this->Lang)->summary : '';?>
                </div>
                <div class="col-md-6 col-lg-6 order-md-2 content bottom-padding" id="outer">
                    <?php echo $model->getContentTranslation($this->Lang)->body;?>
                </div>
                <div class="col-md-2 col-lg-2 order-4"></div>
            </div>
        </div>
    </div>
    <footer class="text-center">
        <div class="nav pull-left d-none d-md-block">
            <ul>
                <?php if (count($sidebar)):?>
                <?php foreach($sidebar as $menu):?>
                <li
                    class='<?php echo (strtolower($menu->keyword) == strtolower(Yii::app()->controller->action->id)?'active':'')?>'>
                    <?php echo CHtml::link( Utilities::uppercase($menu->getTranslation($this->Lang)->name), $menu->getTranslation($this->Lang)->getLink($this->Lang,$menu->id));?>
                </li>
                <?php endforeach;?>
                <?php endif;?>
            </ul>
        </div>
        <span class="dwn-profile float-none float-md-right"><i class="icon-pdf fa-lg"></i><a
                href="/files/Kibrit_Profile_<?php echo $this->Lang; ?>.pdf" target="_blank">
                <?php echo (Utilities::t('Download "Company profile"'));?></a></span>
    </footer>
</div>