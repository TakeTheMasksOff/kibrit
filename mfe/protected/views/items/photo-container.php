
        <?php if (isset($model->photos)):?>
                <?php foreach($model->photos as $img):?>
                    <div class="col-xs-6 col-sm-4 col-md-3 mt10 photo-block">
                        <div class="blog-item sortable" data-sortable="<?php echo $img->id;?>">
                            <div class="blog-photo">
                                <img src="/uploads/items/<?php echo $img->pic_name;?>" class="img-responsive" alt="">
                            </div>
                          <div class="blog-details">
                            <ul class="blog-meta">
                                <li><?php echo (file_exists(Yii::app()->basePath.'/../../uploads/items/'.$img->pic_name)?  ceil(filesize(Yii::app()->basePath.'/../../uploads/items/'.$img->pic_name)/1024):0);?> Kb</li>
                                <li><?php echo date('d/m/Y',  strtotime($img->created_date));?></li>
                                <li>By: <?php echo Users::model()->findByPk($img->created_by)->uname;?></li>
                                <li><a class="delete-button delete" href="<?php echo $this->createUrl('items/deleteImg',array('id'=>$img->id));?>">Delete</a></li>
                            </ul>
                          </div>
                          <div class="blog-content">
                                    <?php 
                                          $ld = array();
                                          foreach($model->stocks as $stock){
                                              $ld[$stock->color_id] = $stock->color->name;
                                          }
                                    ?>
                                    <?php echo CHtml::dropDownList('color', $img->color_id, $ld, 
                                                        array(
                                                            'empty'=>'Select Color',
                                                            'class'=>"form-control photocolorselector",
                                                            'data-action-href'=>$this->createUrl('items/changeImgColor',array('id'=>$img->id)),
                                                        ));?>
                          </div>
                        </div><!-- blog-item -->
                    </div>        
                <?php endforeach;?>
        <?php endif;?>
