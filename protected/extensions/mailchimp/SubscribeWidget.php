<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class SubscribeWidget extends CWidget {
 
    public $Lang='az';
    public function run() {
    $str=<<<JAVASCRIPT
            $('form.subscribe').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url:$(this).attr('action'),
                    type:'get',
                    data:{
                            ajax:1,
                            email:$(this).find('input[type="text"]').val(),
                        },
                    dataType:'json',
                    success:function(data){
                            if (data.message == 'subscribe_ok' || data.message == 'pending' || data.message == 'subscribed'){ 
                                $('form.subscribe input[type="text"]').val('');
                                $('form.subscribe input[type="text"]').attr('disabled','');
                                $('form.subscribe input[type="text"]').attr('placeholder',data.message_translation);
                            }
                        },
                });
            });
JAVASCRIPT;
    Yii::app()->clientScript->registerScript('subscribeAjax',$str,CClientScript::POS_READY);
    
        $this->render('SubscribeWidgetView');
    }
 
}
?>
