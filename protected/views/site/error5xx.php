<?php $this->pageTitle = array(Utilities::t('ERROR').': '.$exception['code'],$this->pageTitle);?> 

<div class="main">
  <div class="container-fluid">
      <div class="row title-block">
          <div class="col-md-2 col-lg-2"></div>
          <div class="col-md-8 col-lg-8">
              <div class="title">
                    <h1><?php echo Utilities::t('ERROR').": ".$exception['code'];?></h1>
                    <hr class="orange" />
              </div>
          </div>
          <div class="col-md-2 col-lg-2"></div>
      </div>
      <div class="row">
          <div class="col-md-2 col-lg-2"></div>
          <div class="col-md-6 col-lg-6">        
<!--            <img src="/assets/images/404.gif" class="center-block img-responsive" alt=""> -->
       
                    <p><b><?php echo Utilities::uppercase(Yii::t('frontend.strings','500error'));?></b></p>
            		<p style="width: 500px;">При обработке запроса произошла ошибка на сервере или превышен лимит времени обработки. Попробуйте повторорить Ваши действия снова.</p>

        			<br>
                    <button type="submit" class="outlined-btn contactFormSubmit" onclick="DisableButton(this);" style="border: solid 2px #fe9901;"><?php echo CHtml::link(Utilities::uppercase(Yii::t('frontend.strings','Return to home')),$this->createUrl('site/index',array('language'=>$this->Lang)));?></button>
                  	<button type="submit" class="outlined-btn contactFormSubmit" onclick="DisableButton(this);" style="border: solid 2px #fe9901;"><?php echo CHtml::link(Utilities::uppercase(Yii::t('frontend.strings','contactus')),$this->createUrl('site/contacts',array('language'=>$this->Lang)));?></button>
          </div>
          <div class="col-md-2 col-lg-2">
          </div>
          <div class="col-md-2 col-lg-2"></div>
      </div>
  </div>
</div>