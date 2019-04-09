<?php
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	//public $layout='';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
        public $bodyClass='';
	public $Lang,$settings,$active;
	public $header, $footer,$left,$right;
        public $gridColumnSize=12;
	private  $LangId;
	public $layout='//layouts/column1';
	public $imgUpl = array();
        public $languages = array('az'=>'Azerbaijani','ru'=>'Russian','en'=>'English');
	/**
	 * Declares class-based actions.
	 */
	private function updateCache() {
		//if(Yii::app()->request->getParam('cache', 'true') === 'false')
			Yii::app()->setComponent('cache', new CDummyCache());
	}
	public function init(){
		parent::init();
		//$this->updateCache();
		if (isset($_GET['id'])) $_GET['id'] = (int) $_GET['id'] ; 
		
		$app = Yii::app();
		$models = Settings::Model()->cache(3600)->findAll();
		if (!isset(Yii::app()->session['compare']))
                    Yii::app()->session['compare'] = array();
		foreach($models as $model){
				$this->settings[$model->attribute] = $model->value;
		}
		unset($models);
		if ($app->getRequest()->getParam('language'))
			{
				$this->Lang = $app->getRequest()->getParam('language');
				$_SESSION['language'] = $this->Lang;
			}
		// else if (isset($_SESSION['language']))
		// 	 $this->Lang =$_SESSION['language'];
		else $this->Lang = 'en';
                Yii::app()->language = $this->Lang;
                if (!isset($_SESSION['compare']))
                    $_SESSION['compare'] = array();

				$clientScript = Yii::app()->getClientScript();
		                // $clientScript->scriptMap=array(
		                //   "jquery.js"=>"/assets/javascripts/jquery.min.js",
		                // );
				//$clientScript->registerCoreScript('jquery');

				// $clientScript->registerScriptFile('/assets/javascripts/jquery.min.js');
				// $clientScript->registerScriptFile('/assets/javascripts/jquery-3.3.1.min.js');
				// // $clientScript->registerScriptFile('/assets/javascripts/popper.js');
				// $clientScript->registerScriptFile('/assets/javascripts/base64.js');
                // //             // $clientScript->registerScriptFile('/assets/javascripts/modernizr.custom.79639.js');
                // $clientScript->registerScriptFile('/assets/javascripts/modernizr.js');
                // $clientScript->registerScriptFile('/assets/javascripts/TweenMax.min.js');
                // $clientScript->registerScriptFile('/assets/javascripts/codyhouse.js');
                // $clientScript->registerScriptFile('/assets/javascripts/bootstrap.min.js');
                // $clientScript->registerScriptFile('/assets/javascripts/main.js');
                
                // $clientScript->registerCssFile('/assets/css/normalize.css');
                // $clientScript->registerCssFile('/assets/css/bootstrap.css');
				// $clientScript->registerCSSFile('/assets/css/styles.css');
                // $clientScript->registerCSSFile('/assets/css/font-awesome.min.css');
                // $clientScript->registerCSSFile('/assets/css/owl.carousel.min.css');
                // $clientScript->registerCSSFile('/assets/css/owl.theme.default.min.css');
                $clientScript->registerCssFile('/assets/css/merged.min.css');
				$clientScript->registerScriptFile('/assets/javascripts/merged.min.js');
				$clientScript->registerScriptFile('/assets/javascripts/bootstrap.min.js');

$this->imgUpl['gallery']= '/images/gallery/';
$this->imgUpl['menu']= '/images/menu/';
$this->imgUpl['carousel']= '/images/carousel/';
$this->imgUpl['banners']= '/images/banners/';

$app->sourceLanguage = 'ge';
$app->setLanguage($this->Lang);
$this->pageTitle = Yii::t('frontend.strings','HTML.PageTitle');//$this->settings['companyName_'.$this->Lang]);
}

public function getSetting($param,$default=NULL){
	if (isset($this->settings[$param]))
	return $this->settings[$param];
	else return $default;
	}
	public function render($view, $data = null, $return = false) {
	//ob_start("ob_gzhandler");
	parent::render($view, $data, $return);
	//ob_end_flush();
	}
}

function mb_str_replace($needle, $replacement, $haystack){
	$needle_len = mb_strlen($needle);
	$replacement_len = mb_strlen($replacement);
	$pos = mb_strpos($haystack, $needle);
	while ($pos !== false)
	{
	$haystack = mb_substr($haystack, 0, $pos) . $replacement
	. mb_substr($haystack, $pos + $needle_len);
	$pos = mb_strpos($haystack, $needle, $pos + $replacement_len);
	}
	return $haystack;
	}
	function mb_ucasefirst($str){
	$str[0] = mb_strtoupper($str[0]);
	return $str;
}
function genRandomString($length=10, $chars='', $type=array()) {
	//initialize the characters
	$alphaSmall = 'abcdefghijklmnopqrstuvwxyz';
	$alphaBig = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$num = '0123456789';
	$othr = '`~!@#$%^&*()/*-+_=[{}]|;:",<>.\/?' . "'";

    $characters = "";
    $string = '';
    //defaults the array values if not set
    isset($type['alphaSmall']) ? $type['alphaSmall']: $type['alphaSmall'] = true; //alphaSmall - default true
    isset($type['alphaBig']) ? $type['alphaBig']: $type['alphaBig'] = true; //alphaBig - default true
    isset($type['num']) ? $type['num']: $type['num'] = true; //num - default true
    isset($type['othr']) ? $type['othr']: $type['othr'] = false; //othr - default false
    isset($type['duplicate']) ? $type['duplicate']: $type['duplicate'] = true; //duplicate - default true

    if (strlen(trim($chars)) == 0) {
    $type['alphaSmall'] ? $characters .= $alphaSmall : $characters = $characters;
    $type['alphaBig'] ? $characters .= $alphaBig : $characters = $characters;
    $type['num'] ? $characters .= $num : $characters = $characters;
    $type['othr'] ? $characters .= $othr : $characters = $characters;
    }
    else
    $characters = str_replace(' ', '', $chars);

    if($type['duplicate'])
    for (; $length > 0 && strlen($characters) > 0; $length--) {
    $ctr = mt_rand(0, (strlen($characters)) - 1);
    $string .= $characters[$ctr];
    }
    else
    $string = substr (str_shuffle($characters), 0, $length);

    return $string;
}