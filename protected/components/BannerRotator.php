<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class BannerRotator extends CWidget {
 
    public $banners = array();
    public $Lang='az';
 
    public function run() {
		//Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.cycle.all.min.js');
		//Yii::app()->clientScript->registerCSSFile(Yii::app()->baseUrl.'/css/jshowoff.css');
	
        $this->render('BannerRotator',array('banners'=>$this->banners));
    }
 
}
?>
