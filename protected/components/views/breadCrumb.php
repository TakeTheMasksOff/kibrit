<div id="breadCrumb">
    <?php

    $lastCrumb = array_pop($this->crumbs);
    
    foreach($this->crumbs as $crumb) {
        
            echo CHtml::link($crumb['name'], $crumb['url']);

        echo $this->delimiter;

    }
    echo $lastCrumb['name'];
    ?>
</div>