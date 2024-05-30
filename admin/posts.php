<!-- ======= Header ======= -->
<?php include "includes/admin_header.php"; ?>
<!-- End Header-->
<!-- ======= Sidebar ======= -->
<?php include "includes/admin_navigation.php"; ?>
<!-- End Sidebar-->

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Posts</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Posts</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                            if(isset($_GET['source'])){
                                $source = $_GET['source'];
                            }
                            else{
                                $source = '';
                            }
                            switch($source){
                                case 'add_post';
                                include 'includes/add_post.php';
                                break;
                                case 'edit_post';
                                include 'includes/edit_post.php';
                                break;
                                default:
                                include 'includes/view_all_post.php';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->


<?php include "includes/admin_footer.php"; ?>