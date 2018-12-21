<?php $controller = Yii::app()->controller;?>
<?php $tmp = array(
    'en'=>'en_US',
    'az'=>'az_AZ',
    'ru'=>'ru_RU'
);?>
<?php setlocale(LC_TIME, 'en_US');?>
<div id="sync1" class="owl-single owl-carousel">
    <?php $i=0; foreach($banners as $banner):?>
    <div class="item" style="background-image: url(/uploads/banners/<?= rawurlencode($banner->pic_name);?>)">
            <div class="container">
                <div class="banner-info">
                    <div class="banner-date"><?php echo date('d',strtotime($banner->user_date)).' '. date('M',strtotime($banner->user_date)).' '.strftime('%Y',strtotime($banner->user_date));?></div>
                    <div class="banner-topic"><?php echo Utilities::uppercase($banner->getTranslation($controller->Lang)->artist);?></div>
                    <div class="banner-topic"><?php echo Utilities::uppercase($banner->getTranslation($controller->Lang)->topic);?></div>
                    <div class="banner-summary"><?php echo ($banner->getTranslation($controller->Lang)->content);?></div>
                </div>
                <div class="banner-button ">
                    <?php if ($banner->getTranslation($controller->Lang)->link!=''):?>
                        <?php echo CHtml::link(Utilities::uppercase(Utilities::t('READ MORE')),$banner->getTranslation($controller->Lang)->link);?>
                    <?php endif;?>
                </div>
            </div>
    </div>
    <?php $i++;endforeach;?>
</div>

<div class="main-carousel container">
    <div id="sync2" class="owl-thumbnails owl-carousel">
        <?php $i=0; foreach($banners as $banner):?>
        <div class="item <?php echo ($i?'':'active');?>" style="background-image: url(/uploads/banners/<?= rawurlencode(($banner->thumbnail?$banner->thumbnail:$banner->pic_name));?>)">
                    <div class="banner-info">
                        <div class="banner-date pull-left"><?php echo Utilities::uppercase(strftime('%d',strtotime($banner->user_date)).' '. Utilities::t(strftime('%B',strtotime($banner->user_date))).' '. strftime('%Y',strtotime($banner->user_date)));?></div>
                        <div class="sprite sprite-xs sprite-rcaret pull-right"></div>
                        <div class="clearfix"></div>
                        <div class="banner-topic"><b><?php echo Utilities::uppercase($banner->getTranslation($controller->Lang)->artist);?></b></div>
                        <div class="banner-topic"><?php echo Utilities::uppercase($banner->getTranslation($controller->Lang)->topic);?></div>
                    </div>
            <div class="color-fill" <?php if ($banner->color!='') echo 'style="background-color:rgba('.implode(',',  Utilities::hex2rgb($banner->color)).',0.7);"';?>></div>
        </div>
        <?php $i++;endforeach;?>
    </div>

  </div>

<?php 

$js=<<<JS
  var sync1 = $("#sync1");
  var sync2 = $("#sync2");
 
  sync1.owlCarousel({
    singleItem : true,
    autoPlay:5000,
    navigation: false,
    pagination:false,
    afterAction : syncPosition,
    responsiveRefreshRate : 200,
  });
 
  sync2.owlCarousel({
    items : 4,
    pagination:false,
    afterInit : function(el){
      el.find(".owl-item").eq(0).addClass("synced");
    }
  });
 
  function syncPosition(el){
    var current = this.currentItem;
    $("#sync2")
      .find(".owl-item")
      .removeClass("synced")
      .eq(current)
      .addClass("synced")
    if($("#sync2").data("owlCarousel") !== undefined){
      center(current)
    }
  }
 
  $("#sync2").on("click", ".owl-item", function(e){
    e.preventDefault();
    var number = $(this).data("owlItem");
    sync1.trigger("owl.goTo",number);
  });
 
  function center(number){
    var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
    var num = number;
    var found = false;
    for(var i in sync2visible){
      if(num === sync2visible[i]){
        var found = true;
      }
    }
 
    if(found===false){
      if(num>sync2visible[sync2visible.length-1]){
        sync2.trigger("owl.goTo", num - sync2visible.length+2)
      }else{
        if(num - 1 === -1){
          num = 0;
        }
        sync2.trigger("owl.goTo", num);
      }
    } else if(num === sync2visible[sync2visible.length-1]){
      sync2.trigger("owl.goTo", sync2visible[1])
    } else if(num === sync2visible[0]){
      sync2.trigger("owl.goTo", num-1)
    }
    
  }
        
JS;
Yii::app()->clientscript->registerScript('owlcarouselInit',$js,  CClientScript::POS_READY);
setlocale(LC_TIME, "en_US");

?>