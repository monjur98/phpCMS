<h5 class="card-title">Update Category</h5>
<form action="" method="post" class="row">
    <?php
    if(isset($_GET['edit'])){    
        $cat_id = $_GET['edit'];
        $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
        $select_the_edit_category_id = mysqli_query($connection,$query);          
        while($row = mysqli_fetch_assoc($select_the_edit_category_id)){
        $cat_title = $row['cat_title'];
    ?>
    <div class="col-12 mb-3">
        <label for="catTitle" class="form-label">Category Name</label>
        <input type="text" value="<?php if(isset($cat_title)){echo $cat_title;}?>" name="cat_title"
            class="form-control rounded-0" id="catTitle">
    </div>
    <?php  }}
    // UPDATE QUERY
    if(isset($_POST['update'])){
        $the_cat_title = $_POST['cat_title'];
        $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$cat_id}";
        $update_query = mysqli_query($connection, $query);
        if(!$update_query){
            die("QUERY FAILED" . mysqli_error($connection));
        }
        header("Location: categories.php");                            
    }
    ?>

    <div class="col-12 text-end">
        <input type="submit" class="btn btn-primary rounded-0" name="update" value="UPDATE CATEGORIY">
    </div>
</form>