<?php// header("HTTP/1.0 404 Not Found"); ?>
<?php $this->pageTitle = array(Utilities::t('ERROR'),$this->pageTitle);?> 


<div class="main">
  <div class="container-fluid">
      <div class="row title-block">
          <div class="col-md-2 col-lg-2"></div>
          <div class="col-md-8 col-lg-8">
              <div class="title">
                    <h1><?php echo Utilities::t('ERROR');?></h1>
                    <hr class="orange" />
              </div>
          </div>
          <div class="col-md-2 col-lg-2"></div>
      </div>
      <div class="row">
          <div class="col-md-2 col-lg-2"></div>
          <div class="col-md-6 col-lg-6">
<!--                 <div class="pull-right">
                    <div class="extralink">
                        <?php// echo  CHtml::link(Utilities::uppercase(Utilities::t('BACK TO MAINPAGE')),$this->createUrl('site/index',array('language'=>$this->Lang)));?>
                    </div>
                </div> -->
        
                <img src="/assets/images/404.gif" class="center-block img-responsive" alt="">
                <center>
                    <p><b><?php echo Utilities::uppercase(Yii::t('frontend.strings','Page not found.'));?></b></p>
                    <p><?php echo CHtml::link(Utilities::uppercase(Yii::t('frontend.strings','Return to home')),$this->createUrl('site/index',array('language'=>$this->Lang)));?></p>
                </center>
          </div>
          <div class="col-md-2 col-lg-2">
          </div>
          <div class="col-md-2 col-lg-2"></div>
      </div>
  </div>
</div>