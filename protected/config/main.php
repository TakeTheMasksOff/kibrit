<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Kibrit Tech',
        
	// preloading 'log' component
	'preload'=>array('log'),
        'onBeginRequest'=>create_function('$event', 'return ob_start("ob_gzhandler");'),
        'onEndRequest'=>create_function('$event', 'return ob_end_flush();'),
        'theme'=>'classic',
	'homeUrl'=>array('site/index'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.helpers.*',
                'application.extensions.yiidebugtb.*',
                'application.extensions.yiidebug2.*',
                'application.extensions.CAdvancedArBehavior',
        // 'ext.phantomjs.EWebScreenshotAction'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
        'language',
//		'gii'=>array(
//			'class'=>'system.gii.GiiModule',
//			'password'=>'123',
//		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
//			'ipFilters'=>array('127.0.0.1','192.168.20.1','109.237.125.162','*','::1'),
//		),
	),

	'controllerMap'=>array(
			/*'min'=>array(
					'class'=>'ext.minScript.controllers.ExtMinScriptController',
			),*/
	),
	// application components
	'components'=>array(
				// uncomment the following to enable URLs in path-format
			'urlManager'=>array(
                // 'class' => 'yii\web\Urlmanager',
	            //'enablePrettyUrl' => true, // использовать ЧПУ
            	//'enableStrictParsing' => true, // url должен строго соответствовать правилам, иначе 404
				'showScriptName' => false, // убирает имя файла (index.php) из urldecode(str)
				'urlFormat'=>'path',
				'caseSensitive'=>false,
				'urlSuffix' => '',  
			    'useStrictParsing'=>true, // В этом режиме будут срабатывать только те правила, которые прописаны в rules, а адреса вроде index.php/site больше не будут распознаваться как корректные
				'rules'=>array(
					'<language:[a-z]{2}>/blog/<article:[\w\-]+>'=>'site/blog',
        				'<language:[a-z]{2}>/<action:\w+>/<keyword:\w+>'=>'site/<action>',
					'sitemap.xml'=>'site/xml',
	                                'gii'=>'gii',
	                                'gii/<controller:\w+>'=>'gii/<controller>',
	                                'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>', 
	                                'site/<parent>/<folder>/<sub>/<pic>'=>'site/pic',
	                                array(
	                                    'class'=>'application.components.urlmanagers.ItemsUrlManager',
	                                    'connectionID'=>'db'
	                                ),
	                                array(
	                                    'class'=>'application.components.urlmanagers.BrandUrlManager',
	                                    'connectionID'=>'db'
	                                ),
	                                array(
	                                    'class'=>'application.components.urlmanagers.CategoryUrlManager',
	                                    'connectionID'=>'db'
	                                ),
	                                array(
	                                    'class'=>'application.components.urlmanagers.NewsUrlManager',
	                                    'connectionID'=>'db'
	                                ),
	                                array(
	                                    'class'=>'application.components.urlmanagers.MenuUrlManager',
	                                    'connectionID'=>'db'
	                                ),
	                                '<language:[a-z]{2}>/allnews/<type:\d+>/<name:\w+>'=>'site/allnews',
	                                '<language:[a-z]{2}>/allnews/<type:\d+>'=>'site/allnews',
	                                'allnews/<type:\d+>'=>'site/allnews',
	                                '<language:[a-z]{2}>/events/<id:\d+>'=>'site/news',
	                                '<language:[a-z]{2}>/gallery/<keyword:\w+>'=>'site/gallery',
	                                '<language:[a-z]{2}>'=>'site/index',
	                                '<language:[a-z]{2}>/<action:\w+>/<id:\d+>'=>'site/<action>',
	                                '<language:[a-z]{2}>/<action:\w+>'=>'site/<action>',
//'<language:[a-z]{2}>/getproducts/<keyword:\w+>'=>'site/getproducts?keyword=<keyword>',
	                                //'#!/<language:[a-z]{2}>/<action:\w+>'=>'#!/site/<action>',

// '\?_escaped_fragment_\=/<controller:site>/<action:.*>'=>'<controller>/<action>',
	                                'min/serve/<g:\w+>'=>'min/serve',
	                                '<language:[a-z]{2}>/goto/<id:\d+>'=>'site/goto',
	       // '<controller:\w+>/' => '<controller>/index',
	       // '<controller:\w+>/<action:(\w|-)+>/<id:\d+>' => '<controller>/<action>',
	       // '<module:\w+>/<controller:\w+>/<action:(\w|-)+>' => '<module>/<controller>/<action>',
	       // '<controller:\w+>/<action:(\w|-)+>' => '<controller>/<action>',

									'' => 'site/index',
									'<action:login|logout|register>' => 'site/<action>',
									'<controller:\w+>' => '<controller>/index',
									'<controller:\w+>/<id:\d+>' => '<controller>/view',

									'site' => 'site/index',
									// 'site/page/<page:\d+>' => 'site/index',
									'site/post/<id:\d+>' => 'site/view',
									'site/<action:category|tag>/page/<page:\d+>' => 'site/<action>',
									'site/<action:category|tag>' => 'site/<action>',

	                                '<action:\w+>'=>'site/<action>',
	                                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
	                                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

	                                '<language:[a-z]{2}>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
	                                '<language:[a-z]{2}>/<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				),
			),
            'assetManager' => array(
                'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'tmp/assets',
                'baseUrl'=>'/tmp/assets/',
            ),
            'messages'=>array(
                'class'=>'CDbMessageSource',
//                'cacheID'=>'cache',
//                'cachingDuration'=>3600,
                'onMissingTranslation'=>array('MfeMissingTranslationHandler','handleMissingTranslation')
                // additional parameters for CDbMessageSource here
            ),
            'session' => array(
                    'class' => 'CHttpSession',
                    //'lifetime' => 60, // 1 minute,
                    'autoStart'=>true
            ),
			'shoppingCart' =>array(
				'class' => 'application.extensions.shoppingCart.EShoppingCart',
			),
			'clientScript'=>array(
				'class' => 'ext.packagecompressor.PackageCompressor',
				// 'enableCompression' => 'true',
				// 'enableCssImageFingerPrinting' => 'true',
				// 'combineOnly' => 'false',
				// 'blockDuringCompression' => 'false',
				// 'javaBin' => 'java',

				'coreScriptPosition'    => 2,   // == POS_END
		        'packages' => array(
		            'js-package' => array(
		            	//'basePath'=>'alias of the directory containing the script files',
		                'baseUrl' => '/assets/javascripts', //'base URL for the script files'
		                'depends' => array('jQuery', 'maskedinput'),
		                'js' => array(
		                    'base64.js',
		                    'content.js',
		                    'modernizr.custom.79639.js',
		                    'modernizr.js',
		                    'TweenMax.min.js',
		                    'codyhouse.js',
		                    'bootstrap.min.js',
		                    'main.js',
		                ),
		            ),
		            'css-package' => array(
		                // requires write permission for this directory
		                'baseUrl' => '/assets/css',
		                'css' => array(
		                    'normalize.css',
		                    'styles.css',
		                    'font-awesome.min.css',
		                ),
		            )),
			),
			'mailer' => array(
				  'class' => 'application.extensions.mailer.EMailer',
				  'pathViews' => 'application.views.email',
				  'pathLayouts' => 'application.views.email.layouts'
		    ),
			'email'=>array(
				'class'=>'application.extensions.email.Email',
				'delivery'=>'php', //Will use the php mailing function.  
				//May also be set to 'debug' to instead dump the contents of the email into the view
			),
			'mandrill'=>array(
				'class'=>'application.extensions.email.YiiMandrill',
	                        'fromEmail'=>'ruslan.salimov@kibrit.tech',
	                        'fromName'=>'Kibrit Mailer',
	                        'apiKey'=>'d2Mg5Xp9ZF5oifIVnRbnDA'
			),
			'image'=>array(
				'class'=>'application.extensions.image.CImageComponent',
				// GD or ImageMagick
				'driver'=>'GD',
				// ImageMagick setup path
				//'params'=>array('directory'=>'/opt/local/bin'),
			),
			'user'=>array(
				// enable cookie-based authentication
				'allowAutoLogin'=>true,
			),

		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
                'cache'=>array(
                    'class'=>'CDummyCache',
                    //'dbConnection'=>Yii::app()->db,
                    //'connectionID'=>'db',
                ),
		'db'=>array(
			'tablePrefix'=>'',
			'class'=>'CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=rcomaz5_kibrit',
			'emulatePrepare' => true,
			'username' => 'rcomaz5_new',
			'password' => 't800fhM3Hypy',
			'charset' => 'utf8',
                        'enableParamLogging'=>true,
                        'schemaCachingDuration'=>3600,
                        'enableProfiling'=>true,
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
           'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
                                // array(
                                //     'class'=>'application.extensions.yiidebug2.YiiDebugToolbarRoute',
                                //     'ipFilters'=>array('127.0.0.1','192.168.1.*','89.147.205.234'),
                                //     'debug'=>(YII_DEBUG?(isset($_GET['debug'])?true:false):false)
                                // ),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				/*  array(
					'class'=>'CFileLogRoute',
					'levels'=>'trace,log',
					'categories' => 'system.db.CDbCommand',
					'logFile' => 'db.log',
				  ), */
				// uncomment the following to show log messages on web pages
				
                                /*array( // configuration for the toolbar
                                  'class'=>'XWebDebugRouter',
                                  'config'=>'alignLeft, opaque, runInDebug, fixedPos, collapsed, yamlStyle',
                                  'levels'=>'error, warning, trace, profile, info',
                                  'allowedIPs'=>array('192\.168\.1\.[0-9]{3}'),
                                ),*/
                        ),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'office@kibrit.tech',
		'product_files' =>'/files/products/',
		'smtpHost'=>'mail.rcom.az',
		'smtpUsername'=>'office@kibrit.tech',
		'smtpPassword'=>'Peace4sim',
	),
);