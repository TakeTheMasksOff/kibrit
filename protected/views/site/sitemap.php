<?php $this->pageTitle = Utilities::t("Site map").' | Kibrit';?> 
<?php
    // $this->breadcrumbs = array(
    //     (string) $model->getContentTranslation($this->Lang)->name,
    // );
?>
<div class='main' >

    <div class="container-fluid">
      <div class="row title-block">
          <div class="col-md-2 col-lg-2"></div>
          <div class="col-md-8 col-lg-8">
              <div class="title">
                    <h1><?php echo Utilities::t ('Site map');?></h1>
                    <hr class="green" />
              </div>

<!--               <div class="pull-right">
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
              </div> -->
          </div>
          <div class="col-md-2 col-lg-2"></div>
      </div>

      <div class='row'>
          <div class="col-md-2 col-lg-2"></div>
          <div class="col-md-8 col-lg-8" id="outer" style="padding-bottom:80px">
		  		<?php 
				  $menusWith = array('translations'=>array('together'=>true),
				                      'hasActiveChildren'=>array('together'=>true),
				                      'activeChildren'=>array('together'=>true,'with'=>array('hasActiveChildren'=>array('together'=>false,'alias'=>'hasStat'),'translations'=>array('alias'=>'translations1', 'together'=>true))));
				  $this->widget('application.components.SitemapBar',array(
				          'menus'=>Menus::model()
				                      ->cache(3600)
				                      ->with($menusWith)
				                      ->findAll(array('condition'=>'t.parent_id=-1 and t.active=1 and t.deleted=0','order'=>'t.sort asc')),
				          'Lang'=>$this->Lang,
				          'level'=>1,
				          'active'=>$this->active,
				          'includes'=>false,
				          'jsvoid'=>1,
				  ));
				?>  
          </div>
          <div class="col-md-2 col-lg-2"></div>  
      </div>
    </div>

</div>

