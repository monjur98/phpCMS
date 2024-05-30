<div class="row">
    <div class="col-lg-6">
        <h5 class="card-title">Post List</h5>
    </div>
    <div class="col-lg-6 text-end">
        <a href="posts.php?source=add_post" class="btn btn-primary my-3">Add New Post</a>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-sm table-hover mb-0">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Author</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Status</th>
                <th scope="col">Image</th>
                <th scope="col">Tags</th>
                <th scope="col">Comments</th>
                <th scope="col">Date</th>
                <th scope="col" style="width: 80px">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "SELECT * FROM posts";
                $select_all_posts = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_all_posts)){
                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];                                        
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content = substr($row['post_content'], 0, 80);
                    $post_comment_count = $row['post_comment_count'];
                    $post_date = $row['post_date'];                
            ?>
            <tr>
                <td><?php echo $post_id ;?></td>
                <td><?php echo $post_author ;?></td>
                <td><?php echo $post_title ;?></td>
                <?php 
                $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
                $select_the_edit_category_id = mysqli_query($connection,$query);          
                while($row = mysqli_fetch_assoc($select_the_edit_category_id)){
                $cat_title = $row['cat_title'];
                ?>
                <td><?php echo $cat_title ;?></td>
                <?php } ?>
                <td><?php echo $post_status ;?></td>
                <td><img class="rounded" width="80px" src="../images/post/<?php echo $post_image ;?>"
                        alt="<?php echo $post_title ;?>"></td>
                <td><?php echo $post_tags ;?></td>
                <td><?php echo $post_comment_count ;?></td>
                <td><span class="badge text-bg-success bg-opacity-25 text-success"><?php echo $post_date ;?></span></td>
                <td>
                    <a class="text-warning mx-1"
                        href="posts.php?source=edit_post&p_id=<?php echo base64_encode($post_id) ?>">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <a class="text-danger mx-1" href="posts.php?delete=<?php echo $post_id ?>">
                        <i class="bi bi-trash"></i>
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php
    
    if(isset($_GET['delete'])){
        $the_delete_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id = {$the_delete_id}";
        $delete_post_query = mysqli_query($connection, $query);
        confirmQuery($delete_post_query);
        header("Location: posts.php");
    }
    
    ?>
</div>