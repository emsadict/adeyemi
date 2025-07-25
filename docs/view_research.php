<?php 
include 'db_connect.php';
?>
<?php include "mobilemenu.php"; ?>
    <div class="kingster-body-outer-wrapper ">
        <div class="kingster-body-wrapper clearfix  kingster-with-frame">
           <?php include "headermenu.php" ?>
           <?php   include "menu.php";?>


<?php


// Check if research ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid Research ID.";
    exit;
}

$research_id = $_GET['id'];

// Fetch research details
$query = "SELECT * FROM research_activities WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $research_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if research exists
if ($result->num_rows === 0) {
    echo "Research not found.";
    exit;
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include "head.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($event['title']); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file -->

    <style>
   .news-image img {
    max-width: 100%;
    height: auto;
    border-radius: 5px;
    border:rgb(108, 27, 27) 4px solid;
    margin-top: 20px;
}
.scrollable-content {
        max-height: 600px; /* Adjust as needed */
        overflow-y: auto; /* Enables vertical scroll */
        padding: 10px;
        border: 1px solid #ddd;
        background:rgb(206, 234, 221);
    }

    /* Custom Scrollbar Styling */
    .scrollable-content::-webkit-scrollbar {
        width: 8px;
    }
    .scrollable-content::-webkit-scrollbar-track {
        background:rgb(24, 140, 107);
    }
    .scrollable-content::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }
    .scrollable-content::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    .event-container ul {
    list-style: none;
    padding: 0;
}

.event-container ul li {
    margin: 10px 0;
}

.event-container ul li a {
    display: inline-block;
    padding: 10px 15px;
    font-size: 20px;
    font-weight: bold;
    text-decoration: none;
    border-radius: 5px;
    color: white;
    transition: background-color 0.3s, transform 0.2s;
}

.event-container ul {
    list-style: none;
    padding: 0;
}

.event-container ul li {
    margin: 10px 0;
}

.event-container ul li a {
    display: inline-block;
    padding: 10px 15px;
    font-size: 20px;
    font-weight: bold;
    text-decoration: none;
    border-radius: 5px;
    color: white;
    transition: background-color 0.3s, transform 0.2s;
}

.event-container ul li a i {
    margin-right: 10px;
}
.event-box {
        background-color: #f7f7f7;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 10px ;
        border:rgb(108, 27, 27) 4px solid;
        align-items: center;
    }
/* Specific colors for each platform */
.event-container ul li a[href*="facebook"] {
    background-color: #1877F2;
}

.event-container ul li a[href*="twitter"] {
    background-color: #1DA1F2;
}

.event-container ul li a[href*="zoom"] {
    background-color: #2D8CFF;
}

.event-container ul li a[href*="meet.google.com"] {  /* Fixed Google Meet link detection */
    background-color: #34A853;
}

.event-container ul li a[href*="youtube"] {
    background-color: #FF0000;
}

.event-container ul li a[href*="others"] {
    background-color: #555;
}

/* Hover effect */
.event-container ul li a:hover {
    transform: scale(1.1);
    opacity: 0.9;
}
.back-button {
    display: inline-block;
    padding: 12px 20px;
    font-size: 18px;
    font-weight: bold;
    color: white;
    background-color: #34A853; /* Dark Gray */
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s, transform 0.2s;
}

.back-button:hover {
    background-color:rgb(5, 112, 96); /* Lighter Gray */
    transform: scale(1.05);
    color: #ddd;
}
.event-details i {
    font-size: 24px; /* Makes the icons bigger */
    margin-right: 8px; /* Adds spacing between icon and text */
}

