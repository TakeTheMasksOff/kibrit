<?php 
    $main = Category::model()->with()->findByAttributes(array('main'=>1));
    if ($main)
        $main = $main->id;
    else $main = -1;
    $controller = Yii::app()->controller;
?>
<?php 
$url =Yii::app()->controller->createUrl('filterMore',array('language'=>Yii::app()->controller->Lang));
$str = <<<JAVASCRIPT
   $('#collapseOne button.submit').on('click',function(e){
        $.ajax({
            'url':'{$url}',
            'dataType':'html',
            'data':$('.filters-widget form').serialize(),
            'context':$(this),
        }).done(function(data){
            $('{$this->update}').html(data);
            $('.tabs .front-tabs li').removeClass('active');
            ind = $(this).parents('.front-tabs').find(' li a').index($(this))+1;
            $('.tabs .front-tabs li:nth-child('+ind+')').addClass('active');
        });
        e.preventDefault();
   }); 
    $('.selectpicker').selectpicker({
    });
JAVASCRIPT;
Yii::app()->getClientScript()->registerScript('filtersWidget',$str,CClientScript::POS_READY);

$str2 = <<<JAVASCRIPT
  
JAVASCRIPT;
Yii::app()->getClientScript()->registerScript('filtersWidgetAnimation',$str2,CClientScript::POS_READY);

