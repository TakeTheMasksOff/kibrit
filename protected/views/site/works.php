<?php $this->pageTitle = array($model->getContentTranslation($this->Lang)->name);?> 
<?php
    $this->breadcrumbs = array(
        (string) $model->getTranslation($this->Lang)->name,
    );
?>
<div class='main'>

    <div class="container-fluid">
      <div class="row title-block">
          <div class="col-md-2 col-lg-2"></div>
          <div class="col-md-8 col-lg-8">
              <div class="title">
                    <span><?php echo Utilities::uppercase($model->getTranslation($this->Lang)->name);?></span>
                    <hr class="blue" />
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
                                             <meta itemprop="position" content="1" /></li>', // home link template
                            'activeLinkTemplate'  =>'<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                                     <a itemprop="item" href="{url}"><span itemprop="name">{label}</span></a></li>', //active link template
                            'inactiveLinkTemplate'  =>'<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="selected"><a itemprop="item" > <span itemprop="name">{label}</span></a></li>', // in-active link template
                        )); ?>
                    <?php endif;?>
                </div>
              </div>
          </div>
          <div class="col-md-2 col-lg-2"></div>
      </div>

      <div class='row'>
          <div class="col-md-2 col-lg-2"></div>  

          <div class="col-md-2 col-lg-2">
              <p><?php echo $model->getContentTranslation($this->Lang)->body;?></p>
          </div>
          <div class="col-md-6 col-lg-6 b-padding" id="outer">
          <br>
          <div class="row">

          <?php if (count($sidebar)):?>
              <?php $i=1;foreach($sidebar as $menu):?>
                    <div class="col-xs-6 thumb works <?php echo $i%2?'':'third';?>">
            
                        <?php if ($menu->getContentTranslation($this->Lang)->body!=""):?>

                        <?php echo CHtml::ajaxLink( ' <img src="'.$menu->getCoverPhoto()->getPath().'" alt="'.trim($menu->getTranslation($this->Lang)->name)." ".Utilities::t("developedBy").'" title="'.$menu->getTranslation($this->Lang)->name.'" class="img-responsive">', 
                          array($this->Lang.'/works'),
                          array(
                              'type' => 'GET',
                              'data'=>array('keyword'=> $menu->getTranslation($this->Lang)->getLink($this->Lang,$menu->id)),
                              'success' => '
                                 function(html){
                                 $("#content-block").html(html);
                                 history.pushState(null,null,"'.Yii::app()->createUrl($this->Lang."/works#!".$menu->getTranslation($this->Lang)->getLink($this->Lang,$menu->id)).'");
                                 changeMetaTags( window.location.href,
                                  "'.htmlspecialchars($menu->getContentTranslation($this->Lang)->summary)." - ".Utilities::t("developedBy"). '",
                                  "'.$menu->getContentTranslation($this->Lang)->description.'"
                                 );
                               }',
                            ),
                          array(
                            'class'=>'showRightBlock '.$menu->getTranslation($this->Lang)->getLink($this->Lang,$menu->id),
                            'href' => Yii::app()->createUrl($this->Lang."/works#!".$menu->getTranslation($this->Lang)->getLink($this->Lang,$menu->id))
                            )
                          );?>

                        <?php echo CHtml::ajaxLink( Utilities::t('Read more'), 
                          array($this->Lang.'/works'),
                          array(
                              'type' => 'GET',
                              'data'=>array('keyword'=> $menu->getTranslation($this->Lang)->getLink($this->Lang,$menu->id)),
                              'success' => '
                                 function(html){
                                 $("#content-block").html(html);
                                 history.pushState(null,null,"'.Yii::app()->createUrl($this->Lang."/works#!".$menu->getTranslation($this->Lang)->getLink($this->Lang,$menu->id)).'");

                                 changeMetaTags( window.location.href,
                                  "'.htmlspecialchars($menu->getContentTranslation($this->Lang)->summary)." - ".Utilities::t("developedBy"). '",
                                  "'.$menu->getContentTranslation($this->Lang)->description.'"
                                 );
                               }',
                            ),
                          array(
                            'class'=>'showRightBlock read_more '.$menu->getTranslation($this->Lang)->getLink($this->Lang,$menu->id),
                            'href' => Yii::app()->createUrl($this->Lang."/works#!".$menu->getTranslation($this->Lang)->getLink($this->Lang,$menu->id))
                            )
                          );?>

                        <?php else:?>
                            <img src="<?php echo $menu->getCoverPhoto()->getPath()?>" alt="<?php echo trim($menu->getTranslation($this->Lang)->name);?> - Kibrit" title="<?php echo $menu->getTranslation($this->Lang)->name?>" class="img-responsive">
                        <?php endif;?>    

                        <div class="summary"><?php echo Utilities::uppercase($menu->getTranslation($this->Lang)->name) ?></div>
                        <p><?php echo $menu->getContentTranslation($this->Lang)->summary?></p>
                   
                    </div>
                        <?php if (!($i%2)):?>
                            <div class="clearfix"></div>
                        <?php endif;?>
              <?php $i++;endforeach;?>
          <?php endif;?>
          <!-- Go to www.addthis.com/dashboard to customize your tools -->
          <div class="addthis_inline_share_toolbox"></div>
          </div>
          </div>
          <div class="col-md-2 col-lg-2"></div>  
      </div>
    </div>

</div>

  <div id="rightBlock" class="overlay">
        <a href="javascript:void(0)" class="closebtn" onclick="closeRightBlock()"><i class="icon-close" aria-hidden="true"></i></a>
        <div class="info-content">
            <div id="content-block" class="mb20">
                  <?php $this->renderPartial('_works', array(
                      'blockContent' => $blockContent,
                  ))?> 
            </div>

        </div>
  </div>