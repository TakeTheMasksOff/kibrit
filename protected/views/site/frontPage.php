<div class="main">
     <div class="projects-container project-3-col">
        <ul class="m-0 p-0 h-100 row custom-display-flex">
            <li class="cd-single-project green is-loaded custom-grow col m-0 p-0 w-100" onclick="">
              <div class="image-about h-100"></div>
              <div class="cd-title text-white">
                <span class="front-title"><?php echo $company->getTranslation($this->Lang)->name;?></span>
                <div class="details mx-auto">
                  <div class="details-summary mt-md-4"><?php echo $company->getContentTranslation($this->Lang)->summary?></div>
                  <a class="details-more" href="/<?php echo $this->Lang?>/history">
                    <button class="outlined-btn  py-lg-2 walsheim-medium backround-white"><?php echo (Utilities::t('See more'));?>
                      <svg class="arrow-right ml-2" width="21" height="14" viewBox="0 0 21 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 7.00013L20 7.00013" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14 13L20 7L14 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                    </button>
                  </a>
                </div>
              </div> 
            </li>


            <li class="cd-single-project blue is-loaded custom-grow col m-0 p-0 w-100" onclick="">
              <div class="image-services h-100"></div>
              <div class="cd-title text-white">
                <span class="front-title"><?php echo $services->getTranslation($this->Lang)->name;?></span>
                <div class="details mx-auto">
                  <div class="details-summary mt-md-4"><?php echo $services->getContentTranslation($this->Lang)->summary?></div>
                  <a class="details-more" href="/<?php echo $this->Lang?>/services">
                    <button class="outlined-btn  py-lg-2 walsheim-medium backround-white"><?php echo (Utilities::t('See more'));?>
                      <svg class="arrow-right ml-2" width="21" height="14" viewBox="0 0 21 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 7.00013L20 7.00013" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14 13L20 7L14 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                    </button>
                  </a>
                </div>
              </div> 
            </li>


            <li class="cd-single-project orange is-loaded custom-grow col m-0 p-0 w-100 " onclick="">
              <div class="image-works h-100"></div>
              <div class="cd-title text-white">
                <span class="front-title"><?php echo $works->getTranslation($this->Lang)->name;?></span>
                <div class="details mx-auto">
                  <div class="details-summary mt-md-4"><?php echo $works->getContentTranslation($this->Lang)->summary?></div>
                  <a class="details-more" href="/<?php echo $this->Lang?>/works">
                    <button class="outlined-btn  py-lg-2 walsheim-medium backround-white"><?php echo (Utilities::t('See more'));?>
                      <svg class="arrow-right ml-2" width="21" height="14" viewBox="0 0 21 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 7.00013L20 7.00013" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14 13L20 7L14 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                    </button>
                  </a>
                </div>
              </div> 
            </li>
        </ul>
    </div>
</div>

