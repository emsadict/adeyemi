<?php
require 'db_connect.php'; // Include database connection

// Fetch schools for dropdown
$schools = $conn->query("SELECT pg_title FROM pages_table WHERE pg_categ_id = 'school'");

if (isset($_GET['id'])) {
    $dept_id = $_GET['id'];

    // Fetch department details
    $stmt = $conn->prepare("SELECT * FROM dept_table WHERE id = ?");
    $stmt->bind_param("s", $dept_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $dept = $result->fetch_assoc();
    $dept_id=$dept['dept_id'];
    $dept_name = $dept['dept_name'] ?? '';
    //$stmt->close();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dept_id = $_POST['dept_id'];
    $dept_name = $_POST['dept_name'];
    $dept_school = $_POST['dept_school'];
    $dept_head = $_POST['dept_head'];
    $dept_email = $_POST['dept_email'];
    $dept_phone = $_POST['dept_phone'];
    $dept_welcome_address = $_POST['dept_welcome_address'];
    $dept_head_title = $_POST['dept_head_title'];
    $dept_head_desig = $_POST['dept_head_desig'];

    $target_dir = "uploads/";
    $dept_head_pic = $dept['dept_head_pic'];
    $dept_image = $dept['dept_image'];

    // Handle optional image uploads
    if (!empty($_FILES['dept_head_pic']['name'])) {
        $dept_head_pic = basename($_FILES['dept_head_pic']['name']);
        move_uploaded_file($_FILES["dept_head_pic"]["tmp_name"], $target_dir . $dept_head_pic);
    }

    if (!empty($_FILES['dept_image']['name'])) {
        $dept_image = basename($_FILES['dept_image']['name']);
        move_uploaded_file($_FILES["dept_image"]["tmp_name"], $target_dir . $dept_image);
    }

    $sql = "UPDATE dept_table 
            SET dept_name=?, dept_school=?, dept_head=?, dept_email=?, dept_phone=?, 
                dept_welcome_address=?, dept_head_pic=?, dept_image=?, 
                dept_head_title=?, dept_head_desig=? 
            WHERE dept_id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssss", $dept_name, $dept_school, $dept_head, $dept_email, $dept_phone, $dept_welcome_address, $dept_head_pic, $dept_image, $dept_head_title, $dept_head_desig, $dept_id);

    if ($stmt->execute()) {
        echo "<script>alert('Department updated successfully!'); window.location.href='manage_dept.php';</script>";
    } else {
        echo "<p style='color:red;'>Update failed: " . $conn->error . "</p>";
    }

   // $stmt->close();
   // $conn->close();
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
                        <h1 class="kingster-page-title">Edit Department Profile</h1></div>
                </div>
            </div>
            <div class="kingster-page-wrapper" id="kingster-page-wrapper">
    <div class="gdlr-core-page-builder-body">
        <div class="gdlr-core-pbf-sidebar-wrapper">
            <div class="gdlr-core-pbf-sidebar-container gdlr-core-line-height-0 clearfix gdlr-core-js gdlr-core-container">
                <div class="gdlr-core-pbf-sidebar-content gdlr-core-column-45 gdlr-core-pbf-sidebar-padding gdlr-core-line-height" style="padding: 60px 10px 30px 30px;">
                    <div class="gdlr-core-pbf-background-wrap" style="background-color:rgba(158, 228, 207, 0.53) ;"></div>
                    <div class="gdlr-core-pbf-sidebar-content-inner">
<div class="gdlr-core-pbf-element">
    <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix gdlr-core-style-blog-full-with-frame" style="padding-bottom: 40px;">
        <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">
            <?php if (!empty($message)) { echo "<div class='alert alert-success text-center'>$message</div>"; } ?>

        <div class="form-container">
       
        <center><h3>Edit Department Profile</h3></center>
<hr />

<form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="dept_id" value="<?= htmlspecialchars($dept_id) ?>">

    <label>Department Name:</label>
    <input type="text" name="dept_name" value="<?= htmlspecialchars($dept_name) ?>" required><br>

    <label>Select School:</label>
    <select name="dept_school" required>
        <option value="">Select School</option>
        <?php while ($row = $schools->fetch_assoc()): ?>
            <option value="<?= $row['pg_title'] ?>" <?= ($row['pg_title'] == $dept['dept_school']) ? 'selected' : '' ?>>
                <?= $row['pg_title'] ?>
            </option>
        <?php endwhile; ?>
    </select><br>

    <label>HOD Name:</label>
    <input type="text" name="dept_head" value="<?= htmlspecialchars($dept['dept_head']) ?>" required><br>

    <label>Department Email:</label>
    <input type="email" name="dept_email" value="<?= htmlspecialchars($dept['dept_email']) ?>" required><br>

    <label>Department Phone:</label>
    <input type="text" name="dept_phone" value="<?= htmlspecialchars($dept['dept_phone']) ?>" required><br>

    <label>Welcome Address:</label>
    <textarea name="dept_welcome_address" required><?= htmlspecialchars($dept['dept_welcome_address']) ?></textarea><br>

    <label>Head Title:</label>
    <input type="text" name="dept_head_title" value="<?= htmlspecialchars($dept['dept_head_title']) ?>" required><br>

    <label>Head Designation:</label>
    <input type="text" name="dept_head_desig" value="<?= htmlspecialchars($dept['dept_head_desig']) ?>" required><br>

    <label>Change Department Head Picture:</label>
    <input type="file" name="dept_head_pic" accept="image/*"><br>
    <?php if ($dept['dept_head_pic']): ?>
        <img src="uploads/<?= $dept['dept_head_pic'] ?>" width="100"><br>
    <?php endif; ?>

    <label>Change Department Image:</label>
    <input type="file" name="dept_image" accept="image/*"><br>
    <?php if ($dept['dept_image']): ?>
        <img src="uploads/<?= $dept['dept_image'] ?>" width="100"><br>
    <?php endif; ?>

    <input type="submit" value="Update Department">
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
                <div class="gdlr-core-pbf-sidebar-left gdlr-core-column-extend-left kingster-sidebar-area gdlr-core-column-15 gdlr-core-pbf-sidebar-padding gdlr-core-line-height">
                    <div class="gdlr-core-sidebar-item gdlr-core-item-pdlr">
                        <div id="recent-posts-3" class="widget widget_recent_entries kingster-widget" style="background-color:rgb(206, 234, 221) ;">
                           
                            <?php include "pagesidebar.php"; ?>
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