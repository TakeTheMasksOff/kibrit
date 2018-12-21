<?php $this->pageTitle = array($parent?($parent->getTranslation($this->Lang)->name):(Utilities::t('News & Events'))," Kibrit Company");?> 
<?php
    $this->breadcrumbs = array(
        (string) $parent->getTranslation($this->Lang)->name,
    );
    $this->pageDescription = $parent->getContentTranslation($this->Lang)->description;
?>



<div class="main" style="background-position: 50% 0px;">
<div class="container-fluid ">
      <div class="row title-block">
          <div class="col-md-2 col-lg-2"></div>
          <div class="col-md-8 col-lg-8" style="background: #071F7A;">
              <div class="title">
                    <h1><?php echo $parent->getTranslation($this->Lang)->name;?></h1>
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
                                             <a itemprop="item" href="/"><span itemprop="name">Kibrit</span></a>
                                             <meta itemprop="position" content="1" /></li></li>', // home link template
                            'activeLinkTemplate'  =>'<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                                     <a itemprop="item" href="{url}"><span itemprop="name">{label}</span></a>
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
          <div class="col-md-6 col-lg-6 news-widget" id="outer" style="padding-bottom:80px; ">
                <?php
                    $this->widget('application.components.NewsList',array(
                        'items'=>$news,
                        'wrapHtmlOptions'=>array('class'=>'news-container'),
                        'itemWrapHtmlOptions'=>array('class'=>'news-block mb40'),
                        'category_block'=>false,
                        'Lang'=>$this->Lang,
                    ));
                ?>
                <br />

                <div class="clearfix"></div>
                <? $this->widget('CLinkPager', array(
                    'internalPageCssClass' => '',
                    'pages' => $pagination, //$paginator определен в контроллере
                    'id' => '',
                    'header' => '',
                    'maxButtonCount' => 10,
                    'nextPageLabel' => Utilities::t('Next page').' <svg class="icon-angle-right"><use xlink:href="#icon-angle-right"></use></svg>',
                    'prevPageLabel' => '<svg class="icon-angle-left"><use xlink:href="#icon-angle-left"></use></svg> '.Utilities::t('Previous page'),
                    'selectedPageCssClass' => 'active',
                    'hiddenPageCssClass' => 'disabled',
                    'lastPageLabel' => '&raquo;&raquo;',  // »»
                    'firstPageLabel' => '&laquo;&laquo;', // ««
                    'htmlOptions' => array('class' => 'pagenav'),
                ));?> 
          </div>
          <div class="col-md-2 col-lg-2 bottom-padding" style="background: #071F7A;">
                    <div class="filter-block">
                        <?php //$langs = array();$controller = Yii::app()->controller; $tmp = $_GET; ?>

                        <ul class="mt10">
                        <?php /*foreach($parent->activeChildren as $child):?>
                            <li class="valued"><?php echo CHtml::link($child->getTranslation($this->Lang)->name,$this->createUrl($controller->id.'/'.$this->action->id,array('language'=>$this->Lang,'type'=>$child->id)));?></li>
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
          </div>
          <div class="col-md-2 col-lg-2"></div>  
      </div>
</div>
</div>