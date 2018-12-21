<!-- <meta name="fragment" content="!"> -->
<?php
    //$this->breadcrumbs = array($title);
?>

<!-- <div class="pull-right">
	<div id="breadCrumb">
	    <?php if(isset($this->breadcrumbs)):?>
	        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
	            'links'=>$this->breadcrumbs,
	            'tagName'   =>'ol itemscope itemtype="http://schema.org/BreadcrumbList"', // container tag
	            'htmlOptions' =>array(), // no attributes on container
	            'separator'=>' <li><svg class="icon-angle-right"><use xlink:href="#icon-angle-right"></use></svg> </li>',
	            'homeLink'    =>'<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
	                             <a itemprop="item" href="/"><span itemprop="name">Kibrit</span></a>
	                             <meta itemprop="position" content="1" /></li></li>', // home link template
	            'activeLinkTemplate'  =>'<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
	                                     <a itemprop="item" href="{url}"><span itemprop="name">{label}</span></a>
	                                     <meta itemprop="position" content="{itemcount}" /></li>', //active link template
	            'inactiveLinkTemplate'  =>'<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="selected"><a itemprop="item" > <span itemprop="name">{label}</span></a>
	                        <meta itemprop="position" content="{itemcount}" /></li>', // in-active link template
	        )); ?>
	    <?php endif;?>
	</div>
</div> -->
<h1><?php echo $title; ?></h1>

<?php echo $blockContent; ?>


<?php if($keyword != "onepoint"):?>
<button class="download-presentation-btn" style="border: solid 2px #fe9901;">
<a href="/files/presentations/<?php echo $keyword; ?>/<?php echo $this->Lang; ?>/presentation.pdf" target="_blank"> <?php echo Yii::t("frontend.strings","Download presentation");?></a>
</button>
<?php endif;?>
<br>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<!-- <div class="addthis_inline_share_toolbox"></div> -->