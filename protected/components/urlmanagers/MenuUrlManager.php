<?php
class MenuUrlManager extends CBaseUrlRule
{
    public $connectionID = 'db';
 
    public function createUrl($manager,$route,$params,$ampersand)
    {
        if ($route==='site/goto' && isset($params['id']))
        {
            $item = Menus::model()->cache(3600)->with(array('translations'=>array('alias'=>'translations', 'together'=>true)))->findByPk($params['id']);
            
            
            if ($item){
                //$category = Cleanurls::getUrlOrSave($item,$item->getTranslation($params['language'])->name?$item->getTranslation($params['language'])->name:'',$params['language']);
                $lang = Yii::app()->controller->Lang;
                return $params['language'].'/menus/'.$item->id.'/'.Utilities::str2url($item->getTranslation($lang)->name?$item->getTranslation($lang)->name:'');
            }
        }
        return false;  // this rule does not apply
    }
 
    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {
        if (preg_match('%^(\w+)(/(\w+))(/(\d+))(/(\w+))?$%', $pathInfo, $matches) && count($matches)==8 && ($matches[3]==='menus'))
        {
            /*if ($url = Cleanurls::model()->findByAttributes(array('url'=>$matches[5],'language'=>$matches[1]))){
                $Model = $url->type;
                $item = $Model::model()->findByPk($url->parent_id);
            }
            else return false;
            if (!$item)
                return false;*/
            $_GET['id'] = $matches[5];
            $_GET['language'] = $matches[1];
            return 'site/goto';
            
            // check $matches[1] and $matches[3] to see
            // if they match a manufacturer and a model in the database
            // If so, set $_GET['manufacturer'] and/or $_GET['model']
            // and return 'car/index'
        }
        return false;  // this rule does not apply
    }
}

?>