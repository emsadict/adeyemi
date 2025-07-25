<?php
include("db_connect.php");
// Fetch latest news
$sql = "SELECT id, title, image, date,  content, author  FROM news ORDER BY date DESC LIMIT 5";
$result = $conn->query($sql);

// Fetch the latest news
$latest_news_query = "SELECT * FROM news ORDER BY created_at DESC LIMIT 1";
$latest_news_result = $conn->query($latest_news_query);

// Fetch the rest of the news
$other_news_query = "SELECT * FROM news ORDER BY created_at DESC LIMIT 4 OFFSET 1";
$other_news_result = $conn->query($other_news_query);


//small Slider code
// Fetch images from the database
$query7 = "SELECT title, image_path FROM images ORDER BY created_at DESC LIMIT 5";
$result7 = $conn->query($query7);

$slides7 = [];

while ($row7 = $result7->fetch_assoc()) {
    $slides7[] = [
        "title" => htmlspecialchars($row7["title"]),
        "image_path" => htmlspecialchars($row7["image_path"])
    ];
}

// Encode data for JavaScript
$slides_json = json_encode($slides7);
// larger slider code
include "db_connect.php";

$query8 = "SELECT title, description, image_path FROM  imagegallery  ORDER BY uploaded_at DESC LIMIT 5";
$result8 = $conn->query($query8);

$slides8 = [];

while ($row8 = $result8->fetch_assoc()) {
    $slides8[] = [
        "title" => htmlspecialchars($row8["title"]),
        "description" => htmlspecialchars($row8["description"]),
        "image_path" => htmlspecialchars($row8["image_path"])
    ];
}

// Encode data for JavaScript
$slides_json1 = json_encode($slides8);
?>

<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
   <?php include "head.php"; ?>
<style>
.swiper-container {
    max-width: 100%;
    height: 600px;
    overflow: hidden; /* Prevent images from escaping */
}

.slider-image-container {
    position: relative;
    text-align: center;
    color: white;
}

.slider-img {
    width: 100%;
    height: 600px;
    object-fit: cover;
    border-radius: 10px;
}

.slider-description {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 60%;
    transform: translate(-50%, -50%);
    font-size: 24px;
    font-weight: bold;
    background: rgba(58, 181, 154, 0.5);
    padding: 10px;
    border-radius: 5px;
}

.slider-title {
    text-align: Buttom;
    font-size: 22px;
    margin-top: 10px;
    color: white;
    background: rgba(0, 0, 0, 0.7);
    padding: 5px;
    border-radius: 5px;
    position: relative;
    bottom: -20px;
}

.news-marquee {
      background-color:rgb(247, 251, 250);
      padding: 15px;
      border: 1px solid #ccc;
      font-family: Arial, sans-serif;
      color: #333;
    }

    .news-marquee marquee {
      font-size: 1.1em;
    }

    .news-item {
      margin-right: 50px;
      white-space: nowrap;
      display: inline-block;
    }

    .news-title {
      font-weight: bold;
      margin-right: 5px;
    }
.popup-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.6);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.popup-box {
  background: white;
  border-radius: 10px;
  width: 90%;
  max-width: 600px;
  padding: 20px;
  position: relative;
  text-align: center;
  box-shadow: 0 0 20px rgba(0,0,0,0.3);
  overflow-y: auto; /* allows scrolling of content if it overflows */
  max-height: 80vh; /* limits height to prevent full screen takeover */
}

.image-scroll-area {
  max-height: 300px; /* only part of image is visible */
  overflow-y: auto;
  border-radius: 8px;
  margin-bottom: 15px;
}

.image-scroll-area img {
  width: 100%;
  display: block;
}

.popup-box h5 {
  margin: 10px 0;
  color: #333;
}

.popup-box p {
  color: #555;
  font-size: 1em;
  margin-bottom: 20px;
}

.close-icon {
  position: absolute;
  top: 10px;
  right: 15px;
  font-size: 20px;
  color: #888;
  cursor: pointer;
}

.close-icon:hover {
  color: #000;
}

.close-btn,
.open-btn {
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  color: white;
}

.close-btn {
  background-color: crimson;
}

.close-btn:hover {
  background-color: darkred;
}

.open-btn {
  background-color: lightgreen;
}

</style>
</head>

<body class="home page-template-default page page-id-2039 gdlr-core-body woocommerce-no-js tribe-no-js kingster-body kingster-body-front kingster-full  kingster-with-sticky-navigation  kingster-blockquote-style-1 gdlr-core-link-to-lightbox">
<!-- Popup -->
<div class="popup-overlay" id="popup">
  <div class="popup-box">
    <span class="close-icon" onclick="closePopup()">×</span>

    <div class="image-scroll-area">
      <img src="images/advert.jpg" alt="Part-Time Degree Banner">
    </div>

    <h5>Part-Time Degree Programmes</h5>
    <p>
      ADEYEMI FEDERAL UNIVERSITY OF EDUCATION, ONDO <br>
      DIRECTORATE OF CONTINUING EDUCATION AND PART-TIME STUDIES <br><br>
      ADMISSION INTO PART-TIME DEGREE PROGRAMME <br>
      OBAFEMI AWOLOWO UNIVERSITY, ILE-IFE <br>
      2025/2026 CONTACT SESSION
      <a href="https://portal.afued.edu.ng" target="_blank">
        <button class="open-btn">Read More</button>
      </a>
    </p>

    <button class="close-btn" onclick="closePopup()">Close</button>
  </div>
</div>

<script>
  function closePopup() {
    document.getElementById("popup").style.display = "none";
  }
