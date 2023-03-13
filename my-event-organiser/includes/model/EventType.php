<?php
/** * Description of Eventtypes
*
* @author gthoogendoorn
*/
class Eventtype { 
    /**
* getPostValues :
* Filter input and retrieve POST input params
* @return array containing known POST input fields
*/
public function getPostValues(){
    // Define the check for params
    $post_check_array = array (
     
    // submit action
    'add'   => array('filter' => FILTER_SANITIZE_STRING ),
     
    // event type name.
    'name'   => array('filter' => FILTER_SANITIZE_STRING ),              
     
    // Help text
    'description'   => array('filter' => FILTER_SANITIZE_STRING ),
    );
     
    // Get filtered input:
    $inputs = filter_input_array( INPUT_POST, $post_check_array );
     
    // RTS
    return $inputs;
     
    }

    /**
*
* @global type $wpdb The WordPress database class
* @param type $input_array containing insert data
* @return boolean TRUE on succes OR FALSE
*/
public function save($input_array){
 
    if (!isset($input_array['name']) OR !isset($input_array['description']))
    return FALSE;
     
    global $wpdb;
     
    // Insert query
    echo 'Insertname and description for this Category:'.$input_array['name']."-". $input_array['description']."";
     
    return TRUE;
    }

    /**
*
* @return int number of Event categories stored in db
*/
public function getNrOfEventCategories(){
    // Tijdelijk gewoon 0 terug geven. (Geen event categorieën)
    return 0;
    }
    
}
?>