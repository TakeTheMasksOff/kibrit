<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MfeMissingTranslationHandler
 *
 * @author sahil1
 */
class MfeMissingTranslationHandler {
    //put your code here
    static function handleMissingTranslation($event){
        $text = implode('<br>', array(
            'Language: '. $event->language,
            'Category: '.$event->category,
            'Message: '.$event->message
        ));
//        $model=null;
//        if (defined('YII_DEBUG'))
//        $model = SourceMessage::model()->findAllByAttributes(array(
//                                                                    'category'=>$event->category,
//                                                                    'message'=>$event->message
//                                                                ));
//        if (defined('YII_DEBUG') && !$model){
//          $model = new SourceMessage();
//          $model->category = $event->category;
//          $model->message = $event->message;
//          $model->save();
//          mail('support@wilsa.net','missing translations',$text);
//        }
    }
}