</script>
<?php include "mobilemenu.php"; ?>
    <div class="kingster-body-outer-wrapper ">
        <div class="kingster-body-wrapper clearfix  kingster-with-frame">
           <?php include "headermenu.php" ?>
           <?php   include "menu.php";?>

            <div class="kingster-page-wrapper" id="kingster-page-wrapper">
                <div class="gdlr-core-page-builder-body">
                    <div class="gdlr-core-pbf-wrapper " style="padding: 0px 0px 0px 0px;">
                        <div class="gdlr-core-pbf-background-wrap" style="background-color: rgba(16, 70, 46, 0.9) ;"></div>
                        <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                            <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-pbf-wrapper-full-no-space">
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-revolution-slider-item gdlr-core-item-pdlr gdlr-core-item-pdb " style="padding-bottom: 0px ;">

                                        <div id="rev_slider_1_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-source="gallery" style="margin:0px auto;background:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
                                            <div id="rev_slider_1_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.8">
                                                <ul>
                                                    <li data-index="rs-3" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300" data-thumb="upload/slider-1-2-100x50.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description=""> <img src="upload/slider1.jpg" alt="" title="slider-1-2" style="overlay: rgb(5, 53, 27);" width="1800" height="1119" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>  
                                                   <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" id="slide-3-layer-4" data-x="-480" data-y="center" data-voffset="80" data-width="['2400']" data-height="['1000']" data-type="shape" data-responsive_offset="on" data-frames='[{"delay":330,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;background-color:rgba(16, 70, 46, 0.42);border-radius:3px 3px 3px 3px;"></div>
                                                    <!-- <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" id="slide-3-layer-4" data-x="50" data-y="center" data-voffset="80" data-width="['1150']" data-height="['100']" data-type="shape" data-responsive_offset="on" data-frames='[{"delay":330,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;background-color:rgba(16, 53, 36, 0.81);border-radius:3px 3px 3px 3px;"></div>
                                                     <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" id="slide-3-layer-4" data-x="50" data-y="center" data-voffset="-40" data-width="['1100']" data-height="['100']" data-type="shape" data-responsive_offset="on" data-frames='[{"delay":330,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;background-color:rgba(16, 53, 36, 0.81);border-radius:3px 3px 3px 3px;"></div>-->

                                                        <div class="tp-caption   tp-resizeme" id="slide-3-layer-1" data-x="38" data-y="center" data-voffset="-130" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":10,"speed":300,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 5; white-space: nowrap; font-size: 33px; line-height: 33px; font-weight: 300; color: #ffffff; letter-spacing: 0px;font-family:Poppins;">Foremost Teacher Training Institutions in Nigeria</div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-1-layer-2" data-x="33" data-y="center" data-voffset="-49" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":370,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6; white-space: nowrap; font-size: 83px; line-height: 83px; font-weight: 600; color: #ffffff; letter-spacing: 0px;font-family:Poppins;">Adeyemi</div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-3-layer-3" data-x="423" data-y="center" data-voffset="-51" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":360,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8; white-space: nowrap; font-size: 88px; line-height: 60px; font-weight: 600; color: #ffffff; letter-spacing: 0px;font-family:Poppins;"> Federal  University</div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-3-layer-3" data-x="55" data-y="center" data-voffset="70" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":360,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 10; white-space: nowrap;font-size: 88px; line-height: 60px; font-weight: 600; color: #ffffff; letter-spacing: 0px;font-family:Poppins;">of Education, Ondo (AFUED) </div>
                                                        
                                                        <div class="tp-caption rev-btn rev-hiddenicon " id="slide-3-layer-6" data-x="34" data-y="center" data-voffset="180" data-width="['auto']" data-height="['auto']" data-type="button" data-responsive_offset="on" data-frames='[{"delay":660,"speed":300,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgb(1, 135, 63);bg:rgba(255,255,255,1);bw:0 0 0 5px;"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[19,19,19,19]" data-paddingright="[21,21,21,21]" data-paddingbottom="[19,19,19,19]" data-paddingleft="[21,21,21,21]" style="z-index: 9; white-space: nowrap; font-size: 17px; line-height: 16px; font-weight: 600; color: #2d2d2d; letter-spacing: 0px;font-family:Poppins;background-color:rgb(255,255,255);border-color:rgb(61,177,102);border-style:solid;border-width:0px 0px 0px 5px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;">Take A Tour</div>
                                                    </li>
                                                    <li data-index="rs-1" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300" data-thumb="upload/slider-2-100x50.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description=""> <img src="upload/slider2.jpg" alt="" title="slider-2" width="1800" height="1119" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                                                    <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" id="slide-3-layer-4" data-x="-480" data-y="center" data-voffset="80" data-width="['2400']" data-height="['1000']" data-type="shape" data-responsive_offset="on" data-frames='[{"delay":330,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;background-color:rgba(16, 70, 46, 0.42);border-radius:3px 3px 3px 3px;"></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-1-layer-1" data-x="70" data-y="center" data-voffset="-130" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":10,"speed":300,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 5; white-space: nowrap; font-size: 33px; line-height: 33px; font-weight: 300; color: #ffffff; letter-spacing: 0px;font-family:Poppins;">Welcome to </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-1-layer-2" data-x="33" data-y="center" data-voffset="-49" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":370,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6; white-space: nowrap; font-size: 83px; line-height: 83px; font-weight: 600; color: #ffffff; letter-spacing: 0px;font-family:Poppins;">The foremost Teacher Training </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-1-layer-2" data-x="33" data-y="center" data-voffset="60" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":370,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6; white-space: nowrap; font-size: 83px; line-height: 83px; font-weight: 600; color: #ffffff; letter-spacing: 0px;font-family:Poppins;">Institution in Nigeria</div>

                                                        <div class="tp-caption rev-btn rev-hiddenicon " id="slide-1-layer-6" data-x="34" data-y="center" data-voffset="160" data-width="['auto']" data-height="['auto']" data-type="button" data-responsive_offset="on" data-frames='[{"delay":740,"speed":300,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(16, 70, 46, 0.9);bg:rgba(255,255,255,1);bw:0 0 0 5px;"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[19,19,19,19]" data-paddingright="[21,21,21,21]" data-paddingbottom="[19,19,19,19]" data-paddingleft="[21,21,21,21]" style="z-index: 7; white-space: nowrap; font-size: 17px; line-height: 16px; font-weight: 600; color: #2d2d2d; letter-spacing: 0px;font-family:Poppins;background-color:rgb(255,255,255);border-color:rgb(61,177,102);border-style:solid;border-width:0px 0px 0px 5px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;">Take A Tour</div>
                                                    </li>

                                                    <li data-index="rs-4" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300" data-thumb="upload/slider-1-2-100x50.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description=""> <img src="upload/registry.jpg" alt="" title="slider-1-2" style="overlay: rgb(5, 53, 27);" width="1800" height="1119" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                                                    <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" id="slide-3-layer-4" data-x="-480" data-y="center" data-voffset="80" data-width="['2400']" data-height="['1000']" data-type="shape" data-responsive_offset="on" data-frames='[{"delay":330,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;background-color:rgba(16, 70, 46, 0.42);border-radius:3px 3px 3px 3px;"></div>
                                                    <!-- <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" id="slide-3-layer-4" data-x="50" data-y="center" data-voffset="80" data-width="['1150']" data-height="['100']" data-type="shape" data-responsive_offset="on" data-frames='[{"delay":330,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;background-color:rgba(16, 53, 36, 0.81);border-radius:3px 3px 3px 3px;"></div>
                                                    <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" id="slide-3-layer-4" data-x="50" data-y="center" data-voffset="-40" data-width="['1100']" data-height="['100']" data-type="shape" data-responsive_offset="on" data-frames='[{"delay":330,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;background-color:rgba(16, 53, 36, 0.81);border-radius:3px 3px 3px 3px;"></div>-->

                                                        <div class="tp-caption   tp-resizeme" id="slide-3-layer-2" data-x="55" data-y="center" data-voffset="-52" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":360,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7; white-space: nowrap; font-size: 88px; line-height: 88px; font-weight: 600; color: #ffffff; letter-spacing: 0px;font-family:Poppins;">AFUED</div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-3-layer-3" data-x="423" data-y="center" data-voffset="-51" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":360,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8; white-space: nowrap; font-size: 88px; line-height: 60px; font-weight: 600; color: #ffffff; letter-spacing: 0px;font-family:Poppins;"> Where examplary</div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-3-layer-3" data-x="55" data-y="center" data-voffset="70" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":360,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 10; white-space: nowrap;font-size: 88px; line-height: 60px; font-weight: 600; color: #ffffff; letter-spacing: 0px;font-family:Poppins ;">Educators are made</div>
                                                        
                                                        <div class="tp-caption rev-btn rev-hiddenicon " id="slide-3-layer-6" data-x="34" data-y="center" data-voffset="180" data-width="['auto']" data-height="['auto']" data-type="button" data-responsive_offset="on" data-frames='[{"delay":660,"speed":300,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgb(1, 135, 63);bg:rgba(255,255,255,1);bw:0 0 0 5px;"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[19,19,19,19]" data-paddingright="[21,21,21,21]" data-paddingbottom="[19,19,19,19]" data-paddingleft="[21,21,21,21]" style="z-index: 9; white-space: nowrap; font-size: 17px; line-height: 16px; font-weight: 600; color: #2d2d2d; letter-spacing: 0px;font-family:Poppins;background-color:rgb(255,255,255);border-color:rgb(61,177,102);border-style:solid;border-width:0px 0px 0px 5px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;">Take A Tour</div>
                                                    </li>

                                                    <li data-index="rs-5" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300" data-thumb="upload/slider-1-2-100x50.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description=""> <img src="upload/tetfund_building.jpg" alt="" title="slider-1-2" style="overlay: rgb(5, 53, 27);" width="1800" height="1119" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                                                    <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" id="slide-3-layer-4" data-x="-480" data-y="center" data-voffset="80" data-width="['2400']" data-height="['1000']" data-type="shape" data-responsive_offset="on" data-frames='[{"delay":330,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;background-color:rgba(16, 70, 46, 0.42);border-radius:3px 3px 3px 3px;"></div>

                                                        <div class="tp-caption   tp-resizeme" id="slide-3-layer-2" data-x="55" data-y="center" data-voffset="-52" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":360,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7; white-space: nowrap; font-size: 88px; line-height: 88px; font-weight: 700; color: #ffffff; letter-spacing: 0px;font-family:Poppins ;">AFUED</div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-3-layer-3" data-x="423" data-y="center" data-voffset="-51" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":360,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8; white-space: nowrap; font-size: 88px; line-height: 60px; font-weight: 600; color: #ffffff; letter-spacing: 0px;font-family:Poppins ;"> We are with you</div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-3-layer-3" data-x="55" data-y="center" data-voffset="70" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":360,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 10; white-space: nowrap;font-size: 88px; line-height: 60px; font-weight: 600; color: #ffffff; letter-spacing: 0px;font-family:Poppins ;">from start to finish</div>
                                                        
                                                        <div class="tp-caption rev-btn rev-hiddenicon " id="slide-3-layer-6" data-x="34" data-y="center" data-voffset="180" data-width="['auto']" data-height="['auto']" data-type="button" data-responsive_offset="on" data-frames='[{"delay":660,"speed":300,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgb(1, 135, 63);bg:rgba(255,255,255,1);bw:0 0 0 5px;"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[19,19,19,19]" data-paddingright="[21,21,21,21]" data-paddingbottom="[19,19,19,19]" data-paddingleft="[21,21,21,21]" style="z-index: 9; white-space: nowrap; font-size: 17px; line-height: 16px; font-weight: 600; color: #2d2d2d; letter-spacing: 0px;font-family:Poppins;background-color:rgb(255,255,255);border-color:rgb(61,177,102);border-style:solid;border-width:0px 0px 0px 5px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;">Take A Tour</div>
                                                    </li>

                                                    <li data-index="rs-6" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300" data-thumb="upload/slider-1-2-100x50.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description=""> <img src="upload/big_building.jpg" alt="" title="slider-1-2" style="overlay: rgb(5, 53, 27);" width="1800" height="1119" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                                                    <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" id="slide-3-layer-4" data-x="-480" data-y="center" data-voffset="80" data-width="['2400']" data-height="['1000']" data-type="shape" data-responsive_offset="on" data-frames='[{"delay":330,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;background-color:rgba(16, 70, 46, 0.42);border-radius:3px 3px 3px 3px;"></div>

                                                        <div class="tp-caption   tp-resizeme" id="slide-3-layer-2" data-x="55" data-y="center" data-voffset="-52" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":360,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7; white-space: nowrap; font-size: 88px; line-height: 88px; font-weight: 700; color: #ffffff; letter-spacing: 0px;font-family:Playfair ;">AFUED</div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-3-layer-3" data-x="423" data-y="center" data-voffset="-51" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":360,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8; white-space: nowrap; font-size: 88px; line-height: 60px; font-weight: 300; color: #ffffff; letter-spacing: 0px;font-family:Playfair ;">Moulding Educators</div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-3-layer-3" data-x="55" data-y="center" data-voffset="70" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":360,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 10; white-space: nowrap;font-size: 88px; line-height: 60px; font-weight: 300; color: #ffffff; letter-spacing: 0px;font-family:Playfair ;">with the capacity to change the world</div>
                                                        
                                                        <div class="tp-caption rev-btn rev-hiddenicon " id="slide-3-layer-6" data-x="34" data-y="center" data-voffset="180" data-width="['auto']" data-height="['auto']" data-type="button" data-responsive_offset="on" data-frames='[{"delay":660,"speed":300,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgb(1, 135, 63);bg:rgba(255,255,255,1);bw:0 0 0 5px;"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[19,19,19,19]" data-paddingright="[21,21,21,21]" data-paddingbottom="[19,19,19,19]" data-paddingleft="[21,21,21,21]" style="z-index: 9; white-space: nowrap; font-size: 17px; line-height: 16px; font-weight: 600; color: #2d2d2d; letter-spacing: 0px;font-family:Poppins;background-color:rgb(255,255,255);border-color:rgb(61,177,102);border-style:solid;border-width:0px 0px 0px 5px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;">Take A Tour</div>
                                                    </li>
                                                    
                                                   
                                                </ul>
                                                <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gdlr-core-pbf-wrapper  hp1-col-services"  data-skin="Blue Title" id="gdlr-core-wrapper-1">
                        <div class="gdlr-core-pbf-background-wrap"></div>
                        <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                            <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-pbf-wrapper-full-no-space">
                                <div class=" gdlr-core-pbf-wrapper-container-inner gdlr-core-item-mglr clearfix" id="div_1dd7_0">
                                    <div class="gdlr-core-pbf-column gdlr-core-column-15 gdlr-core-column-first">
                                        <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " id="div_1dd7_1">
                                            <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                                <div class="gdlr-core-pbf-element">
                                                    <div class="gdlr-core-column-service-item gdlr-core-item-pdb  gdlr-core-left-align gdlr-core-column-service-icon-left gdlr-core-with-caption gdlr-core-item-pdlr" id="div_1dd7_2">
                                                        <div class="gdlr-core-column-service-media gdlr-core-media-image"><img src="upload/icon-1.png" alt="" width="40" height="40" title="icon-1" /></div>
                                                        <div class="gdlr-core-column-service-content-wrapper">
                                                            <div class="gdlr-core-column-service-title-wrap">
                                                                <h3 class="gdlr-core-column-service-title gdlr-core-skin-title" id="h3_1dd7_0">University Life</h3>
                                                                <div class="gdlr-core-column-service-caption gdlr-core-info-font gdlr-core-skin-caption" id="div_1dd7_3">Overall in here</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gdlr-core-pbf-column gdlr-core-column-15" id="gdlr-core-column-1">
                                        <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " id="div_1dd7_4">
                                            <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                                <div class="gdlr-core-pbf-element">
                                                    <div class="gdlr-core-column-service-item gdlr-core-item-pdb  gdlr-core-left-align gdlr-core-column-service-icon-left gdlr-core-with-caption gdlr-core-item-pdlr" id="div_1dd7_5">
                                                        <div class="gdlr-core-column-service-media gdlr-core-media-image"><img src="upload/icon-2.png" alt="" width="44" height="40" title="icon-2" /></div>
                                                        <div class="gdlr-core-column-service-content-wrapper">
                                                            <div class="gdlr-core-column-service-title-wrap">
                                                                <h3 class="gdlr-core-column-service-title gdlr-core-skin-title" id="h3_1dd7_1">Graduation</h3>
                                                                <div class="gdlr-core-column-service-caption gdlr-core-info-font gdlr-core-skin-caption" id="div_1dd7_6">Getting Degree</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gdlr-core-pbf-column gdlr-core-column-15" id="gdlr-core-column-2">
                                        <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " id="div_1dd7_7">
                                            <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                                <div class="gdlr-core-pbf-element">
                                                    <div class="gdlr-core-column-service-item gdlr-core-item-pdb  gdlr-core-left-align gdlr-core-column-service-icon-left gdlr-core-with-caption gdlr-core-item-pdlr" id="div_1dd7_8">
                                                        <div class="gdlr-core-column-service-media gdlr-core-media-image"><img src="upload/icon-3.png" alt="" width="44" height="39" title="icon-3" /></div>
                                                        <div class="gdlr-core-column-service-content-wrapper">
                                                            <div class="gdlr-core-column-service-title-wrap">
                                                                <h3 class="gdlr-core-column-service-title gdlr-core-skin-title" id="h3_1dd7_2">Athletics</h3>
                                                                <div class="gdlr-core-column-service-caption gdlr-core-info-font gdlr-core-skin-caption" id="div_1dd7_9">Sport Clubs</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gdlr-core-pbf-column gdlr-core-column-15" id="gdlr-core-column-3">
                                        <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " id="div_1dd7_10">
                                            <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                                <div class="gdlr-core-pbf-element">
                                                    <div class="gdlr-core-column-service-item gdlr-core-item-pdb  gdlr-core-left-align gdlr-core-column-service-icon-left gdlr-core-with-caption gdlr-core-item-pdlr" id="div_1dd7_11">
                                                        <div class="gdlr-core-column-service-media gdlr-core-media-image"><img src="upload/icon-4.png" alt="" width="41" height="41" title="icon-4" /></div>
                                                        <div class="gdlr-core-column-service-content-wrapper">
                                                            <div class="gdlr-core-column-service-title-wrap">
                                                                <h3 class="gdlr-core-column-service-title gdlr-core-skin-title" id="h3_1dd7_3">Social</h3>
                                                                <div class="gdlr-core-column-service-caption gdlr-core-info-font gdlr-core-skin-caption" id="div_1dd7_12">Overall in here</div>
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
                    <div class="gdlr-core-pbf-wrapper "  id="gdlr-core-wrapper-2">
                        <div class="gdlr-core-pbf-background-wrap">
                            <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js" id="div_1dd7_13" data-parallax-speed="0.8"></div>
                        </div>
                        <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                            <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container-custom">
                                <div class="gdlr-core-pbf-column gdlr-core-column-30 gdlr-core-column-first">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " id="div_1dd7_14" data-sync-height="height-1">
                                        <div class="gdlr-core-pbf-background-wrap">
                                            <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js" id="div_1dd7_15" data-parallax-speed="0"></div>
                                                <div class="vc-name-overlay">Prof. Samuel Akintunde<br> Ag. Vice Chancellor</div> 
                                                <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js gdlr-core-sync-height-content"></div>
                                        </div>
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js  gdlr-core-sync-height-content"></div>
                                    </div>
                                </div>
                                <div class="gdlr-core-pbf-column gdlr-core-column-30" id="gdlr-core-column-4">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " id="div_1dd7_16" data-sync-height="height-1">
                                        <div class="gdlr-core-pbf-background-wrap">
                                            <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js" id="div_1dd7_17" data-parallax-speed="0.1"></div>
                                        </div>
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js  gdlr-core-sync-height-content">
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-bottom gdlr-core-item-pdlr" id="div_1dd7_18">
                                                    <div class="gdlr-core-title-item-title-wrap clearfix">
                                                        <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_4">THE VICE CHANCELLOR'S</h3></div><span class="gdlr-core-title-item-caption gdlr-core-info-font gdlr-core-skin-caption" id="span_1dd7_0">Welcome Address</span></div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align" id="div_1dd7_19">
                                                    <div class="gdlr-core-text-box-item-content" id="div_1dd7_20">
                                                        <p>We don’t just give students an education and experiences that set them up for success in a career. We help them succeed in their career—to discover a field they’re passionate about and dare to lead it.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-button-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align"><a class="gdlr-core-button  gdlr-core-button-solid gdlr-core-button-no-border" href="#" id="a_1dd7_0"><span class="gdlr-core-content" >Read More</span></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gdlr-core-pbf-wrapper " id="div_1dd7_21">
                        <div class="gdlr-core-pbf-background-wrap">
                            <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js" id="div_1dd7_22" data-parallax-speed="0.2"></div>
                        </div>
                        <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                            <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
                               <div class="gdlr-core-pbf-column gdlr-core-column-20 gdlr-core-column-first">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js ">
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                            
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-bottom gdlr-core-item-pdlr" id="div_1dd7_25">
                                                    <div class="gdlr-core-title-item-title-wrap clearfix">
