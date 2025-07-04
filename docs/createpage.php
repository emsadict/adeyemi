<?php
require 'db_connect.php'; // Database connection
include "auth_session.php";
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pg_title = $_POST['pg_title'];
    $pg_category = $_POST['pg_category'];
    $pg_head_name = $_POST['pg_head_name'];
    $pg_h_qualification = $_POST['pg_h_qualification'];
    $pg_h_designation = $_POST['pg_h_designation'];
    $pg_head_title = $_POST['pg_head_title'];
    $pg_accronym = $_POST['pg_accronym'];

    // Handle file uploads
    $dept_picture = $_FILES['dept_picture']['name'];
    $head_picture = $_FILES['head_picture']['name'];

    $target_dir = "uploads/"; // Directory to store images
    $dept_target = $target_dir . basename($dept_picture);
    $head_target = $target_dir . basename($head_picture);

    move_uploaded_file($_FILES['dept_picture']['tmp_name'], $dept_target);
    move_uploaded_file($_FILES['head_picture']['tmp_name'], $head_target);

    // Insert into pages_table
    $sql = "INSERT INTO pages_table (pg_category, pg_categ_id, pg_title, pg_head_name, pg_h_qualification, pg_h_designation, pg_head_title, pg_accronym, dept_picture, head_picture) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $pg_category, $pg_category, $pg_title, $pg_head_name, $pg_h_qualification, $pg_h_designation, $pg_head_title, $pg_accronym, $dept_picture, $head_picture);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Page created successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }

    $stmt->close();
}

// Fetch categories for dropdown
$categories = $conn->query("SELECT category_id, category_name FROM categories_table");
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
                        <h1 class="kingster-page-title">CREATE PAGE</h1></div>
                </div>
            </div>
            <div class="kingster-page-wrapper" id="kingster-page-wrapper">
    <div class="gdlr-core-page-builder-body">
        <div class="gdlr-core-pbf-sidebar-wrapper">
            <div class="gdlr-core-pbf-sidebar-container gdlr-core-line-height-0 clearfix gdlr-core-js gdlr-core-container">
                <div class="gdlr-core-pbf-sidebar-content gdlr-core-column-40 gdlr-core-pbf-sidebar-padding gdlr-core-line-height" style="padding: 60px 10px 30px 30px;">
                    <div class="gdlr-core-pbf-background-wrap" style="background-color:rgba(158, 228, 207, 0.53) ;"></div>
                    <div class="gdlr-core-pbf-sidebar-content-inner">
<div class="gdlr-core-pbf-element">
    <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix gdlr-core-style-blog-full-with-frame" style="padding-bottom: 40px;">
        <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">

            <!-- Upcoming Events -->
            <Center> <h3>Create Page</h3></Center>
            <?php echo "Welcome, admin " . $_SESSION['admin_username'];   ?><br>
                                            <a href="logout.php" style="color: red; text-decoration: none;">Logout</a>
            <hr />
            <div class="form-container">
            <form action="" method="POST" enctype="multipart/form-data">
    <label>Page Title:</label>
    <input type="text" name="pg_title" required><br>

    <label>Select Category:</label>
    <select name="pg_category" required>
        <option value="">Select Category</option>
        <?php while ($row = $categories->fetch_assoc()): ?>
            <option value="<?= $row['category_id'] ?>"><?= $row['category_name'] ?></option>
        <?php endwhile; ?>
    </select><br>

    <label>Head Name:</label>
    <input type="text" name="pg_head_name" required><br>

    <label>Head Qualification:</label>
    <input type="text" name="pg_h_qualification" required><br>

    <label>Head Designation:</label>
    <input type="text" name="pg_h_designation" required><br>

    <label>Head Title:</label>
    <input type="text" name="pg_head_title" required><br>

    <label>Acronym:</label>
    <input type="text" name="pg_accronym" required><br>

    <label>Department Picture:</label>
    <input type="file" name="dept_picture" accept="image/*" required><br>

    <label>Head Picture:</label>
    <input type="file" name="head_picture" accept="image/*" required><br>

    <input type="submit" value="Create Page">
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
                <div class="gdlr-core-pbf-sidebar-left gdlr-core-column-extend-left  kingster-sidebar-area gdlr-core-column-10 gdlr-core-pbf-sidebar-padding  gdlr-core-line-height">
                                
                                <div class="gdlr-core-sidebar-item gdlr-core-item-pdlr">
                                    
                                    
                                    <div id="recent-posts-3" class="widget widget_recent_entries kingster-widget" style="background-color:rgb(206, 234, 221) ;">
                                        <?php include "pagesidebar.php"; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="gdlr-core-pbf-sidebar-right gdlr-core-column-extend-right  kingster-sidebar-area gdlr-core-column-10 gdlr-core-pbf-sidebar-padding  gdlr-core-line-height">
                                
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
            "home_url": "index.html"
        };
    </script>
    <script type='text/javascript' src='js/plugins.min.js'></script>
</body>
</html>
