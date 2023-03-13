<?php // Include model:
include MY_EVENT_ORGANISER_PLUGIN_MODEL_DIR . "/EventCategory.php";

// Declare class variable:
$event_categories = new EventCategory();
 
// Set base url to current file and add page specific vars
$base_url = get_admin_url().'admin.php';
$params = array( 'page'    => basename(__FILE__,".php"));
 
// Add params to base url
$base_url = add_query_arg( $params, $base_url);

// Get the POST data in filtered array
$post_array = $event_categories->getPostValues();

// Collect Errors
$error = FALSE;
 
// Check the POST data
if(!empty($post_array)){
// Check the add form:
$add = FALSE;
if (isset($post_array['add']) ){
 
// Save event categorie
$result = $event_categories->save($post_array);
if ($result){
// Save was succesfull
$add = TRUE;
} else {
// Indicate error
$error = TRUE;
}
}
}
 
// Check the POST data
if (!empty($post_array)){
 
    // Check the add form:
    $add = FALSE;
    if (isset($post_array['add']) ){
     
    // Save event categorie
    $event_categories->save($post_array);
    $add= TRUE;
    }
    }

?>
<div class="wrap">
    Admin event categorie CRUD.<br />
    ( Uitje, excursie, etc)
    <?php echo ($add ? "Added a new event" : "");?>
 
<table>
<caption>Event type categories</caption>
<thead>
<tr>
<th width="10">Id</th>
<th width="150">Name</th>
<th width="200">Description</th>
</tr>
</thead>

<!--<tr><td colspan="3">Event types rij 1</td></tr>-->
<?php  if( $event_categories->getNrOfEventCategories() < 1){?>
<tr>
<td colspan="3">Start adding Event Categories</tr>
<?php } else { $cat_list = $event_categories->getEventCategoryList();
//** Show all event categories in the tabel
foreach( $cat_list as $event_cat_obj){
?>
<tr>
<td width="10"><?php echo $event_cat_obj->getId(); ?></td>
<td width="180"><?php echo $event_cat_obj->getName(); ?></td>
<td width="200"><?php echo $event_cat_obj->getDescription();?></td>
<td><button onclick="myFunction(<?php echo $event_cat_obj->getId();?>)">Click me</button></td>
</tr>
<?php   
}
} ?>

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