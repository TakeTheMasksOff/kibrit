<?php $this->pageTitle = $model->getTranslation($this->Lang)->name." - Kibrit";?>
<?php
    $this->breadcrumbs = array(
        (string) $parentcrumb->getTranslation($this->Lang)->name => $this->createUrl($this->Lang.'/blog/'.$parentcrumb->id),
        (string) $model->parent->getTranslation($this->Lang)->name => $this->createUrl('site/blog',array('language'=>$this->Lang)),
        (string) $model->getTranslation($this->Lang)->name,
    );
?>


<div class="main" style="background-position: 50% 0px;">
    <div class="container-fluid ">
        <div class="row title-block">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-8 col-lg-8" style="background: #071F7A;">
                <div class="title">
                    <h1><strong><?php echo $model->getTranslation($this->Lang)->name;?></strong></h1>
                    <hr class="green" />
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
            <div class="col-md-2 col-lg-2"></div>
        </div>

        <div class='row'>
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-6 col-lg-6 news-widget" id="outer" style="padding-bottom:100px;  background: #071F7A;">
                <div class="article-date mb10">
                    <?php echo date('d.m.Y',strtotime($model->date));?>
                </div>
                <div class="">
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
                <div class="socnet-tools">
                    <hr>

                    <!-- 
                          <div class="addthis_toolbox addthis_default_style addthis_32x32_style"> 
                            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> 
                            <a class="addthis_button_tweet"></a>
                            <a class="addthis_button_google_plusone"></a>
                          </div> -->

                    <hr>
                </div>

                <div class="pull-left">
                    <div class="extralink mb40">
                        <?php echo CHtml::link(Utilities::t('BACK TO'), $this->createUrl($this->Lang.'/blog/'.$parentcrumb->id));?>
                    </div>
                </div>
                <br><br>
                <?php 
                            $this->widget('application.extensions.fb-comment.FBComment', array(
                              'url' => 'http://kibrit.tech'.Yii::app()->request->getUrl(), // required site url
                              'posts' => 20, // optional no. of posts (default: 10)
                              'width' => 600 // optional width of comment box (default: 470)
                            ));
                        ?>
            </div>
            <div class="col-md-2 col-lg-2 bottom-padding" style="background: #071F7A;">
                <div class="filter-block">
                    <?php// $langs = array();$controller = Yii::app()->controller; $tmp = $_GET; ?>
                    <ul>
                        <?php/* foreach($parent->activeChildren as $child):?>
                        <li class="valued">
                            <?php echo CHtml::link($child->getTranslation($this->Lang)->name,$this->createUrl($this->Lang.'/blog/'.$child->id));?>
                        </li>
                        <?php endforeach;*/?>
                    </ul>
                </div>
                <br>
                <div class="subscribe-widget">
                    <div class="widget-inner">
                        <?php
                                $this->widget('ext.mailchimpform.MailchimpForm', 
                                array('apiKey' => '474dad8dacfec2186dcba224265d9b60-us17', 
                                      'listId' => '5c025b0279',
                                      'showName' => false));?>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-2 col-lg-2"></div>
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
            console.log(window.location.href);
            $("link[hreflang=az]").attr("href", "http://kibrit.tech/az/blog/"+urlPath[5]);
            $("link[hreflang=en]").attr("href", "http://kibrit.tech/en/blog/"+urlPath[5]);
            $("link[hreflang=ru]").attr("href", "http://kibrit.tech/ru/blog/"+urlPath[5]);
JS;
 Yii::app()->clientscript->registerScript('codyhouse',$js,  CClientScript::POS_READY);
?>