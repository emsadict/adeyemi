<header class="kingster-header-wrap kingster-header-style-plain  kingster-style-menu-right kingster-sticky-navigation kingster-style-fixed" data-navigation-offset="75px">
                <div class="kingster-header-background"></div>
                <div class="kingster-header-container  kingster-container">
                    <div class="kingster-header-container-inner clearfix">
                        <div class="kingster-logo  kingster-item-pdlr">
                            <div class="kingster-logo-inner">
                                <a class="" href="index.php"><img src="images/logo-2.png" alt="" /></a>
                            </div>
                        </div>
                        <div class="kingster-navigation kingster-item-pdlr clearfix ">
                            <div class="kingster-main-menu" id="kingster-main-menu">
                                <ul id="menu-main-navigation-1" class="sf-menu">
                                    <li class="menu-item menu-item-home menu-item-has-children kingster-normal-menu"><a href="index.php" class="sf-with-ul-pre">Home</a>
                                        
                                    </li>
                              
                                    <li class="menu-item current-menu-item menu-item-has-children kingster-mega-menu" ><a href="organogram.php" class="sf-with-ul-pre">Structure</a>
                                        <div class="sf-mega sf-mega-full ">
                                            <ul class="sub-menu">
                                                <li class="menu-item menu-item-has-children" data-size="15"><a  href="vco.php" class="sf-with-ul-pre">Vice-Chancellor's Office</a>
                                                    <ul class="sub-menu">
                                                        <li class="menu-item"><a href="bachelor-of-science-in-business-administration.html">Legal Unit</a></li>
                                                        <li class="menu-item"><a href="school-of-law.html">Public Relations Unit</a></li>
                                                        <li class="menu-item"><a href="engineering.html">Identity Cards Units</a></li>
                                                        <li class="menu-item"><a href="engineering.html">Internal Audit Unit</a></li>
                                                        <li class="menu-item"><a href="medicine.html">SERVICOM/ACTM</a></li>
                                                        <li class="menu-item"><a href="art-science.html">MIS</a></li>
                                                      
                                                    </ul>
                                                </li>
                                                <li class="menu-item menu-item-has-children" data-size="15"><a href="units.php" class="sf-with-ul-pre">Offices</a>
                                                    <ul class="sub-menu">
                                                    <li class="menu-item"><a href="registry.php">Registry</a></li>
                                                        
                                                        <?php
                                                            

                                                            // Fetch pages with category 'directorate'
                                                            $query5 = "SELECT pg_id, pg_title FROM pages_table WHERE pg_categ_id = 'office'";
                                                            $result5 = $conn->query($query5);
                                                            
                                                            // Generate menu items dynamically
                                                            while ($row5 = $result5->fetch_assoc()) {
                                                                $pageTitle = htmlspecialchars($row5['pg_title']);
                                                                $pageUrl = "school.php?id=" . $row5['pg_id']; // Direct toschools.php with page ID

                                                                echo '<li class="menu-item"><a href="' . $pageUrl . '">' . $pageTitle . '</a></li>';
                                                            }
                                                            ?>
                                                        
                                                    </ul>
                                                </li>
                                               
                                                
                                                <li class="menu-item menu-item-has-children" data-size="15"><a href="schools.php" class="sf-with-ul-pre">Schools</a>
                                                <ul class="sub-menu">
                                                        
                                                        <?php
                                                            

                                                               // Fetch pages with category 'directorate'
                                                               $query2 = "SELECT pg_id, pg_title FROM pages_table WHERE pg_categ_id = 'school'";
                                                               $result2 = $conn->query($query2);
                                                               
                                                               // Generate menu items dynamically
                                                               while ($row2 = $result2->fetch_assoc()) {
                                                                   $pageTitle = htmlspecialchars($row2['pg_title']);
                                                                   $pageUrl = "school.php?id=" . $row2['pg_id']; // Direct toschools.php with page ID

                                                                   echo '<li class="menu-item"><a href="' . $pageUrl . '">' . $pageTitle . '</a></li>';
                                                               }
                                                               ?>
                                                    </ul>
                                                </li> 
                                                <li class="menu-item menu-item-has-children" data-size="15"><a href="directorate.php" class="sf-with-ul-pre">Directorates</a>
                                                    <ul class="sub-menu">
                                                    <?php
                                                               require 'db_connect.php';

                                                               // Fetch pages with category 'directorate'
                                                               $query1 = "SELECT pg_id, pg_title FROM pages_table WHERE pg_categ_id = 'directorate'";
                                                               $result1 = $conn->query($query1);
                                                               
                                                               // Generate menu items dynamically
                                                               while ($row1 = $result1->fetch_assoc()) {
                                                                   $pageTitle = htmlspecialchars($row1['pg_title']);
                                                                   $pageUrl = "directorate-main.php?id=" . $row1['pg_id']; // Direct to directorate-main.php with page ID

                                                                   echo '<li class="menu-item"><a href="' . $pageUrl . '">' . $pageTitle . '</a></li>';
                                                               }
                                                               ?>
                                                    </ul>
                                                </li>  
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="menu-item menu-item-has-children kingster-normal-menu"><a href="#" class="sf-with-ul-pre">Admissions</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item" data-size="60"><a href="#">Apply To AFUED</a></li>
                                            <li class="menu-item" data-size="60"><a href="scholarships.html">Scholarships</a></li>
                                            <li class="menu-item" data-size="60"><a href="scholarships.html">College of Technology</a></li>
                                            <li class="menu-item" data-size="60"><a href="scholarships.html">Pre-Degree</a></li>
                                            <li class="menu-item" data-size="60"><a href="scholarships.html">Part-Time</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item menu-item-has-children kingster-normal-menu"><a href="#" class="sf-with-ul-pre">News</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item" data-size="60"><a href="blog.php">Update</a></li>
                                            <li class="menu-item" data-size="60"><a href="events.php">Events</a></li>
                                            <li class="menu-item" data-size="60"><a href="researchs.php">Researches</a></li>


                                        </ul>
                                    </li>
                                    <li class="menu-item menu-item-has-children kingster-normal-menu"><a href="#" class="sf-with-ul-pre">About Us</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item" data-size="60"><a href="facts.php">University Facts</a></li>
                                            <li class="menu-item" data-size="60"><a href="#">Governing Council</a></li>
                                            <li class="menu-item" data-size="60"><a href="#">Principal Officers</a></li>
                                            <li class="menu-item" data-size="60"><a href="gallery.php">Gallery</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item menu-item-has-children kingster-normal-menu"><a href="#" class="sf-with-ul-pre">Student</a>
                                        <ul class="sub-menu">
                                        <li class="menu-item" data-size="60"><a href="facts.php">Portal</a></li>
                                        <li class="menu-item" data-size="60"><a href="alumni.php">Alumni</a></li>
                                        <li class="menu-item" data-size="60"><a href="#">Payments</a></li>
                                        <li class="menu-item" data-size="60"><a href="#">SUG</a></li>
                                        
                                        </ul>
                                    </li>
                                    <li class="menu-item kingster-normal-menu"><a href="university-life.html">University Life</a></li>
                                </ul>
                                <div class="kingster-navigation-slide-bar" id="kingster-navigation-slide-bar"></div>
                            </div>
                            <div class="kingster-main-menu-right-wrap clearfix ">
                                <div class="kingster-main-menu-search" id="kingster-top-search"><i class="icon_search"></i></div>
                                <div class="kingster-top-search-wrap">
                                    <div class="kingster-top-search-close"></div>
                                    <div class="kingster-top-search-row">
                                        <div class="kingster-top-search-cell">
                                            <form role="search" method="get" class="search-form" action="#">
                                                <input type="text" class="search-field kingster-title-font" placeholder="Search..." value="" name="s">
                                                <div class="kingster-top-search-submit"><i class="fa fa-search"></i></div>
                                                <input type="submit" class="search-submit" value="Search">
                                                <div class="kingster-top-search-close"><i class="icon_close"></i></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
</header>