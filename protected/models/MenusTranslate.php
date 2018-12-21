<?php

/**
 * This is the model class for table "menus_translate".
 *
 * The followings are the available columns in table 'menus_translate':
 * @property integer $id
 * @property integer $menus_id
 * @property string $language
 * @property string $name
 * @property string $link
 */
class MenusTranslate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return MenusTranslate the static model class
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
		return 'menus_translate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('language, name', 'required'),
			array('menus_id', 'numerical', 'integerOnly'=>true),
			array('language', 'length', 'max'=>2),
			array('name, link', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, menus_id, language, name, link', 'safe', 'on'=>'search'),
		);
	}

        public function scopes(){
            $t=$this->getTableAlias(false, true);
            
            return array(
                'translated'=>array(
                    'condition'=>$t.'.name!="" and '.$t.'.language="'.Yii::app()->controller->Lang.'"'
                )
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
			'menu'    => array(self::BELONGS_TO, 'Menus',    'menus_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'menus_id' => 'Menus',
			'language' => 'Language',
			'name' => 'Name',
			'link' => 'Link',
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
		$criteria->compare('menus_id',$this->menus_id);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('link',$this->link,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
        public function getLink($lang,$id=0){
            if ($this->link) return $this->link;
            //else return Yii::app()->createUrl('site/goto',array('id'=>$id,'language'=>$lang));
            else return '/'.$lang.'/menus/'.$this->menus_id.'/'.Utilities::str2url ($this->name);
        }
}
