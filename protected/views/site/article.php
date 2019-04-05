<?php $this->pageTitle = $model->getTranslation($this->Lang)->name." - Kibrit";?>
<?php
    $this->breadcrumbs = array(
        (string) $parentcrumb->getTranslation($this->Lang)->name => $this->createUrl($this->Lang.'/blog/'.$parentcrumb->id),
        (string) $model->parent->getTranslation($this->Lang)->name => $this->createUrl('site/'.$model->parent->keyword,array('language'=>$this->Lang)),
        (string) $model->getTranslation($this->Lang)->name,
    );
?>
<div class="sharethis-sticky-share-buttons centered-vertical" ></div>
<div class="main" style="background-position: 50% 0px;">
    <div class="container-fluid mb80">
        <div class="row title-block">
            <div class="col-0 col-md-2 col-lg-2"></div>
            <div class="col-12 col-md-8 col-lg-8">
                <div class="title">
                    <div class="page-name"><?php echo $model->parent->getTranslation($this->Lang)->name; ?></div>
                    <hr class="orange" />
                </div>

                <div class="pull-right d-none d-md-block">
                    <div id="breadCrumb">
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
                </div>
            </div>
            <div class="col-0 col-md-2 col-lg-2"></div>
        </div>

        <div class='row'>
            <div class="col-0 col-md-2 col-lg-2"></div>
            <div class="col-12 col-md-8 col-lg-8 news-widget news-details">
                <div class="news-content bg-color-light-blue">
                    <div class="news-image float-md-right">
                        <?php echo CHtml::link(CHtml::image( $model->getPhotoItem(0)->getPath() , '',array('class'=>'img-responsive thumb'), Yii::app()->controller->createUrl('site/blog', array('id'=>$model->id,'language'=>$this->Lang))));?>
                    </div>
                    <h1><?php echo $model->getTranslation($this->Lang)->name;?></h1>
                    <div class="article-date color-orange mb20">
                        <?php echo date('d.m.Y',strtotime($model->date));?>
                    </div>
                    <div class="col-md-9 nopa">
                        <?php if (count($model->photos)>1):?>
                        <?php $haystack = $model->getTranslation($this->Lang)->body;?>
                        <?php $carousel = "<div class='mt20 gallerycontainer'>".$this->widget('GalleryCarouselWidget',array('items'=>$model->photos(array('offset'=>2,'limit'=>10000,'pagination'=>false))),true)."</div>";?>
                        <?php 
                                    $carouselUsed =0;
                                    if (mb_strstr($haystack, '{carousel}')){
                                    $haystack = mb_str_replace('{carousel}', $carousel, $haystack);
                                    $carouselUsed =1;
                                    }
                                ?>
                        <?php echo $haystack;?>
                        <?php echo (!$carouselUsed?$carousel:'');?>
                        <?php else:?>
                        <?php echo $model->getContentTranslation($this->Lang)->body;?>
                        <div class="clearfix"></div>
                        <?php endif;?>
                    </div>

                    <div class='clearfix'></div>

                    <!-- <?php 
                        $this->widget('application.extensions.fb-comment.FBComment', array(
                        'url' => 'http://kibrit.tech'.Yii::app()->request->getUrl(), // required site url
                        'posts' => 20, // optional no. of posts (default: 10)
                        'width' => 600 // optional width of comment box (default: 470)
                    ))?> -->
                </div>
                <br />
                <div class="pull-left">
                    <div class="back-to">
                        <?php echo CHtml::link('<img src="/assets/images/arrow-left.png" alt="">'.Utilities::t('Back to Blog'), $this->createUrl($model->parent->getTranslation($this->Lang)->link));?>
                    </div>
                </div>
                <br><br>
            </div>
            <div class="col-0 col-md-2 col-lg-2"></div>
        </div>


    </div>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">
    <span class="close" style="opacity:1">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>

<?php 
$js = <<<JS
      // Get the modal
      var modal = document.getElementById('myModal');

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks on <span> (x), close the modal
      span.onclick = function() { 
          modal.style.display = "none";
      }
            var link = window.location.href;
            var urlPath = link.split("/");
            $("link[hreflang=az]").attr("href", "http://kibrit.tech/az/blog/"+urlPath[5]);
            $("link[hreflang=en]").attr("href", "http://kibrit.tech/en/blog/"+urlPath[5]);
            $("link[hreflang=ru]").attr("href", "http://kibrit.tech/ru/blog/"+urlPath[5]);
JS;
 Yii::app()->clientscript->registerScript('codyhouse',$js,  CClientScript::POS_READY);
?>