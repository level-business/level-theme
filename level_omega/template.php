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
  // Consistant UI friendly date which can't be created with format date
  $hooks['ui_date'] = array(
    'arguments' => array ('date' => NULL, $prefix = ''),
   );

  
  // Add your theme hooks like this:
  /*
  $hooks['hook_name_here'] = array( // Details go here );
  */
  // @TODO: Needs detailed comments. Patches welcome!
  return $hooks;
}

/** @defgroup theme_functions
 * Theme functions implementations.
 *  @{
 */  


/**
 * 
 * Format a date in HTLM in a ui friendly format
 * @param unknown_type $date
 */
function level_omega_ui_date($date, $prefix = '') {
  $ui_date = '<span class="ui_date">' . $prefix .
   '<em>' .
  date('jS F', $date) .
  '</em> ' .
  '<span class="year">' . date('Y',$date) . '</span>' .
  '</span>';
  
  return $ui_date;
}

/** @} */

/** @defgroup custom functions
 *  Functions which are common to the theme but not standard drupal theme 
 *  functions.
 *  @{
 */  

/** @} */

/** @defgroup Preprocessors
 *  Pre process functions. 
 *  @{
 */  


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
  switch ($hook) {
    case 'views_view':
      // Set the title of the the page for the company profile view.
      if($vars['name'] == "companies_house_latest_profile_2") {
        if ($vars['view']->result[0]->name) {
          drupal_set_title($vars['view']->result[0]->name);
          global $company_name;
          $company_name = $vars['view']->result[0]->name;
        }
      }
      if($vars['name'] == "director_profile") {
        if ($vars['view']->result[0]->name) {
          drupal_set_title($vars['view']->result[0]->name . ' director profile');
          global $director_name;
          $director_name = $vars['view']->result[0]->name;
        }
       
     }

     if ($vars['name'] == 'ch_solr_transactions') {
        // Get the date and set the title if the view is one of the main blocks
        // summary_page, page_2 or block
        $system_date = strtotime(variable_get('level_platform_latest_daily_date','0000-00-00'));
        $date = date('jS F Y',$system_date);
        $title = "leveldaily update for ";
        if ($vars['display_id'] == 'block_1') {
          $vars['view']->build_info['title'] = $title . $date;
        }
        if ($vars['display_id'] == 'summary_page') {
          drupal_set_title($title . $date);
        }
        if ($vars['display_id'] == 'summary_homepage_page') {          
          $vars['header'] = '<h1>' . theme('ui_date',$system_date,$title) . '</h1>';
        }
      }
    break;
    
  }
  
  // Always include jquery_ui dialog boxes
  if (module_exists('jquery_ui')) {
    jquery_ui_add('ui.dialog');
    jquery_ui_add('ui.draggable');
  }

}

function level_omega_preprocess_block(&$vars, $hook) {
  // Substitute in some text into the twitter block. 
  $vars['extra_classes'] = '';
  
  switch($vars['block']->delta) {
    case 'tweet_block':
      global $company_name;
      $vars['block']->content = str_replace('class="twitter-share-button"', 'class="twitter-share-button" data-text="I\'ve been looking at the level profile for ' . $company_name . '"' , $vars['block']->content);    
    break;
    case 'company_transactions':
      // Set up the solr objects
      $views_query = apachesolr_current_query();
      list($module, $solr_search_class) = variable_get('apachesolr_query_class', array('apachesolr', 'Solr_Base_Query'));
      $filters = $_GET['filters'];
      $solr_query =  new $solr_search_class(apachesolr_get_solr(), '' , $filters , $views_query->get_solrsort() , $views_query->get_path());
      // Check that there is a company transacitions filter.
      $filter_search = $views_query->get_filters('company_transactions');
           
      if (isset($filter_search[0]['#value'])) {
        $transaction_filter = $filter_search[0]['#value'];
        $filter_elements = explode('|',$transaction_filter);
        $facet_text = constant ('LEVEL_PLATFORM_TRANSACTION_TYPES_' .  $filter_elements[1]);
        $facet_text .= ' on ' . theme('ui_date',strtotime($filter_elements[0]));       
        // Remove the filter
        $solr_query->remove_filter('company_transactions', $transaction_filter);
        $options['query'] = $solr_query->get_url_queryvalues();
        $options['html'] = $facet_text;
        $vars['block']->subject = 'Filtered by';
        $vars['block']->content = theme('apachesolr_unclick_link', $facet_text, $solr_query->get_path(), $options);
      }
      else {
        unset($vars['block']);
      }
    break;
    case 'converted_count-block_counter':
       $vars['extra_classes'] = 'grid_2 alpha';
    break;
  }
  
  if ($vars['block']->module == 'webform') {
    $vars['extra_classes'] = 'grid_1 omega';
  }

  

  if ($vars['block']->region == 'footer') {
    if ($vars['block_id'] == 1) {
      $vars['extra_classes'] = 'alpha';
    } 
    if ($vars['block_id'] == 4) {
      $vars['extra_classes'] = 'omega';
    } 
  }
  

  if ($vars['block']->module == 'any_vote') {
    
    if ((arg(0) == 'node') && is_numeric(arg(1))) {

      $content_type = $node->type;
      $content_id = arg(1);
	    $vars['vote_value'] = votingapi_select_single_result_value($criteria = array());
	  }
  }
  
  if ($vars['block']->module == 'level_user'
      && $vars['block']->delta == 'company_description') {
         $vars['extra_classes'] = ($vars['block']->empty_company_description) ? 'company_description_empty' : '';
  }
}

