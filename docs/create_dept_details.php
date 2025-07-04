<?php
require 'db_connect.php'; // Connect to the database
include "auth_session.php";
// Fetch departments from dept_table
$depts = $conn->query("
    SELECT dept_name 
    FROM dept_table 
    WHERE dept_name NOT IN (SELECT dept_name FROM dept_detail)
");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dept_name = $_POST['dept_name'];
    $dept_objective = $_POST['dept_objective'];
    $welcome_message = $_POST['welcome_message'];
    $programmes = $_POST['programmes'];

    $sql = "INSERT INTO dept_detail (dept_name, dept_objective, welcome_message, programmes) 
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $dept_name, $dept_objective, $welcome_message, $programmes);

    if ($stmt->execute()) {
        echo "<script>alert('Department details added successfully!'); window.location.href='manage_dept_details.php';</script>";
    } else {
        echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
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
                        <h1 class="kingster-page-title">Create A Page Details</h1></div>
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
        <?php echo "Welcome, admin " . $_SESSION['admin_username'];   ?><br>
          <a href="logout.php" style="color: red; text-decoration: none;">Logout</a>
            <hr />
            <?php if (!empty($message)) { echo "<div class='alert alert-success text-center'>$message</div>"; } ?>

        <div class="form-container">
       
        <center><h3>Add Department Details</h3></center>
<hr />

<form action="" method="POST">
    <label>Select Department:</label>
   
<select name="dept_name" required>
    <option value="">--Select Department--</option>
    <?php while ($row = $depts->fetch_assoc()): ?>
        <option value="<?= htmlspecialchars($row['dept_name']) ?>">
            <?= htmlspecialchars($row['dept_name']) ?>
        </option>
    <?php endwhile; ?>
</select><br>

    <label>Department Objective: (One per line)</label>
    <textarea name="dept_objective" rows="5" required></textarea><br>

    <label>Welcome Message:</label>
    <textarea name="welcome_message" rows="5" required></textarea><br>

    <label>Programmes:(One Programme per line)</label>
    <textarea name="programmes" rows="5" required></textarea><br>

    <input type="submit" value="Save Details">
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