                                <?php

/**
 * This is the model class for table "items".
 *
 * The followings are the available columns in table 'items':
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $body
 * @property integer $color_id
 * @property string $size
 * @property integer $price
 * @property integer $discount
 * @property string $pic_name
 * @property integer $stock
 *
 * The followings are the available model relations:
 * @property ItemPhotos[] $itemPhotoses
 * @property Category $category
 * @property ItemsTranslate[] $itemsTranslates
 */
class Items extends Translatable implements IECartPosition
{
    public $minPrice,$maxPrice,$input1,$input2,$input3,$input4,$input5,$input6,$cat;
    public $checkbox1,$checkbox2,$checkbox3,$checkbox4,$checkbox5,$checkbox6;
    public $translationClass='ItemsTranslate';
    public function behaviors() {
        return array(
            'cleanurlBehavior'=>array(
                'class'=>'application.components.behaviors.CleanurlBehavior'

            )
        );
    }
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'items';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_id, name, body, ', 'required','on'=>'Create'),
            array('category_id, name', 'required','on'=>'Import'),
            array('category_id, minPrice,maxPrice,color_id,brands_id, stock', 'numerical', 'integerOnly'=>true),
            array('price, discount','type','type'=>'float'),
            array('name, size, pic_name', 'length', 'max'=>255),
            array('sort','default','value'=>0),
            array('price','numerical','min'=>'0.0001'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, category_id,cat, name,sort,minPrice,maxPrice,input1,input2,input3,brands_id, body,artikul,artikul2,barcode,size, color_id, size, price, discount, pic_name, stock', 'safe', 'on'=>'search'),
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
            'photos' => array(self::HAS_MANY, 'ItemPhotos', 'item_id','order'=>'photos.sort asc'),
            'recommended' => array(self::MANY_MANY, 'Items', 'items_recommended(parent_id,child_id)','condition'=>'recommended.active=1'),
            'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
            'color' => array(self::BELONGS_TO, 'Colors', 'color_id'),
            'brand' => array(self::BELONGS_TO, 'Brands', 'brands_id'),
            'translations' => array(self::HAS_MANY, 'ItemsTranslate', 'parent_id','index'=>'language'),
            'stocks' => array(self::HAS_MANY, 'ItemsStock', 'item_id'),
            'stockSum' => array(self::STAT, 'ItemsStock', 'item_id','select'=>'sum(stock)'),
            'cleanurls'=>array(self::HAS_MANY,'Cleanurls','parent_id','on'=>'cleanurls.type="Items"','index'=>'language'),
            'paramset'=>array(self::HAS_MANY,'ItemsParamset','items_id'),
        );
    }
    public function getActions(){
        $tmp = array('content'=>array(
            'edit'=>array('title'=>'Edit Item',
                            'params'=>array('class'=>'glyphicon glyphicon-edit', 'url'=> 'items/Update','data'=>array('id'=>$this->id))),
            'delete'=>array('title'=>($this->deleted?'Undelete':'Delete').' Item',
                            'params'=>array('aclass'=>'magnum-'.($this->deleted?'undelete':'delete').' magnum-ajax', 'class'=>'glyphicon glyphicon-trash', 'url'=> 'items/delete','data'=>array('id'=>$this->id))),
            'visible'=>array('title'=>'Show / Hide',
                            'params'=>array('aclass'=>'magnum-togglevisibility magnum-ajax', 'class'=>'fa fa-eye', 'url'=> 'items/togglevisibility','data'=>array('id'=>$this->id))),
            //'publish'=>array('title'=>'Publish Item',
            //                'params'=>array('class'=>'glyphicon glyphicon-pushpin', 'url'=> 'content/publish','data'=>array('id'=>$id))),
        ));
        return $tmp;

    }
    
    static function getOptimizedCriteria($preview=0){
        $crit = new CDbCriteria;
        $crit->order = 't.id asc';
        $crit->addCondition('t.active=1');
        $crit->addCondition('t.deleted=0');
        //$crit->with = array('category'=>array('together'=>true,'with'=>array('fields'=>array('together'=>true,'with'=>array('value'=>array('together'=>true),'children'=>array('together'=>true,'with'=>array('value'=>array('alias'=>'value2','together'=>true))))))));
        /*$crit->with =  array(
                                'category'=>array(
                                        'alias'=>'category',
                                        'together'=>true,
                                        'with'=>array(
                                                'fields'=>array('alias'=>'fields',
                                                                'together'=>true,
                                                                //'joinType'=>'right outer join',
                                                                //'on'=>' fields.group = 1 and fields.name=\'Preview specs\' ',
                                                                //'condition'=>' fields.group = 1 and fields.name=\'Preview specs\' ',
                                                                'with'=>array(
                                                                    'children'=>array(
                                                                                    'together'=>true,
                                                                                    //'joinType'=>'right outer join',
                                                                                    'with'=>array(
                                                                                        'value'=>array(
                                                                                            'alias'=>'value2', 
                                                                                            'together'=>true,
                                                                                            'on'=>' value2.items_id=t.id and value2.language='.Yii::app()->db->quoteValue(Yii::app()->controller->Lang),
                                                                                            'condition'=>'value2.language='.Yii::app()->db->quoteValue(Yii::app()->controller->Lang)
                                                                                        )
                                                                                    )
                                                                    ),
                                                                    'value'=>array(
                                                                        'together'=>true,
                                                                        'on'=>'value.items_id=t.id and value.language='.Yii::app()->db->quoteValue(Yii::app()->controller->Lang)
                                                                    )
                                                                )
                                                ),
                                        )
                                ),
                                'brand'=>array('together'=>true),
                                'cleanurls'=>array('together'=>true,'index'=>'language')
                    );*/
        
        if ($preview){
            //unset($crit->with['category']['with']['fields']['on']);
            //unset($crit->with['category']['with']['fields']['condition']);
            
        } else {
            unset($crit->with['category']['with']['fields']['with']['children']);
            
        }
        return $crit;
    }
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'category_id' => 'Category',
            'name' => 'Name',
            'body' => 'Body',
            'brands_id'=>'Brand',
            'color_id' => 'Color',
            'size' => 'Size',
            'price' => 'Price',
            'discount' => 'Discount',
            'pic_name' => 'Pic Name',
            'stock' => 'Stock',
        );
    }
    public function setFilters($attributes){
        for($i=1;$i<=6;$i++){
            $tmp = 'input'.$i;
            if (isset($attributes[$tmp]))
                $this->$tmp = $attributes[$tmp];
            $tmp = 'checkbox'.$i;
            if (isset($attributes[$tmp]))
                $this->$tmp = $attributes[$tmp];
            
        }
        $this->cat = $attributes['cat'];
    }
    public function getStockSum(){
        $sum = 0;
        if (isset($this->stocks) && is_array($this->stocks) && count($this->stocks))
            foreach($this->stocks as $stock)
                $sum+=$stock->stock;
        return $sum;
    }
    public function getColors(){
        $colors = '';
        $colorArr = array();
        if (isset($this->stocks) && is_array($this->stocks) && count($this->stocks))
            foreach($this->stocks as $stock)
                if (!in_array($stock->color->name, $colorArr))
                        $colorArr[] = $stock->color->name;
                //$colors.=$stock->color->name.', ';
         $str = implode(', ', $colorArr);
         return $str;
    }
    public function getPhoto($id){
        if (isset($this->photos) && is_array($this->photos) && isset($this->photos[$id]))
            return '/uploads/items/'.$this->photos[$id]->pic_name;
        else return '/uploads/items/noImage.jpg';
    }
    public function getPhotoItem($id){
        if (isset($this->photos) && is_array($this->photos) && isset($this->photos[$id]))
            return $this->photos[$id];
        else {
            $tmp = new ItemPhotos();
            $tmp->pic_name='noImage.jpg';
            return $tmp;
        }
    }
    public function getStockByNo($i){
        if (isset($this->stocks) && isset($this->stocks[$i]))
            return $this->stocks[$i];
        else return new ItemsStock();
    }
    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->addSearchCondition('category.name',$this->category_id);
        $criteria->addSearchCondition('t.name',$this->name,true);
        $criteria->compare('body',$this->body,true);
        $criteria->addSearchCondition('color.name',$this->color_id);
        $criteria->addSearchCondition('brand.name',$this->brands_id);
        $criteria->compare('size',$this->size,true);
        $criteria->compare('price',$this->price);
        $criteria->compare('discount',$this->discount);
        $criteria->with=array('color','category','brand','stocks');
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public function filters()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=$this->getOptimizedCriteria();

        for($i=1;$i<=6;$i++){
            $tmp1 = 'input'.$i;
            if ($this->$tmp1!=''){
                $this->$tmp1 = Yii::app()->db->quoteValue($this->$tmp1);
                $tmp3 = Yii::app()->controller->settings['filterWidget_input'.$i];
                    $tmp4 = CategoryFieldset::model()->findByAttributes(array('name'=>$tmp3));
                    if ($tmp4)
                        $tmp4 = $tmp4->id;
                    else 
                    throw new CHttpException(500,'Wrong param name');
                //(select i2.id from items i2 left join  items_paramset ip on ip.`items_id`=i2.id where ip.`value`='16 MPX')
                $criteria->addCondition("t.id in (select i2.id from items i2 left join  items_paramset ip on ip.`items_id`=i2.id "
                                                        . "where ip.fieldset_id='{$tmp4}' and "
                                                        . "ip.`value`={$this->$tmp1} and "
                                                        . "ip.language='".Yii::app()->controller->Lang."')");
                //$criteria->compare('paramset.fieldset_id', $tmp4);
                //$criteria->compare('paramset.value', $this->$tmp1);
                //$criteria->compare('paramset.language',Yii::app()->controller->Lang);
            }
            $tmp1 = 'checkbox'.$i;
            if ($this->$tmp1=='on'){
                $tmp3 = Yii::app()->controller->settings['filterWidget_checkbox'.$i];
                    $tmp4 = CategoryFieldset::model()->findByAttributes(array('name'=>$tmp3));
                    if ($tmp4)
                        $tmp4 = $tmp4->id;
                    else 
                    throw new CHttpException(500,'Wrong param name');

            $criteria->addCondition("t.id in (select i2.id from items i2 left join  items_paramset ip on ip.`items_id`=i2.id "
                                                        . "where ip.fieldset_id='{$tmp4}' and "
                                                        . "ip.`value`!='' and "
                                                        . "ip.language='".Yii::app()->controller->Lang."')");
                //$criteria->addCondition('paramset.value!="" and paramset.fieldset_id='. $tmp4,'AND');
                //$criteria->addCondition('','OR');
                $paramset=true;
            }
        }
        
        $criteria->addCondition('t.category_id='.(int)$this->cat);
        $criteria->addCondition('t.active=1');
        $criteria->addCondition('t.deleted=0','AND');
        
        //print_r($criteria);
        if (isset($paramset))
            $criteria->with=array('paramset'=>array('alias'=>'paramset','together'=>true));
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Items the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    function getId(){
        return 'Item'.$this->id;
    }
 
    function getPrice(){
        return $this->price*(1-$this->discount/100);
    }
}

                            