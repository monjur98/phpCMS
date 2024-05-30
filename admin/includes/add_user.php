<?php

    if(isset($_POST['create_user'])){
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $username = $_POST['username'];
        $password = base64_encode($_POST['password']);
        $user_role = $_POST['user_role'];
        // $post_image = $_FILES['post_image']['name'];
        // $post_image_temp = $_FILES['post_image']['tmp_name'];

        // move_uploaded_file($post_image_temp, "../images/post/$post_image");

        $query = "INSERT INTO users(user_firstname, user_lastname, user_email, username, password, user_role) ";
        $query .= "VALUES('{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$username}', '{$password}', '{$user_role}')";
        $create_user_query = mysqli_query($connection, $query);
        
        confirmQuery($create_user_query);

        header("Location: users.php");
    }
?>


<h5 class="card-title">Add User</h5>
<form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-4 mb-3">
            <label for="" class="form-label">Firstname</label>
            <input type="text" name="user_firstname" class="form-control">
        </div>
        <div class="col-lg-4 mb-3">
            <label for="" class="form-label">Lastname</label>
            <input type="text" name="user_lastname" class="form-control">
        </div>
        <div class="col-lg-4 mb-3">
            <label for="" class="form-label">Email</label>
            <input type="mail" name="user_email" class="form-control">
        </div>
        <div class="col-lg-4 mb-3">
            <label for="" class="form-label">Username</label>
            <input type="text" name="username" class="form-control">
        </div>
        <div class="col-lg-4 mb-3">
            <label for="" class="form-label">Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="col-lg-4 mb-3">
            <label for="" class="form-label">Role</label>
            <select name="user_role" class="form-select">
                <option value="">Select Role</option>
                <option value="admin">Admin</option>
                <option value="subscriber">Subscriber</option>
            </select>
        </div>
        <!-- <div class="col-lg-4 mb-3">
            <label for="" class="form-label">Post Image</label>
            <input type="file" name="post_image" class="form-control">
        </div> -->
        <div class="col-12 text-end">
            <button class="btn btn-primary" type="submit" name="create_user">ADD USER</button>
        </div>
</form>