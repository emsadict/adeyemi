<?php
require 'db_connect.php'; // Database connection
include "auth_session.php";
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST['title']);
    $session = trim($_POST['session']);
    $type = $_POST['type'];

    $filename = null;
    $content = null;
    $allowed = ['pdf', 'jpg', 'jpeg', 'png', 'gif'];
    $targetDir = "institutional_upload/";

    if ($type === "text") {
        $content = trim($_POST["content"]);
    } else {
        if (!empty($_FILES["file"]["name"])) {
            $file = $_FILES["file"];
            $extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

            if (!in_array($extension, $allowed)) {
                echo "❌ Invalid file type.";
                exit();
            }

            if ($file["size"] > 5 * 1024 * 1024) {
                echo "❌ File too large.";
                exit();
            }

            $filename = basename($file["name"]);
            move_uploaded_file($file["tmp_name"], $targetDir . $filename);
        }
    }

    $stmt = $conn->prepare("INSERT INTO institutional_data (title, session, type, content, filename) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $title, $session, $type, $content, $filename);
    $stmt->execute();
    echo "<p style='color:green'>✅ Uploaded successfully!</p>";
}
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
                        <h1 class="kingster-page-title">Upload Key Institutional Data</h1></div>
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
            <Center> <h3>Upload Key Institutional Data</h3></Center>
            <?php echo "Welcome, admin " . $_SESSION['admin_username'];   ?><br>
            <a href="logout.php" style="color: red; text-decoration: none;">Logout</a>
            <hr />
            <div class="form-container">
                    <form method="POST" enctype="multipart/form-data">
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Session:</label><br>
    <input type="text" name="session" required><br><br>

    <label>Type:</label><br>
    <select name="type" id="uploadType" onchange="toggleInput()" required>
        <option value="">--Select Type--</option>
        <option value="pdf">PDF</option>
        <option value="image">Image</option>
        <option value="text">Text</option>
    </select><br><br>

    <div id="fileSection" style="display:none;">
        <input type="file" name="file">
    </div>

    <div id="textSection" style="display:none;">
        <textarea name="content" rows="5" cols="50"></textarea>
    </div><br>

    <button type="submit">Upload</button>
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
<script>
function toggleInput() {
    const type = document.getElementById("uploadType").value;
    document.getElementById("fileSection").style.display = (type === "pdf" || type === "image") ? "block" : "none";
    document.getElementById("textSection").style.display = (type === "text") ? "block" : "none";
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
            "home_url": "index.html"
        };
    </script>
    <script type='text/javascript' src='js/plugins.min.js'></script>
</body>
</html>
