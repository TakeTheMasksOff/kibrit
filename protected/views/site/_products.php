<!-- <div class="pull-right">
	<div id="breadCrumb">
	    <?php if(isset($this->breadcrumbs)):?>
	        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
	            'links'=>$this->breadcrumbs,
	            'tagName'   =>'ol itemscope itemtype="http://schema.org/BreadcrumbList"', // container tag
	            'htmlOptions' =>array(), // no attributes on container
	            'separator'=>' <li><span class="delimeter"></span></li>',
	            'homeLink'    =>'<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
	                             <a itemprop="item" href="/"><span itemprop="name">Kibrit</span></a>
	                             <meta itemprop="position" content="1" /></li></li>', // home link template
	            'activeLinkTemplate'  =>'<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
	                                     <a class="text-white" itemprop="item"  href="{url}"><span itemprop="name">{label}</span></a>
	                                     <meta itemprop="position" content="{itemcount}" /></li>', //active link template
	            'inactiveLinkTemplate'  =>'<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="selected"><a class="text-white" itemprop="item" > <span itemprop="name">{label}</span></a>
	                        <meta itemprop="position" content="{itemcount}" /></li>', // in-active link template
	        )); ?>
	    <?php endif;?>
	</div>
</div> -->
<h1><?php echo $title; ?></h1>

<?php echo $blockContent; ?>

<?php if($keyword != "onepoint"):?>
<button class="outlined-btn full">
    <a href="/files/presentations/<?php echo $keyword; ?>/<?php echo $this->Lang; ?>/presentation.pdf" target="_blank">
        <?php echo Yii::t("frontend.strings","Download presentation");?></a>
</button>
<?php endif;?>
<br>
<?php
    //$this->breadcrumbs = array($title);
?>