<?php $controller = Yii::app()->controller;?>
<?php echo CHtml::tag('div',$this->containerHtmlOptions);?>
<div class="owl-indicator"></div>
<div id="sync1" class="owl-single-insider owl-carousel">
    <?php $i=0; foreach($this->items as $img):?>
    <div class="item">
        <?php echo CHtml::image($img->getPath('carouselBig'),'Carousel');?>
    </div>
    <?php $i++;endforeach;?>
</div>

<div class="main-carousel">
    <div id="sync2" class="owl-thumbnails-insider owl-carousel">
        <?php $i=0; foreach($this->items as $img):?>
        <div class="item <?php echo ($i?'':'active');?>" >
            <?php echo CHtml::image($img->getPath('caruselThumb'),'Carousel');?>
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
    autoStart:true,
    navigation: true,
    pagination:false,
    afterAction : syncPosition,
    responsiveRefreshRate : 200,
    addClassActive:true,
    afterInit:function(d,el){
        $('.owl-indicator').html('1 / '+$(d).find('.owl-item').length)
    },
    afterMove:function(d,el){
        $('.owl-indicator').html(($(d).find('.owl-item').index($(d).find('.owl-item.active')) + 1)+ ' / ' + $(d).find('.owl-item').length)
    }
  });
 
  sync2.owlCarousel({
    items : 4,
    pagination:false,
    afterInit : function(el){
      el.find(".owl-item").eq(0).addClass("synced");
    },
    center:true,
    loop:true,
    margin:10,
    responsive:{
        600:{
        items:4
        }
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

?><?php echo CHtml::closeTag('div');?>
