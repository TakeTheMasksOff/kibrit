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
                    <h1><?php echo Utilities::uppercase($model->getTranslation($this->Lang)->name);?></h1>
                    <hr class="green" />
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
          <div class="col-md-6 col-lg-6 b-padding" id="outer">
                <br>
                <div class="row">
                      <?php $i=1;foreach($model->articles(array('order'=>'articles.sort asc','scopes'=>array('active'))) as $stuff):?>
                          <div class="col-xs-4 mb20 <?php echo $i%3?'':'third';?>">
                                  <div class="stuff-image">
                                  <?php if ($this->route !== 'site/certificates'):?>
                                          <img src="<?php echo $stuff->getPhoto(0);?>" class="img-responsive" alt="<?php echo trim($stuff->getTranslation($this->Lang)->name);?> - Kibrit" title="<?php echo $stuff->getTranslation($this->Lang)->name;?>">
                                  <?php else:?>
                                          <img src="<?php echo $stuff->getPhoto(0);?>" class="img-responsive" alt='<?php echo trim($stuff->getTranslation($this->Lang)->summary);?> - Kibrit' title='<?php echo $stuff->getTranslation($this->Lang)->summary;?>'>
                                  <?php endif;?>
                                  </div>
                                  <div class="stuff-text">
                                      <div class="stuff-name">
                                          <?php if (Yii::app()->controller->id=='site' && Yii::app()->controller->action->id=='partners'):?>
                                              <a data-key="<?php echo $stuff->getTranslation($this->Lang)->body?>" data-type="href" href="#" target="_blank"><?php echo $stuff->getTranslation($this->Lang)->name;?></a>
                                          <?php else:?>
                                              <?php echo $stuff->getTranslation($this->Lang)->name;?>
                                          <?php endif;?>
                                      </div>
                                      <div class="stuff-position">
                                          <?php echo $stuff->getTranslation($this->Lang)->summary;?>
                                      </div>
                                  </div>
                          </div>
                          <?php if (!($i%3)):?>
                              <div class="clearfix"></div>
                          <?php endif;?>
                      <?php $i++;endforeach;?>
                      <div class="clearfix"></div>
                </div>  

                <?php if ($this->route === 'site/team' && isset($model2)):?>
                  <br>
                      <div class="title mb20">
                           <h1><?php echo (Utilities::t('Former colleagues'));?></h1>
                      </div><br>
                <div class="row">
                      <?php $i=1;foreach($model2->articles(array('order'=>'articles.sort asc','scopes'=>array('active'))) as $stuff):?>
                          <div class="col-xs-4 mb20 <?php echo $i%3?'':'third';?>">
                                  <div class="stuff-image">
                                          <img src="<?php echo $stuff->getPhoto(0);?>" class="img-responsive" alt="<?php echo trim($stuff->getTranslation($this->Lang)->name);?> - Kibrit" title="<?php echo $stuff->getTranslation($this->Lang)->name;?>">
                                  </div>
                                  <div class="stuff-text">
                                      <div class="stuff-name">
                                           <?php echo $stuff->getTranslation($this->Lang)->name;?>
                                      </div>
                                      <div class="stuff-position">
                                          <?php echo $stuff->getTranslation($this->Lang)->summary;?>
                                      </div>
                                  </div>
                          </div>
                          <?php if (!($i%3)):?>
                              <div class="clearfix"></div>
                          <?php endif;?>
                      <?php $i++;endforeach;?>
                      <div class="clearfix"></div>
                </div>  
                <?php endif;?> 
          </div>
          <div class="col-md-2 col-lg-2 b-padding" >
              <?php echo ($model->getContentTranslation($this->Lang)->summary!='')?$model->getContentTranslation($this->Lang)->summary : '';?>
          </div>
          <div class="col-md-2 col-lg-2"></div>  
      </div>
    </div>

</div>

<footer>
    <div class="nav pull-left">
      <ul>
          <?php if (count($sidebar)):?>
              <?php foreach($sidebar as $menu):?>
                    <li class='<?php echo (strtolower($menu->keyword) == strtolower(Yii::app()->controller->action->id)?'active':'')?>'>
                      <?php echo CHtml::link( Utilities::uppercase($menu->getTranslation($this->Lang)->name), $menu->getTranslation($this->Lang)->getLink($this->Lang,$menu->id));?>
                    </li>
              <?php endforeach;?>
          <?php endif;?>
      </ul>
    </div>
    <span class="nav dwn-profile pull-right"><i class="icon-pdf fa-lg" aria-hidden="true"></i><a href="/files/Kibrit_Profile_<?php echo $this->Lang; ?>.pdf" target="_blank"> <?php echo (Utilities::t('Download "Company profile"'));?></a></span>
</footer>