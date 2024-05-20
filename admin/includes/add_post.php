<?php

    if(isset($_POST['create_post'])){
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        $post_comment_count = 4;

        move_uploaded_file($post_image_temp, "../images/post/$post_image");

        $query = "INSERT INTO posts(post_title, post_category_id, post_author, post_status, post_image, post_tags, post_content, post_date, post_comment_count)";
        $query .= "VALUES('{$post_title}', {$post_category_id}, '{$post_author}', '{$post_status}', '{$post_image}', '{$post_tags}', '{$post_content}', now(), {$post_comment_count})";
        $create_post_query = mysqli_query($connection, $query);
        
        confirmQuery($create_post_query);

        header("Location: post.php");
    }
?>


<h5 class="card-title">Add Post</h5>
<form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-4 mb-3">
            <label for="" class="form-label">Post Title</label>
            <input type="text" name="post_title" class="form-control">
        </div>
        <div class="col-lg-4 mb-3">
            <label for="" class="form-label">Category</label>
            <select name="post_category" class="form-select">
                <option value="">Select Category</option>
                <?php
                    $query = "SELECT * FROM categories";
                    $select_categories = mysqli_query($connection,$query);
                    confirmQuery($select_categories);                
                    while($row = mysqli_fetch_assoc($select_categories)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        echo "<option value='{$cat_id}'>{$cat_title}</option>";
                    }
                ?>
            </select>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="" class="form-label">Author Name</label>
            <input type="text" name="post_author" class="form-control">
        </div>
        <div class="col-lg-4 mb-3">
            <label for="" class="form-label">Status</label>
            <input type="text" name="post_status" class="form-control">
        </div>
        <div class="col-lg-4 mb-3">
            <label for="" class="form-label">Post Image</label>
            <input type="file" name="post_image" class="form-control">
        </div>
        <div class="col-lg-4 mb-3">
            <label for="" class="form-label">Post Tags</label>
            <input type="text" name="post_tags" class="form-control">
        </div>
        <div class="col-12 mb-3">
            <label for="" class="form-label">Post Content</label>
            <textarea name="post_content" class="form-control" rows="4"></textarea>
        </div>
        <div class="col-12 text-end">
            <button class="btn btn-primary" type="submit" name="create_post">ADD POST</button>
        </div>
</form>