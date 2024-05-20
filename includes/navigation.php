<?php
$query = "SELECT * FROM categories";
$select_all_categories_query = mysqli_query($connection,$query);
?>
<header class="navigation">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light px-0">
            <a class="navbar-brand order-1 py-0" href="index.php">
                <img loading="prelaod" decoding="async" class="img-fluid" src="images/logo.png" alt="Reporter Hugo">
            </a>
            <div class="navbar-actions order-3 ml-0 ml-md-4">
                <button aria-label="navbar toggler" class="navbar-toggler border-0" type="button" data-toggle="collapse"
                    data-target="#navigation"> <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <form action="search.php" method="post" class="search order-lg-3 order-md-2 order-3 ml-auto d-flex">
                <input id="search-query" name="search" type="search" placeholder="Search..." autocomplete="off">
                <button type="submit" name="submit">GO</button>
            </form>
            <div class="collapse navbar-collapse text-center order-lg-2 order-4" id="navigation">
                <ul class="navbar-nav mx-auto mt-3 mt-lg-0">
                    <li class="nav-item"> <a class="nav-link" href="javascript:void(0);">About Me</a>
                    </li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="javascript:void(0);"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Articles
                        </a>
                        <div class="dropdown-menu">
                            <?php
                            while($row = mysqli_fetch_assoc($select_all_categories_query)){
                                $cat_title = $row['cat_title'];
                            ?>
                            <a class="dropdown-item" href="javascript:void(0);"><?php echo $cat_title ?></a>
                            <?php } ?>
                        </div>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="javascript:void(0);">Contact</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="admin"><i class='bx bx-log-in-circle'></i> Admin</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>