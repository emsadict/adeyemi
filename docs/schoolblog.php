<?php 
include 'db_connect.php';

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
                        <h1 class="kingster-page-title">SCHOOL BLOG</h1></div>
                </div>
            </div>
            <div class="kingster-page-wrapper" id="kingster-page-wrapper">
    <div class="gdlr-core-page-builder-body">
        <div class="gdlr-core-pbf-sidebar-wrapper">
            <div class="gdlr-core-pbf-sidebar-container gdlr-core-line-height-0 clearfix gdlr-core-js gdlr-core-container">
                <div class="gdlr-core-pbf-sidebar-content gdlr-core-column-60 gdlr-core-pbf-sidebar-padding gdlr-core-line-height" style="padding: 60px 10px 30px 30px;">
                    <div class="gdlr-core-pbf-background-wrap" style="background-color: #f7f7f7;"></div>
                    <div class="gdlr-core-pbf-sidebar-content-inner">
<div class="gdlr-core-pbf-element">
    <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix gdlr-core-style-blog-full-with-frame" style="padding-bottom: 40px;">
        <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">
<?php
           $api_url = 'https://afued.edu.ng/blog/wp-json/wp/v2/posts?_embed';
$response = file_get_contents($api_url);
$posts = json_decode($response, true);

foreach ($posts as $post) {
    $title = $post['title']['rendered'];
    $link = $post['link'];
    $content = strip_tags($post['content']['rendered']);
    $words = implode(' ', array_slice(explode(' ', $content), 0, 20)) . '...';

    // Get featured image if available
    $image_url = '';
    if (isset($post['_embedded']['wp:featuredmedia'][0]['source_url'])) {
        $image_url = $post['_embedded']['wp:featuredmedia'][0]['source_url'];
    }

    echo "<div class='card'>";
    if ($image_url) {
        echo "<img src='$image_url' alt='Post Image'>";
    }
    echo "<div class='card-body'>";
    echo "<h3>$title</h3>";
    echo "<p>$words</p>";
    echo "<a href='$link' class='btn'>Read More</a>";
    echo "</div></div>";
}
       ?>   

        </div>
    </div>
</div>

<style>
    .card {
  width: 300px;
  border: 1px solid #ddd;
  border-radius: 8px;
  overflow: hidden;
  margin: 1rem;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  display: inline-block;
  vertical-align: top;
  background: #fff;
}

.card img {
  width: 100%;
  height: auto;
  display: block;
}

.card-body {
  padding: 1rem;
}

.card-body h3 {
  margin-top: 0;
  font-size: 1.2rem;
}

.card-body p {
  color: #444;
  font-size: 0.95rem;
}

.btn {
  display: inline-block;
  margin-top: 0.5rem;
  padding: 0.5rem 1rem;
  background:rgb(0, 170, 128);
  color: #fff;
  text-decoration: none;
  border-radius: 4px;
}

</style>


</div>
                </div>
                
                <!-- Sidebar with Recent Posts -->
                

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