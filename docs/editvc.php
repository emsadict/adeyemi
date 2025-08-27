<?php
include "auth_session.php";
if ($_SESSION['admin_role'] !== 'superadmin') {
    die("Access denied. Only superadmins can add vc.");
}

include "db_connect.php";
$id = $_GET['id'] ?? null;
if (!$id) { echo "Invalid ID"; exit; }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $title = $_POST['title'];
    $bio = $_POST['bio'];
    $welcome_address = $_POST['welcome_address'];

   if (!empty($_FILES['image']['name'])) {
    $stmt = $conn->prepare("UPDATE vice_chancellor SET full_name=?, title=?, image=?, bio=?, welcome_address=? WHERE id=?");
    $stmt->bind_param("sssssi", $full_name, $title, $image, $bio, $welcome_address, $id);
} else {
    $stmt = $conn->prepare("UPDATE vice_chancellor SET full_name=?, title=?, bio=?, welcome_address=? WHERE id=?");
    $stmt->bind_param("ssssi", $full_name, $title, $bio, $welcome_address, $id);
}


    $stmt->execute();
    header("Location: managevc.php?alert=VC profile updated");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM vice_chancellor WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$vc = $stmt->get_result()->fetch_assoc();


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
                        <h1 class="kingster-page-title">EDIT VC DETAILS </h1></div>
                </div>
            </div>
            <div class="kingster-page-wrapper" id="kingster-page-wrapper">
    <div class="gdlr-core-page-builder-body">
        <div class="gdlr-core-pbf-sidebar-wrapper">
            <div class="gdlr-core-pbf-sidebar-container gdlr-core-line-height-0 clearfix gdlr-core-js gdlr-core-container">
                <div class="gdlr-core-pbf-sidebar-content gdlr-core-column-30 gdlr-core-pbf-sidebar-padding gdlr-core-line-height" style="padding: 60px 10px 30px 30px;">
                    <div class="gdlr-core-pbf-background-wrap" style="background-color: #f7f7f7;"></div>
                    <div class="gdlr-core-pbf-sidebar-content-inner">
<div class="gdlr-core-pbf-element">
    <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix gdlr-core-style-blog-full-with-frame" style="padding-bottom: 40px;">
        <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">

            <!-- Upcoming Events -->
           
            <hr />
          
<!-- Simple form -->
  <a href="managevc.php" class="btn btn-warning">Back</a>
 <div class="form-container">
   <H4>EDIT VICE CHANCELLOR IN HOME PAGE</H4> 
   <hr>
<form method="post" enctype="multipart/form-data">
    Full Name: <input type="text" name="full_name" value="<?= htmlspecialchars($vc['full_name']) ?>"><br>
    Title: <input type="text" name="title" value="<?= htmlspecialchars($vc['title']) ?>"><br>
    Image: <input type="file" name="image"><br>
    Bio: <textarea name="bio"><?= htmlspecialchars($vc['bio']) ?></textarea><br>
    <label for="welcome_address">Welcome Address:</label><br>
<textarea name="welcome_address" rows="6" cols="60"><?= htmlspecialchars($vc['welcome_address']) ?></textarea><br>

    <button type="submit">Update VC</button>
</form>
 </div>          

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
</style>


</div>
                </div>
                
                <!-- Sidebar with Recent Posts -->
             <div class="gdlr-core-pbf-sidebar-left gdlr-core-column-extend-left  kingster-sidebar-area gdlr-core-column-15 gdlr-core-pbf-sidebar-padding  gdlr-core-line-height">
                                
                                <div class="gdlr-core-sidebar-item gdlr-core-item-pdlr">
                                    
                                    
                                    <div id="recent-posts-3" class="widget widget_recent_entries kingster-widget" style="background-color:rgb(206, 234, 221) ;">
                                        <?php include "pagesidebar.php"; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="gdlr-core-pbf-sidebar-right gdlr-core-column-extend-right  kingster-sidebar-area gdlr-core-column-15 gdlr-core-pbf-sidebar-padding  gdlr-core-line-height">
                                
                                <div class="gdlr-core-sidebar-item gdlr-core-item-pdlr">
                                    
                                    
                                    <div id="recent-posts-3" class="widget widget_recent_entries kingster-widget" style="background-color:rgb(206, 234, 221) ;">
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