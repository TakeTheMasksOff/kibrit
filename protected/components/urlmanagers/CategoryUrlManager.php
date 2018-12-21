<?php
class CategoryUrlManager extends CBaseUrlRule
{
    public $connectionID = 'db';
 
    public function createUrl($manager,$route,$params,$ampersand)
    {
        if ($route==='site/main' && isset($params['id'])&& isset($params['url']))
        {
            $with = array('translations'=>array('together'=>true));
            //$item = Category::model()->cache(3600)->with($with)->findByPk($params['id']);
            
            $category = $params['url'];
            //if ($item){
                //$category = Cleanurls::getUrlOrSave($item,$item->getTranslation($params['language'])->name?$item->getTranslation($params['language'])->name:$item->name,$params['language']);
                
            //}
            return $params['language'].'/main/'.$category;

        }
        if ($route==='site/extras' && isset($params['id']))
        {
            $item = Items::model()->cache(3600)->with()->findByPk($params['id']);
            
            
            if ($item ){
                $category = Cleanurls::getUrlOrSave($item,$item->getTranslation($params['language'])->name?$item->getTranslation($params['language'])->name:$item->name,$params['language']);
                
                return $params['language'].'/extras/'.$category;
            }
        }
        return false;  // this rule does not apply
    }
 
    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {
        if (preg_match('%^(\w+)(/(\w+))(/(\w+))?$%', $pathInfo, $matches) && count($matches)==6 && ($matches[3]==='main' || $matches[3]=='extras'))
        {
            if ($url = Cleanurls::model()->findByAttributes(array('url'=>$matches[5],'language'=>$matches[1]))){
                $Model = $url->type;
                $item = $Model::model()->findByPk($url->parent_id);
            }
            else return false;
            if (!$item)
                return false;
            $_GET['id'] = $item->id;
            $_GET['language'] = $matches[1];
            return 'site/'.$matches[3];
            
            // check $matches[1] and $matches[3] to see
            // if they match a manufacturer and a model in the database
            // If so, set $_GET['manufacturer'] and/or $_GET['model']
            // and return 'car/index'
        }
        return false;  // this rule does not apply
    }
}

?>