function level_omega_preprocess_views_view_field(&$vars, $hook) {
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
  
  $body_classes = array($vars['body_classes']);

  if(arg(1) == 'company' || arg(0) == 'company') {
    $vars['scripts'] .= '<script src="http://platform.twitter.com/widgets.js"></script>';
    $vars['scripts'] .= '<script> FB.init({
     appId  : "206040062739797",
     status : false, // check login status
     cookie : false, // enable cookies to allow the server to access the session
     xfbml  : true  // parse XFBML
   });
    </script>'; 
  }

  // Linkedin claim widget.
  if (arg(1) == 'person' || arg(0) == 'user') {
    $vars['scripts'] .= '<script src="http://platform.linkedin.com/in.js" type="text/javascript"></script>';
  }

  $vars['main_content_attributes'] = array();
  /* The following code should be moved to somewhere more applicable in the neer future */
  if(arg(1) == 'company') {
    $vars['main_content_attributes']['typeof'] = 'v:Organization gr:BusinessEntity vcard:Organization';
    // add another <body> class for better theming
    $body_classes[] = 'page-doc-company';
  }
  if (arg(1) == 'person') {
    $vars['main_content_attributes']['typeof'] = 'v:Person';
    // add another <body> class for better theming
    $body_classes[] = 'page-doc-person';
  }
  elseif (arg(2) == 'edit') {
    $body_classes[] = 'level-my-account';
  }
  elseif (arg(2) == 'stats') {
    $body_classes[] = 'level-account-statistics';
  }
  
  $vars['body_classes'] = implode(' ', $body_classes);

  // Dynamic insert additional content and change page titles for anonymous user.
  $vars['obj'] = _level_omega_user_form_elements($vars['obj'] = array(), $vars['title'], $vars['content'], $vars['tabs']);


}



/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function level_omega_preprocess_node(&$vars, $hook) {
  // Change classes for items on the homepage
  
  if($vars['node']->type == 'in_the_news') {
    $vars['node_attributes']['class'][] = 'grid_1';
    if($vars['id'] % 3 == 1) {
      $vars['node_attributes']['class'][] = 'alpha';
    }
    if($vars['id'] % 3 == 0) {
      $vars['node_attributes']['class'][] = 'omega';
    }
    // Attributes has already been set, so re do them
    $new_attributes = $vars['node_attributes'];
    $new_attributes['class'] = implode(' ',$new_attributes['class']);
    $vars['attributes'] = drupal_attributes($new_attributes);
  }
}

function level_omega_preprocess_apachesolr_currentsearch(&$vars, $hook) {
  // Create the current search term as a variable
  drupal_add_js(drupal_get_path('module', 'apachesolr') . '/apachesolr.js');
  $vars['current_search'] = filter_xss($_GET['text']);
  if ($vars['current_search'] == "*:*") {
    $vars['current_search'] = '';    
  }

  $views_query = apachesolr_current_query();
  $filter_search = $views_query->get_filters('company_transactions');
  if (isset($filter_search[0]['#value'])) {
        $transaction_filter = $filter_search[0]['#value'];
        $filter_elements = explode('|',$transaction_filter);
        $facet_text .=  theme('ui_date',strtotime($filter_elements[0]),constant ('LEVEL_PLATFORM_TRANSACTION_TYPES_' .  $filter_elements[1]) . ' on ');       
        $vars['transaction_search'] = $facet_text;    
        $title =  $facet_text;
  }
  

  if ($title) {
    drupal_set_title($title);    
  }
}

