<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php  if (!empty($this->pageDescription)){echo '<meta name="description" content="' . $this->pageDescription . '" />';}?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?//php print_r(Yii::app()->getController()->getAction()->controller->action->id) ?>
        <link rel="alternate" hreflang="az" href="http://kibrit.tech/az<?=(Yii::app()->getController()->getAction()->controller->action->id != "" && Yii::app()->getController()->getAction()->controller->action->id != 'index') ? '/'.Yii::app()->getController()->getAction()->controller->action->id : '';?>" />
        <link rel="alternate" hreflang="en" href="http://kibrit.tech/en<?=(Yii::app()->getController()->getAction()->controller->action->id != "" && Yii::app()->getController()->getAction()->controller->action->id != 'index') ? '/'.Yii::app()->getController()->getAction()->controller->action->id : '';?>" />
        <link rel="alternate" hreflang="ru" href="http://kibrit.tech/ru<?=(Yii::app()->getController()->getAction()->controller->action->id != "" && Yii::app()->getController()->getAction()->controller->action->id != 'index') ? '/'.Yii::app()->getController()->getAction()->controller->action->id : '';?>" />
        <title><?=(is_array($this->pageTitle)?implode(' | ', $this->pageTitle):$this->pageTitle);?></title>
        

        <meta property="og:locale" content="<?=$this->Lang;?>" /> 
        <meta property="og:title" content="<?=(is_array($this->pageTitle)?implode(' - ', $this->pageTitle):$this->pageTitle);?>" /> 
        <meta property="og:description" <?php if (!empty($this->pageDescription)){echo 'content="' . $this->pageDescription . '"';}?>/> 
        <meta property="og:url" content="<?=Yii::app()->request->hostInfo.Yii::app()->request->url?>" /> 
        <meta property="og:image" content="http://kibrit.tech/assets/images/about.jpg" />
        <!--  ShareThis BEGIN -->
        <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5c5059da058f100011a5b26d&product=sticky-share-buttons' async='async'></script>
        <!--  ShareThis END -->
        <meta name="google-site-verification" content="d3lYmjqI7ptbWGYQF2MS6ibRQlMnibLLv76fz9Jk25w" /> <!-- for Google Search Console. Verification-->

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-W854RGQ');</script>
        <!-- End Google Tag Manager -->

        <!-- Custom styles for this template -->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if IE]>
          <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="<?php echo $this->bodyClass;?>">

        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W854RGQ"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=157829294269656";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <?=$content;?>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="icon-angle-right" viewBox="0 0 512 512">
              <path d="m335 274c0 3-1 5-3 7l-133 133c-2 2-5 3-7 3-2 0-5-1-7-3l-14-14c-2-2-3-4-3-7 0-2 1-5 3-6l112-113-112-112c-2-2-3-4-3-7 0-2 1-4 3-6l14-14c2-2 5-3 7-3 2 0 5 1 7 3l133 133c2 2 3 4 3 6z"/>
            </symbol>
        </svg>

        <script type="application/ld+json"> { 
                "@context" : "http://schema.org", 
                "@type" : "Organization", 
                "name" : "Kibrit", 
                "url" : "http://kibrit.tech", 
                "sameAs" : [   
                "https://www.facebook.com/kibrit.tech",   
                "https://www.linkedin.com/company/kibrit"
                ] 
            } 
        </script> 

        <script type="application/ld+json">  {    
                "@context": "http://schema.org",    
                "@type": "Organization",    
                "url": "http://kibrit.tech",    
                "logo": "http://kibrit.tech/assets/images/kibrit_logo.png"  
            } 
        </script>
    </body>
</html>