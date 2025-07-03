<div class="kingster-mobile-header-wrap">
        <div class="kingster-mobile-header kingster-header-background kingster-style-slide kingster-sticky-mobile-navigation " id="kingster-mobile-header">
            <div class="kingster-mobile-header-container kingster-container clearfix">
                <div class="kingster-logo  kingster-item-pdlr">
                    <div class="kingster-logo-inner">
                        <a class="" href="index.php"><img src="images/logo-2.png" alt="" /></a>
                    </div>
                </div>
                <div class="kingster-mobile-menu-right">
                    <div class="kingster-main-menu-search" id="kingster-mobile-top-search"><i class="fa fa-search"></i></div>
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
                    <div class="kingster-mobile-menu"><a class="kingster-mm-menu-button kingster-mobile-menu-button kingster-mobile-button-hamburger" href="#kingster-mobile-menu"><span></span></a>
                        <div class="kingster-mm-menu-wrap kingster-navigation-font" id="kingster-mobile-menu" data-slide="right">
                            <ul id="menu-main-navigation" class="m-menu">
                                <li class="menu-item menu-item-home current-menu-item menu-item-has-children"><a href="index.php">Home</a>
                                    
                                </li>
                                <li class="menu-item menu-item-has-children"><a href="#">Structure</a>
                                    <ul class="sub-menu">
                                        <li class="menu-item menu-item-has-children"><a href="vco.php">Vice-Chancellor's Office</a>
                                            
                                                    <ul class="sub-menu">
                                                        <li class="menu-item"><a  href="vcounits.php">VCO (OfficeS/Units)</a></li>
                                                        <?php
                                                            // Fetch pages with category 'office'
                                                            $query6 = "SELECT pg_id, pg_title FROM pages_table WHERE pg_categ_id = 'vco'";
                                                            $result6 = $conn->query($query6);
                                                            
                                                            // Generate menu items dynamically
                                                            while ($row6 = $result6->fetch_assoc()) {
                                                                $pageTitle = htmlspecialchars($row6['pg_title']);
                                                                $pageUrl = "vcounit.php?id=" . $row6['pg_id']; // Direct toschools.php with page ID

                                                                echo '<li class="menu-item"><a href="' . $pageUrl . '">' . $pageTitle . '</a></li>';
                                                            }
                                                            ?>
                                                    </ul>
                                        </li>
                                        <li class="menu-item menu-item-has-children"><a href="units.php">Offices</a>
                                            <ul class="sub-menu">
                                                <?php
                                                            

                                                            // Fetch pages with category 'office'
                                                            $query5 = "SELECT pg_id, pg_title FROM pages_table WHERE pg_categ_id = 'office'";
                                                            $result5 = $conn->query($query5);
                                                            
                                                            // Generate menu items dynamically
                                                            while ($row5 = $result5->fetch_assoc()) {
                                                                $pageTitle = htmlspecialchars($row5['pg_title']);
                                                                $pageUrl = "office.php?id=" . $row5['pg_id']; // Direct toschools.php with page ID

                                                                echo '<li class="menu-item"><a href="' . $pageUrl . '">' . $pageTitle . '</a></li>';
                                                            }
                                                            ?>
                                            </ul>
                                        </li>
                                        <li class="menu-item menu-item-has-children"><a href="schools.php">Faculties</a>
                                            <ul class="sub-menu">
                                                                <?php
                                                               // Fetch pages with category 'school'
                                                               $query2 = "SELECT pg_id, pg_title FROM pages_table WHERE pg_categ_id = 'fac'";
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
                                        <li class="menu-item menu-item-has-children"><a href="directorate.php">Directorates</a>
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
                                </li>
                                <li class="menu-item menu-item-has-children"><a href="#">Admissions</a>
                                    <ul class="sub-menu">
                                            <ul class="sub-menu">
                                                <li class="menu-item"><a href="https://portal.afued.edu.ng">Apply To AFUED</a></li>
                                                <li class="menu-item"><a href="#">Scholarships</a></li>
                                                <li class="menu-item"><a href="#">College of Technology</a></li>
                                                <li class="menu-item"><a href="#">Pre-Degree</a></li>
                                                <li class="menu-item"><a href="https://portal.afued.edu.ng">Part-Time</a></li>
                                            </ul>
                                    </ul>
                                </li>
                                <li class="menu-item menu-item-has-children"><a href="#">News</a>
                                    <ul class="sub-menu">
                                        <li class="menu-item"><a href="blog.php">Update</a></li>
                                        <li class="menu-item"><a href="events.php">Events</a></li>
                                        <li class="menu-item"><a href="researchs.php">Researches</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item menu-item-has-children"><a href="#">About us</a>
                                    <ul class="sub-menu">
                                        <li class="menu-item"><a href="facts.php">University Facts</a></li>
                                        <li class="menu-item"><a href="#">Governing Council</a></li>
                                        <li class="menu-item"><a href="#">Principal Officers</a></li>
                                        <li class="menu-item"><a href="#">Gallery</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item menu-item-has-children"><a href="#">students</a>
                                    <ul class="sub-menu">
                                        <li class="menu-item"><a href="facts.php">Portal</a></li>
                                        <li class="menu-item"><a href="alumni.php">Alumni</a></li>
                                        <li class="menu-item"><a href="#">Payments</a></li>
                                        <li class="menu-item"><a href="#">SUG</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item"><a href="#">University Life</a></li>
                               
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>