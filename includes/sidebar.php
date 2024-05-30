<?php
$query = "SELECT * FROM categories";
$select_all_categories_query = mysqli_query($connection,$query);
?>
<div class="col-lg-4">
    <div class="widget-blocks">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="widget">
                    <h2 class="section-title mb-3">Categories</h2>
                    <div class="widget-body">
                        <ul class="widget-list">
                            <?php
                            while($row = mysqli_fetch_assoc($select_all_categories_query)){
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];
                            ?>
                            <li><a href="category.php?category=<?php echo base64_encode($cat_id) ?>"><?php echo $cat_title ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php include "includes/widget.php" ?>
        </div>
    </div>
</div>