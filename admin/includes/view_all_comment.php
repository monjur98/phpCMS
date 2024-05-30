<div class="row">
    <div class="col-lg-12">
        <h5 class="card-title">Comment Lists</h5>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-sm table-hover mb-0">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Author</th>
                <th scope="col">Comment</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">In Response to</th>
                <th scope="col">Date</th>
                <th scope="col" style="width: 120px">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "SELECT * FROM comments";
                $select_all_comments = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_all_comments)){
                    $comment_id = $row['comment_id'];
                    $comment_post_id = $row['comment_post_id'];
                    $comment_author = $row['comment_author'];
                    $comment_email = $row['comment_email'];
                    $comment_content = $row['comment_content'];
                    $comment_status = $row['comment_status'];                                        
                    $comment_date = $row['comment_date'];
            ?>
            <tr>
                <td><?php echo $comment_id ;?></td>
                <td><?php echo $comment_author ;?></td>
                <td><?php echo $comment_content ;?></td>
                <td><?php echo $comment_email ;?></td>
                <td><?php echo $comment_status ;?></td>
                <?php 
                $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                $select_the_post = mysqli_query($connection,$query);          
                while($row = mysqli_fetch_assoc($select_the_post)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                ?>
                <td><a href="../post.php?p_id=<?php echo base64_encode($post_id);?>"><?php echo $post_title ;?></a></td>
                <?php } ?>
                <td><span class="badge text-bg-success bg-opacity-25 text-success"><?php echo $comment_date ;?></span>
                </td>
                <td>
                    <a class="text-success mx-1" href="comments.php?approved=<?php echo $comment_id ?>">
                        <i class="bi bi-hand-thumbs-up"></i>
                    </a>
                    <a class="text-warning mx-1" href="comments.php?unapproved=<?php echo $comment_id ?>">
                        <i class="bi bi-hand-thumbs-down"></i>
                    </a>
                    <a class="text-primary mx-1"
                        href="post.php?source=edit_post&p_id=<?php echo base64_encode($post_id) ?>">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <a class="text-danger mx-1" href="comments.php?delete=<?php echo $comment_id ?>">
                        <i class="bi bi-trash"></i>
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php
    if(isset($_GET['approved'])){
        $the_comment_id = $_GET['approved'];
        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$the_comment_id}";
        $approved_comment_query = mysqli_query($connection, $query);
        header("Location: comments.php");
    }

    if(isset($_GET['unapproved'])){
        $the_comment_id = $_GET['unapproved'];
        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$the_comment_id}";
        $unapproved_comment_query = mysqli_query($connection, $query);
        header("Location: comments.php");
    }

    if(isset($_GET['delete'])){
        $the_delete_id = $_GET['delete'];
        $query = "DELETE FROM comments WHERE comment_id = {$the_delete_id}";
        $delete_comment_query = mysqli_query($connection, $query);
        header("Location: comments.php");
    }    
    ?>
</div>