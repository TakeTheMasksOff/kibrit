<?php
/* @var $this BannersController */
/* @var $model Banners */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'banners-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="col-sm-4 mb30 mt10">
		<?php echo $form->labelEx($model,'sort'); ?>
		<?php echo $form->textField($model,'sort',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'sort'); ?>
	</div>
	<div class="col-sm-4 mb30 mt10">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',$model->types(),array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
	<div class="col-sm-4 mb30 mt10">
		<?php echo $form->labelEx($model,'user_date'); ?>
		<?php  $this->widget('booster.widgets.TbDatePicker',array(
                    'model'=>$model,
                    'attribute'=>'user_date',
                    'form'=>$form,
                    'options'=>array(
                        'language'=>'en',//$this->Lang,
                        'format'=>'yyyy-mm-dd',
                        'autoclose'=>true,
                        'todayHighlight'=>true,
                        'startDate'=>date('Y-m-d'),
                    ),
                    'htmlOptions'=>array(
                        'class'=>'form-control'
                    )
                )); ?>
		<?php echo $form->error($model,'user_date'); ?>
	</div>
	<div class="col-sm-4 mb30 mt10">
		<?php echo $form->labelEx($model,'color'); ?>
		<?php echo $form->textField($model,'color',array('class'=>'colorpicker form-control input-lg')); ?>
                <span id="colorSelector" class="colorselector">
                  <span></span>
                </span>
                  <span id="colorpickerholder"></span>
		<?php echo $form->error($model,'color'); ?>
	</div>
	<div class="col-sm-4 mb30 mt10">
		<?php echo $form->labelEx($model,'pic_name'); ?>
		<?php echo $form->fileField($model,'pic_name',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'pic_name'); ?>
                <?php if ($model->pic_name):?>
                    <?php echo CHtml::image($this->baseUrl.$model->pic_name,'',array('width'=>440));?>
                <?php endif;?>
	</div>
	<div class="col-sm-4 mb30 mt10">
		<?php echo $form->labelEx($model,'thumbnail'); ?>
		<?php echo $form->fileField($model,'thumbnail',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'thumbnail'); ?>
                <?php if ($model->thumbnail):?>
                    <?php echo CHtml::image($this->baseUrl.$model->thumbnail,'',array('width'=>440));?>
                <?php endif;?>
	</div>
        <div class="clearfix"></div>

	<div class=" buttons col-xs-2 mt10">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'form-control input-lg btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php

$js= <<<JS
//  // Color Picker Flat Mode
//	jQuery('#colorpickerholder').ColorPicker({
//		flat: true,
//		onChange: function (hsb, hex, rgb) {
//			jQuery('#colorpicker3').val('#'+hex);
//		}
//	});
//        
JS;

Yii::app()->clientscript->registerScript('colorpicker',$js,  CClientScript::POS_READY);
Yii::app()->clientscript->registerScriptFile('/mfe/template/js/colorpicker.js',  CClientScript::POS_HEAD);
Yii::app()->clientscript->registerCSSFile('/mfe/template/css/colorpicker.css',  CClientScript::POS_HEAD);
?>