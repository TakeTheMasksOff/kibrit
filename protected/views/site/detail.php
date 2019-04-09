<script type="text/javascript" defer
    src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js">
</script>
<?php $this->pageTitle = $model->getTranslation($this->Lang)->name." - Kibrit";?>
<?php
    $this->breadcrumbs = array(
        (string) $parentcrumb->getTranslation($this->Lang)->name => $this->createUrl($this->Lang.'/products/'.$parentcrumb->id),
        (string) $model->parent->getTranslation($this->Lang)->name => $this->createUrl($model->parent->getTranslation($this->Lang)->link),
        (string) $model->getTranslation($this->Lang)->name,
    );
?>
<div class="sharethis-sticky-share-buttons centered-vertical" ></div>
<div class='main'>
    <div class="container-fluid assets-block">
        <div class="row justify-content-center title-block mx-md-3">
            <div class="col-md-9 col-lg-12">
                <div class="title">
                    <h1><?php echo $model->parent->getTranslation($this->Lang)->name;?></h1>
                    <hr class="orange d-none d-md-block" />
                    <div class="d-block d-md-none">
                        <div class="back-to">
                            <?php echo CHtml::link('<img src="/assets/images/arrow-left.png" alt=""><div class="line"></div>', $this->createUrl($model->parent->getTranslation($this->Lang)->link));?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class='row mt-4 justify-content-center mx-md-3'>
            <div class="col-12 col-md-3 col-lg-4 d-none d-md-block">
                <p class="mr-lg-5">
                <?php echo $model->parent->getContentTranslation($this->Lang)->body;?></p>
                <div class="pull-left">
                    <div class="back-to">
                        <?php echo CHtml::link('<img src="/assets/images/arrow-left.png" alt="">'.Utilities::t('Back to Blog'), $this->createUrl($model->parent->getTranslation($this->Lang)->link));?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-8" id="outer">

            </div>
        </div>
    </div>

    <div class="rightBlock">
        <div class="container">
            <div class="content-block" class="mb20">
                <div id="breadCrumb" class="pull-left d-none d-md-block">
                    <?php if(isset($this->breadcrumbs)):?>
                    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links'=>$this->breadcrumbs,
                        'tagName'   =>'ol itemscope itemtype="http://schema.org/BreadcrumbList"', // container tag
                        'htmlOptions' =>array(), // no attributes on container
                        'separator'=>'  <li><span class="delimeter"></span></li>',
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
                <h1><?php echo $model->getTranslation($this->Lang)->name;?></h1>
                <?php echo $model->getContentTranslation($this->Lang)->body;?>

                <?php if($model->parent->keyword !== "portfolio"): ?>
                    <?php if($detail === 'call-center-management-system'): ?>
                    <form action="http://orangeline.az/index_en.html#demo" target="_blank">
                        <button type="submit" class="outlined-btn full"><?php echo Yii::t("frontend.strings","Request demo");?></button><br /><br />
                    </form>  
                    <?php endif;?>

                    <?php if(!$_GET['utm']): ?>
                        <button class="outlined-btn full hideEl request-presentation"><?php echo Yii::t("frontend.strings","Request presentation");?></button>
                    <?php endif;?>
                <div 
                    <?php if(!$_GET['utm']): ?>
                    class="hideEl" style="display: none"
                    <?php endif;?>
                >
                    <?php if (Yii::app()->user->hasFlash('contactform-error')):?>
                    <div class="alert alert-danger">
                        <?php echo Yii::app()->user->getFlash('contactform-error');?>
                    </div>
                    <?php endif;?>

                    <?php if (!Yii::app()->user->hasFlash('contactform-success')):?>
                    <?php $detail = Cleanurls::getUrlOrSave($model,$model->getTranslation($this->Lang)->name?$model->getTranslation($this->Lang)->name:'',$this->Lang);?>
                    <form method="post" class="requestForm"
                        action='<?php echo $this->createUrl('site/products/',array('language'=>$this->Lang,'detail'=>$detail, 'utm'=>$detail));?>'>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <?php echo CHtml::activeTextField($formModel, 'name',array('class'=>'form-control','placeholder'=>Yii::t('frontend.strings','Name')));?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <?php echo CHtml::activeTextField($formModel, 'organization',array('class'=>'form-control','placeholder'=>Yii::t('frontend.strings','Organization')));?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <?php echo CHtml::activeTextField($formModel, 'phone',array('class'=>'form-control','placeholder'=>Yii::t('frontend.strings','Phone')));?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <?php echo CHtml::activeTextField($formModel, 'email',array('class'=>'form-control','placeholder'=>Yii::t('frontend.strings','Email')));?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="outlined-btn RequestPresentationForm"
                                    style="border: solid 2px #E44850;">
                                    <?php echo Yii::t('frontend.strings','Send');?>
                                </button>
                            </div>
                        </div>
                        <input class="form-control" name="RequestPresentationForm[productName]"
                            id="RequestPresentationForm_productName" type="hidden" value="<?php echo $model->getTranslation($this->Lang)->name;?>">
                    </form>
                    <?php else:?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('contactform-success');?>
                    </div>

                    <?php endif;?>
                </div>
                
                <?php endif;?>
            </div>
        </div>
    </div>
</div>



<?php
$js=<<<JS
    $(".owl-carousel").owlCarousel({
      margin: 10,
      responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
    });
JS;
Yii::app()->clientscript->registerScript('clientsCarousel',$js,  CClientScript::POS_LOAD);
?>