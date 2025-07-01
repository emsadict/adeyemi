<?php 
include 'db_connect.php';


// Fetch staff members with designation 'Staff'
                                                            
                                                             
?>
<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
   <?php include "head.php"; ?>
   
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
                        <h1 class="kingster-page-title">GOVERNING COUNCIL PAGE</h1></div>
                </div>
            </div>
            <div class="kingster-page-wrapper" id="kingster-page-wrapper">
    <div class="gdlr-core-page-builder-body">
        <div class="gdlr-core-pbf-sidebar-wrapper">
            <div class="gdlr-core-pbf-sidebar-container gdlr-core-line-height-0 clearfix gdlr-core-js gdlr-core-container">
                <div class="gdlr-core-pbf-sidebar-content gdlr-core-column-45 gdlr-core-pbf-sidebar-padding gdlr-core-line-height" style="padding: 60px 10px 30px 30px;">
                    <div class="gdlr-core-pbf-background-wrap" style="background-color:rgba(158, 228, 207, 0.33) ;"></div>
                    <div class="gdlr-core-pbf-sidebar-content-inner">
<div class="gdlr-core-pbf-element">
    <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix gdlr-core-style-blog-full-with-frame" style="padding-bottom: 40px;">
        <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">

            <!-- Upcoming Events -->
            <Center><h4>ADEYEMI FEDERAL UNIVERSITY OF EDUCATION GOVERNING COUNCIL</h4></Center>
            <hr />                                       

<div class="gdlr-core-tab-item-content" data-tab-id="4">
    <div class="gdlr-core-personnel-item gdlr-core-item-pdb clearfix gdlr-core-left-align gdlr-core-personnel-item-style-medium gdlr-core-personnel-style-medium" style="height: 600px; overflow-y: auto; border: 1px solid #ccc; padding: 10px;">
<?php
    $sql = "SELECT * FROM governing_council ORDER BY status DESC, position ASC, year_started DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0): ?>
    
    <div class="council-container">
        <?php while ($row = mysqli_fetch_assoc($result)): 
            $fullName = htmlspecialchars($row['surname'] . ' ' . $row['othernames']);
            $position = htmlspecialchars($row['position']);
            $status = htmlspecialchars($row['status']);
            $years = $row['year_started'] . ' - ' . ($row['year_ended'] ?? 'Present');
            $email = htmlspecialchars($row['email']);
            $phone = htmlspecialchars($row['phone']);
            $passport = !empty($row['passport']) ? "uploads/passports/{$row['passport']}" : "uploads/default.jpg";
        ?>
        <div class="council-member">
            <img src="<?= $passport ?>" alt="<?= $fullName ?>" width="120" height="120">
            <h5><?= $fullName ?></h5>
            <p><strong>Position:</strong> <?= $position ?> (<?= $status ?>)</p>
            <p><strong>Years of Service:</strong> <?= $years ?></p>
            <p><strong>Email:</strong> <?= $email ?></p>
            <p><strong>Phone:</strong> <?= $phone ?></p>
        </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <p>No governing council members found.</p>
<?php endif; ?>

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


    .council-container {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
}
.council-member {
  border: 1px solid #ccc;
  padding: 15px;
  width: 280px;
  background: #f9f9f9;
  text-align: center;
}
.council-member img {
  border-radius: 50%;
  object-fit: cover;
}

</style>


</div>
                </div>
                
                <!-- Sidebar with Recent Posts -->
                <div class="gdlr-core-pbf-sidebar-left gdlr-core-column-extend-left kingster-sidebar-area gdlr-core-column-15 gdlr-core-pbf-sidebar-padding gdlr-core-line-height">
                    <div class="gdlr-core-sidebar-item gdlr-core-item-pdlr">
                        <div id="recent-posts-3" class="widget widget_recent_entries kingster-widget" style="background-color:rgb(206, 234, 221) ;">
                            <h3 class="kingster-widget-title">Menu</h3><span class="clear"></span>
                            <ul>
                                



                            </ul>
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