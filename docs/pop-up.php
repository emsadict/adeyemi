<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Custom Popup</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
    }

    /* Overlay */
    .popup-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6); /* transparent dark background */
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }

    /* Popup box */
    .popup-box {
      background: white;
      border-radius: 10px;
      width: 90%;
      max-width: 400px;
      padding: 20px;
      position: relative;
      text-align: center;
      box-shadow: 0 0 20px rgba(0,0,0,0.3);
    }

    .popup-box img {
      width: 100%;
      border-radius: 8px;
      margin-bottom: 15px;
    }

    .popup-box h2 {
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

    .close-btn {
      padding: 10px 20px;
      background-color: crimson;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .close-btn:hover {
      background-color: darkred;
    }
  </style>
</head>
<body>

<!-- Popup -->
<div class="popup-overlay" id="popup">
  <div class="popup-box">
    <span class="close-icon" onclick="closePopup()">×</span>
    <img src="images/advert.jpg" alt="Popup Image">
    <h2>Part-Time degree Programmes</h2>
    <p>ADEYEMI FEDERAL UNIVERSITY OF EDUCATION, ONDO
DIRECTORATE OF CONTINUING EDUCATION AND PART-TIME STUDIES

ADMISSION INTO PART-TIME DEGREE PROGRAMME  
OBAFEMI AWOLOWO UNIVERSITY, ILE-IFE 
2025/2026 CONTACT SESSION 

Applications are hereby invited from suitably qualified candidates for admission into the following Part-Time degree Programmes for the 2025/2026 Course Session..</p>
    <button class="close-btn" onclick="closePopup()">Close</button>
  </div>
</div>

<script>
  function closePopup() {
    document.getElementById("popup").style.display = "none";
  }
</script>

</body>
</html>
