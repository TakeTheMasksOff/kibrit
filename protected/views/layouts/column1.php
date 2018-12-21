<?php $this->beginContent('//layouts/main'); ?>

    <script type="text/javascript">
        $(document).mouseup(function(event) {
          if ($(event.target).closest("#myNav").length) return;
          closeNav();
          event.stopPropagation();
        });

        function openNav() {
              if (window.matchMedia('(max-width: 768px)').matches)
              {
                  $("#myNav").css("width", "100vw");
                  <?php if ($this->route != 'site/index'): ?><? endif; ?>
                      $(".main").css("transition-duration", "200ms");
                      $(".main").css("transform", "translate(-100vw, 0px)");
                  <?php if ($this->route != 'site/index'): ?><? endif; ?>
              }
              else {
                  $("#myNav").css("width", "33.333vw");
                  <?php if ($this->route != 'site/index'): ?><? endif; ?>
                      $(".main").css("transition-duration", "200ms");
                      $(".main").css("transform", "translate(-33.333vw, 0px)");
                  <?php if ($this->route != 'site/index'): ?><? endif; ?>
              }
        }

        function closeNav() {
            $("#myNav").css("width", "0");
            <?php if ($this->route != 'site/index'): ?><? endif; ?>
                $(".main").css("transition-duration", "200ms");
                $(".main").css("transform", "translate(0px, 0px)");
            <?php if ($this->route != 'site/index'): ?><? endif; ?>
        }

    </script>


<header <?php if (Yii::app()->controller->action->id!=='index' && Yii::app()->controller->action->id!=='philosophy'):?> class="shadow"<?php endif;?> >
    <div id="logo"><a href="http://kibrit.tech"></a></div>
    <span class="cd-nav-trigger" style="cursor:pointer" onclick="openNav()"><?php echo (Utilities::t('Menu'));?> <i class="icon-group" aria-hidden="true"></i></span>
</header>

<?php if (Yii::app()->controller->action->id!=='index' && Yii::app()->controller->action->id!=='philosophy'):?> <div class="shadow-bottom"></div><?php endif;?>


    <?php echo $content; ?>

<div id="myNav" class="overlay">
      <dl id="sample" class="dropdown">
          <dt>  <i class="icon-angle-down"></i><a href="#"><span><?php echo $this->languages[$this->Lang]; ?></span></a></dt>
          <dd>
                <?php $langs = array();$controller = Yii::app()->controller; $tmp = $_GET; ?>
                <ul>
                <?php foreach($controller->languages as $code=>$lang):?>
                    <li class="valued" <?php if ($this->languages[$this->Lang] === $lang):?> style="display:none"<?php endif;?> ><?php $tmp['language'] = $code; echo CHtml::link($lang,$this->createUrl($controller->id.'/'.$this->action->id,$tmp));?></li>
                <?php endforeach;?>
                </ul>
          </dd>
      </dl>

      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="icon-close" aria-hidden="true"></i></a>
      <div class="overlay-content">
          <?php 
              $menusWith = array('translations'=>array('together'=>true),
                                  'hasActiveChildren'=>array('together'=>true),
                                  'activeChildren'=>array('together'=>true,'with'=>array('hasActiveChildren'=>array('together'=>false,'alias'=>'hasStat'),'translations'=>array('alias'=>'translations1', 'together'=>true))));
              $this->widget('application.components.MenuBar',array(
                      'menus'=>Menus::model()
                                  ->cache(3600)
                                  ->with($menusWith)
                                  ->findAll(array('condition'=>'t.parent_id=-1 and t.active=1 and t.deleted=0','order'=>'t.sort asc')),
                      'Lang'=>$this->Lang,
                      'level'=>1,
                      'active'=>$this->active,
                      'includes'=>false,
                      'jsvoid'=>1,
              ));
          ?>
      </div>



      <div class="footer-block">
            <p><?php echo CHtml::link('Sitemap',$this->createAbsoluteUrl($this->Lang.'/sitemap'));?></p>
            <p><?php echo (Utilities::t('Follow us on'));?> <a target="_blank" href="<?php echo $this->getSetting('facebook');?>">Facebook</a> & <a target="_blank" href="<?php echo $this->getSetting('linkedin');?>">Linkedin</a></p>
            <p>2016 - 2018 <i class="icon-copyright" aria-hidden="true"></i> Kibrit</p>

      </div>
</div>

<?php $this->endContent(); ?>