<div style="background-color: #fff; padding: 30px 0;">
  <h2 style="font-family: 'Segoe UI', sans-serif; font-size: 32px; color: rgb(6, 156, 98); text-align: center; margin: 0; letter-spacing: 1px; border-bottom: 3px solid rgb(6, 156, 98); display: inline-block; padding-bottom: 5px;">
    Vision and Mission Statement
  </h2>
</div>


                                                    </div>
                                                        <div style="max-width: 800px; margin: 30px auto; padding: 30px; background: linear-gradient(135deg, #e5eaed, #f3f6f9); border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); font-family: 'Segoe UI', sans-serif;">

  <h2 style="color:rgb(6, 156, 98); font-size: 28px; margin-bottom: 15px; border-left: 5px solid rgb(6, 156, 98); padding-left: 10px;">VISION</h2>
  <p style="color: #333; font-size: 17px; line-height: 1.6; text-align: justify;">The vision of Adeyemi Federal University of Education is "to create a conducive atmosphere where teaching, learning, research, and community activities can take place to produce competent and qualified graduates that can compete globally and for the overall benefit of the teaching profession in Nigeria and abroad through resourceful, transparent, firm, and just leadership."

  </p>

  <hr style="margin: 30px 0; border: none; border-top: 1px solid #ccc;">

  <h2 style="color:rgb(6, 156, 98); font-size: 28px; margin-bottom: 15px; border-left: 5px solid rgb(6, 156, 98); padding-left: 10px;">MISSION</h2>
  <p style="color: #333; font-size: 17px; line-height: 1.6; text-align: justify;">
    The mission of Adeyemi Federal University of Education is "to be a model institution in Nigeria for the pursuit of academic excellence through teaching, learning, and research for the professionalisation of teaching to meet global standards."

    </p>

</div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
               <div class="gdlr-core-pbf-column gdlr-core-column-40">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js ">
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                          
                                                <div class="swiper-container" style="max-width: 100%; height: auto;">
                                                    <div class="swiper-wrapper" id="sliderContainer1"></div>
                                                    <!-- Navigation Arrows -->
                                                    <div class="swiper-button-next"></div>
                                                    <div class="swiper-button-prev"></div>
                                                    <!-- Pagination Dots -->
                                                    <div class="swiper-pagination"></div>
                                                </div>

                                                <!-- Include Swiper.js -->
                                                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
                                                <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
