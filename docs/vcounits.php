
<?php
include "db_connect.php";
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
      

            <div class="kingster-page-title-wrap  kingster-style-custom kingster-left-align" style="background-image: url(upload/about-title-bg.jpg) ;">
                <div class="kingster-header-transparent-substitute"></div>
                <div class="kingster-page-title-overlay"></div>
                <div class="kingster-page-title-bottom-gradient"></div>
                <div class="kingster-page-title-container kingster-container">
                    <div class="kingster-page-title-content kingster-item-pdlr" style="padding-top: 100px ;padding-bottom: 60px ;">
                        <div class="kingster-page-caption" style="font-size: 21px ;font-weight: 400 ;letter-spacing: 0px ;">AFUED</div>
                        <h1 class="kingster-page-title" style="font-size: 48px ;font-weight: 700 ;text-transform: none ;letter-spacing: 0px ;color: #ffffff ;">VCO - Units/ Offices</h1></div>
                </div>
            </div>
            <div class="kingster-breadcrumbs">
                <div class="kingster-breadcrumbs-container kingster-container">
                    <div class="kingster-breadcrumbs-item kingster-item-pdlr"> <span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="Go to Kingster." href="index.php" class="home"><span property="name">Home</span></a>
                        <meta property="position" content="1">
                        </span>&gt;<span property="itemListElement" typeof="ListItem"><span property="name">VCO Units/Offices</span>
                        <meta property="position" content="2">
                        </span>
                    </div>
                </div>
            </div>
            <div class="kingster-page-wrapper" id="kingster-page-wrapper">
                <div class="gdlr-core-page-builder-body">
                    <div class="gdlr-core-pbf-sidebar-wrapper " style="margin: 0px 0px 30px 0px;">
                        <div class="gdlr-core-pbf-sidebar-container gdlr-core-line-height-0 clearfix gdlr-core-js gdlr-core-container">
                            <div class="gdlr-core-pbf-sidebar-content  gdlr-core-column-60 gdlr-core-pbf-sidebar-padding gdlr-core-line-height gdlr-core-column-extend-left" style="padding: 35px 0px 20px 0px;">
                                <div class="gdlr-core-pbf-sidebar-content-inner">
                                    <div class="gdlr-core-pbf-element">
                                        <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr">
                                            <div class="gdlr-core-title-item-title-wrap clearfix">
                                                <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " style="font-size: 27px ;font-weight: 600 ;letter-spacing: 0px ;text-transform: none ;">Units Under Vice Chancellor's Office</h3></div>
                                        </div>
                                    </div>
                                    
                                    <div class="gdlr-core-pbf-element">
                                        <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr" style="padding-bottom: 40px ;">
                                            <div class="gdlr-core-title-item-title-wrap clearfix">
                                                <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " style="font-size: 22px ;font-weight: 600 ;letter-spacing: 0px ;text-transform: none ;color: #223d71 ;margin-right: 30px ;">Click to visit</h3>
                                                <div class="gdlr-core-title-item-divider gdlr-core-right gdlr-core-skin-divider" style="font-size: 22px ;border-bottom-width: 3px ;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                             include 'db_connect.php';

                                             // Fetch pages with category 'directorate'
                                             $query = "SELECT pg_id, pg_title FROM pages_table WHERE pg_categ_id = 'vco'";
                                             $result = $conn->query($query);

                                             // Loop through the results and display them in the template
                                             while ($row = $result->fetch_assoc()) {
                                                 $pageTitle = htmlspecialchars($row['pg_title']);
                                                 $pageUrl = "vcounit.php?id=" . $row['pg_id']; // Link to view page dynamically

                                                 echo '<div class="gdlr-core-pbf-column gdlr-core-column-20">
                                                         <div class="gdlr-core-pbf-column-content-margin gdlr-core-js" style="margin: 0px -3px 0px -3px;">
                                                             <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js">
                                                                 <div class="gdlr-core-pbf-element">
                                                                     <div class="gdlr-core-feature-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-center-align">
                                                                         <div class="gdlr-core-feature-box gdlr-core-js gdlr-core-feature-box-type-outer" style="background-color:rgb(13, 73, 57); border-width: 0px; border-radius: 3px;">
                                                                             <div class="gdlr-core-feature-box-background" style="background-image: url(upload/major-bg-2.jpg); opacity: 0.14;"></div>
                                                                             <div class="gdlr-core-feature-box-content gdlr-core-sync-height-content">
                                                                                 <h3 class="gdlr-core-feature-box-item-title" style="font-size: 16px; font-weight: 600;">' . $pageTitle . '</h3>
                                                                             </div>
                                                                             <a class="gdlr-core-feature-box-link" href="' . $pageUrl . '" target="_self"></a>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>';
                                             }
                                             ?>
                            </div>
    
                        </div>
                    </div>
                  
                  <!--
                    <div class="gdlr-core-pbf-wrapper " style="padding: 65px 0px 60px 0px;">
                        <div class="gdlr-core-pbf-background-wrap" style="background-color: #192f59 ;"></div>
                        <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                            <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
                                <div class="gdlr-core-pbf-column gdlr-core-column-30 gdlr-core-column-first">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " style="padding: 45px 0px 0px 0px;">
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align" style="padding-bottom: 20px ;">
                                                    <div class="gdlr-core-text-box-item-content" style="font-size: 23px ;text-transform: none ;color: #ffffff ;">
                                                        <p>The PLP in Drafting Legislation, Regulation, and Policy has been offered by the Institute of Advanced Legal Studies with considerable success since 2004.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-button-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align"><a class="gdlr-core-button  gdlr-core-button-solid gdlr-core-button-no-border" href="#" style="font-size: 14px ;font-weight: 700 ;letter-spacing: 0px ;padding: 13px 26px 16px 30px;text-transform: none ;margin: 0px 10px 10px 0px;border-radius: 2px;-moz-border-radius: 2px;-webkit-border-radius: 2px;background: #3db166 ;"><span class="gdlr-core-content" >Apply</span><i class="gdlr-core-pos-right fa fa-external-link" style="font-size: 14px ;"  ></i></a><a class="gdlr-core-button  gdlr-core-button-solid gdlr-core-button-no-border" href="#" style="font-size: 14px ;font-weight: 700 ;letter-spacing: 0px ;padding: 13px 26px 16px 30px;text-transform: none ;border-radius: 2px;-moz-border-radius: 2px;-webkit-border-radius: 2px;background: #3db166 ;"><span class="gdlr-core-content" >Download Brochure</span><i class="gdlr-core-pos-right fa fa-file-pdf-o" style="font-size: 14px ;"  ></i></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="gdlr-core-pbf-column gdlr-core-column-30" id="gdlr-core-column-1">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " style="margin: -123px 0px 0px 0px;padding: 0px 0px 0px 40px;">
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-image-item gdlr-core-item-pdlr gdlr-core-item-pdb  gdlr-core-center-align">
                                                    <div class="gdlr-core-image-item-wrap gdlr-core-media-image  gdlr-core-image-item-style-rectangle" style="border-width: 0px;"><img src="upload/shutterstock_183400235-400x257.jpg" width="700" height="450"  alt="" /></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
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