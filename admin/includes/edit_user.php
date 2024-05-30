<?php
    if($_GET['p_id']){
        $the_edit_id = base64_decode($_GET['p_id']);
    }
    $query = "SELECT * FROM posts WHERE post_id = {$the_edit_id}";
    $select_post_by_id = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_post_by_id)){
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];                                        
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
    }

    if(isset($_POST['update_post'])){
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        
        move_uploaded_file($post_image_temp, "../images/post/$post_image");

        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id = {$the_edit_id}";
            $select_image = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_image)){
                $post_image = $row['post_image'];
            }
        }

        $query = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_category_id = {$post_category_id}, ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_image = '{$post_image}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_date = now()" ;
        $query .= "WHERE post_id = {$the_edit_id}" ;

        $update_post = mysqli_query($connection, $query);

        confirmQuery($update_post);

        header("Location: post.php");
    }
?>

<h5 class="card-title">Edit Post</h5>
<form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-4 mb-3">
            <label for="" class="form-label">Post Title</label>
            <input type="text" value="<?php echo $post_title; ?>" name="post_title" class="form-control">
        </div>
        <div class="col-lg-4 mb-3">
            <label for="" class="form-label">Category</label>
            <select name="post_category" class="form-select">
                <option value="">Select Category</option>
                <?php
                    $query = "SELECT * FROM users";
                    $select_users = mysqli_query($connection,$query);

                    confirmQuery($select_users);

                    while($row = mysqli_fetch_assoc($select_users)){
                        $user_id = $row['user_id'];
                        $user_role = $row['user_role'];
                        echo "<option value='{$user_id}'>{$user_role}</option>";
                    }
                ?>
            </select>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="" class="form-label">Author Name</label>
            <input type="text" value="<?php echo $post_author; ?>" name="post_author" class="form-control">
        </div>
        <div class="col-lg-4 mb-3">
            <label for="" class="form-label">Post Image</label><br>
            <div class="row">
                <div class="col-auto">
                    <img style="height: 38px;" class="rounded" src="../images/post/<?php echo $post_image; ?>" alt="">
                </div>
                <div class="col">
                    <input type="file" name="post_image" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="" class="form-label">Status</label>
            <input type="text" value="<?php echo $post_status; ?>" name="post_status" class="form-control">
        </div>
        <div class="col-lg-4 mb-3">
            <label for="" class="form-label">Post Tags</label>
            <input type="text" value="<?php echo $post_tags; ?>" name="post_tags" class="form-control">
        </div>
        <div class="col-12 mb-3">
            <label for="" class="form-label">Post Content</label>
            <textarea name="post_content" class="form-control" rows="4">
                <?php echo $post_content; ?>
            </textarea>
        </div>
        <div class="col-12 text-end">
            <button class="btn btn-primary" type="submit" name="update_post">UPDATE POST</button>
        </div>
</form>