<div class="row" style="background:rgb(57, 110, 85); padding-bottom: 20px;" >
<div class="gdlr-core-pbf-wrapper "  id="gdlr-core-wrapper-4">
    <div class="gdlr-core-pbf-background-wrap">

    </div>
     <h3 style="text-align: center; color: white;">We have a variety of Programmes for you to enroll</h3> 

    <div class="gdlr-core-pbf-wrapper-content gdlr-core-js " >
        <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container-custom" id="div_1dd7_81">
         
        <a href="schools.php">
           <div class="gdlr-core-pbf-column gdlr-core-column-15 col-lg-3 col-md-6 col-sm-12 col-xs-12">
           <div class="gdlr-core-pbf-column-content-margin gdlr-core-js" id="div_1dd7_88" data-sync-height="height-column" data-sync-height-center style="background-color:rgba(71, 152, 98, 0.52); overflow: hidden;transition: border-color 0.3s ease, transform 0.3s ease;" 
        onmouseover="this.style.borderColor='#479862'; this.style.transform='translateY(-5px)';" onmouseout="this.style.borderColor='#ddd'; this.style.transform='translateY(0)';">
        <div class="gdlr-core-pbf-background-wrap">
        <div style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;background: rgba(0, 0, 0, 0.4);">
        </div>
          <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js faded-background2" id="div_1dd7_89" data-parallax-speed="0" style="background: url('images/mission_vision.jpg') no-repeat center center;   background-size: cover; ">
          </div>
        </div>
       
        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js gdlr-core-sync-height-content">
            <div class="gdlr-core-pbf-element">
                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix gdlr-core-center-align gdlr-core-title-item-caption-bottom gdlr-core-item-pdlr" id="div_1dd7_90">
                    <div class="gdlr-core-title-item-title-wrap clearfix">
                        <h3 class="gdlr-core-title-item-title gdlr-core-skin-title" id="h3_1dd7_30" style="color: white; font-size: 17px;">
                            UNDERGRADUATE
                        </h3>
                    </div>
                </div>
            </div>
        </div>
          </div>
     </div>

          </a>
          <a href="#">
            <div class="gdlr-core-pbf-column gdlr-core-column-15 col-lg-3 col-md-6 col-sm-12 col-xs-12 " style="border-radius: 20px; transition: border-color 0.3s ease, transform 0.3s ease;" onmouseover="this.style.borderColor='#479862'; this.style.transform='translateY(-5px)';"  onmouseout="this.style.transform='translateY(0)'";>
                <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " id="div_1dd7_88" data-sync-height="height-column" data-sync-height-center style="background-color:rgba(143, 181, 156, 0.77);">
                    <div class="gdlr-core-pbf-background-wrap">
                    <div style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;background: rgba(0, 0, 0, 0.4);">
                    </div>
                        <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js faded-background2" id="div_1dd7_89" data-parallax-speed="0" style="background: url('images/mission_vision.jpg') no-repeat center center; background-size: cover;">

                        </div>
                    </div>
                    <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js  gdlr-core-sync-height-content">
                        <div class="gdlr-core-pbf-element">
                            <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-center-align gdlr-core-title-item-caption-bottom gdlr-core-item-pdlr" id="div_1dd7_90">
                                <div class="gdlr-core-title-item-title-wrap clearfix">

                                    <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_30" style="color: white; font-size: 17px;">POSTGRADUATE</h3>
                                </div>
                                <!-- <span class="gdlr-core-title-item-caption gdlr-core-info-font gdlr-core-skin-caption" id="span_1dd7_7" style="color: #1c2e51;">Kingster University was established by John Smith in 1920 for the public benefit and it is recognized globally.</span> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </a>
          <a href="https://portal.aceondo.edu.ng" target="_blank">
            <div class="gdlr-core-pbf-column gdlr-core-column-15 col-lg-3 col-md-6 col-sm-12 col-xs-12 " style="border-radius: 20px; border: 4px solid transparent; transition: border-color 0.3s ease, transform 0.3s ease;">
                <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " id="div_1dd7_88" data-sync-height="height-column" data-sync-height-center style="background-color:rgba(71, 152, 98, 0.52);">
                    <div class="gdlr-core-pbf-background-wrap">

                        <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js faded-background2" id="div_1dd7_89" data-parallax-speed="0" style="background: url('images/cat8.jpg') no-repeat center center; background-size: cover;"></div>
                    </div>
                    <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js  gdlr-core-sync-height-content">
                        <div class="gdlr-core-pbf-element">
                            <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-center-align gdlr-core-title-item-caption-bottom gdlr-core-item-pdlr" id="div_1dd7_90">
                                <div class="gdlr-core-title-item-title-wrap clearfix">

                                    <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_30" style="color: white; font-size: 17px;">OAU/COLLEGE STUDENTS</h3>
                                </div>
                                <!-- <span class="gdlr-core-title-item-caption gdlr-core-info-font gdlr-core-skin-caption" id="span_1dd7_7" style="color: #1c2e51;">Kingster University was established by John Smith in 1920 for the public benefit and it is recognized globally.</span> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </a>
          <a href="#">
            <div class="gdlr-core-pbf-column gdlr-core-column-15 col-lg-3 col-md-6 col-sm-12 col-xs-12 " style="border-radius: 20px; border: 4px solid transparent; transition: border-color 0.3s ease, transform 0.3s ease;">
                <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " id="div_1dd7_88" data-sync-height="height-column" data-sync-height-center style="background-color:rgba(143, 181, 156, 0.77);">
                    <div class="gdlr-core-pbf-background-wrap">

                        <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js faded-background2" id="div_1dd7_89" data-parallax-speed="0" style="background: url('images/cat8.jpg') no-repeat center center; background-size: cover;"></div>
                    </div>
                    <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js  gdlr-core-sync-height-content">
                        <div class="gdlr-core-pbf-element">
                            <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-center-align gdlr-core-title-item-caption-bottom gdlr-core-item-pdlr" id="div_1dd7_90">
                                <div class="gdlr-core-title-item-title-wrap clearfix">

                                    <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_30" style="color: white; font-size: 17px;">COLEGE OF TECHNOLOGY</h3>
                                </div>
                                <!-- <span class="gdlr-core-title-item-caption gdlr-core-info-font gdlr-core-skin-caption" id="span_1dd7_7" style="color: #1c2e51;">Kingster University was established by John Smith in 1920 for the public benefit and it is recognized globally.</span> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </a>

        </div>
    </div>
</div>
</div>  
                    <div class="gdlr-core-pbf-wrapper " id="div_1dd7_44">
                        <div class="gdlr-core-pbf-background-wrap"></div>
                        <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                            <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
                                
                            <?php


// Fetch the latest news
$latest_news_query = "SELECT * FROM news ORDER BY created_at DESC LIMIT 1";
$latest_news_result = $conn->query($latest_news_query);

// Fetch the rest of the news
$other_news_query = "SELECT * FROM news ORDER BY created_at DESC LIMIT 4 OFFSET 1";
$other_news_result = $conn->query($other_news_query);
?>

