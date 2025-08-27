<?php
require 'db_connect.php';
include "auth_session.php";
// Fetch pages

$result = $conn->query("SELECT * FROM vice_chancellor ORDER BY created_at DESC");
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
                        <h1 class="kingster-page-title">MANAGE VC PROFILE</h1></div>
                </div>
            </div>
            <div class="kingster-page-wrapper" id="kingster-page-wrapper">
    <div class="gdlr-core-page-builder-body">
        <div class="gdlr-core-pbf-sidebar-wrapper">
            <div class="gdlr-core-pbf-sidebar-container gdlr-core-line-height-0 clearfix gdlr-core-js gdlr-core-container" id="madewith">
                <div class="gdlr-core-pbf-sidebar-content gdlr-core-column-45 gdlr-core-pbf-sidebar-padding gdlr-core-line-height" style="padding: 60px 10px 30px 30px;">
                    <div class="gdlr-core-pbf-background-wrap" style="background-color: #f7f7f7;"></div>
                    <div class="gdlr-core-pbf-sidebar-content-inner">
<div class="gdlr-core-pbf-element">
    <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix gdlr-core-style-blog-full-with-frame" style="padding-bottom: 40px;">
        <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">
            <?php
           

            echo "Welcome, admin " . $_SESSION['admin_username'] . "<br>";
            ?>
            <a href="logout.php" style="color: red; text-decoration: none;">Logout</a>

            <?php if (isset($_GET['alert'])): ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_GET['alert']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
                <a href="adminpanel.php" class="btn btn-warning">Back</a>
            <center><h2>MANAGE VC PROFILE IN HOME PAGE</h2></center>

           <h3>Vice Chancellor Profile</h3>
<table class="table table-bordered table-striped">
    <thead class="table-success">
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Title</th>
        <th>Actions</th>
    </tr>
    </thead>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><img src="images/<?= $row['image'] ?>" style="height:60px;"></td>
            <td><?= htmlspecialchars($row['full_name']) ?></td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td>
    <a href="editvc.php?id=<?= $row['id'] ?>">Edit</a> |
    <button class="btn btn-info btn-sm" onclick="showWelcome(`<?= htmlspecialchars(addslashes($row['welcome_address'])) ?>`)">View Welcome</button> |
    <a href="deletevc.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this profile?')">Delete</a>
</td>

        </tr>
    <?php endwhile; ?>
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
</style>


</div>
                </div>
                
                <!-- Sidebar with Recent Posts -->
                <div class="gdlr-core-pbf-sidebar-left gdlr-core-column-extend-left kingster-sidebar-area gdlr-core-column-10 gdlr-core-pbf-sidebar-padding gdlr-core-line-height">
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
<div id="welcomePopup" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%);
background:#fff; padding:20px; border:2px solid #333; border-radius:10px; max-width:600px; max-height:400px; overflow:auto; z-index:9999;">
    <h3>Welcome Address</h3>
    <div id="welcomeContent" style="white-space:pre-wrap;"></div>
    <button onclick="document.getElementById('welcomePopup').style.display='none'" style="margin-top:10px;" class="btn btn-danger">Close</button>
</div>

<script>
function showWelcome(content) {
    document.getElementById('welcomeContent').innerHTML = content;
    document.getElementById('welcomePopup').style.display = 'block';
}
</script>

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