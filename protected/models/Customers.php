<?php

/**
 * This is the model class for table "customers".
 *
 * The followings are the available columns in table 'customers':
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $phone
 * @property string $email
 * @property string $login
 * @property string $password
 * @property integer $subscribe
 */
class Customers extends CActiveRecord
{
    public $verifyCode,$password2;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Customers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,  phone, email, login, password,password2', 'required', 'on'=>'Register'),
			array('subscribe', 'numerical', 'integerOnly'=>true),
			array('name, surname, phone, email, login, password,password2', 'length', 'max'=>255),
			array('password', 'compare', 'compareAttribute'=>'password2','on'=>'Register'),
			array('email','email'),
			array('login,email','unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, surname, phone, email, login, password, subscribe', 'safe', 'on'=>'search'),
            array('verifyCode', 'captcha','allowEmpty'=>!Yii::app()->user->isGuest || !CCaptcha::checkRequirements(),'on'=>'Register'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'addresses'=>array(self::HAS_MANY,'Adress','customers_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                    'id'=>'ID',
                    'login'=>Yii::t('frontend.strings','Login'),
                    'name'=>Yii::t('frontend.strings','Name'),
                    'phone'=>Yii::t('frontend.strings','Phone'),
                    'password'=>Yii::t('frontend.strings','Password'),
                    'password2'=>Yii::t('frontend.strings','Password2'),
                    'email'=>Yii::t('frontend.strings','E-mail'),
                    'subscribe'=>Yii::t('frontend.strings','Subscribe'),
                    'verifyCode'=>Yii::t('frontend.strings','verifyCode'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('subscribe',$this->subscribe);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    public function behaviors()
    {
        return array(
        );
    }
}