<div class="gdlr-core-pbf-column gdlr-core-column-40 gdlr-core-column-first">
    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js" id="div_1dd7_45" data-sync-height="height-2">
        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js gdlr-core-sync-height-content">
            <div class="gdlr-core-pbf-element">
                <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix gdlr-core-style-blog-widget">
                    <div class="gdlr-core-block-item-title-wrap gdlr-core-left-align gdlr-core-item-mglr" id="div_1dd7_46">
                        <div class="gdlr-core-block-item-title-inner clearfix">
                            <h3 class="gdlr-core-block-item-title" id="h3_1dd7_10"style="color:rgb(48, 142, 98);">News & Updates</h3>
                            <div class="gdlr-core-block-item-title-divider" id="div_1dd7_47"></div>
                        </div>
                        <a class="gdlr-core-block-item-read-more" href="all_news.php" target="_self" id="a_1dd7_5">Read All News</a>
                    </div>

                    <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">
                        
                        <!-- Latest News - Large Thumbnail -->
                        <?php if ($latest_news_result->num_rows > 0) {
                            $latest_news = $latest_news_result->fetch_assoc(); 

                            // Extract first 50 words from content
                            $content_words = explode(' ', strip_tags($latest_news['content']));
                            $short_description = implode(' ', array_slice($content_words, 0, 20)) . '... ';
                        ?>
                            <div class="gdlr-core-item-list-wrap gdlr-core-column-30" >
                                <div class="gdlr-core-item-list-inner gdlr-core-item-mglr" style="background-color:rgb(173, 223, 199); padding-top:20px; padding-left:20px;padding-right:20px;padding-bottom: 20px;">
                                    <div class="gdlr-core-blog-grid">
                                        <div class="gdlr-core-blog-thumbnail gdlr-core-media-image gdlr-core-opacity-on-hover gdlr-core-zoom-on-hover">
                                            <a href="view_news.php?id=<?= $latest_news['id'] ?>">
                                                <img src="upload/<?= $latest_news['image']; ?>" width="700" height="430" alt="<?= $latest_news['title'] ?>" />
                                            </a>
                                        </div>
                                        <div class="gdlr-core-blog-grid-content-wrap">
                                            <div class="gdlr-core-blog-info-wrapper gdlr-core-skin-divider">
                                                <span class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption gdlr-core-blog-info-date">
                                                    <a href="#"><?= date('F j, Y', strtotime($latest_news['created_at'])) ?></a>
                                                </span>
                                                <span class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption">
                                                     BY <?= htmlspecialchars($latest_news['author']) ?>
                                                </span>
                                            </div>
                                            <h3 class="gdlr-core-blog-title gdlr-core-skin-title" id="h3_1dd7_11">
                                                <a href="view_news.php?id=<?= $latest_news['id'] ?>"><?= $latest_news['title'] ?></a>
                                            </h3>
                                            <p><?= $short_description ?> <center><button  style="color: #ffffff; border:0px; decoration:none; background-color:rgb(48, 142, 98); width: 100px;; padding:auto; height:40px;"><a style="color: #ffffff; border:0px; decoration:none; background-color:rgb(48, 142, 98); width: 100px; padding:auto; height:40px;" href="view_news.php?id=<?= $latest_news['id'] ?>">Read More</a></button></center></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- Other News - Small Thumbnails -->
                        <div class="gdlr-core-item-list-wrap gdlr-core-column-30" style="background-color:rgb(173, 223, 199); padding-top:20px; padding-bottom:85px;">
                            <?php if ($other_news_result->num_rows > 0) {
                                while ($row = $other_news_result->fetch_assoc()) { ?>
                                    <div class="gdlr-core-item-list gdlr-core-blog-widget gdlr-core-item-mglr clearfix gdlr-core-style-small">
                                        <div class="gdlr-core-blog-thumbnail gdlr-core-media-image gdlr-core-opacity-on-hover gdlr-core-zoom-on-hover">
                                            <a href="view_news.php?id=<?= $row['id'] ?>">
                                                <img src="upload/<?= $row['image']; ?>" alt="<?= $row['title'] ?>" width="150" height="150" />
                                            </a>
                                        </div>
                                        <div class="gdlr-core-blog-widget-content">
                                            <div class="gdlr-core-blog-info-wrapper gdlr-core-skin-divider">
                                                <span class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption gdlr-core-blog-info-date">
                                                    <a href="#"><?= date('F j, Y', strtotime($row['created_at'])) ?></a>
                                                </span>
                                                <span class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption">
                                                     BY <?= htmlspecialchars($row['author']) ?>
                                                </span>
                                            </div>
                                            <h3 class="gdlr-core-blog-title gdlr-core-skin-title" id="h3_1dd7_12">
                                                <a href="view_news.php?id=<?= $row['id'] ?>"><?= $row['title'] ?></a>
                                            </h3>
                                        </div>
                                    </div>
                                <?php } 
                            } ?>
                            <center><button style="color:#ffffff; border:0px; background-color:rgb(48, 142, 98); width: 100px;; padding:auto; padding: top 40px;;height:40px;"><a style="color: #ffffff;" href="blog.php">Read all News</a></button></center>
                        </div><br />
                                
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Close connection
//$conn->close();
?>
                                <div class="gdlr-core-pbf-column gdlr-core-column-20" id="gdlr-core-column-8">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js  gdlr-core-column-extend-right" id="div_1dd7_48" data-sync-height="height-2">
                                        <div class="gdlr-core-pbf-background-wrap">
                                    <!--    <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme"  data-x="-480" data-y="center" data-voffset="80" data-width="['400']" data-height="['1000']" data-type="shape" data-responsive_offset="on" data-frames='[{"delay":330,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;background-color:rgba(147, 246, 201, 0.84);border-radius:3px 3px 3px 3px;"></div> -->
                                                                    
                                            <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js" id="div_1dd7_49" data-parallax-speed="0"></div>
                                        </div>
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js  gdlr-core-sync-height-content">
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr" id="div_1dd7_50">
                                                    <div class="gdlr-core-title-item-left-icon" id="div_1dd7_51"><i class="icon_link_alt" id="i_1dd7_1"></i></div>
                                                    <div class="gdlr-core-title-item-left-icon-wrap">
                                                        <div class="gdlr-core-title-item-title-wrap clearfix">
                                                            <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_15">Quick Links</h3></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr"  id="gdlr-core-title-item-id-66469">
                                                    <div class="gdlr-core-title-item-title-wrap clearfix">
                                                        <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_16"><a href="https://portal.afued.edu.ng" target="_blank" style="color:#ffffff">Student Portal</a></h3></div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-divider-item gdlr-core-divider-item-normal gdlr-core-item-pdlr gdlr-core-center-align" id="div_1dd7_52">
                                                    <div class="gdlr-core-divider-line gdlr-core-skin-divider" id="div_1dd7_53"></div>
                                                </div>
                                            </div>
                                             <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr"  id="gdlr-core-title-item-id-66469">
                                                    <div class="gdlr-core-title-item-title-wrap clearfix">
                                                        <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_16"><a href="https://dec.afued.edu.ng" target="_blank" style="color:#ffffff">Part-time Portal</a></h3></div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-divider-item gdlr-core-divider-item-normal gdlr-core-item-pdlr gdlr-core-center-align" id="div_1dd7_52">
                                                    <div class="gdlr-core-divider-line gdlr-core-skin-divider" id="div_1dd7_53"></div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr"  id="gdlr-core-title-item-id-42777">
                                                    <div class="gdlr-core-title-item-title-wrap clearfix">
                                                        <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_17"><a href="https://portal.afued.edu.ng" target="_blank" style="color:#ffffff">Application Portal</a></h3></div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-divider-item gdlr-core-divider-item-normal gdlr-core-item-pdlr gdlr-core-center-align" id="div_1dd7_54">
                                                    <div class="gdlr-core-divider-line gdlr-core-skin-divider" id="div_1dd7_55"></div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr"  id="gdlr-core-title-item-id-51281">
                                                    <div class="gdlr-core-title-item-title-wrap clearfix">
                                                        <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_18"><a href="schools.php" target="_self" style="color:#ffffff" >Schools</a></h3></div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-divider-item gdlr-core-divider-item-normal gdlr-core-item-pdlr gdlr-core-center-align" id="div_1dd7_56">
                                                    <div class="gdlr-core-divider-line gdlr-core-skin-divider" id="div_1dd7_57"></div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr"  id="gdlr-core-title-item-id-78243">
                                                    <div class="gdlr-core-title-item-title-wrap clearfix">
                                                        <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_19"><a href="#" target="_self" style="color:#ffffff">Office of the VC</a></h3></div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-divider-item gdlr-core-divider-item-normal gdlr-core-item-pdlr gdlr-core-center-align" id="div_1dd7_58">
                                                    <div class="gdlr-core-divider-line gdlr-core-skin-divider" id="div_1dd7_59"></div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr"  id="gdlr-core-title-item-id-14842">
                                                    <div class="gdlr-core-title-item-title-wrap clearfix">
                                                        <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_20"><a href="#" target="_self" style="color:#ffffff" >Admissions</a></h3></div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-divider-item gdlr-core-divider-item-normal gdlr-core-item-pdlr gdlr-core-center-align" id="div_1dd7_60">
                                                    <div class="gdlr-core-divider-line gdlr-core-skin-divider" id="div_1dd7_61"></div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr"  id="gdlr-core-title-item-id-33183">
                                                    <div class="gdlr-core-title-item-title-wrap clearfix">
                                                        <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_21"><a href="#" target="_self" style="color:#ffffff" >Alumni</a></h3></div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-divider-item gdlr-core-divider-item-normal gdlr-core-item-pdlr gdlr-core-center-align" id="div_1dd7_62">
                                                    <div class="gdlr-core-divider-line gdlr-core-skin-divider" id="div_1dd7_63"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="gdlr-core-pbf-column gdlr-core-column-40 gdlr-core-column-first" data-skin="Blue Title">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js  gdlr-core-column-extend-left" id="div_1dd7_64" data-sync-height="height-3" data-sync-height-center>
                                        <div class="gdlr-core-pbf-background-wrap" id="div_1dd7_65"></div>
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js  gdlr-core-sync-height-content">
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align">
                                                    <div class="gdlr-core-text-box-item-content" id="div_1dd7_66">
                                                        <div class="gdlr-core-twitter-item gdlr-core-item-pdb" id="div_1dd7_67">
                                                            <div class="gdlr-core-block-item-title-nav ">
                                                                <div class="gdlr-core-flexslider-nav gdlr-core-plain-style gdlr-core-block-center"></div>
                                                            </div>
                                                                 <div class="news-marquee">
  <marquee behavior="scroll" direction="left" scrollamount="5" onmouseover="this.stop();" onmouseout="this.start();">
    <?php while($row = mysqli_fetch_assoc($result)): ?>
      <span class="news-item">
        <span class="news-title"><?= htmlspecialchars($row['title']) ?>:</span>
        <?= htmlspecialchars($row['content']) ?>
      </span>
    <?php endwhile; ?>
  </marquee>
</div>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="gdlr-core-pbf-column gdlr-core-column-20" data-skin="White Text">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js  gdlr-core-column-extend-right" id="div_1dd7_68" data-sync-height="height-3">
                                        <div class="gdlr-core-pbf-background-wrap" id="div_1dd7_69"></div>
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js  gdlr-core-sync-height-content">
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-column-service-item gdlr-core-item-pdb  gdlr-core-left-align gdlr-core-column-service-icon-left gdlr-core-no-caption gdlr-core-item-pdlr" id="div_1dd7_70">
                                                    <div class="gdlr-core-column-service-media gdlr-core-media-image" id="div_1dd7_71"><img src="images/LOGOO.png" alt="" width="42" height="39" title="apply-logo" /></div>
                                                    <div class="gdlr-core-column-service-content-wrapper">
                                                        <div class="gdlr-core-column-service-title-wrap">
                                                            <h3 class="gdlr-core-column-service-title gdlr-core-skin-title" id="h3_1dd7_22">Apply To AFUED</h3></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="gdlr-core-pbf-column-link" href="#" target="_self"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- begin of news/facebook tweet -->
<div class="gdlr-core-pbf-column gdlr-core-column-40 gdlr-core-column-first" style="background-color:rgba(171, 206, 195, 0.9); margin-top: 0px;">
    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " style="margin: 0px 20px 0px 0px;padding: 30px 0px 0px 0px;">
        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
            <div class="gdlr-core-pbf-element">
                <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix  gdlr-core-style-blog-widget">
                    <div class="gdlr-core-block-item-title-wrap  gdlr-core-left-align gdlr-core-item-mglr" style="margin-bottom: 35px ;">
                        <div class="gdlr-core-block-item-title-inner clearfix">
                            <h3 class="gdlr-core-block-item-title" style="font-size: 24px ;font-style: normal ;text-transform: none ;letter-spacing: 0px ;color: #600909 ;">Research Activities in AFUED</h3>
                            <div class="gdlr-core-block-item-title-divider" style="font-size: 24px ;border-bottom-width: 3px ;"></div>
                        </div>
                    </div>
                    <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">
                 <?php
                 include "db_connect.php";   // Fetch the most recent research
$query = "SELECT * FROM research_activities ORDER BY date DESC LIMIT 1";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $research_title = htmlspecialchars($row['title']);
    $research_date = date('F j, Y', strtotime($row['date']));
    $research_image = !empty($row['thumbnail']) ? 'uploads/' . htmlspecialchars($row['thumbnail']) : 'images/default-research.jpg';
    $research_id = $row['id'];
} else {
    // Default values if no research is found
    $research_title = "No recent research available";
    $research_date = date('F j, Y');
    $research_image = "images/default-research.jpg";
    $research_id = "#";
}?>
                    <div class="gdlr-core-item-list-wrap gdlr-core-column-30">
    <div class="gdlr-core-item-list-inner gdlr-core-item-mglr">
        <div class="gdlr-core-blog-grid">
            <div class="gdlr-core-blog-thumbnail gdlr-core-media-image gdlr-core-opacity-on-hover gdlr-core-zoom-on-hover" 
                 style="max-width: 700px; min-height: 430px;">
                <a href="view_research.php?id=<?php echo $research_id; ?>">
                    <img src="<?php echo $research_image; ?>" style="width: inherit; height: inherit;" alt="Research Image" />
                </a>
            </div>
            <div class="gdlr-core-blog-grid-content-wrap">
                <div class="gdlr-core-blog-info-wrapper gdlr-core-skin-divider">
                    <span class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption gdlr-core-blog-info-date">
                        <a href="view_research.php?id=<?php echo $research_id; ?>" class="text-white"><?php echo $research_date; ?></a>
                    </span>
                    <span class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption gdlr-core-blog-info-tag">
                        <a href="view_research.php?id=<?php echo $research_id; ?>" rel="tag" class="text-white">Research</a>
                    </span>
                </div>
                <h3 class="gdlr-core-blog-title gdlr-core-skin-title" style="font-size: 19px; font-weight: 700; letter-spacing: 0px;">
                    <a href="view_research.php?id=<?php echo $research_id; ?>" class="text-white"><?php echo $research_title; ?></a>
                </h3>
            </div>
        </div>
    </div>
