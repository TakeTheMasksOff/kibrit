
    <div class="extralinks">
            <div class="container">
                <div class="row">
                <?php if (isset($items[0])):?>
                  <div class="col col-xs-10 col-sm-6 col-xs-offset-1 col-sm-offset-0 col-md-4 thumbnail-parent">
                    <div class="thumbnail img-rounded">
                      <img src="/uploads/banners/<?php echo $items[0]->pic_name;?>" alt="...">
                      <div class="caption">
                          <?php echo CHtml::link($items[0]->getTranslation($this->Lang)->topic, $items[0]->link);?>
                      </div>
                    </div>
                  </div>
                <?php endif;?>
                <?php if (isset($items[1])):?>
                  <div class="hidden-xs  col-sm-6 col col-md-4 thumbnail-parent">
                    <div class="thumbnail img-rounded">
                      <img src="/uploads/banners/<?php echo $items[1]->pic_name;?>" alt="...">
                      <div class="caption">
                          <?php echo CHtml::link($items[1]->getTranslation($this->Lang)->topic, $items[1]->link);?>
                      </div>
                    </div>
                  </div>
                <?php endif;?>
                <?php if (isset($items[2])):?>
                  <div class="hidden-xs hidden-sm col col-md-4 thumbnail-parent">
                    <div class="thumbnail img-rounded">
                      <img src="/uploads/banners/<?php echo $items[2]->pic_name;?>" alt="...">
                      <div class="caption">
                          <?php echo CHtml::link($items[2]->getTranslation($this->Lang)->topic, $items[2]->link);?>
                      </div>
                    </div>
                  </div>
                <?php endif;?>
                </div>
            </div>
    </div>
