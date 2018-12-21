<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MailChimpAction extends CAction{
    public function run(){
        $controller= $this->getController();
        $email = Yii::app()->getRequest()->getParam('email',null);
        Yii::import('application.extensions.mailchimp.Mailchimp');

        $master = new Mailchimp($controller->getSetting('mailchimp_apikey'));
        $list = new Mailchimp_lists($master);
        $tmp2 = $list->memberInfo($controller->getSetting('mailchimp_list_id'), array(array('email'=>$email)));  
        if (isset($tmp2['data'][0]['error'])){}
        else if (isset($tmp2['data'][0]['status'])){
            $message['message'] = $tmp2['data'][0]['status'];
            $message['message_translation'] = Yii::t('frontend.strings',$message['message']);
            echo CJSON::encode($message); 
            Yii::app()->end();
        }
        try {
            $tmp = $list->subscribe($controller->getSetting('mailchimp_list_id'), array('email'=>$email));         
        } catch (Exception $exc) {
            $message['message']=$exc->getMessage ();
        }  
        if (isset($tmp)){
            $message['message'] = 'subscribe_ok';
        }
        $message['message_translation'] = Yii::t('frontend.strings',$message['message']);
        echo CJSON::encode($message);
    }
}