<?php 
    $controller = Yii::app()->controller;
?>
    <ul class="subcategories ">
            <?php if ($this->allLink):?>
                <li >
                    <?php echo CHtml::link(Yii::t('frontend.strings','ALL'), 
                                        $controller->createUrl($controller->action->id,array('id'=>0,'language'=>$controller->Lang,'category'=>$this->category,'view'=>$this->view)),
                                        array('class'=>$this->active?'':'active')
                                        );?>
                </li>
            <?php endif;?>
            <?php $i=0; foreach ($this->items as $model):?>
                <?php if ($model->itemsCount):?>
                <?php endif;?>
                    <li>
                        <?php echo CHtml::link($model->name, 
                                                $controller->createUrl($controller->action->id,array('id'=>$model->id,'language'=>$controller->Lang,'category'=>$this->category,'view'=>$this->view)),
                                                array('class'=>$this->active==$model->id?'active':'')
                                                
                        );?>
                    </li>
            <?php $i++; endforeach;?>
    </ul>


<?php 
$str = <<<JAVASCRIPT
   $('.tabs.front-tabs li a').on('click',function(e){
        $.ajax({
            'url':$(this).attr('href'),
            'dataType':'html',
            'context':$(this),
            'data':{
                'itemWrapHtmlOptions':{
                    'class':$('{$this->update} .items-container>div').attr('class'),
                }
            },
            'type':'post'
        }).done(function(data){
            $('{$this->update}').html(data);
            $('.tabs.front-tabs li a').removeClass('active');
            ind = $(this).parents('.tabs.front-tabs').find(' li a').index($(this))+1;
            $('.tabs.front-tabs li:nth-child('+ind+') a').addClass('active');
        });
        e.preventDefault();
   }); 
JAVASCRIPT;
Yii::app()->getClientScript()->registerScript('front-tabs',$str,CClientScript::POS_READY);
?>