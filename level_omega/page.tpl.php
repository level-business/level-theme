<?php
// $Id: page.tpl.php,v 1.1.2.16 2010/11/16 14:39:39 himerus Exp $
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>

<body class="<?php print $body_classes; ?>">
   <?php if($help || $messages): ?>
    <div id="system_messages">
        <?php print $help; ?>
        <?php print $messages; ?>
    </div><!-- /.container-xx -->
    <?php endif; ?>
  <?php if (!empty($admin)) print $admin; ?>
  <div id="page" class="clearfix">
   <div id="header_container" class="container_4 clearfix">
   <?php //Calculate suffix (TODO: put in preprocess function)
   $header_suffix = 3;
   if ($header_first) { $header_suffix -=2; }
   if ($header_last) { $header_suffix -=1; }
   ?>
    <div id="site-header" class="grid_1 suffix_<?php print $header_suffix; ?> clearfix">
    
      <div id="branding" class="grid-<?php print $header_logo_width; ?>">
        <?php if ($linked_logo_img): ?>
          <?php print $linked_logo_img; ?>
        <?php endif; ?>
        <?php if ($linked_site_name): ?>
          <?php if ($title): ?>
            <h2 id="site-name" class=""><?php print $linked_site_name; ?></h2>
          <?php else: ?>
            <h2 id="site-name" class=""><?php print $linked_site_name; ?></h2>
          <?php endif; ?>
        <?php endif; ?>
      </div><!-- /#branding -->

      <?php if ($main_menu_links || $secondary_menu_links): ?>
        <div id="site-menu" class="grid-<?php print $header_menu_width; ?>">
        <?php if($main_menu_links): ?>
          <div><?php print $main_menu_links; ?></div>
        <?php endif; ?>
        <?php if($secondary_menu_links): ?>
          <div><?php print $secondary_menu_links; ?></div>
        <?php endif; ?>
        </div><!-- /#site-menu -->
      <?php endif; ?>
    </div><!-- /#site-header -->
   
    <?php if($header_first || $header_last): ?>    
      <?php if($header_first): ?>
        <div id="header-first" class="grid_2">
          <?php print $header_first; ?>
        </div><!-- /#header-first -->
      <?php endif; ?>
      <?php if($header_last): ?>
        <div id="header-last" class=" grid_1">
          <?php print $header_last; ?>
        </div><!-- /#header-last -->
      <?php endif; ?>
    <?php endif; ?>
    </div><!--  /#header-container -->
    
    <!-- container splitting left sidebar from the rest of the content -->
    <div class="container_4">
   	   <!--  for the moment the let sidebar is allways there ---> 
   	   
   	     <div id="left_sidebad_container" class="grid_1">
	        <?php 
	        if($left_sidebar) {
	          print $left_sidebar; 
	        }
	        else {
	         print "&nbsp;";
	        }?>
         </div>

  <?php 
    // TODO move to preprocess function
    $content_width = 2;
    //if(!$left_sidebar) $content_width++;
    if(!$right_sidebar) $content_width++;
        ?> 
    <div id="main-content-container"  class="grid_<?php print $content_width; ?> " ><!-- TODO: calculate width depending on block visibility -->
    



    <?php if($site_slogan && $is_front || $search_box || $breadcrumb): ?>
    <div id="internal-nav" class="container-<?php print $internal_nav_wrapper_width; ?> clearfix">
      <div id="slogan-bcrumb" class="grid-<?php print $breadcrumb_slogan_width; ?>">
        <?php if ($site_slogan && $is_front): ?>
          <div id="slogan"><?php print $site_slogan; ?></div><!-- /#slogan -->
        <?php endif; ?>
        <?php if($breadcrumb): ?>
          <div id="bcrumb"><?php print $breadcrumb; ?></div><!-- /#bcrumb -->
        <?php endif; ?>
      </div>
      <?php if ($search_box): ?>
        <div id="search-box" class="grid-<?php print $search_width; ?>"><?php print $search_box; ?></div><!-- /#search-box -->
      <?php endif; ?>
    </div><!-- /#internal-nav -->
    <?php endif; ?>
    
    <?php if($top_bar):
      //top_bar can be used for bold page titles such as company names on the company profile page
    ?>
     <div id="top_bar">
        <?php print $top_bar; ?>
     </div>
    <?php endif; ?>
    <?php if($page_tools):
     // Page tools is a region for tools specific to a page, things such as like or tweet.
    ?>
      <div id="page_tools">
        <?php print $page_tools; ?>
      </div>
    <?php endif; ?>
      <div id="main-wrapper" >
        <?php if (!empty($mission)) {
          print $mission;
        }?>
        <?php if($content_top): ?>
        <div id="content-top">
          <?php print $content_top; ?>
        </div><!-- /#content-top -->
        <?php endif; ?>
        <?php if ($tabs): ?>
          <div id="content-tabs" class=""><?php print $tabs; ?></div><!-- /#content-tabs -->
        <?php endif; ?>
    
        <?php if ($title): ?>
          <h2 class="title" id="page-title"><?php print $title; ?></h2>
        <?php endif; ?>
        <div id="main-content" class="region clearfix ">
          <?php print $content; ?>
        </div><!-- /#main-content -->
        
        <?php if($content_bottom): ?>
        <div id="content-bottom">
          <?php print $content_bottom; ?>
        </div><!-- /#content-bottom -->
        <?php endif; ?>
      </div><!-- /#main-wrapper -->
 </div>    
	<?php if($right_sidebar): ?>
          <div id="right_sidebar" class="grid_1">
	    <?print $right_sidebar ?>
          </div>
        <?php endif;?> 
    </div> <!-- /container -->    
    <div id="footer-wrapper" class="container_4 clearfix">
    </div><!--  /footer -->
    
  </div><!-- /#page -->
  <?php print $closure; ?>
</body>
</html>
