<?php $this->pageTitle = Utilities::t("Site map").' | Kibrit';?>

<div class='main'>

    <div class="container-fluid">
        <div class="row title-block">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-8 col-lg-8">
                <div class="title">
                    <h1><?php echo Utilities::t ('Sitemap');?></h1>
                    <hr class="orange" />
                </div>
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