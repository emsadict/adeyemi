
<?php
include 'db_connect.php'; // Include your database connection file

if (isset($_GET['dept_name'])) {
    $dept_name = $_GET['dept_name'];

    // Prevent SQL Injection
    $dept_name = mysqli_real_escape_string($conn, $dept_name);

    // Query to fetch details from dept_table
    $sql = "SELECT * FROM dept_table WHERE dept_name = '$dept_name'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Fetch and display department details
        while ($row = mysqli_fetch_assoc($result)) {
            $dept_name=htmlspecialchars($row['dept_name']);
            $dept_image=htmlspecialchars($row['dept_image']);
            $dept_head_pic=htmlspecialchars($row['dept_head_pic']);
           $dept_email= htmlspecialchars($row['dept_email']);
           $dept_phone= htmlspecialchars($row['dept_phone']);
            $dept_head=htmlspecialchars($row['dept_head']);
            $dept_head_title=htmlspecialchars($row['dept_head_title']);
            $dept_head_desig=htmlspecialchars($row['dept_head_desig']);
        }
    } else {
        echo "<p>No department found with the name: " . htmlspecialchars($dept_name) . "</p>";
    }
} else {
    echo "<p>Department name is missing in the URL.</p>";
}

// Query to fetch details from dept_detail
$dept_wel = $dept_progs = $dept_objs = $fallback_msg = "";

$sql1 = "SELECT * FROM dept_detail WHERE dept_name = ?";
$stmt = $conn->prepare($sql1);
$stmt->bind_param("s", $dept_name);
$stmt->execute();
$result1 = $stmt->get_result();

if ($result1->num_rows > 0) {
    $row1 = $result1->fetch_assoc();

    $dept_objs = !empty(trim($row1['dept_objective']))
        ? nl2br(htmlspecialchars($row1['dept_objective']))
        : "<em>No objective provided for <strong>" . htmlspecialchars($dept_name) . "</strong>.</em>";

    $dept_wel = !empty(trim($row1['welcome_message']))
        ? nl2br(htmlspecialchars($row1['welcome_message']))
        : "<em>No welcome message found for <strong>" . htmlspecialchars($dept_name) . "</strong>.</em>";

    $dept_progs = !empty(trim($row1['programmes']))
        ? nl2br(htmlspecialchars($row1['programmes']))
        : "<em>No programme available for <strong>" . htmlspecialchars($dept_name) . "</strong>.</em>";

} else {
    $fallback_msg = "<p><em>No department details found for <strong>" . htmlspecialchars($dept_name) . "</strong>.</em></p>";
}

$stmt->close();


?>

<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
   <?php include "head.php"; ?>
   <!-- CSS for Row Layout -->
<style>
    .staff-container {
        display: flex;
        width: 600px;
        flex-direction: column;
        gap: 20px; /* Space between rows */
    }
    .staff-row {
        display: flex;
        align-items: center;
        background:rgba(187, 244, 225, 0.61);
        padding: 15px;
        border-radius: 8px;
        box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
    }
    .staff-image img {
        border-radius: 50%;
        border: 5px solid rgb(10, 81, 59);
        margin-right: 20px;
    }
    .staff-details {
        flex: 1; /* Takes the remaining space */
    }
    .staff-details h3 {
        margin: 0;
        font-size: 20px;
        color: #333;
    }
    .staff-details p {
        margin: 5px 0;
        font-size: 16px;
        color: #555;
    }
    .more-btn {
        display: inline-block;
        padding: 8px 12px;
        background: #2eca9b;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 10px;
    }
    .more-btn:hover {
        background: #25a87e;
    }
</style>

</head>

