<?php
class BrandUrlManager extends CBaseUrlRule
{
    public $connectionID = 'db';
 
    public function createUrl($manager,$route,$params,$ampersand)
    {
        $category ='';
        if ($route==='site/brand' && isset($params['id']) && isset($params['url']))
        { 
            //$item = Brands::model()->cache(3600)->with()->findByPk($params['id']);
            $brand = $params['url'];
            if (isset($params['category'])&& $cat = Category::model()->with()->findByPk($params['category']))
                $category = Cleanurls::getUrlOrSave($cat,$cat->getTranslation($params['language'])->name?$cat->getTranslation($params['language'])->name:$cat->name,$params['language']);
            //if ($item){
                //$brand = Cleanurls::getUrlOrSave($item,$item->name,$params['language']);
                
                return $params['language'].'/'.($category?'category':'brand').'/'.($category?$category.'/':'').$brand;
            //}
        }
        return false;  // this rule does not apply
    }
 
    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {
        if (preg_match('%^(\w+)(/(\w+))(/(\w+))(/(\w+))?$%', $pathInfo, $matches) && count($matches)==8 && $matches[3]==='catalogue')
        {
            if ($url = Cleanurls::model()->findByAttributes(array('url'=>$matches[7],'language'=>$matches[1]))){
                $Model = $url->type;
                $item = $Model::model()->findByPk($url->parent_id);
            }
            if (!$item)
                {}
            else {
                $_GET['id'] = $item->id;
                $_GET['language'] = $matches[1];
                return 'site/brand';
            }
            // check $matches[1] and $matches[3] to see
            // if they match a manufacturer and a model in the database
            // If so, set $_GET['manufacturer'] and/or $_GET['model']
            // and return 'car/index'
        }
        if (preg_match('%^(\w+)(/(\w+))(/(\w+))?$%', $pathInfo, $matches) && count($matches)==6 && $matches[3]==='brand')
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
            return 'site/brand';
            
            // check $matches[1] and $matches[3] to see
            // if they match a manufacturer and a model in the database
            // If so, set $_GET['manufacturer'] and/or $_GET['model']
            // and return 'car/index'
        }
        return false;  // this rule does not apply
    }
}

?>