/* Specific colors for each detail */
.event-details .fa-calendar-alt { color: #e44d26; }  /* Date - Orange */
.event-details .fa-clock { color: #3498db; }         /* Time - Blue */
.event-details .fa-map-marker-alt { color: #27ae60; } /* Venue - Green */
.event-details .fa-align-left { color: #8e44ad; }    /* Description - Purple */


</style>
</head>

<body class="home page-template-default page page-id-2039 gdlr-core-body woocommerce-no-js tribe-no-js kingster-body kingster-body-front kingster-full  kingster-with-sticky-navigation  kingster-blockquote-style-1 gdlr-core-link-to-lightbox">



<div class="kingster-page-wrapper" id="kingster-page-wrapper">
    <div class="kingster-blog-title-wrap kingster-style-custom kingster-feature-image" 
         style="background-image: url(upload/<?php echo htmlspecialchars($event['image']); ?>); height:400px">
        <div class="kingster-header-transparent-substitute"></div>
        <div class="kingster-blog-title-overlay" style="opacity: 0.01;"></div>
        <div class="kingster-blog-title-bottom-overlay"></div>
        <div class="kingster-blog-title-container kingster-container">
            <div class="kingster-blog-title-content kingster-item-pdlr" 
                 style="padding-top: 200px; padding-bottom: 80px;">
                <header class="kingster-single-article-head clearfix">
                    <div class="kingster-single-article-date-wrapper post-date updated">
                        <div class="kingster-single-article-date-day"><?php echo date('d', strtotime($row['date'])); ?></div>
                        <div class="kingster-single-article-date-month"><?php echo date('M', strtotime($row['date'])); ?></div>
                    </div>
                    <div class="kingster-single-article-head-right">
                        <h1 class="kingster-single-article-title"><?php echo ucfirst(htmlspecialchars($row['title'])); ?></h1>
                    </div>
                </header>
            </div>
        </div>
    </div>

    <!-- Sidebar with Recent Posts -->
    <div class="gdlr-core-pbf-sidebar-left gdlr-core-column-extend-left kingster-sidebar-area gdlr-core-column-15 gdlr-core-pbf-sidebar-padding gdlr-core-line-height">
                    <div class="gdlr-core-sidebar-item gdlr-core-item-pdlr">
                        <div id="recent-posts-3" class="widget widget_recent_entries kingster-widget" style="background-color:rgba(158, 228, 207, 0.33) ;">
                            <h3 class="kingster-widget-title">Research</h3><span class="clear"></span>
                            <ul>
                                <?php
                                $recentPosts = $conn->query("SELECT id, title FROM research_activities ORDER BY date DESC LIMIT 10");
                                while ($post = $recentPosts->fetch_assoc()):
                                ?>
                                    <li><a href="view_research.php?id=<?= $post['id']; ?>"><?= $post['title']; ?></a></li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    </div>
                </div>
<!-- Sidebar with contant Posts -->
    <div class="kingster-content-container kingster-container">
        <div class="kingster-sidebar-wrap clearfix kingster-line-height-0 kingster-sidebar-style-none">
            <div class="kingster-sidebar-center kingster-column-45 kingster-line-height">
                <div class="kingster-content-wrap kingster-item-pdlr clearfix">
                    <div class="kingster-content-area">
                        
    <div class="event-container">
    <div class="event-box">
   

    <div class="container">
        <h2><?php echo ucfirst(htmlspecialchars($row['title'])); ?></h2>
        <p><strong>Date:</strong> <?php echo date('F j, Y', strtotime($row['date'])); ?></p>
        <p><strong>Principal Investigator:</strong> <?php echo htmlspecialchars($row['principal_investigator']); ?></p>
        <p><strong>Designation:</strong> <?php echo htmlspecialchars($row['designation']); ?></p>
        <p><strong>Department:</strong> <?php echo htmlspecialchars($row['department']); ?></p>
        <p><strong>School:</strong> <?php echo htmlspecialchars($row['school']); ?></p>
        <p><strong>Qualifications:</strong> <?php echo htmlspecialchars($row['qualifications']); ?></p>

        <?php if (!empty($row['co_investigators'])): ?>
            <h3>Co-Investigators</h3>
            <p><?php echo nl2br(htmlspecialchars($row['co_investigators'])); ?></p>
        <?php endif; ?>

        <h3>Abstract</h3>
        <p><?php echo nl2br(htmlspecialchars($row['abstract'])); ?></p>

        <h3>Findings</h3>
        <p><?php echo nl2br(htmlspecialchars($row['findings'])); ?></p>

        <h3>Recommendations</h3>
        <p><?php echo nl2br(htmlspecialchars($row['recommendations'])); ?></p>

        <?php if (!empty($row['image'])): ?>
            <h3>Research Image</h3>
            <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Research Image" width="300">
        <?php endif; ?>

        <br>
       
    </div>

      
        
        
        <a href="researchs.php" class="back-button"><i class="fas fa-arrow-left"></i> Back to Research Activities</a>

    </div>

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