<body class="home page-template-default page page-id-2039 gdlr-core-body woocommerce-no-js tribe-no-js kingster-body kingster-body-front kingster-full  kingster-with-sticky-navigation  kingster-blockquote-style-1 gdlr-core-link-to-lightbox">
<?php include "mobilemenu.php"; ?>
    <div class="kingster-body-outer-wrapper ">
        <div class="kingster-body-wrapper clearfix  kingster-with-frame">
           <?php include "headermenu.php" ?>
           <?php   include "menu.php";?>


        <div class="kingster-blog-title-wrap kingster-style-custom kingster-feature-image" 
         style="background-image: url(uploads/<?php echo $dept_image; ?>); height:400px">
        <div class="kingster-header-transparent-substitute"></div>
        <div class="kingster-blog-title-overlay" style="opacity: 0.01;"></div>
        <div class="kingster-blog-title-bottom-overlay"></div>
        <div class="kingster-blog-title-container kingster-container">
            <div class="kingster-blog-title-content kingster-item-pdlr" 
                 style="padding-top: 200px; padding-bottom: 80px;">
                <header class="kingster-single-article-head clearfix">
                    <div class="kingster-single-article-date-wrapper post-date updated">
                       
                    </div>
                    <div class="kingster-single-article-head-right">
                        <h1 class="kingster-single-article-title"><?php echo "Department of ". $dept_name; ?></h1>
                    </div>
                </header>
            </div>
        </div>
    </div>
            <div class="kingster-breadcrumbs">
                <div class="kingster-breadcrumbs-container kingster-container">
                    <div class="kingster-breadcrumbs-item kingster-item-pdlr"> <span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="Go to Kingster." href="index.html" class="home"><span property="name">Home</span></a>
                        <meta property="position" content="1">
                        </span>&gt;<span property="itemListElement" typeof="ListItem"><span property="name"><?php echo "Department of ". $dept_name; ?></span>
                        <meta property="position" content="2">
                        </span>
                    </div>
                </div>
            </div>
             <!-- body begins   -->

            
            <div class="kingster-page-title-wrap  kingster-style-custom kingster-left-align" style="background-image: none;">
                <div class="kingster-header-transparent-substitute"></div>
                <div class="kingster-page-title-overlay"></div>
                <div class="kingster-page-title-container kingster-container">
                    <div class="kingster-page-title-content kingster-item-pdlr" style="padding-top: 10px ;padding-bottom: 0px ;">
                      
                        <h1 class="kingster-page-title" style="font-size: 45px ;font-weight: 700 ;text-transform: none ;letter-spacing: 0px ;color:rgb(11, 0, 60) ;"><?php //echo htmlspecialchars($page['pg_title']); ?></h1></div>
                </div>
            </div>
        

            <!--- A SEGMENT -->
                    
            <!-- END OF A SEGMENT -->
            <div class="kingster-page-wrapper" id="kingster-page-wrapper">
                <div class="gdlr-core-page-builder-body">
                    <div class="gdlr-core-pbf-wrapper " style="padding: 0px 0px 0px 0px;">
                        <div class="gdlr-core-pbf-background-wrap"></div>
                        <div class="gdlr-core-pbf-section">
                        <div class="gdlr-core-pbf-section-container gdlr-core-container clearfix">
                            <div class="gdlr-core-pbf-element">
                                <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix  gdlr-core-style-blog-image" style="padding-bottom:0px ;">
                                    <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">
                                        <div class="gdlr-core-item-list  gdlr-core-item-pdlr gdlr-core-item-mgb gdlr-core-column-15">
                                            <div class="gdlr-core-blog-modern  gdlr-core-with-image  ">
                                            
                                                    <div class="gdlr-core-image-item-wrap gdlr-core-media-image  gdlr-core-image-item-style-rectangle" style="border-width: 0px;">
                                                        <a class="gdlr-core-lightgallery gdlr-core-js " href="upload/59.jpg"><img src="uploads/<?php echo $dept_head_pic; ?>" width="377" height="400" alt="" /><span class="gdlr-core-image-overlay "></span></a>
                                                    </div> 
                                                    <p style="margin-bottom:5px;font-size: 20px ;font-weight: 400 ;letter-spacing: 0px ;text-transform: none ;color:rgb(15, 13, 41) ; text-align:center;"><?php echo $dept_head; ?>
                                                   </p>
                                                        <p style="margin-bottom: 5px;font-size: 18px ;font-weight: 200 ;color:rgb(15, 13, 41) ; text-align:center;"><?php echo $dept_head_desig; ?>
                                                    </p> 
                                                        <p style="font-size: 18px ;font-weight: 200 ;color:rgb(15, 13, 41) ; text-align:center;"><?php echo $dept_head_title; ?>
                                                    </p>
                                            </div>
                                        </div>
                                        <div class="gdlr-core-item-list  gdlr-core-item-pdlr gdlr-core-item-mgb gdlr-core-column-40">
                                            <div class="gdlr-core-blog-modern  gdlr-core-with-image gdlr-core-hover-overlay-content gdlr-core-opacity-on-hover ">
                                                <div class="gdlr-core-blog-modern-inner">
                                                <a class="gdlr-core-lightgallery gdlr-core-js " href="upload/59.jpg"><img src="uploads/<?php echo $dept_image; ?>" width="850" height="100" alt="" /></a>

                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      
                                        
                                        
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
             
                            <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                            <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
                            <div class="gdlr-core-pbf-column gdlr-core-column-80 gdlr-core-column-first">
                                <div class="gdlr-core-tab-item gdlr-core-js gdlr-core-item-pdb  gdlr-core-left-align gdlr-core-tab-style1-vertical gdlr-core-item-pdlr">
                                <div class="gdlr-core-divider-item gdlr-core-divider-item-normal gdlr-core-item-pdlr gdlr-core-center-align">
                                <div class="gdlr-core-divider-line gdlr-core-skin-divider" style="border-color:rgb(3, 71, 52) ;border-bottom-width: 3px ;"></div>
                                </div>
                                        <div class="gdlr-core-tab-item-wrap">
                                            <div class="gdlr-core-tab-item-title-wrap clearfix gdlr-core-title-font">
                                                <div class="gdlr-core-tab-item-title  gdlr-core-active" data-tab-id="1">Introduction</div>
                                                <div class="gdlr-core-tab-item-title " data-tab-id="2">Objectives</div>
                                                <div class="gdlr-core-tab-item-title " data-tab-id="3">Programmes</div>
                                                <div class="gdlr-core-tab-item-title " data-tab-id="4">Staff Directory</div>
                                                <div class="gdlr-core-tab-item-title " data-tab-id="5">Contact Details</div>
                                            </div>
                                            <div class="gdlr-core-tab-item-content-wrap clearfix">
                                                <div class="gdlr-core-tab-item-content  gdlr-core-active" data-tab-id="1" >
                                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top">
                                                        <div class="gdlr-core-title-item-title-wrap ">
                                                            <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_25">Welcome<span class="gdlr-core-title-item-title-divider gdlr-core-skin-divider" ></span></h3></div>
                                                    </div>
                                                    <p style="text-align: justify;">
                                                          <?php    
                                                                if (!empty($fallback_msg)) {
                                                                    // No department detail found at all
                                                                    echo $fallback_msg;
                                                                } else {
                                                                    echo "<h4></h4>$dept_wel";
                                                                  
                                                                }
                                                                ?>        
                                                    </p> 
                                                    
                                                </div>
                                                <div class="gdlr-core-tab-item-content " data-tab-id="2" >
                                                    <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top">
                                                        <div class="gdlr-core-title-item-title-wrap ">
                                                            <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_25">Objectives<span class="gdlr-core-title-item-title-divider gdlr-core-skin-divider" ></span></h3></div>
                                                    </div>
                                                    <p style="text-align: justify;">

                                                         <?php    
                                                                if (!empty($fallback_msg)) {
                                                                    // No department detail found at all
                                                                    echo $fallback_msg;
                                                                } else {
                                                                  //  echo "<h4>Welcome Message</h4>$dept_wel";
                                                                  //  echo "<h4>Programmes</h4>$dept_progs";
                                                                    echo "<h4></h4>$dept_objs";
                                                                }
                                                                ?>     
                                                       </p>
                                                </div>
                                                <div class="gdlr-core-tab-item-content " data-tab-id="3" >
                                                    <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top">
                                                        <div class="gdlr-core-title-item-title-wrap ">
                                                            <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_26">Programmes <span class="gdlr-core-title-item-title-divider gdlr-core-skin-divider" ></span></h3></div>
                                                    </div>
                                                    <p style="text-align: justify;">
                                                     <?php    
                                                                if (!empty($fallback_msg)) {
                                                                    // No department detail found at all
                                                                    echo $fallback_msg;
                                                                } else {
                                                                   // echo "<h4>Welcome Message</h4>$dept_wel";
                                                                    echo "<h4></h4>$dept_progs";
                                                                   // echo "<h4>Objective</h4>$dept_objs";
                                                                }
                                                                ?>     
                                                    </p>

                                                    <p style="text-align: justify;"></p>
                                                    
                                                </div>
                                                <div class="gdlr-core-tab-item-content " data-tab-id="4" >
                                                    <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top">
                                                        <div class="gdlr-core-title-item-title-wrap ">
                                                            <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_27" style="color: #25a87e;">Staff Directory<span class="gdlr-core-title-item-title-divider gdlr-core-skin-divider" ></span></h3></div>
                                                    </div>
                                                       
                                                    <?php


