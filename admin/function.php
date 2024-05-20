<?php
function confirmQuery($result){
   global $connection;
   if(!$result){
       die("QUERY FAILD" . mysqli_error($connection));
   }
}

function insert_categories(){
    global $connection;
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];
        if( $cat_title == "" || empty($cat_title)){
           echo "<p class='text-danger'><i class='bi bi-bell'></i> This Filed should not be empty</p>";
        }
        else{
           $query = "INSERT INTO categories(cat_title)";
           $query .= "VALUE('{$cat_title}')";
           $create_category_query = mysqli_query($connection, $query);
           if(!$create_category_query){
               die('QUERY FAILED' . mysqli_error($connection));
           }
           header("Location: categories.php");
        }
   }                       
}

function delete_category(){
   global $connection;
   if(isset($_GET['delete'])){
      $the_cat_id = $_GET['delete'];
      $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
      $delete_query = mysqli_query($connection, $query);

      header("Location: categories.php");
  }
}

?>