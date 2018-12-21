<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class RequestPresentationForm extends CFormModel //CFormModel
{
	public $name;
	public $email;
	public $phone;
	public $organization;
	// public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('name, email, phone, organization', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
            array('phone', 'numerical')
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
		    'organization'=>Yii::t('frontend.strings','Organization')		
		);
	}

    public function send(){
        $mailer = Yii::app()->mandrill;


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
