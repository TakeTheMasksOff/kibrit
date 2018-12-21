<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class BrandsABC extends CWidget {
 
    public $items = array();
    public $nav=0;
    public $Lang;
    public function run() {
        $this->Lang = Yii::app()->controller->Lang;
        $tmp = array();
        foreach($this->items as $model):
        if (isset($model->brand) &&
            (!isset($tmp[ucfirst(mb_substr($model->brand->name, 0,1,'UTF-8'))]) || 
             !array_key_exists($model->brand->name, $tmp[ucfirst(mb_substr($model->brand->name, 0,1,'UTF-8'))])
            )
        )
            $tmp[ucfirst(mb_substr($model->brand->name, 0,1,'UTF-8'))][$model->brand->name] = $model;
    
        endforeach;
        ksort($tmp);
        $this->render('BrandsABC',array('lang'=>$this->Lang,'tmp'=>$tmp));
    }
}
?>
