<!-- ======= Header ======= -->
<?php include "includes/admin_header.php"; ?>
<!-- End Header-->
<!-- ======= Sidebar ======= -->
<?php include "includes/admin_navigation.php"; ?>
<!-- End Sidebar-->

<?php
$query = "SELECT * FROM categories";
$select_all_categories_query = mysqli_query($connection,$query);
?>


<main id="main" class="main">
    <div class="pagetitle">
        <h1>Categories</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Categories</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Category</h5>
                        <?php insert_categories(); ?>
                        <form action="" method="post" class="row">
                            <div class="col-12 mb-3">
                                <label for="catTitle" class="form-label">Category Name</label>
                                <input type="text" name="cat_title" class="form-control rounded-0" id="catTitle">
                            </div>
                            <div class="col-12 text-end">
                                <input type="submit" class="btn btn-primary rounded-0" name="submit"
                                    value="ADD CATEGORIY">
                            </div>
                        </form>

                        <?php
                        
                        if(isset($_GET['edit'])){
                            $cat_id = $_GET['edit'];
                            include "includes/update_categories.php";
                        }

                        ?>

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Category List</h5>
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Category Title</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while($row = mysqli_fetch_assoc($select_all_categories_query)){
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $cat_id ?></th>
                                    <td><?php echo $cat_title ?></td>
                                    <td>
                                        <a class="text-warning mx-1" href="categories.php?edit=<?php echo $cat_id ?>"><i
                                                class="bi bi-pencil-square"></i></a>
                                        <a class="text-danger mx-1"
                                            href="categories.php?delete=<?php echo $cat_id ?>"><i
                                                class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                                <?php }?>
                                <?php delete_category(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->


<?php include "includes/admin_footer.php"; ?>