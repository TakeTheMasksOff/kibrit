<?php

class SiteController extends Controller
{
    
    public $pageDescription;
    // public function beforeRender()
    // {

    //     if (!empty($this->pageDescription))
    //     {
    //         Yii::app()->clientScript->registerMetaTag($this->pageDescription, 'description');
    //     }

    //     return true;
    // }

  public function beforeAction($action){
         if ($this->route === 'site/index' && $this->Lang === "en") {
                Yii::app()->clientScript->registerLinkTag('canonical', null, Yii::app()->request->getHostInfo());
         } else {
                Yii::app()->clientScript->registerLinkTag('canonical', null, Yii::app()->request->getHostInfo() . '/' . Yii::app()->request->getPathInfo());
         }
    return parent::beforeAction($action);
  }

  public function actions(){
    //$headers = Yii::app()->getResponse()->getHeaders();
    //$headers->set('Vary: User-Agent');

    return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
            'class'=>'CCaptchaAction',
            'backColor'=>0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page'=>array(
            'class'=>'CViewAction',
            ),
            'mailchimp'=>array(
                'class'=>'application.extensions.mailchimp.MailChimpAction',

            ),
            'pic'=>array(
                'class'=>'application.extensions.image.ThumbnailAction',

            ),
            'createThumbnailFolders'=>array(
                'class'=>'application.extensions.image.CreateThumbnailFoldersAction',

            ),
            'emptyThumbnails'=>array(
                'class'=>'application.extensions.image.EmptyThumbnailsAction',

            ),
    );
  }
  public function actionPhpinfo(){
      // phpinfo();
        //echo Yii::app()->controller->getSetting('contactEmail');
  }
  public function filters()
  {
        return array(
            // array(
            //     'COutputCache',
            //     'duration'=> 60,
            //     'varyByParam'=>array('id'),
            // ),
        );
  }

    public function actionSitemap()
    {
        $error = 0;
        $output = array();
        $output['parent'] = Menus::model()->findByAttributes(array('keyword'=>'aboutus'));
        $output['model'] = $this->active = Menus::model()->findByAttributes(array('keyword'=>'sitemap'));
        //$this->crumbTitle = $output['model']->getTranslation($this->Lang)->name;
        $this->render('sitemap',$output);
    }
    /**
     * Render the sitemap in XML form
     */
    public function actionXml()
    {
            $list = array();
            $this->populateSitemap($list);
            //header('Content-Type: application/xml');
            $this->renderPartial('sitemapxml',array('list'=>$list));
    }   

    public function populateSitemap( &$list )
    {
            $output = array();
            $output['parent'] = $this->active = ($output['model']->parent?$output['model']->parent:$output['model']->parent->getparent);
            if (!$output['parent'])
                $output['parent'] = $this->active = Menus::model()->findByAttributes(array('keyword'=>'blog'));
            $crit = new CDbCriteria();
            $crit->with = array(
                'parent'=>array(
                    'together'=>true,
                    'with'=>array(
                        'getparent'=>array(
                            'together'=>true,
                            'with'=>array(
                                'getparent'=>array(
                                    'alias'=>'getparent2',
                                    'together'=>true,
                                    'with'=>array(
                                        'getparent'=>array(
                                            'alias'=>'getparent3',
                                            'together'=>true
                                        )
                                    )
                                )
                            )
                        )
                    )
                )
            );
            $parent = $output['parent']->id;
            $crit->addCondition("t.parent_id=$parent or parent.parent_id=$parent or getparent.parent_id=$parent or getparent2.parent_id=$parent",'AND');
            $crit->compare('t.parent_id',$output['model']->parent_id);
            $blogs = Articles::Model()->with()->articles()->active()->findAll($crit);

            // services
            $output['parent'] = $this->active = ($output['model']->parent?$output['model']->parent:$output['model']->parent->getparent);
            if (!$output['parent'])
                $output['parent'] = $this->active = Menus::model()->findByAttributes(array('keyword'=>'services'));
            $crit = new CDbCriteria();
            $crit->with = array(
                'parent'=>array(
                    'together'=>true,
                    'with'=>array(
                        'getparent'=>array(
                            'together'=>true,
                            'with'=>array(
                                'getparent'=>array(
                                    'alias'=>'getparent2',
                                    'together'=>true,
                                    'with'=>array(
                                        'getparent'=>array(
                                            'alias'=>'getparent3',
                                            'together'=>true
                                        )
                                    )
                                )
                            )
                        )
                    )
                )
            );
            $parent = $output['parent']->id;
            $crit->addCondition("t.parent_id=$parent or parent.parent_id=$parent or getparent.parent_id=$parent or getparent2.parent_id=$parent",'AND');
            $crit->compare('t.parent_id',$output['model']->parent_id);
            $services =  Articles::Model()->with()->articles()->active()->findAll($crit);

            // portfolio
            $output['parent'] = $this->active = ($output['model']->parent?$output['model']->parent:$output['model']->parent->getparent);
            if (!$output['parent'])
                $output['parent'] = $this->active = Menus::model()->findByAttributes(array('keyword'=>'portfolio'));
            $crit = new CDbCriteria();
            $crit->with = array(
                'parent'=>array(
                    'together'=>true,
                    'with'=>array(
                        'getparent'=>array(
                            'together'=>true,
                            'with'=>array(
                                'getparent'=>array(
                                    'alias'=>'getparent2',
                                    'together'=>true,
                                    'with'=>array(
                                        'getparent'=>array(
                                            'alias'=>'getparent3',
                                            'together'=>true
                                        )
                                    )
                                )
                            )
                        )
                    )
                )
            );
            $parent = $output['parent']->id;
            $crit->addCondition("t.parent_id=$parent or parent.parent_id=$parent or getparent.parent_id=$parent or getparent2.parent_id=$parent",'AND');
            $crit->compare('t.parent_id',$output['model']->parent_id);
            $portfolio = Articles::Model()->with()->articles()->active()->findAll($crit);

            // portfolio
            $output['parent'] = $this->active = ($output['model']->parent?$output['model']->parent:$output['model']->parent->getparent);
            if (!$output['parent'])
                $output['parent'] = $this->active = Menus::model()->findByAttributes(array('keyword'=>'products'));
            $crit = new CDbCriteria();
            $crit->with = array(
                'parent'=>array(
                    'together'=>true,
                    'with'=>array(
                        'getparent'=>array(
                            'together'=>true,
                            'with'=>array(
                                'getparent'=>array(
                                    'alias'=>'getparent2',
                                    'together'=>true,
                                    'with'=>array(
                                        'getparent'=>array(
                                            'alias'=>'getparent3',
                                            'together'=>true
                                        )
                                    )
                                )
                            )
                        )
                    )
                )
            );
            $parent = $output['parent']->id;
            $crit->addCondition("t.parent_id=$parent or parent.parent_id=$parent or getparent.parent_id=$parent or getparent2.parent_id=$parent",'AND');
            $crit->compare('t.parent_id',$output['model']->parent_id);
            $products =  Articles::Model()->with()->articles()->active()->findAll($crit);

            $langs = array("en", "az", "ru");
              
            $list[] = array(
                        'loc'=>$this->createAbsoluteUrl('/'),
                        'frequency'=>'yearly',
                        'priority'=>'0.5',
                        'path'=>'',
                        );
            
    foreach($langs as $lang) 
    {
            $list[] = array(
                        'loc'=>$this->createAbsoluteUrl('/'.$lang.'/history'),
                        'frequency'=>'yearly',
                        'priority'=>'0.3',
                        'path'=>'/history',
                        );
            $list[] = array(
                        'loc'=>$this->createAbsoluteUrl('/'.$lang.'/philosophy'),
                        'frequency'=>'yearly',
                        'priority'=>'0.3',
                        'path'=>'/philosophy',
                        ); 
            $list[] = array(
                        'loc'=>$this->createAbsoluteUrl('/'.$lang.'/partners'),
                        'frequency'=>'monthly',
                        'priority'=>'0.5',
                        'path'=>'/partners',
                        ); 
            $list[] = array(
                        'loc'=>$this->createAbsoluteUrl('/'.$lang.'/certificates'),
                        'frequency'=>'monthly',
                        'priority'=>'0.5',
                        'path'=>'/certificates',
                        ); 
            $list[] = array(
                        'loc'=>$this->createAbsoluteUrl('/'.$lang.'/team'),
                        'frequency'=>'monthly',
                        'priority'=>'0.3',
                        'path'=>'/team',
                        ); 
            $list[] = array(
                        'loc'=>$this->createAbsoluteUrl('/'.$lang.'/blog'),
                        'frequency'=>'weekly',
                        'priority'=>'1',
                        'path'=>'/blog',
            ); 
            $list[] = array(
                        'loc'=>$this->createAbsoluteUrl('/'.$lang.'/contacts'),
                        'frequency'=>'yearly',
                        'priority'=>'0.3',
                        'path'=>'/contacts',
                        );
            foreach( $portfolio as $row )
            {
                $item = Articles::model()->cache(3600)->with(array('translations'=>array('alias'=>'translations', 'together'=>true)))->findByPk($row->id);
                $detail = Cleanurls::getUrlOrSave($item,$item->getTranslation($this->Lang)->name?$item->getTranslation($this->Lang)->name:'',$this->Lang);
                $list[] = array( 
                        'loc'=>$this->createAbsoluteUrl('/'.$lang.'/portfolio/'.$detail),
                        'frequency'=>'weekly',
                        'priority'=>'1',
                        'path'=>'/portfolio/'.$detail,
                );
            }

            foreach( $products as $row )
            {
                $item = Articles::model()->cache(3600)->with(array('translations'=>array('alias'=>'translations', 'together'=>true)))->findByPk($row->id);
                $detail = Cleanurls::getUrlOrSave($item,$item->getTranslation($this->Lang)->name?$item->getTranslation($this->Lang)->name:'',$this->Lang);
                $list[] = array( 
                        'loc'=>$this->createAbsoluteUrl('/'.$lang.'/products/'.$detail),
                        'frequency'=>'weekly',
                        'priority'=>'1',
                        'path'=>'/products/'.$detail,
                );
            }

            foreach( $services as $row )
            {
                $item = Articles::model()->cache(3600)->with(array('translations'=>array('alias'=>'translations', 'together'=>true)))->findByPk($row->id);
                $detail = Cleanurls::getUrlOrSave($item,$item->getTranslation($this->Lang)->name?$item->getTranslation($this->Lang)->name:'',$this->Lang);
                $list[] = array( 
                        'loc'=>$this->createAbsoluteUrl('/'.$lang.'/services/'.$detail),
                        'frequency'=>'weekly',
                        'priority'=>'1',
                        'path'=>'/services/'.$detail,
                );
            }

            foreach( $blogs as $row )
            {
                $item = Articles::model()->cache(3600)->with(array('translations'=>array('alias'=>'translations', 'together'=>true)))->findByPk($row->id);
                $detail = Cleanurls::getUrlOrSave($item,$item->getTranslation($this->Lang)->name?$item->getTranslation($this->Lang)->name:'',$this->Lang);
                $list[] = array( 
                        'loc'=> $this->createAbsoluteUrl('/'.$lang.'/blog/'.$detail),
                        'frequency'=>'weekly',
                        'priority'=>'1',
                        'path'=>'/blog/'.$detail,
                );
            }
    }           
    }
    public function actionIndex(){
            $error = 0;
            $output = array();
           // $this->pageDescription = '';
            $output['company'] = Menus::model()->findByAttributes(array('keyword'=>'company'));
            $output['services'] = Menus::model()->findByAttributes(array('keyword'=>'services'));
            $output['works'] = Menus::model()->findByAttributes(array('keyword'=>'portfolio'));

            $this->render('frontPage', $output );
    }

    public function actionServices($detail = null){
        if($detail === null) {
            $error = 0;
            $output = array();

            $output['model'] = $this->active = Menus::model()->findByAttributes(array('keyword'=>'services'));
            $this->pageDescription = $output['model']->getContentTranslation($this->Lang)->description;
            $tmp = Menus::model()->with(array('activeChildren'=>array('together'=>true)))->findByAttributes(array('keyword'=>'aboutus'));
            $output['sidebar'] = $output['model']->hasActiveChildren?
                                    $output['model']->activeChildren:
                                    (isset($output['model']->getparent)&&($output['model']->getparent->hasActiveChildren>1) &&count($output['model']->getparent->activeChildren)?
                                                $output['model']->getparent->activeChildren:
                                                $tmp->activeChildren
                                    );
        
            $output['parent'] = Menus::model()->findByAttributes(array('keyword'=>'aboutus')); 

            $this->render('services',$output);
        } else {
            $output = array();
            $cleanUrl = Cleanurls::model()->findByAttributes(array('url'=> $detail));
            $output['model'] = Articles::model()->findByPk($cleanUrl['parent_id']);
            $this->pageDescription = $output['model']->getTranslation($this->Lang)->description;
            $output['parent'] = $this->active = ($output['model']->parent && $output['model']->parent?$output['model']->parent:$output['model']->parent->getparent);
            if (!$output['parent'])
                $output['parent'] = $this->active = Menus::model()->findByAttributes(array('keyword'=>'services'));

            $crit = new CDbCriteria();
            $crit->with = array(
                'translations'=>array(
                    'together'=>true,
                ),
                'photos'=>array(
                    'together'=>true,
                ),
            );
            $crit->compare('t.parent_id',$output['model']->parent_id);
            $crit->order = 't.date desc';
            $output['services'] = Articles::model()->findAll($crit);

                $parent = $output['parent']->id;
                $crit->addCondition("parent.id=$parent or parent.parent_id=$parent or getparent.parent_id=$parent or getparent2.parent_id=$parent");
                $output['pagination'] = $pages;
                $output['parentcrumb'] = $output['parent'];
                $output['topcrumb'] = $output['parentcrumb']->getparent;


                $output['formModel'] = new RequestPresentationForm;
                if(isset($_POST['RequestPresentationForm']))
                {
                    $output['formModel']->attributes=$_POST['RequestPresentationForm'];
                    if($output['formModel']->validate())
                    {
                        try {
                            Yii::import('application.extensions.phpmailer.JPhpMailer');
                            $mail = new JPhpMailer;
                            $mail->IsSMTP();
                            $mail->SMTPSecure = "tls";  
                            $mail->Host = Yii::app()->controller->getSetting('smtpHost'); 
                            $mail->SMTPAuth = true;
                            $mail->Username = Yii::app()->controller->getSetting('smtpUsername');
                            $mail->Password = Yii::app()->controller->getSetting('smtpPassword');
                            $mail->Port = '587'; 
                            $mail->IsHTML(true);
                            $mail->SMTPAuth   = true;  
                            $mail->CharSet = 'utf-8';  
                            $mail->SMTPDebug  = 1;
                            $mail->SetFrom(Yii::app()->controller->getSetting('contactEmail'), 'Admin');
                            $mail->Subject = 'Request Presentation Form: Kibrit web site';
                            $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        
                            $msg='<b>Request Product Name: </b> '.$_POST['RequestPresentationForm']['productName'].'<br />
                            <b>'.Yii::t("frontend.strings","Name").': </b> '.$_POST['RequestPresentationForm']['name'].'<br />
                            <b>'.Yii::t("frontend.strings","Organization").': </b> '.nl2br($_POST['RequestPresentationForm']['organization']).'
                            <b>'.Yii::t("frontend.strings","Email").': </b> '.$_POST['RequestPresentationForm']['email'].'<br />
                            <b>'.Yii::t("frontend.strings","Phone").': </b> '.$_POST['RequestPresentationForm']['phone'].'<br />
                            ';
                            $mail->MsgHTML($msg);
                            $mail->AddAddress(Yii::app()->controller->getSetting('contactEmail'), 'Kibrit');
                            if ($mail->Send())
                                Yii::app()->user->setFlash('contactform-success',  Utilities::t ('Message successfully sent. We will contact you as soon as possible'));
                            else{
                                Yii::app()->user->setFlash('contactform-error',  Utilities::t ('Message could not be sent. Please try after a while.'));
                            }
                            //$this->refresh();
                        }
                        catch(Exception $e) {
                          echo 'Message: ' .$e->getMessage();
                        }
                    }
                }
        

            $this->render('servicesDetail',$output);
        }
    }
    public function actionProducts($detail = null)  { 
        
        if($detail === null) {
            $error = 0;
            $output = array();

            $output['model'] = $this->active = Menus::model()->findByAttributes(array('keyword'=>'products'));
            $this->pageDescription = $output['model']->getContentTranslation($this->Lang)->description;
            $tmp = Menus::model()->with(array('activeChildren'=>array('together'=>true)))->findByAttributes(array('keyword'=>'aboutus'));
            $output['sidebar'] = $output['model']->hasActiveChildren?
                                    $output['model']->activeChildren:
                                    (isset($output['model']->getparent)&&($output['model']->getparent->hasActiveChildren>1) &&count($output['model']->getparent->activeChildren)?
                                                $output['model']->getparent->activeChildren:
                                                $tmp->activeChildren
                                    );
        
            $output['parent'] = Menus::model()->findByAttributes(array('keyword'=>'aboutus')); 

            $this->render('products',$output);
        } else {
            $output = array();
            $cleanUrl = Cleanurls::model()->findByAttributes(array('url'=> $detail));
            $output['detail']=$detail;
            $output['model'] = Articles::model()->findByPk($cleanUrl['parent_id']);
            $this->pageDescription = $output['model']->getTranslation($this->Lang)->description;
            $output['parent'] = $this->active = ($output['model']->parent && $output['model']->parent?$output['model']->parent:$output['model']->parent->getparent);
            if (!$output['parent'])
                $output['parent'] = $this->active = Menus::model()->findByAttributes(array('keyword'=>'products'));

            $crit = new CDbCriteria();
            $crit->with = array(
                'translations'=>array(
                    'together'=>true,
                ),
                'photos'=>array(
                    'together'=>true,
                ),
            );
            $crit->compare('t.parent_id',$output['model']->parent_id);
            $crit->order = 't.date desc';
            $output['products'] = Articles::model()->findAll($crit);

                $parent = $output['parent']->id;
                $crit->addCondition("parent.id=$parent or parent.parent_id=$parent or getparent.parent_id=$parent or getparent2.parent_id=$parent");
                $output['pagination'] = $pages;
                $output['parentcrumb'] = $output['parent'];
                $output['topcrumb'] = $output['parentcrumb']->getparent;

                $output['formModel'] = new RequestPresentationForm;
                if(isset($_POST['RequestPresentationForm']))
                {
                    $output['formModel']->attributes=$_POST['RequestPresentationForm'];
                    if($output['formModel']->validate())
                    {
                        try {
                            Yii::import('application.extensions.phpmailer.JPhpMailer');
                            $mail = new JPhpMailer;
                            $mail->IsSMTP();
                            $mail->SMTPSecure = "tls";  
                            $mail->Host = Yii::app()->controller->getSetting('smtpHost'); 
                            $mail->SMTPAuth = true;
                            $mail->Username = Yii::app()->controller->getSetting('smtpUsername');
                            $mail->Password = Yii::app()->controller->getSetting('smtpPassword');
                            $mail->Port = '587'; 
                            $mail->IsHTML(true);
                            $mail->SMTPAuth   = true;  
                            $mail->CharSet = 'utf-8';  
                            $mail->SMTPDebug  = 1;
                            $mail->SetFrom(Yii::app()->controller->getSetting('contactEmail'), 'Admin');
                            $mail->Subject = 'Request Presentation Form: Kibrit web site';
                            $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        
                            $msg='<b>Request Product Name: </b> '.$_POST['RequestPresentationForm']['productName'].'<br />
                            <b>'.Yii::t("frontend.strings","Name").': </b> '.$_POST['RequestPresentationForm']['name'].'<br />
                            <b>'.Yii::t("frontend.strings","Organization").': </b> '.nl2br($_POST['RequestPresentationForm']['organization']).'
                            <b>'.Yii::t("frontend.strings","Email").': </b> '.$_POST['RequestPresentationForm']['email'].'<br />
                            <b>'.Yii::t("frontend.strings","Phone").': </b> '.$_POST['RequestPresentationForm']['phone'].'<br />
                            ';
                            $mail->MsgHTML($msg);
                            $mail->AddAddress(Yii::app()->controller->getSetting('contactEmail'), 'Kibrit');
                            if ($mail->Send())
                                Yii::app()->user->setFlash('contactform-success',  Utilities::t ('Message successfully sent. We will contact you as soon as possible'));
                            else{
                                Yii::app()->user->setFlash('contactform-error',  Utilities::t ('Message could not be sent. Please try after a while.'));
                            }
                            //$this->refresh();
                        }
                        catch(Exception $e) {
                            echo 'Message: ' .$e->getMessage();
                        }
                    }
                }

            $this->render('detail',$output);
        }


    }
    public function actionPortfolio($detail = null){
        if($detail === null) {
            $error = 0;
            $output = array();

            $output['model'] = $this->active = Menus::model()->findByAttributes(array('keyword'=>'portfolio'));
            $this->pageDescription = $output['model']->getContentTranslation($this->Lang)->description;
            $tmp = Menus::model()->with(array('activeChildren'=>array('together'=>true)))->findByAttributes(array('keyword'=>'aboutus'));
            $output['sidebar'] = $output['model']->hasActiveChildren?
                                    $output['model']->activeChildren:
                                    (isset($output['model']->getparent)&&($output['model']->getparent->hasActiveChildren>1) &&count($output['model']->getparent->activeChildren)?
                                                $output['model']->getparent->activeChildren:
                                                $tmp->activeChildren
                                    );
        
            $output['parent'] = Menus::model()->findByAttributes(array('keyword'=>'aboutus')); 

            $this->render('portfolio',$output);
        } else {
            $output = array();
            $cleanUrl = Cleanurls::model()->findByAttributes(array('url'=> $detail));
            
            $output['model'] = Articles::model()->findByPk($cleanUrl['parent_id']);
            $this->pageDescription = $output['model']->getTranslation($this->Lang)->description;
            $output['parent'] = $this->active = ($output['model']->parent && $output['model']->parent?$output['model']->parent:$output['model']->parent->getparent);
            if (!$output['parent'])
                $output['parent'] = $this->active = Menus::model()->findByAttributes(array('keyword'=>'portfolio'));

            $crit = new CDbCriteria();
            $crit->with = array(
                'translations'=>array(
                    'together'=>true,
                ),
                'photos'=>array(
                    'together'=>true,
                ),
            );
            $crit->compare('t.parent_id',$output['model']->parent_id);
            $crit->order = 't.date desc';
            $output['products'] = Articles::model()->findAll($crit);

                $parent = $output['parent']->id;
                $crit->addCondition("parent.id=$parent or parent.parent_id=$parent or getparent.parent_id=$parent or getparent2.parent_id=$parent");
                $output['pagination'] = $pages;
                $output['parentcrumb'] = $output['parent'];
                $output['topcrumb'] = $output['parentcrumb']->getparent;

            $this->render('detail',$output);
        }
    }
    public function actionBlog($type=false, $detail = null){
        if($detail === null) {
            $output = array();
            $output['parent'] = $this->active = Menus::model()->findByAttributes(array('keyword'=>'blog'));
            $crit = new CDbCriteria;
            $crit->order = 't.date desc';
            $crit->compare('type', 'Menus');
            $crit->with = array(
                // 'translations'=>array(
                //     'together'=>true,
                // ),
                'parent'=>array(
                    'together'=>true,
                    'with'=>array(
                        'getparent'=>array(
                            'together'=>true,
                            'with'=>array(
                                'getparent'=>array(
                                    'alias'=>'getparent2',
                                    'together'=>true,
                                    'with'=>array(
                                        'getparent'=>array(
                                            'alias'=>'getparent3',
                                            'together'=>true
                                        )
                                    )
                                )
                            )
                        )
                    )
                )
            );
            if ($type)
                $parent = (int) $type;
            else $parent = $output['parent']->id;

             $crit->addCondition("parent.id=$parent or parent.parent_id=$parent or getparent.parent_id=$parent or getparent2.parent_id=$parent");

             $count=Articles::Model()->with()->articles()->active()->count($crit);
             $pages=new CPagination($count);

             $pages->pageSize=3;
             $pages->applyLimit($crit);
             $output['pagination'] = $pages;

            $output['news']=Articles::Model()->with()->articles()->active()->findAll($crit);
            //$output['newsSub'] = $this->active = Menus::model()->findByPk($parent);
            $output['parentcrumb'] = $output['parent'];
          //  $this->crumbTitle = $output['newsSub']->getTranslation($this->Lang)->name;
            $output['type'] = $type;
            
            $this->render('news', $output);
        } else {
            $output = array();
            $cleanUrl = Cleanurls::model()->findByAttributes(array('url'=> $detail));
            $output['model'] = Articles::model()->findByPk($cleanUrl['parent_id']);
            $this->pageDescription = $output['model']->getTranslation($this->Lang)->description;
            $output['parent'] = $this->active = ($output['model']->parent && $output['model']->parent?$output['model']->parent:$output['model']->parent->getparent);
            if (!$output['parent'])
                $output['parent'] = $this->active = Menus::model()->findByAttributes(array('keyword'=>'allnews'));

            $crit = new CDbCriteria();
            $crit->with = array(
                'translations'=>array(
                    'together'=>true,
                ),
                'photos'=>array(
                    'together'=>true,
                ),
            );
            $crit->compare('t.parent_id',$output['model']->parent_id);
            $crit->limit = 4;
            $crit->order = 't.date desc';
            $output['news'] = Articles::model()->findAll($crit);

                if ($type)
                    $parent = (int) $type;
                else $parent = $output['parent']->id;
                $crit->addCondition("parent.id=$parent or parent.parent_id=$parent or getparent.parent_id=$parent or getparent2.parent_id=$parent");
                $output['pagination'] = $pages;
                $output['parentcrumb'] = $output['parent'];
                $output['topcrumb'] = $output['parentcrumb']->getparent;

            $this->render('article',$output);
        }
    }
    public function actionGoto($id){
        $output = array();
        $output['model']=  $this->active = Menus::model()->with()->findByPk($id);
        $tmp = Menus::model()->with(array('activeChildren'=>array('together'=>true)))->findByAttributes(array('keyword'=>'aboutus'));
        $output['sidebar'] = $output['model']->hasActiveChildren?
                                $output['model']->activeChildren:
                                (isset($output['model']->getparent)&&($output['model']->getparent->hasActiveChildren>1) &&count($output['model']->getparent->activeChildren)?
                                            $output['model']->getparent->activeChildren:
                                            $tmp->activeChildren
                                );
        $output['parent'] = Menus::model()->findByAttributes(array('keyword'=>'aboutus'));
        $this->render('static',$output);
    }
    public function actionHistory(){
        $error = 0;
        $output = array();
        $output['model'] = $this->active = Menus::model()->findByAttributes(array('keyword'=>'history'));

        $this->pageDescription = $output['model']->getContentTranslation($this->Lang)->description;
        $tmp = Menus::model()->with(array('activeChildren'=>array('together'=>true)))->findByAttributes(array('keyword'=>'aboutus'));
        $output['sidebar'] = $output['model']->hasActiveChildren?
                                $output['model']->activeChildren:
                                (isset($output['model']->getparent)&&($output['model']->getparent->hasActiveChildren>1) &&count($output['model']->getparent->activeChildren)?
                                            $output['model']->getparent->activeChildren:
                                            $tmp->activeChildren
                                );
        $output['parent'] = Menus::model()->findByAttributes(array('keyword'=>'aboutus'));
        $this->render('static',$output);
    }

    public function actionVacancies($type=false, $detail = null){
        if($detail === null) {
            $output = array();
            $output['parent'] = $this->active = Menus::model()->findByAttributes(array('keyword'=>'vacancies'));
            $crit = new CDbCriteria;
            $crit->order = 't.date desc';
            $crit->compare('type', 'Menus');
            $crit->with = array(
                // 'translations'=>array(
                //     'together'=>true,
                // ),
                'parent'=>array(
                    'together'=>true,
                    'with'=>array(
                        'getparent'=>array(
                            'together'=>true,
                            'with'=>array(
                                'getparent'=>array(
                                    'alias'=>'getparent2',
                                    'together'=>true,
                                    'with'=>array(
                                        'getparent'=>array(
                                            'alias'=>'getparent3',
                                            'together'=>true
                                        )
                                    )
                                )
                            )
                        )
                    )
                )
            );
            if ($type)
                $parent = (int) $type;
            else $parent = $output['parent']->id;

             $crit->addCondition("parent.id=$parent or parent.parent_id=$parent or getparent.parent_id=$parent or getparent2.parent_id=$parent");

             $count=Articles::Model()->with()->articles()->active()->count($crit);
             $pages=new CPagination($count);

             $pages->pageSize=3;
             $pages->applyLimit($crit);
             $output['pagination'] = $pages;

            $output['news']=Articles::Model()->with()->articles()->active()->findAll($crit);
            //$output['newsSub'] = $this->active = Menus::model()->findByPk($parent);
            $output['parentcrumb'] = $output['parent'];
          //  $this->crumbTitle = $output['newsSub']->getTranslation($this->Lang)->name;
            $output['type'] = $type;
            
            $this->render('news', $output);
        } else {
            $output = array();
            $cleanUrl = Cleanurls::model()->findByAttributes(array('url'=> $detail));
            $output['model'] = Articles::model()->findByPk($cleanUrl['parent_id']);
            $this->pageDescription = $output['model']->getTranslation($this->Lang)->description;
            $output['parent'] = $this->active = ($output['model']->parent && $output['model']->parent?$output['model']->parent:$output['model']->parent->getparent);
            if (!$output['parent'])
                $output['parent'] = $this->active = Menus::model()->findByAttributes(array('keyword'=>'allnews'));

            $crit = new CDbCriteria();
            $crit->with = array(
                'translations'=>array(
                    'together'=>true,
                ),
                'photos'=>array(
                    'together'=>true,
                ),
            );
            $crit->compare('t.parent_id',$output['model']->parent_id);
            $crit->limit = 4;
            $crit->order = 't.date desc';
            $output['news'] = Articles::model()->findAll($crit);

                if ($type)
                    $parent = (int) $type;
                else $parent = $output['parent']->id;
                $crit->addCondition("parent.id=$parent or parent.parent_id=$parent or getparent.parent_id=$parent or getparent2.parent_id=$parent");
                $output['pagination'] = $pages;
                $output['parentcrumb'] = $output['parent'];
                $output['topcrumb'] = $output['parentcrumb']->getparent;

            $this->render('article',$output);
        }
    }
    public function actionPhilosophy(){
        $error = 0;
        $output = array();
        $output['model'] = $this->active = Menus::model()->findByAttributes(array('keyword'=>'philosophy'));
        $this->pageDescription = $output['model']->getContentTranslation($this->Lang)->description;
        $tmp = Menus::model()->with(array('activeChildren'=>array('together'=>true)))->findByAttributes(array('keyword'=>'aboutus'));
        $output['sidebar'] = $output['model']->hasActiveChildren?
                                $output['model']->activeChildren:
                                (isset($output['model']->getparent)&&($output['model']->getparent->hasActiveChildren>1) &&count($output['model']->getparent->activeChildren)?
                                            $output['model']->getparent->activeChildren:
                                            $tmp->activeChildren
                                );
        $output['parent'] = Menus::model()->findByAttributes(array('keyword'=>'aboutus'));
        $this->render('static',$output);
    }
    public function actionPartners(){
        $error = 0;
        $output = array();
        $output['model'] = $this->active = Menus::model()->findByAttributes(array('keyword'=>'partners'));
        $this->pageDescription = $output['model']->getContentTranslation($this->Lang)->description;
        $tmp = Menus::model()->with(array('activeChildren'=>array('together'=>true)))->findByAttributes(array('keyword'=>'aboutus'));
        $output['sidebar'] = $output['model']->hasActiveChildren?
                                $output['model']->activeChildren:
                                (isset($output['model']->getparent)&&($output['model']->getparent->hasActiveChildren>1) &&count($output['model']->getparent->activeChildren)?
                                            $output['model']->getparent->activeChildren:
                                            $tmp->activeChildren
                                );
        $output['parent'] = Menus::model()->findByAttributes(array('keyword'=>'aboutus'));
        $this->render('gridPage',$output);
    }
    public function actionCertificates(){
        $error = 0;
        $output = array();
        $output['model']=  $this->active = Menus::model()->with()->findByAttributes(array('keyword'=>'certificates'));
        $this->pageDescription = $output['model']->getContentTranslation($this->Lang)->description;
        $tmp = Menus::model()->with(array('activeChildren'=>array('together'=>true)))->findByAttributes(array('keyword'=>'aboutus'));
        $output['sidebar'] = $output['model']->hasActiveChildren?
                                $output['model']->activeChildren:
                                (isset($output['model']->getparent)&&($output['model']->getparent->hasActiveChildren>1) &&count($output['model']->getparent->activeChildren)?
                                            $output['model']->getparent->activeChildren:
                                            $tmp->activeChildren
                                );
        $output['parent'] = Menus::model()->findByAttributes(array('keyword'=>'aboutus'));
        $this->render('gridPage',$output);
    }
    public function actionTeam(){
        $error = 0;
        $output = array();
        $output['model2']=  $this->active = Menus::model()->with()->findByAttributes(array('keyword'=>'honorary_employee'));
        $output['model']=  $this->active = Menus::model()->with()->findByAttributes(array('keyword'=>'team'));

        $this->pageDescription = $output['model']->getContentTranslation($this->Lang)->description;
        $tmp = Menus::model()->with(array('activeChildren'=>array('together'=>true)))->findByAttributes(array('keyword'=>'aboutus'));
        $output['sidebar'] = $output['model2']->hasActiveChildren?
                                $output['model2']->activeChildren:
                                (isset($output['model']->getparent)&&($output['model']->getparent->hasActiveChildren>1) &&count($output['model']->getparent->activeChildren)?
                                            $output['model']->getparent->activeChildren:
                                            $tmp->activeChildren
                                );
        $output['parent'] = Menus::model()->findByAttributes(array('keyword'=>'aboutus'));
        $this->render('gridPage',$output);
    }
    public function actionContacts(){
        $error = 0;
        $output = array();
        $output['parent'] = Menus::model()->findByAttributes(array('keyword'=>'aboutus'));
        $output['model'] = $this->active = Menus::model()->findByAttributes(array('keyword'=>'contacts'));
        $this->pageDescription = $output['model']->getContentTranslation($this->Lang)->description;
        $output['formModel'] = new ContactForm;
        if(isset($_POST['ContactForm']))
        {
            $output['formModel']->attributes=$_POST['ContactForm'];
            if($output['formModel']->validate())
            {
                try {
                    Yii::import('application.extensions.phpmailer.JPhpMailer');
                    $mail = new JPhpMailer;
                    $mail->IsSMTP();
                    $mail->SMTPSecure = "tls";  
                    $mail->Host = Yii::app()->controller->getSetting('smtpHost'); 
                    $mail->SMTPAuth = true;
                    $mail->Username = Yii::app()->controller->getSetting('smtpUsername');
                    $mail->Password = Yii::app()->controller->getSetting('smtpPassword');
                    $mail->Port = '587'; 
                    $mail->IsHTML(true);
                    $mail->SMTPAuth   = true;  
                    $mail->CharSet = 'utf-8';  
                    $mail->SMTPDebug  = 1;
                    $mail->SetFrom(Yii::app()->controller->getSetting('contactEmail'), 'Admin');
                    $mail->Subject = 'Contact Form: Kibrit web site';
                    $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';

                    $msg='<b>Name: </b> '.$_POST['ContactForm']['name'].'<br />
                    <b>Email: </b> '.$_POST['ContactForm']['email'].'<br />
                    <b>Phone number: </b> '.$_POST['ContactForm']['phone'].'<br />

                    <b>Message: </b> <br /><br />

                    '.nl2br($_POST['ContactForm']['message']).'

                    ';
                    $mail->MsgHTML($msg);
                    $mail->AddAddress(Yii::app()->controller->getSetting('contactEmail'), 'Kibrit');
                    if ($mail->Send())
                        Yii::app()->user->setFlash('contactform-success',  Utilities::t ('Message successfully sent. We will contact you as soon as possible'));
                    else{
                        Yii::app()->user->setFlash('contactform-error',  Utilities::t ('Message could not be sent. Please try after a while.'));
                    }
                    $this->refresh();    
                }
                catch(Exception $e) {
                  echo 'Message: ' .$e->getMessage();
                }
            }
        }
        $this->render('contacts',$output);
    }

    public function actionSearch(){
            $output = array();
            $crit = new CDbCriteria;
            $output['parent'] = $this->active = Menus::model()->findByAttributes(array('keyword'=>'blog'));
            $crit = new CDbCriteria;
            $crit->order = 't.date desc';
            $crit->with = array(
                'translations'=>array(
                    'together'=>true,
                    'joinType'=>'right join'
                ),
                'parent'=>array(
                    'together'=>true,
                    'with'=>array(
                        'getparent'=>array(
                            'together'=>true,
                            'with'=>array(
                                'getparent'=>array(
                                    'alias'=>'getparent2',
                                    'together'=>true,
                                    'with'=>array(
                                        'getparent'=>array(
                                            'alias'=>'getparent3',
                                            'together'=>true
                                        )
                                    )
                                )
                            )
                        )
                    )
                )
            );
            $parent = $output['parent']->id;
            $output['keyword'] = $search =  htmlspecialchars (strip_tags(mb_strtolower(Yii::app()->getRequest()->getParam('query'),'UTF-8')));
            if($search!='')    {
                $crit->addSearchCondition('lower(translations.name)',$search,true,'OR');
                $crit->addSearchCondition('lower(translations.body)',$search,true,'OR');
                }
            $crit->addCondition("t.parent_id=$parent or parent.parent_id=$parent or getparent.parent_id=$parent or getparent2.parent_id=$parent",'AND');
            $crit->compare('translations.language', $this->Lang,false,'AND');
            $crit->compare('type', 'Menus',false,'AND');
            $crit->scopes = array('articles');
//      $count=Articles::model()->count($crit);

//      $pages=new CPagination($count);
            //$pages->pageSize=9;
//      $pages->applyLimit($crit);
//      $output['pages'] = $pages;
            $output['items']=Articles::Model()->with()->findAll($crit);
            $this->render('search', $output );
    }
  public function actionError(){
    $error = array();
    $error=Yii::app()->errorHandler->error;
    if ($error !== null) {
        $error5xx = array(500, 501, 502, 503, 504, 505, 507, 510);
        $search = array_search($error['code'], $error5xx); 
        if ($search !== false) return $this->render('error5xx', ['exception' => $error]);
            return $this->render('error', $error);
    }

  }
}