/** @} */

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

  // If 'filters' is not present apachesolr_l will ignore it and keep the 
  // existing filter so add the empty string to clear final filter.
  if (!isset($options['query']['filters'])) {
    $options['query']['filters']  = "";
  }
  $options['attributes']['class'] = 'apachesolr-unclick';
  $options['html'] = '<div class="link_text">' . $facet_text . '</div> (remove)';
//  var_dump($options);
  return   apachesolr_l('<div class="link_text">' . $facet_text . '</div> (remove)', $path, $options);
}

function level_omega_form_element($element, $value) {
  // This is also used in the installer, pre-database setup.
  $t = get_t();

  $output = '<div class="form-item"';
  if (!empty($element['#id'])) {
    $output .= ' id="'. $element['#id'] .'-wrapper"';
  }
  $output .= ">\n";
  $required = !empty($element['#required']) ? '<span class="form-required" title="'. $t('This field is required.') .'">*</span>' : '';
  
  if (!empty($element['#title'])) {
    $title = $element['#title'];
    if (!empty($element['#id'])) {
      $output .= ' <label for="'. $element['#id'] .'">'. $t('!title !required', array('!title' => filter_xss_admin($title), '!required' => $required)) ."</label>\n";
    }
    else {
      $output .= ' <label>'. $t('!title !required', array('!title' => filter_xss_admin($title), '!required' => $required)) ."</label>\n";
    }
  }
  
  if (!empty($element['#description'])) {
    $output .= ' <div class="description">'. $element['#description'] ."</div>\n";
  }
  
  $output .= "$value\n";

  $output .= "</div>\n";

  return $output;
}

/* Override LinkedIn button text to "Login with LinkedIn" */
function level_omega_linkedin_auth_display_login_block_button($display = NULL, $path = 'linkedin/login/0', $text = 'Login with LinkedIn') {
  drupal_add_css(drupal_get_path('module', 'linkedin_auth') . '/linkedin_auth.css', 'module');
  $data = l(t($text), $path);
  $class = 'linkedin-button';
  $items[] = array(
    'data' => $data,
    'class' => $class,
  );
  return theme('item_list', $items);
}

/* Theme function for the Global Toolbar */
function level_omega_global_toolbar($vars) {
  
  $output = '<div id="global-links-left">'.
              $vars['links']['my_profile'].
              $vars['links']['my_account'].
            '</div>'.

            _level_omega_get_level_tagging_block().

            '<div id="global-links-right">'.
              $vars['links']['login'].
              $vars['links']['register'].
              $vars['links']['logout'].
            '</div>';

  return $output;
}

function _level_omega_get_level_tagging_block() {
  global $user;

  // Company detail pages
  if (arg(0) == 'doc' && arg(1) == 'company') {
    // Call 'save_block'
    $block = module_invoke('level_tagging', 'block', 'view', 'save_block');
    $block['content'] = '<div id="global-links-middle">'.$block['content'].'</div>';
    return $block['content'];
  }

  // Other pages only when user logged in
  elseif ($user->uid) {
    // Call 'user_lists_summary_block'
    $block = module_invoke('level_tagging', 'block', 'view', 'user_lists_summary_block');
    $block['content'] = '<div id="global-links-middle">'.$block['content'].'</div>';
    return $block['content'];
  }
  
}

/* Dynamic display page & user form elements */
function _level_omega_user_form_elements($obj = array(), $title, $content, $tabs) {
  
  // Get Drupal paths
  $path = drupal_get_path_alias($_GET['q']);
  
  // Additional content for login page
  $login_add_contents = '
    <div class="item-list additional">
      <div class="no-account-text">Don\'t have an account with LevelBusiness yet?</div>
      <ul>
        <li class="standard-registration-option first last"><a href="/user/register">Register</a></li>
      </ul>
    </div>
  ';

  $obj['tabs'] = $tabs;
  $obj['title'] = $title;
  $obj['content'] = $content;
  
  // Set Drupal paths as arguments
  list($dest, ) = explode('/', $path, 2);
  
  if (arg(0) == 'login-opts') {
    $obj['tabs'] = '';
    $obj['title'] = 'Login.';
  }
  
  if (arg(0) == 'user' && (arg(1) == NULL || arg(1) == 'login')) {
    $obj['tabs'] = '';
    $obj['title'] = 'Login.';
    $obj['content'] = $content . $login_add_contents;
  }
  
  if (arg(0) == 'register' && arg(1) == NULL) {
    $obj['tabs'] = '';
    $obj['title'] = 'Register.';
  }
  
  if (arg(1) == 'register') {
    $obj['tabs'] = '';
    $obj['title'] = 'Register.';
  }

  return $obj;

}