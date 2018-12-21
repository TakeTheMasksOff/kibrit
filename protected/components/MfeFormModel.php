<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class MfeFormModel extends CFormModel
{
        public $ip;
        
        public function beforeValidate() {
            parent::beforeValidate();
            if (isset($_POST[get_class($this)])){
                $this->attributes = $_POST[get_class($this)];
            }
            $this->ip = $_SERVER['REMOTE_ADDR'];
            if (!isset($_POST[get_class($this)]))  return false;
            return true;
        }
        public function render(){
            
            $str = "<div class='contactform'>";
            foreach ( $this->attributes as $attr=>$val ){
                if ($this->$attr){
                    $str .= '<div class="row">';
                    $str.="<span class='label'>".$this->getAttributeLabel($attr)." : </span>";
                    $str.="<span class='value'>".$this->$attr."</span>";
                    $str.="</div>";
                }
            }
            $str .= '</div>';
            return $str;
        }
        public function textRender(){
            $str = "";
            
            foreach ( $this->attributes as $attr=>$val ){
                if ($this->$attr){                
                    $str.="".$this->getAttributeLabel($attr)." : ";
                    $str.="".$this->$attr."\n\r";
                }
            }
            return $str;
        }        
        public function send(){
            $mailer = Yii::app()->mandrill;
            // $matches  = explode(',', Yii::app()->controller->getSetting('adminEmail','ruslan.salimov@kibrit.tech'));
            // if (count($matches)){
            //     $mailData['to']= array();
            //     $i=0;
            //     foreach($matches as $email){
            //         $mailData['to'][$i]['email']=$email;
            //         $mailData['to'][$i]['name']=$email;
            //         $mailData['to'][$i]['type']='to';
                    
            //         $i++;
            //     }
            // } else 
                $mailData['to_email'] = Yii::app()->controller->getSetting('adminEmail','ruslan.salimov@kibrit.tech');
            
            $mailData['subject'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].' mailer';
            $mailData['html'] = $this->render();
            $mailData['text'] = $this->textRender();
            $result = $mailer->sendMessage($mailData);
            if (is_array($result) && ($result[0]->status=='sent' || $result[0]->status=='queued')){
                return true;
            } 
            else {
                return false;
            }
        }
}