$department = isset($_GET['dept_name']) ? $_GET['dept_name'] : ''; // Get department from URL

if (!empty($department)) {
    // Fetch staff where staff_dept matches the given department name
    $staffQuery = "SELECT * FROM staff_table WHERE staff_dept = ?";
    $stmt = $conn->prepare($staffQuery);
    $stmt->bind_param("s", $department);
    $stmt->execute();
    $staffResult = $stmt->get_result();

    if ($staffResult->num_rows > 0) {
        echo "<div class='staff-container'>"; // Wrap everything in a flex container
        while ($row = $staffResult->fetch_assoc()) {
            $staffName = ucfirst($row['staff_id']); // Assuming staff_id is their name
            $staffEmail = htmlspecialchars($row['staff_email']);
            $staffQualification = htmlspecialchars($row['staff_qualification']);
            $staffDesignation = htmlspecialchars($row['staff_designation']);
            $staffPhoto = !empty($row['staff_photo']) ? "uploads/staff_photos/{$row['staff_photo']}" : "upload/default.jpg"; // Default image if no photo
            ?>

            <!-- Staff Display Template -->
            <div class="staff-row">
                <div class="staff-image">
                    <img src="<?php echo $staffPhoto; ?>" alt="Staff Photo" width="120" height="120">
                </div>
                <div class="staff-details">
                    <h3><?php echo $staffName; ?></h3>
                    <p><strong>Qualification:</strong> <?php echo $staffQualification; ?></p>
                    <p><strong>Designation:</strong> <?php echo $staffDesignation; ?></p>
                    <p><strong>Email:</strong> <a href="mailto:<?php echo $staffEmail; ?>"><?php echo $staffEmail; ?></a></p>
                    <a class="more-btn" href="#">More Detail</a>
                </div>
            </div>

            <?php
        }
        echo "</div>"; // Close staff-container div
    } else {
        echo "<p class='alert alert-warning'>No staff found in the <strong>$department</strong> department.</p>";
    }

    $stmt->close();
} else {
    echo "<p class='alert alert-danger'>Department not specified!</p>";
}
?>
                                                </div>
                                                <div class="gdlr-core-tab-item-content " data-tab-id="5" >
                                                    <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top">
                                                        <div class="gdlr-core-title-item-title-wrap ">
                                                            <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_28">Contact<span class="gdlr-core-title-item-title-divider gdlr-core-skin-divider" ></span></h3></div>
                                                    </div>
                                                    <p style="text-align: justify;">
                                                        

                                                                <?php  echo $dept_email; ?> <br/>
                                                                     <?php    echo $dept_phone; ?>

                                                    </p>
                                                       
                                                </div>
                                              
                                            </div>
                                        </div>
                                    </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                        
                            </div>
                                </div>

                        </div>
                    </div>

                    
                </div>
            </div>


           <!-- body ends     -->



            <footer>
               <?php include "footer.php";?>
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