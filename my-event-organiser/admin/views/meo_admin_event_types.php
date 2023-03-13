<?php // Include model:
include MY_EVENT_ORGANISER_PLUGIN_MODEL_DIR. "/EventType.php"; 

// Declare class variable:
$event_types = new Eventtype();
 
// Set base url to current file and add page specific vars
$base_url = get_admin_url().'admin.php';
$params = array( 'page'    => basename(__FILE__,".php"));
 
// Add params to base url
$base_url = add_query_arg( $params, $base_url);


// Get the POST data in filtered array
$post_array = $event_types->getPostValues();
 
// Check the POST data
if (!empty($post_array)){
 
    // Check the add form:
    $add = FALSE;
    if (isset($post_array['add']) ){
     
    // Save event categorie
    $event_types->save($post_array);
    $add= TRUE;
    }
    }

?>



<div class="wrap">
Admin event types CRUD.<br />
(Open inschrijving, alleen IVS Leden, etc)
<?php echo ($add ? "Added a new type" : "");?>
 
<table>
<caption>Event type</caption>
<thead>
<tr>
<th width="10">Id</th>
<th width="150">Name</th>
<th width="200">Description</th>
</tr>
</thead>

<!--<tr><td colspan="3">Event types rij 1</td></tr>-->
<?php if( $event_types->getNrOfEventCategories() < 1){?>
<tr>
<td colspan="3">Start adding Event Categories</tr>
<?php } ?>

<tr>
<td colspan="3">Event types rij 1</td>
</tr>
</table>

<form action="<?php echo $base_url; ?>" method="post">
<tr>
<table>   
<tr>
<td colspan="2"><input type="text" name="name"></td>
<td><input type="text" name="description"></td>
</tr>
<tr>
<td colspan="2"><input type="submit" name="add" value="Toevoegen"/></td>
</tr>
</table>
</form>    
</div>
<?php
?>
</div>

