<?php 
/**
 * Appointment field will render the value of a field of a director appointemnt.
 * 
 * A template sugestion is added so that indavidual fields can have custom 
 * formatting if needed. this is in the format
 *   appointment_field-FIELD_NAME.tpl.php
 *   
 *  Variables available to the template are:
 *   - TITLE: the human readable title of the field
 *   - VALUE: the display value of the field. 
 *   - FIELD_NAME: the name of the field in solr
 *   - ATTRIBUTES: an array which can be passed to drupal_attributes
 *   - RAW_DATE: if a date format has been peformed this is the date before processing
 * 
 * @see level_user_preprocess_appointment_field().
 * 
 * 
 */
?>

<div <?php print drupal_attributes($field['#attributes'])?>>
<h3><?php print $field['#title']?>:</h3>
<p><span><?php print $field['#value']?></span></p>
</div>