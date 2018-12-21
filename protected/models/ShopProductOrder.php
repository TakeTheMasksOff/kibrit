<?php

/**
 * This is the model class for table "ShopProductOrder".
 *
 * The followings are the available columns in table 'ShopProductOrder':
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $product_shipped
 * @property integer $product_arrived
 * @property string $name
 * @property string $body
 * @property string $size
 * @property double $amount
 * @property integer $quantity
 * @property string $pic_name
 */
class ShopProductOrder extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ShopProductOrder the static model class
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
		return 'ShopProductOrder';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, product_id, amount', 'required'),
			array('order_id, product_id, product_shipped, product_arrived, quantity', 'numerical', 'integerOnly'=>true),
			array('amount,color_id', 'numerical'),
			array('name, size, pic_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('order_id, product_id, product_shipped, product_arrived, name, size, amount, quantity, pic_name', 'safe', 'on'=>'search'),
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
			'order'=>array(self::BELONGS_TO, 'ShopOrder', 'order_id'),
			'product'=>array(self::BELONGS_TO, 'ItemsStock', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'order_id' => 'Order',
			'product_id' => 'Product',
			'product_shipped' => 'Product Shipped',
			'product_arrived' => 'Product Arrived',
			'name' => 'Name',
			'body' => 'Body',
			'size' => 'Size',
			'amount' => 'Amount',
			'quantity' => 'Quantity',
			'pic_name' => 'Pic Name',
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

		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('product_shipped',$this->product_shipped);
		$criteria->compare('product_arrived',$this->product_arrived);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('pic_name',$this->pic_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function cloneByModel(ItemsStock $model,$order=NULL){
            $this->product_id = $model->id;
            $this->name = $model->item->name;
            $this->color_id = $model->color_id;
            $this->size = $model->size;

            $this->amount = $model->price-(1-$model->discount/100);
            $this->pic_name = $model->item->getPhotoItem(0)->pic_name;
            $this->quantity = $model->getQuantity();
            if ($order)
                $this->order_id = $order->order_id;

        }
}