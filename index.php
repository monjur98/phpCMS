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
              <h2 class="section-title">Latest Articles</h2>
            </div>
            <?php 
              $quiry = "SELECT * FROM posts";
              $select_all_posts_quiry = mysqli_query($connection,$quiry);
              while($row = mysqli_fetch_assoc($select_all_posts_quiry)){
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_content = $row['post_content'];
            ?>
            <div class="col-md-6 mb-4">
              <article class="card article-card article-card-sm h-100">
                <a href="article.html">
                  <div class="card-image">
                    <div class="post-info"> <span class="text-uppercase"><?php echo $post_date ?></span></div>
                    <img loading="lazy" decoding="async" src="images/post/<?php echo $post_image ?>"
                      alt="Post Thumbnail" class="w-100">
                  </div>
                </a>
                <div class="card-body px-0 pb-0">
                  <ul class="post-meta mb-2">
                    <li><a href="javascript:void(0);"><?php echo $post_tags ?></a></li>
                  </ul>
                  <u><b>By:</b> <?php echo $post_author ?></u>
                  <h2><a class="post-title" href="javascript:void(0)"><?php echo $post_title ?></a></h2>
                  <div class="content"> <a class="read-more-btn" href="article.html">Read Full Article</a>
                  </div>
                </div>
              </article>
            </div>
            <?php } ?>
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