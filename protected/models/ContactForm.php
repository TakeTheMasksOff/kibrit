<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ContactForm extends CFormModel //CFormModel
{
	public $name;
	public $email;
	public $phone;
	public $message;
	// public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('name, email, phone', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
            array('phone', 'numerical')
            // array('phone', 'numerical', 'integerOnly'=>true)
                        // array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
                    // verifyCode needs to be entered correctly
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			// 'verifyCode'=>Yii::t('frontend.strings','Verification Code'),
			'name'=>Yii::t('frontend.strings','Name'),
			'email'=>Yii::t('frontend.strings','Email'),
            'phone'=>Yii::t('frontend.strings','Phone'),
			 'message'=>Yii::t('frontend.strings','Message')		
		);
	}

    public function send(){
        $mailer = Yii::app()->mandrill;
        // $matches  = explode(',', Yii::app()->controller->getSetting('adminEmail','ruslan.salimov@kibrit.tech'));
        // $tmp = $this->getDepartmentList();
        
        // $matches[0] = isset($tmp['emails'][$this->department])?$tmp['emails'][$this->department]:'ruslan.salimov@kibrit.tech';
        // if (count($matches)){
        //     $mailData['to']= array();
        //     $i=0;
        //     foreach($matches as $email){
        //         $mailData['to'][$i]['email']=$email;
        //         $mailData['to'][$i]['name']=$email;
        //         $mailData['to'][$i]['type']='to';
                
        //         $i++;
        //     }
        // } else 

        $mailData['to_email'] = Yii::app()->controller->getSetting('adminEmail','ruslan.salimov@kibrit.tech');
        $mailData['subject'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].' mailer';

        $mailData['html'] = $this->render();
        $mailData['text'] = $this->textRender();
        $result = $mailer->sendMessage($mailData);
        // print_r($result);
        if (is_array($result) && ($result[0]->status=='sent' || $result[0]->status=='queued')){
            return true;
        } 
        else {
            return false;
        }
    }




}