?>
<div class="panel-group col-sm-12 filters-widget" id="accordion">
  <div class="panel panel-default grey-border">
        <div class="panel-heading">
          <div class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                  <span class="pull-left">
                        <?php echo Yii::t('frontend.strings','choose phone');?>
                  </span>
                  <img src="/assets/images/filter-arrow.png" class="pull-right filter-open" alt="">
                  <img src="/assets/images/filter-close.png" class="pull-right filter-close" alt="">
                  <span class="clearfix"></span>
                </a>
          </div>
        </div>
        <div id="collapseOne" class="panel-collapse collapse">
          <div class="panel-body">
                <?php  echo CHtml::beginForm(Yii::app()->controller->createUrl('site/searchItems'),'get');?>
                            <?php $data =   CHtml::listData(ItemsParamset::model()->
                                            with(array('fieldset'=>array('condition'=>'fieldset.name='.Yii::app()->db->quoteValue(Yii::app()->controller->settings['filterWidget_input1']))))->
                                            findAllByAttributes(array('language'=>Yii::app()->controller->Lang),
                                                                array('order'=>'t.value asc')), 'value', 'value');?>
                            <?php echo CHtml::dropDownList('Items[input1]', (isset($_GET['input1'])?$_GET['input1']:''), $data, array('empty'=>Yii::t('frontend.strings','Choose '.Yii::app()->controller->settings['filterWidget_input1']),'class'=>'selectpicker col-xs-12 col-md-4'));?>
                            
                            <?php $data =   CHtml::listData(ItemsParamset::model()->
                                            with(array('fieldset'=>array('condition'=>'fieldset.name='.Yii::app()->db->quoteValue(Yii::app()->controller->settings['filterWidget_input2']))))->
                                            findAllByAttributes(array('language'=>Yii::app()->controller->Lang),
                                                                array('order'=>'t.value asc')), 'value', 'value');?>
                            <?php echo CHtml::dropDownList('Items[input2]', (isset($_GET['input2'])?$_GET['input2']:''), $data, array('empty'=>Yii::t('frontend.strings','Choose '.Yii::app()->controller->settings['filterWidget_input2']),'class'=>'selectpicker col-xs-12 col-md-4'));?>
                            <div class="col-xs-12 col-md-4 chkbox-default">
                                    <div>
                                            <input type="checkbox" name="Items[checkbox1]" id="Items_checkbox1">
                                            <label for="Items_checkbox1"><?php echo Yii::t('frontend.strings',$controller->settings['filterWidget_checkbox1']);?></label>
                                            <div class="clearfix"></div>
                                    </div>
                            </div>

                            <?php $data =   CHtml::listData(ItemsParamset::model()->
                                            with(array('fieldset'=>array('condition'=>'fieldset.name='.Yii::app()->db->quoteValue(Yii::app()->controller->settings['filterWidget_input3']))))->
                                            findAllByAttributes(array('language'=>Yii::app()->controller->Lang),
                                                                array('order'=>'t.value asc')), 'value', 'value');?>
                            <?php echo CHtml::dropDownList('Items[input3]', (isset($_GET['input3'])?$_GET['input3']:''), $data, array('empty'=>Yii::t('frontend.strings','Choose '.Yii::app()->controller->settings['filterWidget_input3']),'class'=>'selectpicker col-xs-12 col-md-4'));?>
                            
                            <div class="col-xs-12 col-md-4 chkbox-default">
                                    <div>
                                            <input type="checkbox" name="Items[checkbox2]" id="Items_checkbox2">
                                            <label for="Items_checkbox2"><?php echo Yii::t('frontend.strings',$controller->settings['filterWidget_checkbox2']);?></label>
                                            <div class="clearfix"></div>
                                    </div>
                            </div>
                            <?php $data =   CHtml::listData(ItemsParamset::model()->
                                            with(array('fieldset'=>array('condition'=>'fieldset.name='.Yii::app()->db->quoteValue(Yii::app()->controller->settings['filterWidget_input4']))))->
                                            findAllByAttributes(array('language'=>Yii::app()->controller->Lang),
                                                                array('order'=>'t.value asc')), 'value', 'value');?>
                            <?php echo CHtml::dropDownList('Items[input4]', (isset($_GET['input4'])?$_GET['input4']:''), $data, array('empty'=>Yii::t('frontend.strings','Choose '.Yii::app()->controller->settings['filterWidget_input4']),'class'=>'selectpicker col-xs-12 col-md-4'));?>
                            <div class="col-xs-12 col-md-4 chkbox-default">
                                    <div>
                                            <input type="checkbox" name="Items[checkbox3]" id="Items_checkbox3">
                                            <label for="Items_checkbox3"><?php echo Yii::t('frontend.strings',$controller->settings['filterWidget_checkbox3']);?></label>
                                            <div class="clearfix"></div>
                                    </div>
                            </div>
                            <?php echo CHtml::hiddenField('Items[cat]',$this->category_id);?>
                            <?php echo CHtml::hiddenField('language',$this->Lang);?>
                            <?php $data =   CHtml::listData(ItemsParamset::model()->
                                            with(array('fieldset'=>array('condition'=>'fieldset.name='.Yii::app()->db->quoteValue(Yii::app()->controller->settings['filterWidget_input5']))))->
                                            findAllByAttributes(array('language'=>Yii::app()->controller->Lang),
                                                                array('order'=>'t.value asc')), 'value', 'value');?>
                            <?php echo CHtml::dropDownList('Items[input5]', (isset($_GET['input5'])?$_GET['input5']:''), $data, array('empty'=>Yii::t('frontend.strings','Choose '.Yii::app()->controller->settings['filterWidget_input5']),'class'=>'selectpicker col-xs-12 col-md-4'));?>
                            <div class="col-xs-12 col-md-4 chkbox-default">
                                    <div>
                                            <input type="checkbox" name="Items[checkbox4]" id="Items_checkbox4">
                                            <label for="Items_checkbox4"><?php echo Yii::t('frontend.strings',$controller->settings['filterWidget_checkbox4']);?></label>
                                            <div class="clearfix"></div>
                                    </div>
                            </div>

                            <?php $data =   CHtml::listData(ItemsParamset::model()->
                                            with(array('fieldset'=>array('condition'=>'fieldset.name='.Yii::app()->db->quoteValue(Yii::app()->controller->settings['filterWidget_input6']))))->
                                            findAllByAttributes(array('language'=>Yii::app()->controller->Lang),
                                                                array('order'=>'t.value asc')), 'value', 'value');?>
                            <?php echo CHtml::dropDownList('Items[input6]', (isset($_GET['input6'])?$_GET['input6']:''), $data, array('empty'=>Yii::t('frontend.strings','Choose '.Yii::app()->controller->settings['filterWidget_input6']),'class'=>'selectpicker col-xs-12 col-md-4'));?>
                            <div class="col-xs-12 col-md-4 chkbox-default">
                                    <div>
                                            <input type="checkbox" name="Items[checkbox5]" id="Items_checkbox5">
                                            <label for="Items_checkbox5"><?php echo Yii::t('frontend.strings',$controller->settings['filterWidget_checkbox5']);?></label>
                                            <div class="clearfix"></div>
                                    </div>
                            </div>
                            <div class="col-xs-12 col-md-4 chkbox-default">
                                    <div>
                                            <input type="checkbox" name="Items[checkbox6]" id="Items_checkbox6">
                                            <label for="Items_checkbox6"><?php echo Yii::t('frontend.strings',$controller->settings['filterWidget_checkbox6']);?></label>
                                            <div class="clearfix"></div>
                                    </div>
                            </div>
                                <div class="col-xs-12 col-md-4 filter-submit">
                                        <?php echo CHtml::htmlButton(Yii::t('frontend.strings','Search'),array('class'=>'btn btn-warning col-xs-12 submit'));?>
                                </div>
                                <div class="clearfix"></div>
                <?php echo CHtml::endForm();?>
          </div>
        </div>
  </div>
</div>      	
