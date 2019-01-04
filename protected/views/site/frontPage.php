<div class="main">
     <div class="projects-container project-3-col">
        <ul class="m-0 p-0 h-100 row custom-display-flex">
            <li class="cd-single-project green is-loaded custom-grow col p-0 w-100">
              <div class="image-about h-100"></div>
              <div class="cd-title">
                <span><?php echo $company->getTranslation($this->Lang)->name;?></span>
                <div class="see-more">
                      <p><?php echo $company->getContentTranslation($this->Lang)->summary?></p>
                    <a href="/<?php echo $this->Lang?>/history"><button class="outlined-btn px-5 py-2 walsheim-medium backround-white"><?php echo (Utilities::t('See more'));?></button></a>
                </div>
              </div> <!-- .cd-title -->
            </li>


            <li class="cd-single-project blue is-loaded custom-grow col p-0 w-100">
              <div class="image-services h-100"></div>
              <div class="cd-title">
                <span><?php echo $services->getTranslation($this->Lang)->name;?></span>
                <div class="see-more">
                      <p><?php echo $services->getContentTranslation($this->Lang)->summary?></p>
                    <a href="/<?php echo $this->Lang?>/services"><button class="outlined-btn px-5 py-2 walsheim-medium backround-white"><?php echo (Utilities::t('See more'));?></button></a>
                </div>
              </div> <!-- .cd-title -->
            </li>


            <li class="cd-single-project orange is-loaded custom-grow col p-0 w-100 ">
              <div class="image-works h-100"></div>
              <div class="cd-title">
                <span><?php echo $works->getTranslation($this->Lang)->name;?></span>
                <div class="see-more">
                      <p><?php echo $works->getContentTranslation($this->Lang)->summary?></p>
                    <a href="/<?php echo $this->Lang?>/works"><button class="outlined-btn px-5 py-2 walsheim-medium backround-white"><?php echo (Utilities::t('See more'));?></button></a>
                </div>
              </div> <!-- .cd-title -->
            </li>
        </ul>
    </div>
</div>

