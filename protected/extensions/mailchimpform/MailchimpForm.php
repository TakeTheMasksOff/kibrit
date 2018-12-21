<?php
/**
 * Yii mailchimp form
 *
 * @author Marc Oliveras Galvez <oligalma@gmail.com> 
 * @link http://www.oligalma.com
 * @copyright 2016 Oligalma
 * @license New BSD License
 */
 
class MailchimpForm extends CWidget
{
    public $apiKey;
    public $listId;
    public $showName;
    
	public function run()
	{
        $assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('ext.mailchimpform.assets'));
            
		Yii::app()->clientScript->registerCssFile($assetsUrl . '/style.css');
        
        if(isset($_POST['subscribe-submit']))
        {
            if(!empty($_POST['subscribe-email']) && (!$this->showName || (!empty($_POST['subscribe-first-name']) && !empty($_POST['subscribe-last-name']))))
            {                
                require __DIR__ . '/lib/Mailchimp.php';
                
                $api_key = $this->apiKey;
                $list_id = $this->listId;
                $email = array('email' => $_POST['subscribe-email']);

                if($this->showName)
                    $merge_vars = array('FNAME' => $_POST['subscribe-first-name'],'LNAME' => $_POST['subscribe-last-name']);
                else
                    $merge_vars = array();
                
                $email_type = 'html';
                $double_optin = true;
                
                $Mailchimp = new Mailchimp($api_key);
                $Mailchimp_Lists = new Mailchimp_Lists($Mailchimp);
                
                try
                {
                    $subscriber = $Mailchimp_Lists->subscribe($list_id, $email, $merge_vars, $email_type, $double_optin);
                }
                catch(Exception $e)
                {
                    $message = CHtml::tag('span', array('class' => 'subscribe-red'), $e->getMessage());   
                }
                
                if (!empty($subscriber['leid'])) {
                   $message = CHtml::tag('span', array('class' => 'subscribe-green'), 'You have been subscribed successfully.');
                }
            }
            else
            {
                $message = CHtml::tag('span', array('class' => 'subscribe-red'), 'You need to fill all fields.');  
            }
        }
        




        echo CHtml::tag('div', array('class' => 'subscribe-helper mb20'), Utilities::t('subscribeToBlog'));


        // echo CHtml::openTag('div', array('id' => 'subscribe-div'));

        if(isset($message))
            echo CHtml::tag('div', array('id' => 'subscribe-message'), $message);
        
        echo CHtml::beginForm('','post',array('class'=>'navbar-form subscribe'));
        // echo CHtml::tag('span', array('class' => 'subscribe-label'), 'Email');
        echo CHtml::emailField('subscribe-email', (empty($_POST['subscribe-email']) ? '' : $_POST['subscribe-email']), array('required' => 'required','placeholder'=>Utilities::t('Your mail')));
            

        // if($this->showName)
        // {
        //     echo CHtml::tag('span', array('class' => 'subscribe-label'), 'First name');
        //     echo CHtml::textField('subscribe-first-name',(empty($_POST['subscribe-first-name']) ? '' : $_POST['subscribe-first-name']), array('required' => 'required'));
        //     echo CHtml::tag('span', array('class' => 'subscribe-label'), 'Last name');
        //     echo CHtml::textField('subscribe-last-name',(empty($_POST['subscribe-last-name']) ? '' : $_POST['subscribe-last-name']), array('required' => 'required'));
        // }
            
     //   echo CHtml::button('Ok', array('name' => 'subscribe-submit', 'class' => 'subscribe-submit'));   
        echo CHtml::tag('button', array('name' => 'subscribe-submit', 'type'=>'submit'), 'Ok');

        echo CHtml::endForm();  
 
      //  echo CHtml::closeTag('div');
	}
}