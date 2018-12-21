
<div class="container-fluid">
  <!-- carousel start -->
    <div id="carousel-example-generic" class="main-carousel carousel slide hidden-xs hidden-sm" data-ride="carousel">
        <div class="carousel-inner">
            <? $i=0; foreach($banners as $banner):?>
                    <div class="item <?=($i?'':'active');?>" style="background: url(/site/images/banners/big/<?=$banner->pic_name;?>)">
                          <div class="carousel-caption container">
                              <div class="pull-left ">
                                  <div class="brand-model">
                                      <img src="/assets/images/cube-logo.png" alt="">
                                      <p><?=(isset($banner->translations[$this->Lang])?$banner->translations[$this->Lang]->topic:'');?></p>
                                  </div>
                              </div>
                              <div class="pull-right">
                                  <div class="price-details">
                                      <div class="price">
                                          450<sub><img src="/assets/images/azn.png"></sub>
                                      </div>
                                      <div class="details">
                                        <a href="<?=(isset($banner->translations[$this->Lang])?$banner->translations[$this->Lang]->link:"");?>">+ ДЕТАЛИ</a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                    </div>
                <? $i++;?>
            <? endforeach;?>
        </div>
        <div class="container controls" style="">
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
              <span><img src="/assets/images/slider-left.png" alt="2teker.az"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
              <span><img src="/assets/images/slider-right.png" alt="2teker.az"></span>
            </a>
        </div>
        <div class="opacity-layer">
            <img src="/assets/images/opacity_layer.png">
        </div>
      </div>

  <!-- carousel end -->
</div>
