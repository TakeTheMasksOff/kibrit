<?php 
    $controller = Yii::app()->controller;
?>
<div class="subscribe-helper mb20">
    <?php echo Utilities::t('Sign up for email updates about upcoming events and special offers.');?>
</div>
<form class="navbar-form navbar-right subscribe" action="<?php echo $controller->createUrl('site/mailchimp',array('language'=>$controller->Lang));?>" role="search">
    <input type="text" class=" subscribe-text" placeholder="<?php echo Utilities::uppercase(Utilities::t('Your email'));?>">
    <button class="">OK</button>
</form>
