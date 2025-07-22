<?php 
include 'db_connect.php';
$result = $conn->query("SELECT * FROM institutional_data ORDER BY uploaded_at DESC");
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
                        <h1 class="kingster-page-title">key Institutional Data<Data></Data></h1></div>
                </div>
            </div>
            <div class="kingster-page-wrapper" id="kingster-page-wrapper">
                <div class="gdlr-core-page-builder-body">
                    <div class="gdlr-core-pbf-wrapper " style="padding: 100px 20px 30px 20px;">
                        <div class="gdlr-core-pbf-background-wrap"></div>
                        <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                            <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-pbf-wrapper-full">
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-center-align gdlr-core-title-item-caption-bottom gdlr-core-item-pdlr" style="padding-bottom: 60px ;">
                                        <div class="gdlr-core-title-item-title-wrap clearfix">
                                            <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " style="text-transform: none ;">KEY INSTITUTIONAL DATA</h3></div><span class="gdlr-core-title-item-caption gdlr-core-info-font gdlr-core-skin-caption">With Names</span></div>
                                </div>
                                <div class="gdlr-core-pbf-element">
                                                    <div style="display: flex; flex-wrap: wrap;">
    <?php while ($row = $result->fetch_assoc()):
        $title = htmlspecialchars($row['title']);
        $session = htmlspecialchars($row['session']);
        $type = $row['type'];
        $filename = htmlspecialchars($row['filename']);
        $content = nl2br(htmlspecialchars($row['content']));
    ?>
    <div style="width:300px; margin:10px; border:1px solid #ccc; padding:10px; position:relative;">
        <h4><?= $title ?></h4>
        <small>Session: <?= $session ?></small><br><br>

        <?php if ($type === 'image'): ?>
            <div style="position:relative;">
                <a href="institutional_upload/<?= $filename ?>" target="_blank">
                    <img src="institutional_upload/<?= $filename ?>" width="100%" alt="<?= $title ?>">
                    <span style="position:absolute; top:10px; right:10px; background:rgba(0,0,0,0.6); color:white; padding:6px 8px; border-radius:50%; font-size:16px;">
                        🔍
                    </span>
                </a>
            </div>

        <?php elseif ($type === 'pdf'): ?>
            <div style="position:relative;">
                <iframe src="institutional_upload/<?= $filename ?>" width="100%" height="300px" style="border:1px solid #aaa;"></iframe>
                <a href="institutional_upload/<?= $filename ?>" target="_blank" title="Open PDF" style="position:absolute; top:10px; right:10px; background:rgba(0,0,0,0.6); color:white; padding:6px 8px; border-radius:50%; font-size:16px; text-decoration:none;">
                    🔍
                </a>
            </div>

        <?php elseif ($type === 'text'): ?>
            <div style="background:#f9f9f9; padding:10px; border:1px solid #ddd;">
                <?= $content ?>
            </div>
        <?php endif; ?>
    </div>
    <?php endwhile; ?>
</div>




                                </div>
                            </div>
                        </div>
                    </div>
                 
                  
                   
                  
                    
                </div>
            </div>


            <footer>
                
                
				<?php include "footer.php"; ?>
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