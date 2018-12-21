<div class="main">
     <div class="projects-container project-3-col">
        <ul>
            <li class="cd-single-project green is-loaded">
              <div class="image"></div>
              <div class="cd-title">
              <span><?php echo $company->getTranslation($this->Lang)->name;?></span>
                <div class="see-more">
                      <p><?php echo $company->getContentTranslation($this->Lang)->summary?></p>
                    <a href="/<?php echo $this->Lang?>/history"><button class="rectangle-90"><?php echo (Utilities::t('See more'));?></button></a>
                </div>
              </div> <!-- .cd-title -->
            </li>


            <li class="cd-single-project blue is-loaded">
              <div class="image"></div>
              <div class="cd-title">
              <span><?php echo $services->getTranslation($this->Lang)->name;?></span>
                <div class="see-more">
                      <p><?php echo $services->getContentTranslation($this->Lang)->summary?></p>
                    <a href="/<?php echo $this->Lang?>/services"><button class="rectangle-90"><?php echo (Utilities::t('See more'));?></button></a>
                </div>
              </div> <!-- .cd-title -->
            </li>


            <li class="cd-single-project orange is-loaded">
              <div class="image"></div>
              <div class="cd-title">
              <span><?php echo $works->getTranslation($this->Lang)->name;?></span>
                <div class="see-more">
                      <p><?php echo $works->getContentTranslation($this->Lang)->summary?></p>
                    <a href="/<?php echo $this->Lang?>/works"><button class="rectangle-90"><?php echo (Utilities::t('See more'));?></button></a>
                </div>
              </div> <!-- .cd-title -->
            </li>
        </ul>
    </div>
</div>

