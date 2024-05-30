<!-- DB -->
<?php include "includes/db.php" ?>
<!-- Head -->
<?php include "includes/header.php" ?>
<!-- Navigation -->
<?php include "includes/navigation.php" ?>

<main>
	<section class="section">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mb-5 mb-lg-0">
					<?php
						if(isset($_GET['p_id'])){
							$the_post_id = base64_decode($_GET['p_id']);						
						}   
						$quiry = "SELECT * FROM posts WHERE post_id = $the_post_id";
						$select_all_posts_quiry = mysqli_query($connection,$quiry);
						while($row = mysqli_fetch_assoc($select_all_posts_quiry)){
							$post_id = $row['post_id'];
							$post_title = $row['post_title'];
							$post_author = $row['post_author'];
							$post_date = $row['post_date'];
							$post_image = $row['post_image'];
							$post_tags = $row['post_tags'];
							$post_content = $row['post_content'];
					?>
					<article>
						<img loading="lazy" decoding="async" src="images/post/<?php echo $post_image ?>"
							alt="Post Thumbnail" class="w-100">
						<ul class="post-meta mb-2 mt-4">
							<li>
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
									style="margin-right:5px;margin-top:-4px" class="text-dark" viewBox="0 0 16 16">
									<path d="M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" />
									<path
										d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
									<path
										d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" />
								</svg> <span><?php echo $post_date ?></span>
							</li>
						</ul>
						<h1 class="my-3"><?php echo $post_title ?></h1>
						<ul class="post-meta mb-4">
							<li> <a href="/categories/destination"><?php echo $post_tags ?></a>
							</li>
						</ul>
						<u><b>By:</b> <?php echo $post_author ?></u>
						<div class="content text-left">
							<h2 id="paragraph">Post Details</h2>
							<p><?php echo $post_content ?></p>
						</div>
					</article>
					<div class="widget">
						<h2 class="section-title mb-3">Leave a Comment</h2>
						<?php
							if(isset($_POST['create_comment'])){
								$the_post_id = base64_decode($_GET['p_id']);
								$comment_author = $_POST['comment_author'];
								$comment_email = $_POST['comment_email'];
								$comment_content = $_POST['comment_content'];

								$query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
								$query .="VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now() )";
								
								$create_comment_query = mysqli_query($connection, $query);
								
								if(!$create_comment_query){
									die('QUERY FAILED' . mysqli_error($connection) );
								}

								$query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
								$query .= "WHERE post_id = $the_post_id";
								$update_comment_count = mysqli_query($connection, $query);
							}
						?>
						<div class="widget-body">
							<div class="widget-list">
								<form action="" method="post" role="form">
									<div class="row">
										<div class="col-md-6 mb-3">
											<label for="" class="form-label">Name</label>
											<input type="text" class="form-control" name="comment_author">
										</div>
										<div class="col-md-6 mb-3">
											<label for="" class="form-label">Email</label>
											<input type="mail" class="form-control" name="comment_email">
										</div>
									</div>
									<label for="" class="form-label">Your Comment Here</label>
									<textarea class="form-control mb-3" name="comment_content" rows="3"></textarea>
									<div class="text-right mb-3 pb-3 border-bottom">
										<button class="btn btn-primary btn-sm" type="submit" name="create_comment">SEND
											COMMENT</button>
									</div>
								</form>
								<?php
									$query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
									$query .= "AND comment_status = 'approved' ";
									$query .= "ORDER BY comment_id DESC";
									$select_comment_quiry = mysqli_query($connection,$query);
									while($row = mysqli_fetch_assoc($select_comment_quiry)){	
										$comment_date = $row['comment_date'];
										$comment_author = $row['comment_author'];
										$comment_email = $row['comment_email'];
										$comment_content = $row['comment_content'];
								?>
								<a class="media align-items-center" href="javascript:void(0)"> <span
										class="image-fallback image-fallback-xs">No Image Specified</span>
									<div class="media-body ml-3">
										<h3 style="margin-top:-5px"><?php echo $comment_author ?> <i
												class="small text-secondary">[<?php echo $comment_date ?>]</i></h3>
										<p class="mb-0 small"><?php echo $comment_content ?></p>
									</div>
								</a>
								<?php }?>
							</div>
						</div>
					</div>
					<?php } ?>
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