<!-- DB -->
<?php include "includes/db.php" ?>
<!-- Head -->
<?php include "includes/header.php" ?>
<!-- Navigation -->
<?php include "includes/navigation.php" ?>

<main>
    <section class="section">
        <div class="container">
            <div class="row no-gutters-lg">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="row">
                        <div class="col-12">
                            <?php
                                if(isset($_GET['category'])){
                                    $the_category_id = base64_decode($_GET['category']);
                                }
                                $query = "SELECT * FROM categories WHERE cat_id = $the_category_id";
                                $select_categories = mysqli_query($connection,$query);
                                while($row = mysqli_fetch_assoc($select_categories)){
                                    $cat_title = $row['cat_title'];
                                    echo "<h2 class='section-title'>{$cat_title}</h2>";
                                }
                            ?>
                        </div>
                        <?php                            
                            $quiry = "SELECT * FROM posts WHERE post_category_id = $the_category_id";
                            $select_all_posts_quiry = mysqli_query($connection,$quiry);
                            if(!$select_all_posts_quiry){
                                die("QUERY FAILED" . mysqli_error($connection));
                            }
                            $count = mysqli_num_rows($select_all_posts_quiry);
                            if($count == 0){
                                echo "<div class='col-12 text-center'><div class='alert alert-warning' role='alert'> :( Sorry No Post Found</div></div>";
                            }
                            else{
                            while($row = mysqli_fetch_assoc($select_all_posts_quiry)){
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_tags = $row['post_tags'];
                                $post_content = substr($row['post_content'], 0, 100);
                        ?>
                        <div class="col-md-6 mb-4">
                            <article class="card article-card article-card-sm h-100">
                                <a href="post.php?p_id=<?php echo base64_encode($post_id) ?>">
                                    <div class="card-image">
                                        <div class="post-info"> <span
                                                class="text-uppercase"><?php echo $post_date ?></span></div>
                                        <img loading="lazy" decoding="async" src="images/post/<?php echo $post_image ?>"
                                            alt="Post Thumbnail" class="w-100">
                                    </div>
                                </a>
                                <div class="card-body px-0 pb-0">
                                    <ul class="post-meta mb-2">
                                        <li><a href="javascript:void(0);"><?php echo $post_tags ?></a></li>
                                    </ul>
                                    <u><b>By:</b> <?php echo $post_author ?></u>
                                    <h2><a class="post-title"
                                            href="post.php?p_id=<?php echo base64_encode($post_id) ?>"><?php echo $post_title ?></a>
                                    </h2>
                                    <p class="card-text"><?php echo $post_content ?>...</p>
                                    <div class="content"> <a class="read-more-btn"
                                            href="post.php?p_id=<?php echo base64_encode($post_id) ?>">Read Full
                                            Article</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <?php }} ?>
                    </div>
                </div>
                <!-- Sidebar -->
                <?php include "includes/sidebar.php" ?>
            </div>
        </div>
    </section>
</main>

<?php
include "includes/footer.php"
?>