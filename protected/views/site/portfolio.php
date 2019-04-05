<?php $controller = Yii::app()->controller;?>
<?php $this->pageTitle = array($model->getContentTranslation($this->Lang)->name);?>
<?php
    $this->breadcrumbs = array(
        (string) $model->getTranslation($this->Lang)->name,
    );
?>
<div class="sharethis-sticky-share-buttons centered-vertical" ></div>
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
            <div class="col-12 col-md-3 col-lg-4 d-none d-md-block">
                <p class="mr-lg-5"><?php echo $model->getContentTranslation($this->Lang)->body;?></p>
            </div>
            <div class="col-12 col-md-6 col-lg-8" id="outer">
                <div class="row justify-content-end bbq-link mb-5">
                <?php $i=1;foreach($model->articles(array('order'=>'articles.sort asc','scopes'=>array('active'))) as $item):?>
                    <div class="col-12 col-md-9 col-lg-6 thumb bbq-nav bbq-nav-top works <?php echo $i%2?'':'third';?>">
                        <div class="client-info">
                        <?php if ($item->getContentTranslation($this->Lang)->body!=""):?>
                        <?php $detail = Cleanurls::getUrlOrSave($item,$item->getTranslation($this->Lang)->name?$item->getTranslation($this->Lang)->name:'',$this->Lang);?>

                        <?php echo CHtml::link(' <img src="'.$item->getPhoto(0).'" alt="'.trim($item->getTranslation($this->Lang)->name)." ".Utilities::t("developedBy").'" title="'.$item->getTranslation($this->Lang)->name.'" class="img-responsive w-100">', 
                        $controller->createUrl('site/portfolio',array('language'=>$controller->Lang,'detail'=>$detail)));?>
                        <?php echo CHtml::link(Utilities::t('Read more'), '', array('class'=>'read_more', 'href'=>$controller->createUrl('site/portfolio',array('language'=>$controller->Lang,'detail'=>$detail))));?>


                        <?php else:?>
                        <img src="<?php echo $item->getPhoto(0)?>"
                            alt="<?php echo trim($item->getTranslation($this->Lang)->name);?> - Kibrit"
                            title="<?php echo $item->getTranslation($this->Lang)->name?>" class="img-responsive w-100">
                        <?php endif;?>

                        <div class="summary"><?php echo Utilities::uppercase($item->getTranslation($this->Lang)->summary) ?></div>
                        </div>
                        <p class="servise-name"><?php echo $item->getContentTranslation($this->Lang)->name?></p>

                    </div>
                    <?php if (!($i%2)):?>
                    <div class="clearfix"></div>
                    <?php endif;?>
                    <?php $i++;endforeach;?>
                </div>
            </div>
        </div>
    </div>

</div>

