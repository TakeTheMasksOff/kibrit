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
                    <span><?php echo Utilities::uppercase($model->getTranslation($this->Lang)->name);?></span>
                    <hr class="orange" />
                </div>
                <div class="pull-right">
                    <div id="breadCrumb">
                        <?php if(isset($this->breadcrumbs)):?>
                        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                            'links'=>$this->breadcrumbs,
                            'tagName'   =>'ol itemscope itemtype="http://schema.org/BreadcrumbList"', // container tag
                            'htmlOptions' =>array(), // no attributes on container
                            'separator'=>' <li><svg class="icon-angle-right"><use xlink:href="#icon-angle-right"></use></svg> </li>',
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
                <!-- Sidebar -->
                <div class="mr-lg-5" id="sidebar-wrapper">
                    <ul class="sidebar-nav">
                        <?php if (count($sidebar)):?>
                        <?php foreach($sidebar as $menu):?>
                        <li>
                            <?php echo CHtml::ajaxLink( $menu->getTranslation($this->Lang)->name, 
                              array($this->Lang.'/services'),
                              array(
                                  'type' => 'GET',
                                  'data'=>array('keyword'=> $menu->getTranslation($this->Lang)->getLink($this->Lang,$menu->id)),
                                  'success' => '
                                     function(html){
                                     $("#content-block").html(html);
                                     history.pushState(null,null,"'.Yii::app()->createUrl($this->Lang."/services#!".$menu->getTranslation($this->Lang)->getLink($this->Lang,$menu->id)).'");
                                     changeMetaTags( window.location.href,
                                                    "'.ucwords($menu->getContentTranslation($this->Lang)->name).'",
                                                    "'.$menu->getContentTranslation($this->Lang)->description.'"
                                                   );

                                                   
                                   }',
                                ),
                              array(
                                'class'=>'showRightBlock '.$menu->getTranslation($this->Lang)->getLink($this->Lang,$menu->id),
                                'href' => Yii::app()->createUrl($this->Lang."/services#!".$menu->getTranslation($this->Lang)->getLink($this->Lang,$menu->id))
                                )
                              );?>
                        </li>
                        <?php endforeach;?>
                        <?php endif;?>
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


<div id="rightBlock" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeRightBlock()"><i class="icon-close"
            aria-hidden="true"></i></a>
    <div class="info-content">
        <div id="content-block" class="mb20">
            <?php $this->renderPartial('_services', array(
                    'blockContent' => $blockContent,
                ))?>
        </div>
        <div class="hideEl" style="display: none">
            <?php if (Yii::app()->user->hasFlash('contactform-error')):?>
            <div class="alert alert-danger">
                <?php echo Yii::app()->user->getFlash('contactform-error');?>
            </div>
            <?php endif;?>

            <?php if (!Yii::app()->user->hasFlash('contactform-success')):?>
            <form method="post" class="requestForm"
                action='<?php echo $this->createUrl('site/products',array('language'=>$this->Lang));?>'>
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
                    id="RequestPresentationForm_productName" type="hidden" value="">
            </form>
            <?php else:?>
            <div class="alert alert-success">
                <?php echo Yii::app()->user->getFlash('contactform-success');?>
            </div>

            <?php endif;?>
        </div>
    </div>
</div>