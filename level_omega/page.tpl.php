<?php
// $Id: page.tpl.php,v 1.1.2.16 2010/11/16 14:39:39 himerus Exp $
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml"
      xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
<meta http-equiv="X-UA-Compatible" content="IE=8" />
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>
  <meta name="google-site-verification" content="pZgSESN5QxVKkNG8sfYvuTkAG_sSYMh6IyN0em74Gso" />
  <meta property="og:site_name" content="Level Business" />
  <meta property="fb:app_id" content="206040062739797" />
  <meta property="og:image" content="http://<?php print $_SERVER['HTTP_HOST'] . '/' . drupal_get_path('theme','level_omega'); ?>/images/level_fb_like.png" />  
  <?php 
  // TODO: add fb_app id and fb_admins as system variables 
  // TODO, we can get some of the types from the SIC code for bars, hotes etc. 
  // TODO move this to a seperate module
    if (arg(1) == 'company') {
      global $base_root;
      $path = $base_root . request_uri();
      
      print '<meta property="og:type" content="company" />';
      print '<meta property="og:title" content="'. trim($title) . '" />';
     // TODO: change this to be just http://levelbusiness.com
      print '<meta property="og:url" content="http://'. $_SERVER['HTTP_HOST'] . request_uri() .'" />';
    }
  ?> 
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
  <div id="header_container" class="container_4">
    <div id="site-header" class="grid_4 ">
      <div id="branding" class="grid_1 alpha omega">
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
       <?php /* When needed insert other drupal header things here */ ?>

    </div>
  </div>
                

  <div id="content" class="container_4">

    <div id="left_sidebar" class="grid_1 ">
      <?php 
	        if($left_sidebar) {
	          print $left_sidebar; 
	        }
	        else {
	         print "&nbsp;";
	       }?>
    </div>

<div id="main_content_container" class="grid_3 clearfix">
  <?php if($top_bar || $title):
      /* top_bar can be used for bold page titles such as company
       * names on the company profile page. It will allways span 
       * the page after the left column.
       */
     
     ?>
     <div id="top_bar" class="clearfix">
     <?php  if ($top_bar): // TOP bar used in place of standard page title ?>
        <?php print $top_bar; ?>
     <?php else:?>
       <h1 class="title" id="page-title"><?php print $title; ?></h1>
     <?php endif;  ?>       
     </div>
   <?php endif; ?>

   <?php //Calculate suffix (TODO: put in preprocess function)
   
   if ($right_sidebar) {
     $content_classes = "grid_2 alpha";
    }
    else {
      $content_classes = "grid_3 alpha omega";
    }
   ?>

   <div id="main_wrapper" class="<?php print $content_classes; ?> clearfix">
   
   <?php if ($tabs): ?>
     <div id="content-tabs" class=""><?php print $tabs; ?></div><!-- /#content-tabs -->
   <?php endif; ?>
 
     <?php if($content_top): ?>
       <div id="content-top">
          <?php print $content_top; ?>
       </div><!-- /#content-top -->
      <?php endif; ?>
 
      
     <?php if (!empty($page_tools)): ?>
       <div id="page_tools">
         <?php print $page_tools; ?>
       </div>
     <?php endif; ?>
 
      <div id="main-content" class="">
        <?php print $content; ?>
      </div><!-- /#main-content -->
      <?php if($content_bottom): ?>
        <div id="content-bottom">
          <?php print $content_bottom; ?>
        </div><!-- /#content-bottom -->
      <?php endif; ?>
    </div><!-- /#main-wrapper -->   


   <?php if($right_sidebar): ?>
      <div id="right_sidebar" class="grid_1 omega">
	    <?print $right_sidebar ?>
       </div>
   <?php endif;?> 


</div>

</div>
                

<div id="footer_wrapper" class="container_4">
 
 <div id="footer_main" class="grid_4 clearfix">
  <div class="block alpha">
   &nbsp; <?php /* This is a spacer */ ?>
  </div>
  <?php if($footer) {
            print $footer;
          }?>
</div>
</div>
</div><!-- /page -->
  <?php print $closure; ?>
   <script>
     FB.XFBML.parse();
   </script>          
</body>
</html>