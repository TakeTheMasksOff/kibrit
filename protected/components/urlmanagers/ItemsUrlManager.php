<?php
class ItemsUrlManager extends CBaseUrlRule
{
    public $connectionID = 'db';
 
    public function createUrl($manager,$route,$params,$ampersand)
    {
        if ($route==='site/item' && isset($params['id']) && isset($params['url']) && isset($params['category']) && isset($params['brand']))
        {
           /* $item = Items::model()->cache(3600)->with(
                                                        array('category'=>array(
                                                                        'together'=>true,'with'=>array(
                                                                                            'translations'=>array(
                                                                                                    'alias'=>'cat_translations', 'together'=>true,
                                                                                                    'join'=>' and cat_translations.language='.Yii::app()->db->quoteValue($params['language'])
                                                                                        )
                                                                                        )),'brand'=>array('together'=>true),
                                                                                        'translations'=>array(
                                                                                            'together'=>true,
                                                                                            'join'=>' and translations.language='.Yii::app()->db->quoteValue($params['language'])
                                                                                        )
                                                            )
                                                    )->findByPk($params['id']);
            
            
            if ($item && $item->category){
                $category = Cleanurls::getUrlOrSave($item->category,$item->category&&$item->category->getTranslation($params['language'])->name?$item->category->getTranslation($params['language'])->name:$item->category->name,$params['language']);
                $brand = Cleanurls::getUrlOrSave($item->brand,$item->brand->name,$params['language']);
                $item = Cleanurls::getUrlOrSave($item,($item->getTranslation($params['language'])->name?$item->getTranslation($params['language'])->name:$item->name),$params['language']);
                
            }
            * 
            */
            return $params['language'].'/catalogue/'.$params['category'].'/'.$params['brand'].'/'.$params['url'];
        }
        return false;  // this rule does not apply
    }
 
    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {
        if (preg_match('%^(\w+)(/(\w+))(/(\w+))(/(\w+))(/(\w+))?$%', $pathInfo, $matches) && count($matches)==10 && $matches[3]==='catalogue')
        {
            if ($url = Cleanurls::model()->findByAttributes(array('url'=>$matches[9],'language'=>$matches[1]))){
                $Model = $url->type;
                $item = $Model::model()->findByPk($url->parent_id);
            }
            else return false;
            if (!$item)
                return false;
            $_GET['id'] = $item->id;
            $_GET['language'] = $matches[1];
            return 'site/item';
            
            // check $matches[1] and $matches[3] to see
            // if they match a manufacturer and a model in the database
            // If so, set $_GET['manufacturer'] and/or $_GET['model']
            // and return 'car/index'
        }
        return false;  // this rule does not apply
    }
}

?>