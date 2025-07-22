<?php
include "db_connect.php";
include "auth_session.php";
// Handle delete request
// Handle deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    $stmt = $conn->prepare("SELECT filename, type FROM institutional_data WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($filename, $type);
    $stmt->fetch();
    $stmt->close();

    if ($filename && ($type === 'pdf' || $type === 'image')) {
        unlink("institutional_upload/" . $filename);
    }

    $delete = $conn->prepare("DELETE FROM institutional_data WHERE id = ?");
    $delete->bind_param("i", $id);
    $delete->execute();

    header("Location: manageinstitutiondata.php?success=deleted");
    exit();
}

// Fetch all records
$result = $conn->query("SELECT * FROM institutional_data ORDER BY uploaded_at DESC");

?>
<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
   <?php include "head.php"; ?>

   <style>

/* Custom styling for success button (green) */
.btn-success {
    background-color: #28a745 !important; /* Bootstrap default green */
    border-color: #218838 !important;
    color: #f7f7f7 !important;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 8px;
    transition: all 0.3s ease-in-out;
}

.btn-success:hover {
    background-color: #218838 !important;
    border-color: #1e7e34 !important;
}

/* Custom styling for danger button (red) */
.btn-danger {
    background-color: #dc3545 !important; /* Bootstrap default red */
    border-color: #c82333 !important;
    color: white !important;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 8px;
    transition: all 0.3s ease-in-out;
}

.btn-danger:hover {
    background-color: #c82333 !important;
    border-color: #bd2130 !important;
}

/* Custom styling for primary button (blue) */
.btn-primary {
    background-color: #007bff !important; /* Bootstrap default blue */
    border-color: #0056b3 !important;
    color: white !important;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 8px;
    transition: all 0.3s ease-in-out;
}

.btn-primary:hover {
    background-color: #0056b3 !important;
    border-color: #004085 !important;
}
    </style>
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
                
            </div>
            <div class="kingster-page-wrapper" id="kingster-page-wrapper">
                <div class="gdlr-core-page-builder-body">
                    <div class="gdlr-core-pbf-sidebar-wrapper ">
                        <div class="gdlr-core-pbf-sidebar-container gdlr-core-line-height-0 clearfix gdlr-core-js gdlr-core-container" id="madewith">
                            <div class="gdlr-core-pbf-sidebar-content  gdlr-core-column-50 gdlr-core-pbf-sidebar-padding gdlr-core-line-height" style="padding: 60px 10px 30px 30px;">
                                <div class="gdlr-core-pbf-background-wrap" style="background-color: #f7f7f7 ;"></div>
                                <div class="gdlr-core-pbf-sidebar-content-inner">
                                    <div class="gdlr-core-pbf-element">
                                        <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix  gdlr-core-style-blog-full-with-frame" style="padding-bottom: 40px ;">
                                            <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">

                                                <h2>🗂 Manage Institutional Data</h2>
                                                <?php if (isset($_GET['success']) && $_GET['success'] === 'deleted'): ?>
                                                    <p style="color:green;">✅ Item deleted successfully.</p>
                                                <?php endif; ?>
                                                
                                                <?php echo "Welcome, admin " . $_SESSION['admin_username'];   ?><br>
                                            <a href="logout.php" style="color: red; text-decoration: none;">Logout</a>
                                            <h2>Manage Institutional Data</h2>
                                                            <table border="1" class="table table-bordered table-striped">
                                                                <thead class="table-success">
                                                                    <tr>
                                                                        <th>ID</th>
                                                                        <th>Title</th>
                                                                        <th>Session</th>
                                                                        <th>Type</th>
                                                                        <th>Preview</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php while ($row = $result->fetch_assoc()):
                                                                        $id = $row['id'];
                                                                        $title = htmlspecialchars($row['title']);
                                                                        $session = htmlspecialchars($row['session']);
                                                                        $type = $row['type'];
                                                                        $filename = htmlspecialchars($row['filename']);
                                                                        $content = htmlspecialchars($row['content']);
                                                                    ?>
                                                                            <tr>
                                                                                <td><?= $id ?></td>
                                                                                <td><?= $title ?></td>
                                                                                <td><?= $session ?></td>
                                                                                <td><?= $type ?></td>
                                                                                <td>
                                                                                    <?php if ($type === 'image'): ?>
                                                                                        <img src="institutional_upload/<?= $filename ?>" width="100" />
                                                                                    <?php elseif ($type === 'pdf'): ?>
                                                                                        <a href="institutional_upload/<?= $filename ?>" target="_blank">📄 View PDF</a>
                                                                                    <?php elseif ($type === 'text'): ?>
                                                                                        <?= mb_strimwidth($content, 0, 50, "...") ?>
                                                                                    <?php endif; ?>
                                                                                </td>
                                                                                <td>
                                                                                    <a href="editinstitutiondata.php?id=<?= $id ?>">✏️ Edit</a> |
                                                                                    <a href="manageinstitutiondata.php?delete=<?= $id ?>" onclick="return confirm('Are you sure you want to delete this item?')">🗑 Delete</a>
                                                                                </td>
                                                                            </tr>
                                                                            <?php endwhile; ?>
                                                                        </tbody>
                                                                   </table>
                                                           
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="gdlr-core-pbf-sidebar-left gdlr-core-column-extend-left  kingster-sidebar-area gdlr-core-column-10 gdlr-core-pbf-sidebar-padding  gdlr-core-line-height">
                                
                                <div class="gdlr-core-sidebar-item gdlr-core-item-pdlr">
                                    
                                    
                                    <div id="recent-posts-3" class="widget widget_recent_entries kingster-widget" style="background-color:rgb(206, 234, 221) ; margin-top:10px;">
                                        <?php include "adminsidemenu.php"; ?>
                                        <?php include "pagesidebar.php"; ?>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

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
<?php
$conn->close();
?>