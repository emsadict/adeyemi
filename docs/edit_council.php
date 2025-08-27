<?php
include "auth_session.php";
if ($_SESSION['admin_role'] !== 'superadmin') {
    die("Access denied. Only superadmins can add admins.");
}

include "db_connect.php";

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "Invalid request.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $surname = $_POST['surname'];
    $othernames = $_POST['othernames'];
    $position = $_POST['position'];
    $status = $_POST['status'];
    $year_started = $_POST['year_started'];
    $year_ended = $_POST['year_ended'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $bio = $_POST['bio'];
    $appointed_by = $_POST['appointed_by'];

    $passport = '';
    if (!empty($_FILES['passport']['name'])) {
        $targetDir = "upload/GOVERNING/";
        $passport = basename($_FILES["passport"]["name"]);
        move_uploaded_file($_FILES["passport"]["tmp_name"], $targetDir . $passport);

        $stmt = $conn->prepare("UPDATE governing_council SET surname=?, othernames=?, position=?, status=?, year_started=?, year_ended=?, email=?, phone=?, passport=?, bio=?, appointed_by=? WHERE id=?");
        $stmt->bind_param("sssssssssssi", $surname, $othernames, $position, $status, $year_started, $year_ended, $email, $phone, $passport, $bio, $appointed_by, $id);
    } else {
        $stmt = $conn->prepare("UPDATE governing_council SET surname=?, othernames=?, position=?, status=?, year_started=?, year_ended=?, email=?, phone=?, bio=?, appointed_by=? WHERE id=?");
        $stmt->bind_param("ssssssssssi", $surname, $othernames, $position, $status, $year_started, $year_ended, $email, $phone, $bio, $appointed_by, $id);
    }

    $stmt->execute();
    header("Location: managecouncil.php?alert=Council member updated");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM governing_council WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$member = $result->fetch_assoc();
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
                        <h1 class="kingster-page-title">ADD COUNCIL MEMBERS</h1></div>
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
 <a href="managecouncil.php" class="btn btn-warning">Back</a>
 <div class="form-container">
<form method="post" enctype="multipart/form-data">
    Surname: <input type="text" name="surname" value="<?= htmlspecialchars($member['surname']) ?>"><br>
    Other Names: <input type="text" name="othernames" value="<?= htmlspecialchars($member['othernames']) ?>"><br>
    Position: <input type="text" name="position" value="<?= htmlspecialchars($member['position']) ?>"><br>
    Status: 
    <select name="status">
        <option value="active" <?= $member['status'] === 'active' ? 'selected' : '' ?>>Active</option>
        <option value="inactive" <?= $member['status'] === 'inactive' ? 'selected' : '' ?>>Inactive</option>
    </select><br>
    Year Started: <input type="text" name="year_started" value="<?= $member['year_started'] ?>"><br>
    Year Ended: <input type="text" name="year_ended" value="<?= $member['year_ended'] ?>"><br>
    Email: <input type="email" name="email" value="<?= htmlspecialchars($member['email']) ?>"><br>
    Phone: <input type="text" name="phone" value="<?= htmlspecialchars($member['phone']) ?>"><br>
    Passport: <input type="file" name="passport"><br>
    Bio: <textarea name="bio"><?= htmlspecialchars($member['bio']) ?></textarea><br>
    Appointed By: <input type="text" name="appointed_by" value="<?= htmlspecialchars($member['appointed_by']) ?>"><br>
    <button type="submit">Update Member</button>
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