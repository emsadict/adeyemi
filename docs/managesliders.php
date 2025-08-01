<?php
require 'db_connect.php';
include "auth_session.php";

?>




<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
   <?php include "head.php"; ?>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="home page-template-default page page-id-2039 gdlr-core-body woocommerce-no-js tribe-no-js kingster-body kingster-body-front kingster-full  kingster-with-sticky-navigation  kingster-blockquote-style-1 gdlr-core-link-to-lightbox">
<?php include "mobilemenu.php"; ?>
    <div class="kingster-body-outer-wrapper ">
        <div class="kingster-body-wrapper clearfix  kingster-with-frame">
           <?php include "headermenu.php" ?>
           <?php   include "menu.php";?>
            <div class="kingster-page-title-wrap  kingster-style-medium kingster-center-align">
                <div class="kingster-header-transparent-substitute"></div>
                <div class="kingster-page-title-overlay"></div>
                <div class="kingster-page-title-container kingster-container">
                    <div class="kingster-page-title-content kingster-item-pdlr">
                        <h1 class="kingster-page-title">MANAGE SLIDERS</h1></div>
                </div>
            </div>
            <div class="kingster-page-wrapper" id="kingster-page-wrapper">
    <div class="gdlr-core-page-builder-body">
        <div class="gdlr-core-pbf-sidebar-wrapper">
            <div class="gdlr-core-pbf-sidebar-container gdlr-core-line-height-0 clearfix gdlr-core-js gdlr-core-container" id="madewith">
                <div class="gdlr-core-pbf-sidebar-content gdlr-core-column-50 gdlr-core-pbf-sidebar-padding gdlr-core-line-height" style="padding: 60px 10px 30px 30px;">
                    <div class="gdlr-core-pbf-background-wrap" style="background-color: #f7f7f7;"></div>
                    <div class="gdlr-core-pbf-sidebar-content-inner">
<div class="gdlr-core-pbf-element">
    <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix gdlr-core-style-blog-full-with-frame" style="padding-bottom: 40px;">
        <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">

            <!-- Upcoming Events -->
              <?php echo "Welcome, admin " . $_SESSION['admin_username'];   ?><br>
               <a href="logout.php" style="color: red; text-decoration: none;">Logout</a>

               <?php if (isset($_GET['alert'])): ?>
  <div class="alert alert-info alert-dismissible fade show" role="alert">
    <?= htmlspecialchars($_GET['alert']) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

            <h3>MANAGE SLIDERS</h3>
            <table class="table table-bordered table-striped">
         <table>
        <tr>
            <th>S/N</th>
            <th>Title</th>
            <th>Image</th>
            <th>Description</th>
            <th>Action</th>
        </tr>

        <?php
        $sn = 1;

        // Fetch large sliders
        $largeQuery = "SELECT * FROM imagegallery ORDER BY id DESC";
        $largeResult = $conn->query($largeQuery);
        if ($largeResult->num_rows > 0) {
            while ($row = $largeResult->fetch_assoc()) {
                echo "<tr>
                        <td>{$sn}</td>
                        <td>{$row['title']}</td>
                        <td><img src='uploads/{$row['image_path']}' alt='' style='width:150px; height:100px; object-fit:cover;'></td>
                        <td>{$row['description']}</td>
                        <td>
                            <a href='editlargeslider.php?id={$row['id']}' class='action-btn'>Edit</a>
                            <a href='deletelargeslider.php?id={$row['id']}' class='action-btn delete-btn'>Delete</a>
                        </td>
                      </tr>";
                $sn++;
            }
        }

        // Fetch small sliders
        $smallQuery = "SELECT * FROM images ORDER BY id DESC";
        $smallResult = $conn->query($smallQuery);
        if ($smallResult->num_rows > 0) {
            while ($row = $smallResult->fetch_assoc()) {
                echo "<tr>
                        <td>{$sn}</td>
                        <td>{$row['title']}</td>
                        <td><img src='uploads/{$row['image_path']}' alt='' style='width:150px; height:100px; object-fit:cover;'></td>
                        <td><i>—</i></td>
                        <td>
                            <a href='editsmallslider.php?id={$row['id']}' class='action-btn'>Edit</a>
                            <a href='deletesmallslider.php?id={$row['id']}' class='action-btn delete-btn'>Delete</a>
                        </td>
                      </tr>";
                $sn++;
            }
        }
        ?>
   
</table>

        </div>
    </div>
</div>

<style>
    .event-box {
        background-color: #f7f7f7;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 10px ;
        border:rgb(108, 27, 27) 4px solid;
        align-items: center;
    }
    .pagination {
        margin-top: 10px;
        padding: 10px;
    }
    .pagination a {
        margin: 2px;
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        text-decoration: none;
        background-color:rgb(20, 141, 106);
        color: #f7f7f7;
    }
    .pagination a:hover {
        background-color:rgb(5, 125, 79);
        color: white;
    }
          table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        img {
            max-width: 100px;
            height: auto;
        }
        th {
            background-color: #f0f0f0;
        }
        .action-btn {
            margin: 0 5px;
            padding: 5px 10px;
            background-color: dodgerblue;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .delete-btn {
            background-color: crimson;
        }
</style>


</div>
                </div>
                
                <!-- Sidebar with Recent Posts -->
                <div class="gdlr-core-pbf-sidebar-left gdlr-core-column-extend-left  kingster-sidebar-area gdlr-core-column-10 gdlr-core-pbf-sidebar-padding  gdlr-core-line-height">
                                
                                <div class="gdlr-core-sidebar-item gdlr-core-item-pdlr">
                                    
                                    
                                    <div id="recent-posts-3" class="widget widget_recent_entries kingster-widget" style="background-color:rgb(206, 234, 221) ;">
                                        <?php include "pagesidebar.php"; ?>
                                         <?php include "adminsidemenu.php"; ?>
                                    </div>
                                </div>
                            </div>
                           

            </div>
        </div>
    </div>
</div>

<?php mysqli_close($conn); ?>


            <footer>
                <?php  include "footer.php";?>
            </footer>
        </div>
    </div>


	<script type='text/javascript' src='js/jquery/jquery.js'></script>
    <script type='text/javascript' src='js/jquery/jquery-migrate.min.js'></script>
    <script type='text/javascript' src='plugins/goodlayers-core/plugins/combine/script.js'></script>
    <script type='text/javascript'>
        var gdlr_core_pbf = {
            "admin": "",
            "video": {
                "width": "640",
                "height": "360"
            },
            "ajax_url": "#"
        };
    </script>
    <script type='text/javascript' src='plugins/goodlayers-core/include/js/page-builder.js'></script>
    <script type='text/javascript' src='js/jquery/ui/effect.min.js'></script>
    <script type='text/javascript'>
        var kingster_script_core = {
            "home_url": "index.php"
        };
    </script>
    <script type='text/javascript' src='js/plugins.min.js'></script>
</body>
</html>