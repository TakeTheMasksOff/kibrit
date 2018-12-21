    <div class="extra-footer">
            <div class="container ">
                <div class="highlighteds img-rounded">
                <?php if (isset($items[0])):?>
                    <div class="pull-left highlighted">
                        <div class="pull-left imgcont hidden-xs">
                            <img src="/uploads/banners/<?php echo $items[0]->pic_name;?>" alt="" class="img-rounded ">
                        </div>
                        <div class="pull-right text ">
                            <p><?php echo $items[0]->getTranslation($this->Lang)->content;?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                <?php endif;?>
                <?php if (isset($items[1])):?>
                    <div class="pull-left hidden-xs hidden-sm highlighted">
                        <div class="pull-left imgcont  ">
                            <img src="/uploads/banners/<?php echo $items[1]->pic_name;?>" alt="" class="img-rounded ">
                        </div>
                        <div class="pull-right text ">
                            <p><?php echo $items[1]->getTranslation($this->Lang)->content;?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                <?php endif;?>
                <?php if (isset($items[2])):?>
                    <div class="pull-left visible-lg highlighted">
                        <div class="pull-left imgcont  ">
                            <img src="/uploads/banners/<?php echo $items[2]->pic_name;?>" alt="" class="img-rounded ">
                        </div>
                        <div class="pull-right text ">
                            <p><?php echo $items[2]->getTranslation($this->Lang)->content;?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                <?php endif;?>
                    <div class="clearfix"></div>
                </div>
            </div>
    </div>
 