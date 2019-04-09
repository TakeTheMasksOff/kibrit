<?php $controller = Yii::app()->controller;?>
<?php $this->pageTitle = array($model->getContentTranslation($this->Lang)->name);?>
<?php
    $this->breadcrumbs = array(
        (string) $model->getTranslation($this->Lang)->name,
    );
?>
<div class="sharethis-sticky-share-buttons centered-vertical" ></div>
<div
    class='main <?php if (Yii::app()->controller->id=='site' && Yii::app()->controller->action->id=='philosophy'):?>philosophy<?php endif;?>'>

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
                            'separator'=>'<li><span class="delimeter"></span></li>',
                            'homeLink'    =>'<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                             <a class="text-white" itemprop="item" href="/"><span itemprop="name">Kibrit</span></a>
                                             <meta itemprop="position" content="1" /></li>', // home link template
                            'activeLinkTemplate'  =>'<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                                     <a class="text-white" itemprop="item" href="{url}"><span itemprop="name">{label}</span></a></li>', //active link template
                            'inactiveLinkTemplate'  =>'<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="selected"><a class="text-white" itemprop="item" > <span itemprop="name">{label}</span></a></li>', // in-active link template
                        )); ?>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>

        <div class='row mt-4 justify-content-center mx-md-3'>
            <div class="col-12 col-md-3 col-lg-4 d-none d-md-block">
                <!-- Sidebar -->
                <div class="mr-lg-5" id="sidebar-wrapper">
                    <ul class="sidebar-nav">
                        <?php foreach($model->articles(array('order'=>'articles.sort asc','scopes'=>array('active'))) as $item):?>
                        <li>
                            <?php $detail = Cleanurls::getUrlOrSave($item,$item->getTranslation($this->Lang)->name?$item->getTranslation($this->Lang)->name:'',$this->Lang);?>
                            <?php echo CHtml::link(  $item->getTranslation($this->Lang)->name, $controller->createUrl('site/services',array('language'=>$controller->Lang,'detail'=>$detail)));?>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <!-- /#sidebar-wrapper -->
            </div>
            <div class="col-12 col-md-6 col-lg-8" id="outer">

                <?php echo $model->getContentTranslation($this->Lang)->body;?>

            </div>
        </div>
    </div>

</div>

