<?php
class NewsUrlManager extends CBaseUrlRule
{
    public $connectionID = 'db';
 
    public function createUrl($manager,$route,$params,$ampersand)
    {
        if ($route==='site/article' && isset($params['id']))
        {
            
            $lang = Yii::app()->controller->Lang;
            
            $item = Articles::model()->cache(3600)->with(array('translations'=>array('alias'=>'translations', 'together'=>true)))->findByPk($params['id']);
            $article = Cleanurls::getUrlOrSave($item,$item->getTranslation($lang)->name?$item->getTranslation($lang)->name:'',$lang);
            
            if ($item && isset($item->translations['en']))
                return $params['language']."/blog/".$article;
                // return $params['language']."/article/".date('Y/m/d/',strtotime($item->date)).$item->id.'/'.$article;
        }
        return false;  // this rule does not apply
    }
 
    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {
        if (preg_match('%^(\w+)(/(\w+))(/(\d+))(/(\d+))(/(\d+))(/(\d+))(/(\w+))?$%', $pathInfo, $matches) && count($matches) && $matches[3]==='blog')
        {
            $modelname = '';
            if (isset($matches[11])){
                $crit = new CDbCriteria();
                $item = Articles::model()->findByPk($matches[11]);
            }
            else return false;
            if (!$item)
                return false;
            $_GET['id'] = $item->id;
            $_GET['language'] = $matches[1];
            return 'site/blog';
            
            // check $matches[1] and $matches[3] to see
            // if they match a manufacturer and a model in the database
            // If so, set $_GET['manufacturer'] and/or $_GET['model']
            // and return 'car/index'
        }
        return false;  // this rule does not apply
    }
}

?>