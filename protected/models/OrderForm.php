<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class OrderForm extends CFormModel
{
	public $name,$surname;
	public $email;
	public $phone;
	public $bookid;
	public $message;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('name, surname,email, phone, message,bookid', 'required'),
			array('email', 'email'),
			array('bookid,phone', 'numerical'),
			
			// email has to be a valid email address
			array('email', 'email'),
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
			'surname'=>Yii::t('right','Surname'),
			'name'=>Yii::t('right','Name'),
			'email'=>Yii::t('right','E-mail'),
			'phone'=>Yii::t('right','Phone'),
			'message'=>Yii::t('right','Message')
		);
	}
}