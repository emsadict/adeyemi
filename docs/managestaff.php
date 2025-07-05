<?php 
include "db_connect.php";
include "auth_session.php";

// Now the user is verified, place protected content here
echo "Welcome, admin " . $_SESSION['admin_username'];
// Fetch all staff records
$sql = "SELECT * FROM staff_table ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
   <?php include "head.php"; ?>
   <style>
table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        th, td,tr {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        img {
            width: 60px;
            height: auto;
            border-radius: 4px;
        }
        .actions a {
            margin-right: 8px;
            text-decoration: none;
            padding: 4px 8px;
            border-radius: 4px;
            color: white;
        }
        .edit { background-color: #007bff; }
        .delete { background-color: #dc3545; }
        .view { background-color: #28a745; }
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
                        <div class="gdlr-core-pbf-sidebar-container gdlr-core-line-height-0 clearfix gdlr-core-js gdlr-core-container">
                            <div class="gdlr-core-pbf-sidebar-content  gdlr-core-column-50 gdlr-core-pbf-sidebar-padding gdlr-core-line-height" style="padding: 60px 10px 30px 30px;">
                                <div class="gdlr-core-pbf-background-wrap" style="background-color: #f7f7f7 ;"></div>
                                <div class="gdlr-core-pbf-sidebar-content-inner">
                                    <div class="gdlr-core-pbf-element">
                                        <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix  gdlr-core-style-blog-full-with-frame" style="padding-bottom: 40px ;">
                                            <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">
                                               <?php echo "Welcome, admin " . $_SESSION['admin_username'];   ?><br>
                                            <a href="logout.php" style="color: red; text-decoration: none; float:right;">Logout</a>
  
                                                
                                                                <h5>Staff Management</h5>

<table>
    <thead>
        <tr>
            <th>S/N</th>
            <th>Staff ID</th>
            <th>Department</th>
            <th>Email</th>
           
            
            <th>Designation</th>
            <th>Photo</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $sn = 1; // Serial number counter
        if ($result->num_rows > 0): 
            while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $sn++ ?></td>
                    <td><?= $row['staff_id'] ?></td>
                    <td><?= $row['staff_dept'] ?></td>
                    <td><?= $row['staff_email'] ?></td>
                    
                    <td><?= $row['staff_designation'] ?></td>
                    <td>
                        <?php if (!empty($row['staff_photo'])): ?>
                            <img src="uploads/staff_photos/<?= $row['staff_photo'] ?>" alt="Staff Photo">
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>
                    <td class="actions">
                        <a href="editstaff.php?id=<?= $row['id'] ?>" class="edit">Edit</a>
                        <a href="deletestaff.php?id=<?= $row['id'] ?>" class="delete" onclick="return confirm('Are you sure you want to delete this staff?');">Delete</a>
                        <a href="viewstaff.php?id=<?= $row['id'] ?>" class="view">View</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="9">No staff records found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
                                              
                                            
                                              
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="gdlr-core-pbf-sidebar-left gdlr-core-column-extend-right  kingster-sidebar-area gdlr-core-column-10 gdlr-core-pbf-sidebar-padding  gdlr-core-line-height">
                                
                                <div class="gdlr-core-sidebar-item gdlr-core-item-pdlr">
                                    
                                    
                                    <div id="recent-posts-3" class="widget widget_recent_entries kingster-widget" style="background-color:rgb(206, 234, 221) ;">
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