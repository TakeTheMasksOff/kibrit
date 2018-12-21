<?php
class BreadCrumb extends CWidget {

    public $crumbs = array();
    public $newCrumb = array();
    public $delimiter = ' <svg class="icon-angle-right"><use xlink:href="#icon-angle-right"></use></svg> ';
    public $hideCrumbsOnHome = true;
    public $firstCrumbName = false;
    public $firstCrumb = array('Home' => array('name' => 'Home', 'url' => array()));
    public $excludeCrumbs = array('Login');
    public $crumbs2Show = 4;
    public $truncatedCrumb = array('Truncated' => array('name' => '…'));


    public function run() {
        $session_crumb=array();
        // if home url is not supplied, use application base url
        if (count($this->firstCrumb['Home']['url'])==0)
            $this->firstCrumb['Home']['url'] = Yii::app()->UrlManager->baseUrl."/";

        if ($this->firstCrumbName) $this->firstCrumb['Home']['name']=$this->firstCrumbName;

        // Breadcrumbs are a way back to to the homepage so dump
        // the crumbs if we find ourselves back on the homepage
        $homepageRoutes = array('/index.php', '/'.Yii::app()->defaultController.'/list', '/');
        
        if ( in_array($this->newCrumb['url'][0], $homepageRoutes)) {
            unset ($session_crumb['crumbs']);

            // If desired, don't show the lone Home crumb on
            // the homepage
            if ($this->hideCrumbsOnHome) {
                return;
            }
        }

        // Place the homepgage anchor crumb in the first position
        $this->crumbs = $this->firstCrumb;

        // Some pages, such as Login, we don't want in the list, so
        // let's exclude them
        if ( !in_array($this->newCrumb['name'], $this->excludeCrumbs)) {

            $newCrumbKey = $this->newCrumb['name'];

            if (!key_exists('crumbs', $session_crumb)) $session_crumb['crumbs'] = array();

            // If we have an existing crumb list, check to see whether
            // the new crumb is already in the list. If so, dump all the
            // crumbs from that crumb position to the end of the list. The
            // purpose of this is to keep the list clean of duplicates.
            if ( sizeof($session_crumb['crumbs']) > 0 ) {
                if ( array_key_exists($newCrumbKey, $session_crumb['crumbs'])) {

                    $offset = $this->array_offset($session_crumb['crumbs'], $newCrumbKey);
                    $session_crumb['crumbs'] = array_slice( $session_crumb['crumbs'], 0, $offset, true);

                }
            }

            // Handle UrlManager->urlSuffix case
            $this->newCrumb['url'][0] = rtrim($this->newCrumb['url'][0], Yii::app()->UrlManager->urlSuffix);
            // Finally add the new crumb to the end of the list
            $session_crumb['crumbs'][$newCrumbKey]=$this->newCrumb;

            // If we have more crumbs than we want to display, we'll evict the
            // oldest crumbs from the list. Plus we'll show a truncated crumb
            // so the user has a visual indicator that we are truncating.
            if (sizeof($session_crumb['crumbs']) > $this->crumbs2Show ) {
                array_shift($session_crumb['crumbs']) ;
                $this->crumbs = array_merge($this->crumbs, $this->truncatedCrumb);
            }
        }

        // Ok, we've build the crumb list prefix with the Home crumb and possibly
        // the Truncated crumb. Now lets add the user's crumbs.
        if ( sizeof($session_crumb['crumbs']) > 0 ) {
            $this->crumbs = array_merge($this->crumbs, $session_crumb['crumbs']);
        }

        // display!
        $this->render('BreadCrumb');
    }

    /**
     * Find the integer position of the offset key in the array
     * @param array $array
     * @param string $offset_key
     * @return int
     */
    public function array_offset($array, $offset_key) {
        $offset = 0;
        foreach($array as $key=>$val) {
            if($key == $offset_key)
                return $offset;
            $offset++;
        }
        return -1;
    }
}
?>