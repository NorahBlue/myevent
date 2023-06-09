<?php
/** * Description of EventCategories
*
* @author gthoogendoorn
*/
class EventCategory {
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
 
    try {
        if ( !isset($input_array['name']) OR
        !isset($input_array['description'])){
         
        // Mandatory fields are missing
        throw new Exception(__("Missing mandatory fields"));
        }
         
        if (  (strlen($input_array['name']) < 1) OR
        (strlen($input_array['description']) < 1) ){
         
        // Mandatory fields are empty
        throw new Exception( __("Empty mandatory fields") ); }
         
        global $wpdb;
         
        // Insert query
        $wpdb->query($wpdb->prepare("INSERT INTO `". $wpdb->prefix .
        "meo_event_category` ( `name`, `description`)".
        " VALUES ( '%s', '%s');",$input_array['name'],
        $input_array['description']) );
         
        // Error ? It's in there:
        if ( !empty($wpdb->last_error) ){
        $this->last_error = $wpdb->last_error;
        return FALSE;
        }
         
        /*
        echo '
        <pre>';
        echo __FILE__.__LINE__.'';
        var_dump($wpdb);
        echo '</pre>';
        //*/
         
        //echo 'Insert name and description for this Category:"'.$input_array['name'].
        // '"-"'. $input_array['description'].'"';
        } catch (Exception $exc) {
        // @todo: Add error handling
        echo '<pre>'. $exc->getTraceAsString() .'</pre>';
        }
     
    return TRUE;
    }

    /**
*
* @return int number of Event categories stored in db
*/
public function getNrOfEventCategories(){
    global $wpdb;
 
$query = "SELECT COUNT(*) AS nr FROM `". $wpdb->prefix ."meo_event_category`";
$result = $wpdb->get_results( $query, ARRAY_A );
 
return $result[0]['nr'];
    }

    /**
*
* @return type
*/
public function getEventCategoryList(){
    global $wpdb;
    $return_array = array();
    $result_array = $wpdb->get_results( "SELECT * FROM `". $wpdb->prefix . "meo_event_category` ORDER BY `id_event_category`", ARRAY_A);
    /*
    echo '
    <pre>';
    echo __FILE__.__LINE__.'';
    var_dump($result_array);
    echo '</pre>';
    //*/
     
    // For all database results:
    foreach ( $result_array as $idx => $array){
     
    // New object
    $cat = new EventCategory();
     
    // Set all info
    $cat->setName($array['name']);
    $cat->setId($array['id_event_category']);
    $cat->setDescription($array['description']);
     
    // Add new object toe return array.
    $return_array[] = $cat;
    }
    return $return_array;
    }

    /**
*
* @param type $id Id of the event category
*/
public function setId( $id ){
    if ( is_int(intval($id) ) ){
    $this->id = $id;
    }
    }
     
    /**
    *
    * @param type $name name of the event category
    */
    public function setName( $name ){
    if ( is_string( $name )){
    $this->name = trim($name);
    }
    }
     
    /**
    *
    * @param type $desc The help text of the event category
    */
    public function setDescription ($desc){
    if ( is_string($desc)){
    $this->decription = trim($desc);
    }
    }

    /**
*
* @return int The db id of this event
*/
public function getId(){
    return $this->id;
    }
     
    /**
    *
    * @return string The name of the Event Category
    */
    public function getName(){
    return $this->name;
    }
     
    /**
    *
    * @return string The help text of the description
    */
    public function getDescription(){
    return $this->decription;
    }

 }

 
 

?>