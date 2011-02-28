<?php
// $Id: template.php,v 1.1.2.9 2010/07/09 14:53:42 himerus Exp $

/*
 * Add any conditional stylesheets you will need for this sub-theme.
 *
 * To add stylesheets that ALWAYS need to be included, you should add them to
 * your .info file instead. Only use this section if you are including
 * stylesheets based on certain conditions.
 */
/* -- Delete this line if you want to use and modify this code
// Example: optionally add a fixed width CSS file.
if (theme_get_setting('omega_starterkit_fixed')) {
  drupal_add_css(path_to_theme() . '/layout-fixed.css', 'theme', 'all');
}
// */


/**
 * Implementation of HOOK_theme().
 */
function level_omega_theme(&$existing, $type, $theme, $path) {
  $hooks = omega_theme($existing, $type, $theme, $path);
  // Add your theme hooks like this:
  /*
  $hooks['hook_name_here'] = array( // Details go here );
  */
  // @TODO: Needs detailed comments. Patches welcome!
  return $hooks;
}

/**
 * Override or insert variables into all templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered (name of the .tpl.php file.)
 */
function level_omega_preprocess(&$vars, $hook) {
  // Preprocessing for items we don't have templates for
  switch($hook) {
    case 'views_view':
      // Set the title of the the page for the company profile view.
      if($vars['name'] == "companies_house_latest_profile_2") {
        drupal_set_title($vars['view']->result[0]->name);
     }

    break;
    
  }
  

}



function level_omega_preprocess_views_view_field(&$vars, $hook) {
  //var_dump(array_keys($vars));
  //var_dump($vars['field']->options['id']);
  switch($vars['field']->options['id']) {
  case 'return_made_up_date':
  case 'incorporation_date':
    $vars['output'] = date('Y m d',strtotime($vars['output']));
  break;
  case 'accounts_made_up_date':
    $vars['output'] = date('d M Y',strtotime($vars['output']));
  break;
  }
}
/**
 * Override or insert variables into the page templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function level_omega_preprocess_page(&$vars, $hook) {
  if(arg(0) == 'company') {
    $vars['scripts'] .= '<script src="http://platform.twitter.com/widgets.js"></script>';
    $vars['scripts'] .= '<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>';
    $vars['scripts'] .= '<script src="http://www.scribd.com/javascripts/view.js"></script>';
  }
}

function level_omega_preprocess_apachesolr_currentsearch(&$vars, $hook) {
  // Create the current search term as a variable
  drupal_add_js(drupal_get_path('module', 'apachesolr') . '/apachesolr.js');
  $vars['current_search'] = filter_xss($_GET['text']);
  if ($vars['current_search'] == "*:*") {
    $vars['current_search'] = '';    
  }
  $title = filter_xss($_GET['title']);
  if ($title) {
    drupal_set_title($title);    
  }
}

/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function omega_starterkit_preprocess_node(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function omega_starterkit_preprocess_comment(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function omega_starterkit_preprocess_block(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */


/**
 * Create a string of attributes form a provided array.
 * 
 * @param $attributes
 * @return string
 */
function level_omega_render_attributes($attributes) {
	return omega_render_attributes($attributes);  
}


function level_omega_apachesolr_facet_link($facet_text, $path, $options = array(), $count, $active = FALSE, $num_found = NULL) {
  $options['attributes']['class'][] = 'apachesolr-facet';
  if ($active) {
    $options['attributes']['class'][] = 'active';
  }
  $options['attributes']['class'] = implode(' ', $options['attributes']['class']);
  $formatted_count = number_format($count);
  return $facet_text . "&nbsp;" .apachesolr_l("($formatted_count)",   $path, $options);
}

function level_omega_apachesolr_unclick_link($facet_text, $path, $options = array()) {
  if (empty($options['html'])) {
    $facet_text = check_plain($facet_text);
  }

  else {
    // Don't pass this option as TRUE into apachesolr_l().
    unset($options['html']);
  }
  $options['attributes']['class'] = 'apachesolr-unclick';
//  var_dump($options);
  return $facet_text . ' ' . apachesolr_l("(remove)", $path, $options);
}
