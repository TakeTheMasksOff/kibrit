<?php $this->pageTitle = array($model->getContentTranslation($this->Lang)->name);?>
<?php
    $this->breadcrumbs = array(
        (string) $model->getTranslation($this->Lang)->name,
    );
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkRnJl0N4PafPZwZydn-pOCmSZikd5vq8"
    type="text/javascript"></script>
<?php $str=<<<JAVASCRIPT

      var myCenter=new google.maps.LatLng(40.40045, 49.86418);
      function initialize() {
        var mapCanvas = document.getElementById('map-canvas');
        var mapOptions = {
          center: myCenter,
          zoom: 12,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var marker = new google.maps.Marker({
          position: myCenter,
          map: map,
          icon:  '/assets/images/gmap-marker.png'
        });

        var infowindow = new google.maps.InfoWindow({
            content:"<b>Premium Plaza</b> <br /> 106, Yahya Bakuvi street, Baku, Azerbaijan, AZ1072"
        });

        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
        });
$(".map-canvas").prepend('<a href="javascript:void(0)" class="closebtn" onclick="closeGmapBlock()"><i class="icon-close" aria-hidden="true"></i></a>');
      }
      google.maps.event.addDomListener(window, 'load', initialize);
JAVASCRIPT;
    Yii::app()->clientscript->registerScript('contactspageScript',$str,  CClientScript::POS_READY);
?>


<div class="main">
    <div class="container-fluid">
        <div class="row title-block">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-8 col-lg-8">
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
        <div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-6 col-lg-6">

                <br />

                <?php if (Yii::app()->user->hasFlash('contactform-error')):?>
                <div class="alert alert-danger">
                    <?php echo Yii::app()->user->getFlash('contactform-error');?>
                </div>
                <?php endif;?>

                <?php if (!Yii::app()->user->hasFlash('contactform-success')):?>
                <form method="post"
                    action='<?php echo $this->createUrl('site/contacts',array('language'=>$this->Lang));?>'>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <?php echo CHtml::activeTextField($formModel, 'name',array('class'=>'form-control','placeholder'=>Yii::t('frontend.strings','Name')));?>
                            <?php // echo CHtml::error($formModel, 'name');?>
                        </div>
                        <div class="col-md-4">
                            <?php echo CHtml::activeTextField($formModel, 'email',array('class'=>'form-control','placeholder'=>Yii::t('frontend.strings','Email')));?>
                            <?php // echo CHtml::error($formModel, 'name');?>
                        </div>
                        <div class="col-md-4">
                            <?php echo CHtml::activeTextField($formModel, 'phone',array('class'=>'form-control','placeholder'=>Yii::t('frontend.strings','Phone')));?>
                            <?php // echo CHtml::error($formModel, 'name');?>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <?php echo CHtml::activeTextArea($formModel, 'message',array('class'=>'form-control', 'rows'=>9, 'placeholder'=>Yii::t('frontend.strings','Message')));?>
                            <?php // echo CHtml::error($formModel, 'body');?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="submit" class="outlined-btn contactFormSubmit" onclick="DisableButton(this);"
                                style="border: solid 2px #fe9901;">
                                <?php echo Yii::t('frontend.strings','Send');?>
                            </button>
                        </div>
                    </div>
                </form>
                <?php else:?>
                <div class="alert alert-success">
                    <?php echo Yii::app()->user->getFlash('contactform-success');?>
                </div>

                <?php endif;?>
                <div class="clearfix"></div>


            </div>
            <div class="col-md-2 col-lg-2 bottom-padding contacts-page <?=$this->Lang?>">
                <br>
                <div itemscope itemtype="http://schema.org/Organization">
                    <span itemprop="name"><?=Yii::app()->controller->getSetting('company_name')?></span>
                    <span itemprop="telephone"><?=Yii::app()->controller->getSetting('phone_number')?></span>
                    <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                        <span itemprop="streetAddress"><?=Yii::t('frontend.strings','streetAddress');?></span>
                        <span itemprop="postalCode"><?=Yii::app()->controller->getSetting('postal_code')?></span>
                        <span itemprop="addressLocality"><?=Yii::t('frontend.strings','addressLocality');?></span>
                    </div>
                </div>
                <br>
                <a class="link" href="javascript:void(0)"
                    onclick="openGmapBlock()"><?php echo Yii::t('frontend.strings','Show on map');?></a>

            </div>
            <div class="col-md-2 col-lg-2"></div>
        </div>
    </div>
</div>

<div class="overlay map-canvas" id="map-canvas"> </div>