</div>


                        <div class="gdlr-core-item-list-wrap gdlr-core-column-30">
                           

                           

                          <?php
include 'db_connect.php'; // Include database connection

// Fetch the next four most recent research entries (excluding the most recent one)
$query = "SELECT * FROM research_activities ORDER BY date DESC LIMIT 1, 4"; // Skip the first one, get next 4
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $research_title = htmlspecialchars($row['title']);
        $research_date = date('F j, Y', strtotime($row['date']));
        $research_image = !empty($row['thumbnail']) ? 'uploads/' . htmlspecialchars($row['thumbnail']) : 'images/default-research.jpg';
        $research_id = $row['id'];
?>

<div class="gdlr-core-item-list gdlr-core-blog-widget gdlr-core-item-mglr clearfix gdlr-core-style-small">
    <div class="gdlr-core-blog-thumbnail gdlr-core-media-image gdlr-core-opacity-on-hover gdlr-core-zoom-on-hover" 
         style="max-width: 80px; min-height: 80px;">
        <a href="view_research.php?id=<?php echo $research_id; ?>">
            <img src="<?php echo $research_image; ?>" alt="Research Image" style="width: inherit; height: inherit;" title="" />
        </a>
    </div>
    <div class="gdlr-core-blog-widget-content">
        <div class="gdlr-core-blog-info-wrapper gdlr-core-skin-divider">
            <span class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption gdlr-core-blog-info-date">
                <a href="view_research.php?id=<?php echo $research_id; ?>" class="text-white"><?php echo $research_date; ?></a>
            </span>
            <span class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption gdlr-core-blog-info-tag">
                <a href="view_research.php?id=<?php echo $research_id; ?>" rel="tag" class="text-white">Hot</a>
                <span class="gdlr-core-sep">,</span> 
                <a href="view_research.php?id=<?php echo $research_id; ?>" rel="tag" class="text-white">Research</a>
            </span>
        </div>
        <h3 class="gdlr-core-blog-title gdlr-core-skin-title" style="font-size: 16px; font-weight: 700; letter-spacing: 0px;">
            <a href="view_research.php?id=<?php echo $research_id; ?>" class="text-white"><?php echo $research_title; ?></a>
        </h3>
    </div>
</div>

<?php
    }
} else {
    echo "<p class='text-white'>No recent research available.</p>";
}
?>

                      
                            <a class="gdlr-core-block-item-read-more readmore" 
                            href="researchs.php" target="_self" 
                            style="width: 200px; text-align: center; color: white; display: block; margin: 0 auto; padding: 10px; background-color: white; color: #1F2B44;">
                            Read More
                         </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--- begin of facebook tweet---->

<div class="gdlr-core-pbf-column gdlr-core-column-20" style="margin-top: 50px;">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " style="margin: 0px 20px 0px 0px;padding: 0px 0px 0px 0px; ">
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-event-item gdlr-core-item-pdb" style="padding-bottom: 0px ;">
                                                    <div class="gdlr-core-block-item-title-wrap  gdlr-core-left-align gdlr-core-item-mglr" style="margin-bottom: 8px ; ">
                                                        <div class="gdlr-core-block-item-title-inner clearfix">
                                                            <h3 class="gdlr-core-block-item-title" style="font-size: 22px ;font-style: normal ;text-transform: none ;letter-spacing: 0px ;color: #1F2B44 ;">Social Media</h3>
                                                            <div class="gdlr-core-block-item-title-divider" style="font-size: 22px ;border-bottom-color: #dcdcdc ;border-bottom-width: 2px ;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="gdlr-core-event-item-holder clearfix">
                                                        <div id="fb-root">
                                                        <script async defer crossorigin="anonymous" 
                                                            src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v19.0" nonce="XYZ">
                                                        </script>
                                                      <!-- <h4 class="text-white text-center" style="background-color: #1F2B44; color: white; padding: 20px; ">Facebook Feeds</h4> -->
                                                    
                                                        <!-- Facebook Page Plugin -->
                                                        <div  class="fb-page" 
                                                            data-href="https://www.facebook.com/aceondo.edu.ng" 
                                                            data-tabs="timeline" 
                                                            data-width="480" 
                                                            data-height="600" 
                                                            data-small-header="false" 
                                                            data-adapt-container-width="true" 
                                                            data-hide-cover="false" 
                                                            data-show-facepile="true">
                                                            <blockquote cite="https://www.facebook.com/aceondo.edu.ng" class="fb-xfbml-parse-ignore">
                                                                <a href="https://www.facebook.com/aceondo.edu.ng">Visit  AFUED POSTS</a>
                                                            </blockquote>
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


<!--- end of facebook tweet---->

                   
                    <div class="gdlr-core-pbf-wrapper " id="div_1dd7_91">
                        <div class="gdlr-core-pbf-background-wrap"></div>
                        <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                            <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container" id="event" >
                                
                                <div class="gdlr-core-pbf-column gdlr-core-column-20 gdlr-core-column-first">
                            <div class="gdlr-core-block-item-title-wrap  gdlr-core-left-align gdlr-core-item-mglr" id="div_1dd7_95">
                                                        <div class="gdlr-core-block-item-title-inner clearfix">
                                                            <h3 class="gdlr-core-block-item-title" id="h3_1dd7_32">Photo Slider</h3>
                                                            <div class="gdlr-core-block-item-title-divider" id="div_1dd7_96"></div>
                                                        </div>
                                                    </div>
                                       <div class="gdlr-core-pbf-column-content-margin gdlr-core-js">
                                           <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js">
                                               <div class="swiper-container" style="max-width: 100%; height: auto;">
                                                   <div class="swiper-wrapper" id="sliderContainer">
                                                       <!-- Images will load here dynamically -->
                                                   </div>
                                                   <!-- Navigation Arrows -->
                                                   <div class="swiper-button-next"></div>
                                                   <div class="swiper-button-prev"></div>
                                                   <!-- Pagination Dots -->
                                                   <div class="swiper-pagination"></div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>

                                <div class="gdlr-core-pbf-column gdlr-core-column-20">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " id="div_1dd7_93">
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                            
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-event-item gdlr-core-item-pdb" id="div_1dd7_94">
                                                    <div class="gdlr-core-block-item-title-wrap  gdlr-core-left-align gdlr-core-item-mglr" id="div_1dd7_95">
                                                        <div class="gdlr-core-block-item-title-inner clearfix">
                                                            <h3 class="gdlr-core-block-item-title" id="h3_1dd7_32"> Events</h3>
                                                            <div class="gdlr-core-block-item-title-divider" id="div_1dd7_96"></div>
                                                        </div>
                                                    </div>
                                                    <div class="gdlr-core-event-item-holder clearfix">
                                                        <?php                                                
                                                                // Fetch upcoming events from the database
