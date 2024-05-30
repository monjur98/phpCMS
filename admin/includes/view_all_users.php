<div class="row">
    <div class="col-lg-6">
        <h5 class="card-title">Users Lists</h5>
    </div>
    <div class="col-lg-6 text-end">
        <a href="users.php?source=add_user" class="btn btn-primary my-3">Add New User</a>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-sm table-hover mb-0">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Firstname</th>
                <th scope="col">Lastname</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col" style="width: 120px">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "SELECT * FROM users";
                $select_all_users = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_all_users)){
                    $user_id = $row['user_id'];
                    $username = $row['username'];
                    $user_firstname = $row['user_firstname'];
                    $user_lastname = $row['user_lastname'];
                    $user_email = $row['user_email'];                                        
                    $user_image = $row['user_image'];                                        
                    $user_role = $row['user_role'];
            ?>
            <tr>
                <td><?php echo $user_id ;?></td>
                <td><?php echo $username ;?></td>
                <td><?php echo $user_firstname ;?></td>
                <td><?php echo $user_lastname ;?></td>
                <td><?php echo $user_email ;?></td>
                <td><?php echo $user_role ;?></td>                
                <td>
                    <a class="text-success mx-1" href="comments.php?change_to_admin=<?php echo $comment_id ?>">
                        <i class="bi bi-hand-thumbs-up"></i>
                    </a>
                    <a class="text-warning mx-1" href="comments.php?change_to_sub=<?php echo $comment_id ?>">
                        <i class="bi bi-hand-thumbs-down"></i>
                    </a>
                    <a class="text-primary mx-1"
                        href="post.php?source=edit_post&p_id=<?php echo base64_encode($post_id) ?>">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <a class="text-danger mx-1" href="users.php?delete=<?php echo $user_id ?>">
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
        $query = "DELETE FROM users WHERE user_id = {$the_delete_id}";
        $delete_user_query = mysqli_query($connection, $query);
        header("Location: users.php");
    }    
    ?>
</div>