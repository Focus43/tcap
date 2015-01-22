<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
<!DOCTYPE HTML>
<html>
<head>

    <?php  Loader::element('header_required'); ?>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,900' rel='stylesheet' type='text/css'>
	<?php  echo $html->css($view->getStylesheet('iGotStyle.less'))?>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0,  maximum-scale=1.0, user-scalable=no">
	
</head>

<body id="page<?php  echo $c->getCollectionID();?>">

<div class="<?php  echo $c->getPageWrapperClass()?>">
	
	<header id="siteHeader">
	    
	    <div id="searchShell">
	        
	        <div class="container">
	            
	            <?php  $a = new GlobalArea('Search'); $a->display(); ?>
	            
	        </div>
	        
	    </div>
	
        <div class="container">
            
            <div class="row">
        
    	        <div id="logo" class="col-xs-6 col-md-3">
    	        
    	            <?php  $a = new GlobalArea('Logo'); $a->display(); ?>
    	        
    	        </div><!-- #logo -->
    		        
		        <nav id="mainNav" class="clearfix hidden-xs hidden-sm col-sm-9">
		        
		            <?php  $a = new GlobalArea('Header Nav'); $a->display(); ?>
		            
		            <i class="fa fa-search btnSearchIcon hidden-xs"></i>
		
		        </nav>
		        
		        <div id="mobileAssets" class="col-xs-6 visible-xs-block visible-sm-block text-right">
                    
                    <div id="icoMobileNav"><i class="fa fa-bars"></i></div>
                
                </div><!-- #mobileAssets -->
	        
	        </div><!-- .row -->
	              
        </div><!-- .container -->             
	                	
	</header>