$query = "SELECT id, title, event_date, event_time, event_venue FROM events ORDER BY event_date DESC LIMIT 3";
$result = $conn->query($query);
                                                                  while ($row = $result->fetch_assoc()) {
                                                                 // Extract date and format it for display
                                                                  $eventDate = date("d", strtotime($row['event_date'])); // Extracts the day
                                                                  $eventMonth = date("M", strtotime($row['event_date'])); // Extracts the month
                                                                  $eventTime = htmlspecialchars($row['event_time']);
                                                                  $eventTitle = htmlspecialchars($row['title']);
                                                                  $eventVenue = htmlspecialchars($row['event_venue']);

                                                                  echo '
                                                                  <div class="gdlr-core-event-item-listgdlr-core-style-widget gdlr-core-item-pdlr  clearfix" id="div_1dd7_97"">
                                                                          <span class="gdlr-core-event-item-info gdlr-core-type-start-date-month">
                                                                            <span class="gdlr-core-date">'.$eventDate.'</span>
                                                                              <span class="gdlr-core-month">'.$eventMonth.'</span>
                                                                          </span>
                                                                          <div class="gdlr-core-event-item-content-wrap">
                                                                              <h3 class="gdlr-core-event-item-title">
                                                                                  
                                                                                  <a href="mainevent.php?id='.$row['id'].'">'.$eventTitle.'</a>
                                                                              </h3>
                                                                                  <div class="gdlr-core-event-item-info-wrap">
                                                                                  <span class="gdlr-core-event-item-info gdlr-core-type-time">
                                                                                      <span class="gdlr-core-head">
                                                                                          <i class="icon_clock_alt"></i>
                                                                                      </span>
                                                                                      <span class="gdlr-core-tail">'.$eventTime.'</span>
                                                                                  </span>
                                                                                  <span class="gdlr-core-event-item-info gdlr-core-type-location">
                                                                                      <span class="gdlr-core-head">
                                                                                          <i class="icon_pin_alt"></i>
                                                                                      </span>
                                                                                    <span class="gdlr-core-tail">'.$eventVenue.'</span>
                                                                                  </span>
                                                                              </div>
                                                                          </div>
                                                                      </div>';
                                                              }
                                                              ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-button-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align"><a class="gdlr-core-button  gdlr-core-button-transparent gdlr-core-button-no-border" href="events.php" id="a_1dd7_7"><span class="gdlr-core-content" >View All Events</span><i class="gdlr-core-pos-right fa fa-long-arrow-right" id="i_1dd7_2"  ></i></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="gdlr-core-pbf-column gdlr-core-column-20" data-skin="Newsletter">
                                <div class="gdlr-core-block-item-title-wrap  gdlr-core-left-align gdlr-core-item-mglr" id="div_1dd7_95">
                                                        <div class="gdlr-core-block-item-title-inner clearfix">
                                                            <h3 class="gdlr-core-block-item-title" id="h3_1dd7_32">Location</h3>
                                                            <div class="gdlr-core-block-item-title-divider" id="div_1dd7_96"></div>
                                                        </div>
                                                    </div>
                                                <div class="gdlr-core-wp-google-map-plugin-item gdlr-core-item-pdlr gdlr-core-item-pdb " style="padding-bottom: 0px ;">
                                                    <div style="overflow:hidden;width: 100%;position: relative;">
                                                        
                                                        <iframe style="width:100%; height:380px; " 
                                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.123456789012!2d4.8136234!3d7.0733019!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x10386328add66a6f%3A0x27f15847046d73ba!2sAdeyemi%20Federal%20University%20of%20Education!5e0!3m2!1sen!2sng!4v1234567890123!5m2!1sen!2sng"
                                                        width="600" 
                                                        height="450" 
                                                        frameborder="4px" style="border:4px solid rgba(16, 70, 46, 0.9)" 
                                                        allowfullscreen>
                                                    </iframe>
                                                        <div style="position:  absolute; width: 80%; bottom: 20px;left: 0;right: 0;margin-left: auto;margin-right: auto;color: #000;">
                                                        
                                                        </div>
                                                        <style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
                                                    </div>
                                                    <!-- Marquee Text -->
                                                         <div style="margin-top: 10px; padding: 5px;">
                                                           <marquee behavior="scroll" direction="left" style="color: #ae2c2c; font-weight: 600;font-size: 30px;">
                                                             Welcome to Adeyemi Federal University of Education, Ondo.!
                                                           </marquee>
                                                            </div>
                                            </div>      
                                    </div>
                                    </div>
                            
                        </div>
                    </div>
               
                    <div class="gdlr-core-pbf-wrapper " id="div_1dd7_107">
                        <div class="gdlr-core-pbf-background-wrap" id="div_1dd7_108"></div>
                        <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                            <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container-custom" id="div_1dd7_109">
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-gallery-item gdlr-core-item-pdb clearfix  gdlr-core-gallery-item-style-grid" id="div_1dd7_110">
                                        <div class="gdlr-core-gallery-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">
                                            <div class="gdlr-core-item-list gdlr-core-gallery-column  gdlr-core-column-12 gdlr-core-column-first gdlr-core-item-pdlr gdlr-core-item-mgb">
                                                <div class="gdlr-core-gallery-list gdlr-core-media-image"><img src="upload/banner-1.png" alt="" width="248" height="120" title="banner-1" /></div>
                                            </div>
                                            <div class="gdlr-core-item-list gdlr-core-gallery-column  gdlr-core-column-12 gdlr-core-item-pdlr gdlr-core-item-mgb">
                                                <div class="gdlr-core-gallery-list gdlr-core-media-image"><img src="upload/banner-2.png" alt="" width="248" height="120" title="banner-2" /></div>
                                            </div>
                                            <div class="gdlr-core-item-list gdlr-core-gallery-column  gdlr-core-column-12 gdlr-core-item-pdlr gdlr-core-item-mgb">
                                                <div class="gdlr-core-gallery-list gdlr-core-media-image"><img src="upload/banner-3.png" alt="" width="248" height="120" title="banner-3" /></div>
                                            </div>
                                            <div class="gdlr-core-item-list gdlr-core-gallery-column  gdlr-core-column-12 gdlr-core-item-pdlr gdlr-core-item-mgb">
                                                <div class="gdlr-core-gallery-list gdlr-core-media-image"><img src="upload/banner-4-1.png" alt="" width="248" height="120" title="banner-4" /></div>
                                            </div>
                                            <div class="gdlr-core-item-list gdlr-core-gallery-column  gdlr-core-column-12 gdlr-core-item-pdlr gdlr-core-item-mgb">
                                                <div class="gdlr-core-gallery-list gdlr-core-media-image"><img src="upload/banner.png" alt="" width="248" height="120" title="banner-5" /></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <?php include "footer.php";?>
        </div>
    </div>


	<script type='text/javascript' src='js/jquery/jquery.js'></script>
    <script type='text/javascript' src='js/jquery/jquery-migrate.min.js'></script>
    <script type='text/javascript' src='plugins/revslider/public/assets/js/jquery.themepunch.tools.min.js'></script>
    <script type='text/javascript' src='plugins/revslider/public/assets/js/jquery.themepunch.revolution.min.js'></script>
    <script type="text/javascript" src="plugins/revslider/public/assets/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script type="text/javascript" src="plugins/revslider/public/assets/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script type="text/javascript" src="plugins/revslider/public/assets/js/extensions/revolution.extension.kenburn.min.js"></script>
    <script type="text/javascript" src="plugins/revslider/public/assets/js/extensions/revolution.extension.navigation.min.js"></script>
    <script type="text/javascript" src="plugins/revslider/public/assets/js/extensions/revolution.extension.parallax.min.js"></script>  
    <script type="text/javascript" src="plugins/revslider/public/assets/js/extensions/revolution.extension.actions.min.js"></script> 
    <script type="text/javascript" src="plugins/revslider/public/assets/js/extensions/revolution.extension.video.min.js"></script>

    <script type="text/javascript">
        /*<![CDATA[*/
        function setREVStartSize(e) {
            try {
                e.c = jQuery(e.c);
                var i = jQuery(window).width(),
                    t = 9999,
                    r = 0,
                    n = 0,
                    l = 0,
                    f = 0,
                    s = 0,
                    h = 0;
                if (e.responsiveLevels && (jQuery.each(e.responsiveLevels, function(e, f) {
                        f > i && (t = r = f, l = e), i > f && f > r && (r = f, n = e)
                    }), t > r && (l = n)), f = e.gridheight[l] || e.gridheight[0] || e.gridheight, s = e.gridwidth[l] || e.gridwidth[0] || e.gridwidth, h = i / s, h = h > 1 ? 1 : h, f = Math.round(h * f), "fullscreen" == e.sliderLayout) {
                    var u = (e.c.width(), jQuery(window).height());
                    if (void 0 != e.fullScreenOffsetContainer) {
                        var c = e.fullScreenOffsetContainer.split(",");
                        if (c) jQuery.each(c, function(e, i) {
                            u = jQuery(i).length > 0 ? u - jQuery(i).outerHeight(!0) : u
                        }), e.fullScreenOffset.split("%").length > 1 && void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 ? u -= jQuery(window).height() * parseInt(e.fullScreenOffset, 0) / 100 : void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 && (u -= parseInt(e.fullScreenOffset, 0))
                    }
                    f = u
                } else void 0 != e.minHeight && f < e.minHeight && (f = e.minHeight);
                e.c.closest(".rev_slider_wrapper").css({
                    height: f
                })
            } catch (d) {
                console.log("Failure at Presize of Slider:" + d)
            }
        }; /*]]>*/
    </script>
    <script>
        (function(body) {
            'use strict';
            body.className = body.className.replace(/\btribe-no-js\b/, 'tribe-js');
        })(document.body);
    </script>
    <script>
        var tribe_l10n_datatables = {
            "aria": {
                "sort_ascending": ": activate to sort column ascending",
                "sort_descending": ": activate to sort column descending"
            },
            "length_menu": "Show _MENU_ entries",
            "empty_table": "No data available in table",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "info_empty": "Showing 0 to 0 of 0 entries",
            "info_filtered": "(filtered from _MAX_ total entries)",
            "zero_records": "No matching records found",
            "search": "Search:",
            "all_selected_text": "All items on this page were selected. ",
            "select_all_link": "Select all pages",
            "clear_selection": "Clear Selection.",
            "pagination": {
                "all": "All",
                "next": "Next",
                "previous": "Previous"
            },
            "select": {
                "rows": {
                    "0": "",
                    "_": ": Selected %d rows",
                    "1": ": Selected 1 row"
                }
            },
            "datepicker": {
                "dayNames": ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                "dayNamesShort": ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                "dayNamesMin": ["S", "M", "T", "W", "T", "F", "S"],
                "monthNames": ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                "monthNamesShort": ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                "monthNamesMin": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                "nextText": "Next",
                "prevText": "Prev",
                "currentText": "Today",
                "closeText": "Done",
                "today": "Today",
                "clear": "Clear"
            }
        };
        var tribe_system_info = {
            "sysinfo_optin_nonce": "a32c675aaa",
            "clipboard_btn_text": "Copy to clipboard",
            "clipboard_copied_text": "System info copied",
            "clipboard_fail_text": "Press \"Cmd + C\" to copy"
        };
    </script>

    <script type="text/javascript">
        /*<![CDATA[*/
        function revslider_showDoubleJqueryError(sliderID) {
            var errorMessage = "Revolution Slider Error: You have some jquery.js library include that comes after the revolution files js include.";
            errorMessage += "<br> This includes make eliminates the revolution slider libraries, and make it not work.";
            errorMessage += "<br><br> To fix it you can:<br>&nbsp;&nbsp;&nbsp; 1. In the Slider Settings -> Troubleshooting set option:  <strong><b>Put JS Includes To Body</b></strong> option to true.";
            errorMessage += "<br>&nbsp;&nbsp;&nbsp; 2. Find the double jquery.js include and remove it.";
            errorMessage = "<span style='font-size:16px;color:#BC0C06;'>" + errorMessage + "</span>";
            jQuery(sliderID).show().html(errorMessage);
        } /*]]>*/
    </script>

    <script type='text/javascript' src='plugins/goodlayers-core/plugins/combine/script.js'></script>
    <script type='text/javascript'>
        var gdlr_core_pbf = {
            "admin": "",
            "video": {
                "width": "640",
                "height": "360"
            },
            "ajax_url": "https:\/\/demo.goodlayers.com\/kingster\/wp-admin\/admin-ajax.php"
        };
    </script>
    <script type='text/javascript' src='plugins/goodlayers-core/include/js/page-builder.js'></script>



    <script type='text/javascript' src='js/jquery/ui/effect.min.js'></script>
    <script type='text/javascript'>
        var kingster_script_core = {
            "home_url": "https:\/\/demo.goodlayers.com\/kingster\/"
        };
    </script>
    <script type='text/javascript' src='js/plugins.min.js'></script>
	<script>
	    /*<![CDATA[*/
	    var htmlDiv = document.getElementById("rs-plugin-settings-inline-css");
	    var htmlDivCss = "";
	    if (htmlDiv) {
	        htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
	    } else {
	        var htmlDiv = document.createElement("div");
	        htmlDiv.innerHTML = "<style>" + htmlDivCss + "</style>";
	        document.getElementsByTagName("head")[0].appendChild(htmlDiv.childNodes[0]);
	    } /*]]>*/
	</script>
	<script type="text/javascript">
	    /*<![CDATA[*/
	    if (setREVStartSize !== undefined) setREVStartSize({
	        c: '#rev_slider_1_1',
	        gridwidth: [1380],
	        gridheight: [713],
	        sliderLayout: 'auto'
	    });
	    var revapi1, tpj;
	    (function() {
	        if (!/loaded|interactive|complete/.test(document.readyState)) document.addEventListener("DOMContentLoaded", onLoad);
	        else onLoad();

	        function onLoad() {
	            if (tpj === undefined) {
	                tpj = jQuery;
	                if ("off" == "on") tpj.noConflict();
	            }
	            if (tpj("#rev_slider_1_1").revolution == undefined) {
	                revslider_showDoubleJqueryError("#rev_slider_1_1");
	            } else {
	                revapi1 = tpj("#rev_slider_1_1").show().revolution({
	                    sliderType: "standard",
	                    jsFileLocation: "//demo.goodlayers.com/kingster/wp-content/plugins/revslider/public/assets/js/",
	                    sliderLayout: "auto",
	                    dottedOverlay: "none",
	                    delay: 9000,
	                    navigation: {
	                        keyboardNavigation: "off",
	                        keyboard_direction: "horizontal",
	                        mouseScrollNavigation: "off",
	                        mouseScrollReverse: "default",
	                        onHoverStop: "off",
	                        touch: {
	                            touchenabled: "on",
	                            touchOnDesktop: "off",
	                            swipe_threshold: 75,
	                            swipe_min_touches: 1,
	                            swipe_direction: "horizontal",
	                            drag_block_vertical: false
	                        },
	                        arrows: {
	                            style: "uranus",
	                            enable: true,
	                            hide_onmobile: true,
	                            hide_under: 1500,
	                            hide_onleave: true,
	                            hide_delay: 200,
	                            hide_delay_mobile: 1200,
	                            tmp: '',
	                            left: {
	                                h_align: "left",
	                                v_align: "center",
	                                h_offset: 20,
	                                v_offset: 0
	                            },
	                            right: {
	                                h_align: "right",
	                                v_align: "center",
	                                h_offset: 20,
	                                v_offset: 0
	                            }
	                        },
	                        bullets: {
	                            enable: true,
	                            hide_onmobile: false,
	                            hide_over: 1499,
	                            style: "uranus",
	                            hide_onleave: true,
	                            hide_delay: 200,
	                            hide_delay_mobile: 1200,
	                            direction: "horizontal",
	                            h_align: "center",
	                            v_align: "bottom",
	                            h_offset: 0,
	                            v_offset: 30,
	                            space: 7,
	                            tmp: '<span class="tp-bullet-inner"></span>'
	                        }
	                    },
	                    visibilityLevels: [1240, 1024, 778, 480],
	                    gridwidth: 1380,
	                    gridheight: 713,
	                    lazyType: "none",
	                    shadow: 0,
	                    spinner: "off",
	                    stopLoop: "off",
	                    stopAfterLoops: -1,
	                    stopAtSlide: -1,
	                    shuffle: "off",
	                    autoHeight: "off",
	                    disableProgressBar: "on",
	                    hideThumbsOnMobile: "off",
	                    hideSliderAtLimit: 0,
	                    hideCaptionAtLimit: 0,
	                    hideAllCaptionAtLilmit: 0,
	                    debugMode: false,
	                    fallbacks: {
	                        simplifyAll: "off",
	                        nextSlideOnWindowFocus: "off",
	                        disableFocusListener: false,
	                    }
	                });
	            };
	        };
	    }()); /*]]>*/
	</script>
	<script>
	    /*<![CDATA[*/
	    var htmlDivCss = unescape("%23rev_slider_1_1%20.uranus.tparrows%20%7B%0A%20%20width%3A50px%3B%0A%20%20height%3A50px%3B%0A%20%20background%3Argba%28255%2C255%2C255%2C0%29%3B%0A%20%7D%0A%20%23rev_slider_1_1%20.uranus.tparrows%3Abefore%20%7B%0A%20width%3A50px%3B%0A%20height%3A50px%3B%0A%20line-height%3A50px%3B%0A%20font-size%3A40px%3B%0A%20transition%3Aall%200.3s%3B%0A-webkit-transition%3Aall%200.3s%3B%0A%20%7D%0A%20%0A%20%20%23rev_slider_1_1%20.uranus.tparrows%3Ahover%3Abefore%20%7B%0A%20%20%20%20opacity%3A0.75%3B%0A%20%20%7D%0A%23rev_slider_1_1%20.uranus%20.tp-bullet%7B%0A%20%20border-radius%3A%2050%25%3B%0A%20%20box-shadow%3A%200%200%200%202px%20rgba%28255%2C%20255%2C%20255%2C%200%29%3B%0A%20%20-webkit-transition%3A%20box-shadow%200.3s%20ease%3B%0A%20%20transition%3A%20box-shadow%200.3s%20ease%3B%0A%20%20background%3Atransparent%3B%0A%20%20width%3A15px%3B%0A%20%20height%3A15px%3B%0A%7D%0A%23rev_slider_1_1%20.uranus%20.tp-bullet.selected%2C%0A%23rev_slider_1_1%20.uranus%20.tp-bullet%3Ahover%20%7B%0A%20%20box-shadow%3A%200%200%200%202px%20rgba%28255%2C%20255%2C%20255%2C1%29%3B%0A%20%20border%3Anone%3B%0A%20%20border-radius%3A%2050%25%3B%0A%20%20background%3Atransparent%3B%0A%7D%0A%0A%23rev_slider_1_1%20.uranus%20.tp-bullet-inner%20%7B%0A%20%20-webkit-transition%3A%20background-color%200.3s%20ease%2C%20-webkit-transform%200.3s%20ease%3B%0A%20%20transition%3A%20background-color%200.3s%20ease%2C%20transform%200.3s%20ease%3B%0A%20%20top%3A%200%3B%0A%20%20left%3A%200%3B%0A%20%20width%3A%20100%25%3B%0A%20%20height%3A%20100%25%3B%0A%20%20outline%3A%20none%3B%0A%20%20border-radius%3A%2050%25%3B%0A%20%20background-color%3A%20rgb%28255%2C%20255%2C%20255%29%3B%0A%20%20background-color%3A%20rgba%28255%2C%20255%2C%20255%2C%200.3%29%3B%0A%20%20text-indent%3A%20-999em%3B%0A%20%20cursor%3A%20pointer%3B%0A%20%20position%3A%20absolute%3B%0A%7D%0A%0A%23rev_slider_1_1%20.uranus%20.tp-bullet.selected%20.tp-bullet-inner%2C%0A%23rev_slider_1_1%20.uranus%20.tp-bullet%3Ahover%20.tp-bullet-inner%7B%0A%20transform%3A%20scale%280.4%29%3B%0A%20-webkit-transform%3A%20scale%280.4%29%3B%0A%20background-color%3Argb%28255%2C%20255%2C%20255%29%3B%0A%7D%0A");
	    var htmlDiv = document.getElementById('rs-plugin-settings-inline-css');
	    if (htmlDiv) {
	        htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
	    } else {
	        var htmlDiv = document.createElement('div');
	        htmlDiv.innerHTML = '<style>' + htmlDivCss + '</style>';
	        document.getElementsByTagName('head')[0].appendChild(htmlDiv.childNodes[0]);
	    } /*]]>*/
	</script>
     <!-- Include Swiper.js -->
     <!-- small slider script --->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Fetch image data from PHP
    const slides = <?php echo $slides_json; ?>;

    const sliderContainer = document.getElementById("sliderContainer");

    // Generate slides dynamically
    slides.forEach(slide => {
        const slideElement = document.createElement("div");
        slideElement.classList.add("swiper-slide");
        slideElement.innerHTML = `
            <div class="gdlr-core-image-item">
                <img src="./uploads/${slide.image_path}" alt="${slide.title}" style="width:90%; height:auto; border-radius:10px;">
                <h5 style="text-align:center; margin-top:10px;">${slide.title}</h5>
            </div>
        `;
        sliderContainer.appendChild(slideElement);
    });

    // Initialize Swiper.js slider
    new Swiper(".swiper-container", {
        loop: true,
        autoplay: { delay: 3000 },
        pagination: { el: ".swiper-pagination", clickable: true },
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
    });
});
</script>

<!-- large slider script --->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const slides = <?php echo $slides_json1; ?>;
    const sliderContainer = document.getElementById("sliderContainer1");

    slides.forEach(slide => {
    const slideElement = document.createElement("div");
    slideElement.classList.add("swiper-slide");
    slideElement.innerHTML = `
        <div class="slider-image-container">
            <img src="uploads/${slide.image_path}" alt="${slide.title}" class="slider-img">
            <div class="slider-description">${slide.description}</div>
            <h3 class="slider-title">${slide.title}</h3>
        </div>
    `;
    sliderContainer.appendChild(slideElement);
});


    new Swiper(".swiper-container", {
        loop: true,
        autoplay: { delay: 3000 },
        pagination: { el: ".swiper-pagination", clickable: true },
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
    });
});
</script>
</body>
</html>