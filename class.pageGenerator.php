
<?php

class pageGenerator {

    protected
            $masterTable
            , $detailTable
            , $ParalaxSclic
            ,$ParalaxScliceN2
            ,$ParalaxScliceN3
            , $connection
            , $menue
            , $about
            , $sectionsContent
            , $newsSection
            , $centersSection
            , $centerId
            , $Colorslicer
            , $imgSlicer
            , $activitiesSlideShow
            , $taskShow

    ;
    private
            $dbPass
            , $dbHost
            , $dbUser
            , $dbName

    ;

    public function __construct($host, $user, $pass, $dbName, $centerId) {
        $this->dbPass = $pass;
        $this->dbName = $dbName;
        $this->dbHost = $host;
        $this->dbUser = $user;

        $this->centerId = $centerId;
        $this->connection = $this->connectToDB();
        $this->menue = $this->createMenue();
        $this->about = $this->creatAboutSection();
        $this->ParalaxSclice = $this->createParalaxsclice();
        $this->ParalaxScliceN2 = $this->createParalaxscliceN2();
        $this->ParalaxScliceN3 = $this->createParalaxscliceN3();
        $this->sectionsContent = $this->createSlider();
        $this->newsSection = $this->createNewsSection();
        $this->centersSection = $this->createCentersSection();
        $this->Colorslicer = $this->createColorSlicer();
        $this->imgSlicer = $this->createImgSlicer();
         $this->activitiesSlideShow = $this->createActivitiesSlideShow();
        $this->taskShow = $this->createtaskShow();
    }

    private function connectToDB() {
        $connection = mysql_connect($this->dbHost, $this->dbUser, $this->dbPass);
        mysql_select_db($this->dbName, $connection);
        mysql_query("SET NAMES UTF8");
        return $connection;
    }
//    public static function sendMsg($centerId){
//       
//        $msg = 7;
//         $msgContent = "SELECT * FROM `centers_content_details` WHERE center_id=$centerId AND section_id=$msg";
//        $msgContentQuery = mysql_query($msgContent, $this->connection);
//         if (mysql_num_rows($msgContentQuery) > 0) {
//            $asso = mysql_fetch_assoc($msgContentQuery);
//            $id = $asso['id'];
//            
//         }
//         return $id;
//    }

    public function createMenue() {
        $centerId = $this->centerId;
        $menuItem = 8;
        $menue = '<div id="globalWrapper" class="localscroll"><header id="mainHeader" class="clearfix">
    <div class="container">
      <div class="row">
        <div class="span12">
          <a href="index.html" class="brand">
            <img src="images/logo.png" alt="alteaE website template"/>
          </a>
          <nav id="mainMenu" class="scrollMenu clearfix">
            <ul class="nav clearfix"><li>  <a class="active" href="#homeCorpo"> صفحه اصلی</a></li>';
        $menuContentId = "SELECT * FROM `centers_content_details` WHERE center_id=$centerId AND section_id=$menuItem";
        $menuContentIdQuery = mysql_query($menuContentId, $this->connection);
        if (mysql_num_rows($menuContentIdQuery) > 0) {
            $asso = mysql_fetch_assoc($menuContentIdQuery);
            $id = $asso['id'];

            $MenuItems = "SELECT * FROM  `content_type_menuitem` WHERE `center_content_details_id`=$id AND `url` != '#homeCorpo' ";
            $getMenu = mysql_query($MenuItems, $this->connection);

            while ($menu = mysql_fetch_assoc($getMenu)) {


                $menue .= " <li><a href='$menu[url]'>$menu[menu_title]</a> </li>";
            }
            $menue .=' </ul>
          </nav>
        </div>
      </div>
    </div>
  </header>';
        }
        return $menue;
    }
    public function createActivitiesSlideShow() {
        $centerId = $this->centerId;
        $ActivitiesSlideShowSectionsId = 14;
        $query = "SELECT id FROM centers_content_details WHERE center_id=$centerId AND section_id=$ActivitiesSlideShowSectionsId";
        $ActivitiesSlideShowSectionsIdQuery = mysql_query($query, $this->connection);
        $asso = mysql_fetch_assoc($ActivitiesSlideShowSectionsIdQuery);
        $id = $asso['id'];
        $ActivitiesSlideShowSection = '<section class="slice"  id="activitySlideShow">
		 <div class="container">


            <h1>مشاهده فعالیت ها</h1>




			  <div class="span12">
            <div class="flexslider flexProject">
              <ul class="slides sliderWrapper">
              ';
        $masterQuery = "SELECT * FROM   content_type_activityslideshow WHERE centers_contentDetails_id=$id";
        $activities = mysql_query($masterQuery, $this->connection);

        if ($activities > 0) {
            while ($sectionResult = mysql_fetch_assoc($activities)) {
                $ActivitiesSlideShowSection .=" <li class='slide'>
                    <div class='span6'>
                     <section class='imgWrapper'>
                     <img src='images/news/$sectionResult[media]' ' />



                         </section>
                    <p style='position:absolute; right: 50px; top: 10px; font-size: x-large;'>$sectionResult[title]</p><br>

                    <div style='position:absolute; right: 50px; top: 50px; width: 400px; height:150px;'>$sectionResult[contentText]</div><br>

               </div>
                    </li>";
            }
            $ActivitiesSlideShowSection .= '   </ul>
            </div>
          </div></div>

	</section>';
        }
        return $ActivitiesSlideShowSection;
    }

    public function createtaskShow() {
        $centerId = $this->centerId;
        $taskShowSectionsId = 15;
        $query = "SELECT id FROM centers_content_details WHERE center_id=$centerId AND section_id=$taskShowSectionsId";
        $taskShowSectionsIdQuery = mysql_query($query, $this->connection);
        $asso = mysql_fetch_assoc($taskShowSectionsIdQuery);
        $id = $asso['id'];
        $taskShowSection = '<section class="slice color3"  id="taskShow">
		 <div class="container">


            <h1>مشاهده فعالیت ها</h1>


		<div class="span12">


            <div class="row">
             <div class="portfolio-items isotopeWrapper clearfix imgHover" id="3">

              ';
        $masterQuery = "SELECT * FROM   content_type_taskshow WHERE centers_contentDetails_id=$id";
        $activities = mysql_query($masterQuery, $this->connection);

        if ($activities > 0) {
            while ($sectionResult = mysql_fetch_assoc($activities)) {
                $taskShowSection .="

        <article class='boxLink boxNew span4 isotopeItem women'>
                     <section class='imgWrapper'>
                     <img src='images/news/$sectionResult[image]' ' />
                         </section>

                         <div class='media-hover'>
                                    <div class='mask'></div>
                                    <div class='iconLinks'>
                                      <a href='$sectionResult[link]' target='_blank' class='sizer iconWrapper'>
                                        <i class='icon-videocam'></i></a>
                                        <a href='images/portfolio/zoom6.jpg' class='prettyPhoto iconWrapper'>
                                          <i class='icon-search'></i></a>
                                          </div>
                                        </div>
                                        <section class='boxContent'>
                                          <h3>$sectionResult[title]</h3>
                                          <p>
                                             $sectionResult[contentText]
                                            <br>
                                            <a href='$sectionResult[link]' class='moreLink'>&rarr; ادامه مطلب</a>                                    </p>
                                          </section>

                    ";
            }
            $taskShowSection .= '
                </div>
            </div>
          </div>
          </div>

	</section>';
        }
        return $taskShowSection;
    }
    public function createColorSlicer() {
        $centerId = $this->centerId;
        $colorSlicerItem = 13;
        $Colorslicer = '';
        $ColorslicerId = "SELECT id FROM `centers_content_details` WHERE center_id=$centerId AND section_id=$colorSlicerItem";
        $ColorslicerIdQuery = mysql_query($ColorslicerId, $this->connection);
        if (mysql_num_rows($ColorslicerIdQuery) > 0) {
            $asso = mysql_fetch_assoc($ColorslicerIdQuery);
            $id = $asso['id'];
            $Color_slicerItems = "SELECT * FROM  `slicers` WHERE `centerDetailsId`=$id";
            $getItems = mysql_query($Color_slicerItems, $this->connection);
            while($slicer = mysql_fetch_assoc($getItems)) {
                $Colorslicer .= " <section class='color$slicer[bg_color]'>
       <div class='ctaBox ctaBoxFullwidth'>
        <div class='container'>
         
           
                <div class='descSubscribe'>
        <img src='./images/slider/camera/$slicer[bg_img]'></img>
                 


            </div>
            
              <div class='subscribe' style='margin-top: -89px;'>
             
                
					        <input type='text'  placeholder=پست الکترونی'ی' id='EmailSubs'>
                                                <button  onclick='addEmail($(EmailSubs).val());' >ارسال</button>

				      	
                            		</div>
           
        
        </div>
      </div>
    </section>";
            }
        }
        return $Colorslicer;
    }

    public function createImgSlicer() {
        $centerId = $this->centerId;
        $imgSlicerItem = 12;
        $imgSlicer = '';
        $imgSlicerId = "SELECT * FROM `centers_content_details` WHERE center_id=$centerId AND section_id=$imgSlicerItem";
        $imgslicerIdQuery = mysql_query($imgSlicerId, $this->connection);
        if (mysql_num_rows($imgslicerIdQuery) > 0) {
            $asso = mysql_fetch_assoc($imgslicerIdQuery);
            $id = $asso['id'];
            $img_slicerItems = "SELECT * FROM  `slicers` WHERE `centerDetailsId`=$id";
            $getItems = mysql_query($img_slicerItems, $this->connection);

            while ($slicer = mysql_fetch_assoc($getItems)) {
                $imgSlicer .="<section style='background-image: url(./images/slider/camera/$slicer[bg_img]); height:100px; width:100%;'>    
                    <p style='font-size: 23px;
color: #fff;
margin-right: 34%;
padding-top: 16px;
margin-bottom: -0.1em;'>
			$slicer[p1]
			</p>
            <p style='font-size: 16.5px;
color: #EBEBEB;
 margin-right: 33.8%;'>$slicer[p2]</p></section>";
            }
            return $imgSlicer;
        }
    }

//$masterTable = array('table' => 'cateories', 'title' => 'title', 'pk' => 'id')
    public function createSlider() {
        $centerId = $this->centerId;
        $sliderSectionsId = 1;
        $query = "SELECT id FROM centers_content_details WHERE center_id=$centerId AND section_id=$sliderSectionsId";
        $sliderContentIdQuery = mysql_query($query, $this->connection);
        if (mysql_num_rows($sliderContentIdQuery) > 0) {
            $asso = mysql_fetch_assoc($sliderContentIdQuery);
            $id = $asso['id'];
            $sectionsContent = '  <section class="content">
            <section class="clearfix" id="homeCorpo">
      <div class="container">
        <div class="row">
          <div class="span12">
            <div class="flexslider flexFullScreen mb40 ">
              <ul class="slides">';
            $masterQuery = "SELECT * FROM  slider_content_list WHERE slider_id=$id ORDER BY slidePriority";
            $slides = mysql_query($masterQuery, $this->connection);
            if (mysql_num_rows($slides) > 0) {
                $slideNumber = mysql_num_rows($slides);
                if ($slideNumber > 0) {
                    for ($i = 0; $i <= $slideNumber; $i++) {
                        while ($sectionResult = mysql_fetch_assoc($slides)) {


                            $j = $i + 1;
                            $k = $j + 1;
                            $sectionsContent .="<li class='slideN$i'>
                    <img src='./images/slider/super/$sectionResult[slide_img_Title]' alt='$sectionResult[slide_img_alt]' style='width:100%;height: 420px;  padding-bottom: 1px;'/>
                        <div class='caption $sectionResult[caption]'>
                         <div class='element$j-$j' data-animation='$sectionResult[animatingTypeBig]'>
                      <h1>$sectionResult[slide_big_title]</h1>
                    </div>
                    <div class='element$j-$k' data-animation='$sectionResult[animatingTypeSmall]'>
                      <h2>$sectionResult[slide_small_title]</h2>
                    </div>
                        </li> ";
                            $i++;
                        }
                    }

                    $sectionsContent .='</ul> ';
                }

                return $sectionsContent .='</div>
          </div>
        </div>
      </div></section>';
            }
        }
    }

    public function creatAboutSection() {

        $centerId = $this->centerId;
        $aboutSectionsId = 2;
        $query = "SELECT id FROM centers_content_details WHERE center_id=$centerId AND section_id=$aboutSectionsId";
        $aboutContentIdQuery = mysql_query($query, $this->connection);

        if (mysql_num_rows($aboutContentIdQuery) > 0) {
            $asso = mysql_fetch_assoc($aboutContentIdQuery);
            $id = $asso['id'];
            $about = ' <section class="slice" id="about">
      <div class="container">
        <div class="row mb40">
          <div class="span12">
            <h1>درباره ما</h1>
          </div> <div class="span6">
            <div class="flexslider flexProject">
              <ul class="slides sliderWrapper">';
            $getIntroTextId = "SELECT * FROM  intro_section_content WHERE section_id=$id";
            $introId = mysql_query($getIntroTextId, $this->connection);
            if (mysql_num_rows($introId) > 0) {
                $assoarrayIntro = mysql_fetch_assoc($introId);
                $myIntroId = $assoarrayIntro['id'];
                $myIntroTitle = $assoarrayIntro['title'];
                $myIntroText = $assoarrayIntro['text_content'];
                $masterQuery = "SELECT * FROM   introslider WHERE introId=$myIntroId";
                $slides = mysql_query($masterQuery, $this->connection);
                $slideNumber = mysql_num_rows($slides);
                if ($slideNumber > 0) {
                    for ($i = 0; $i <= $slideNumber; $i++) {
                        while ($sectionResult = mysql_fetch_assoc($slides)) {
                            $isImage = $sectionResult['isImage'];


                            $about .="<li class='slideN$i'>";
                            if ($isImage == 1)
                                $about .="    <img src='./images/introSlider/$sectionResult[slideContent]' alt='$slides[alt]' style='width:570px; height:320px;'/></li>";
                            else {
                                $about .=" <video  width='570px' height='320px' controls>
                <source src='./images/introSlider/$sectionResult[slideContent]' type='video/mp4'>
             </video>";
                            }

                            $i++;
                        }
                    }
                    $about .="</ul>
            </div>
          </div> <div class='span6'><h2>$myIntroTitle</h2><p>$myIntroText</p></div>
        </div>
      </div>
    </section>";
                }
            }

            return $about;
        }
    }

    public function createCentersSection() {
        $centerId = $this->centerId;
        $centersSectionsId = 4;
        $queryy = "SELECT id FROM centers_content_details WHERE center_id=$centerId AND section_id=$centersSectionsId";

        $centersContentIdQuery = mysql_query($queryy, $this->connection);
        if (mysql_num_rows($centersContentIdQuery) > 0) {
            $asso = mysql_fetch_assoc($centersContentIdQuery);
            $id = $asso['id'];
            $centersSection = '  <section class="slice" id="centers">
                    <div class="container">
                    <div class="row">

                            <h1>مراکز شرکت</h1>';
            $masterQuery = "SELECT * FROM  centers WHERE section_id=$id";
            $centers = mysql_query($masterQuery, $this->connection);


            while ($sectionResult = mysql_fetch_assoc($centers)) {
                $centersSection .="<div class='span6 clearfix'>
            <div class='boxFeature clearfix'>
              <div class='one_third'>
                <div class='iconWrapper iconBig color4'><i class='$sectionResult[icone_img]'></i>
                </div>
              </div>
              <div class='two_thirds last'>
                <h2><a href='HTTP://$sectionResult[url]' target='_blank'>$sectionResult[name]</a></h2>
                <p>$sectionResult[center_description]</p>
              </div>
            </div>
          </div>";
            }
            $centersSection .=' </section>';



            return $centersSection;
        }
    }

    public function createNewsSection() {
        $centerId = $this->centerId;
        $newsSectionsId = 6;
        $query = "SELECT id FROM centers_content_details WHERE center_id=$centerId AND section_id=$newsSectionsId";
        $newsContentIdQuery = mysql_query($query, $this->connection);
        $asso = mysql_fetch_assoc($newsContentIdQuery);
        $id = $asso['id'];
        $newsSection = '<section class="slice"  id="news">
		 <div class="container">


            <h1>اخبار مرکز </h1>




			  <div class="span12">
            <div class="flexslider flexProject">
              <ul class="slides sliderWrapper">
              ';
        $masterQuery = "SELECT * FROM  content_type_news WHERE section_id=$id";
        $news = mysql_query($masterQuery, $this->connection);

        if ($news > 0) {
            while ($sectionResult = mysql_fetch_assoc($news)) {
                $newsSection .=" <li class='slide'>
                    <div class='span13'>
                     <section class='imgWrapper'>
                     <img src='images/news/$sectionResult[news_img]' alt='$sectionResult[news_img_alt]' />
                     <section class='newsDate'>
                          <h4>$sectionResult[newsDay]</h4>
                          <span>$sectionResult[news_month]</span> </section>


                         </section>
                    <p style='position:absolute; right: 50px; top: 10px; font-size: x-large;'>$sectionResult[news_title]</p><br>

                    <p style='position:absolute;right: 50px; top: 50px; width: 600px;'>$sectionResult[news_summery]</p><br>
                 <p style='float:right; margin-right: 100px;margin-top: 180px;'>$sectionResult[newsDay]</p>
               </div>
                    </li>";
            }
            $newsSection .= '   </ul>
            </div>
          </div></div>

	</section>';
        }
        return $newsSection;
    }

    public function createParalaxsclice() {

        $centerId = $this->centerId;
        $ParalaxSectionsId = 9;
        $query = "SELECT id FROM centers_content_details WHERE center_id=$centerId AND section_id=$ParalaxSectionsId";
        $ParalaxContentIdQuery = mysql_query($query, $this->connection);
        $asso = mysql_fetch_assoc($ParalaxContentIdQuery);
        $id = $asso['id'];
        $ParalaxSclice = '';
        $masterQuery = "SELECT * FROM  content_type_parallaxslice WHERE centers_content_details_id=$id";
        $paralax = mysql_query($masterQuery, $this->connection);

        if ($paralax > 0) {
            while ($sectionResult = mysql_fetch_assoc($paralax)) {
                $ParalaxSclice .="<div id='paralaxSlice1' data-stellar-background-ratio='0.5' style='background-image: url(./images/slider/camera/$sectionResult[bgPic]);'>
                  <div class='paralaxText'>
                     
                  <p style='text-align: center;
font-size: 32px;
margin-top: 55px;margin-bottom: -0.1em;'>$sectionResult[bigTitle]</p>
		<p style='text-align: center;
font-size: 25px;color: #DDD;'>$sectionResult[alt]</p>
                  </div>
                </div>
                 
                  ";
            }
            
        }
        return $ParalaxSclice;
    }
public function createParalaxscliceN2() {

        $centerId = $this->centerId;
        $ParalaxSectionsId = 10;
        $query = "SELECT id FROM centers_content_details WHERE center_id=$centerId AND section_id=$ParalaxSectionsId";
        $ParalaxContentIdQuery = mysql_query($query, $this->connection);
        $asso = mysql_fetch_assoc($ParalaxContentIdQuery);
        $id = $asso['id'];
        $ParalaxScliceN2 = '';
        $masterQuery = "SELECT * FROM  content_type_parallaxslice WHERE centers_content_details_id=$id";
        $paralax = mysql_query($masterQuery, $this->connection);

        if ($paralax > 0) {
            while ($sectionResult = mysql_fetch_assoc($paralax)) {
                $ParalaxScliceN2 .="<div id='paralaxSlice1' data-stellar-background-ratio='0.5' style='background-image: url(./images/slider/camera/$sectionResult[bgPic]);'>
                  <div class='paralaxText'>
                     
                  <p style='text-align: center;
font-size: 32px;
margin-top: 55px;margin-bottom: -0.1em;'>$sectionResult[bigTitle]</p>
		<p style='text-align: center;
font-size: 25px;color: #DDD;'>$sectionResult[alt]</p>
                  </div>
                </div>
                 
                  ";
            }
            
        }
        return $ParalaxScliceN2;
    }
    public function createParalaxscliceN3() {

        $centerId = $this->centerId;
        $ParalaxSectionsId = 11;
        $query = "SELECT id FROM centers_content_details WHERE center_id=$centerId AND section_id=$ParalaxSectionsId";
        $ParalaxContentIdQuery = mysql_query($query, $this->connection);
        $asso = mysql_fetch_assoc($ParalaxContentIdQuery);
        $id = $asso['id'];
        $ParalaxScliceN3 = '';
        $masterQuery = "SELECT * FROM  content_type_parallaxslice WHERE centers_content_details_id=$id";
        $paralax = mysql_query($masterQuery, $this->connection);

        if ($paralax > 0) {
            while ($sectionResult = mysql_fetch_assoc($paralax)) {
                $ParalaxScliceN3 .="<div id='paralaxSlice1' data-stellar-background-ratio='0.5' style='background-image: url(./images/slider/camera/$sectionResult[bgPic]);'>
                  <div class='paralaxText'>
                     
                  <p style='text-align: center;
font-size: 32px;
margin-top: 55px;margin-bottom: -0.1em;'>$sectionResult[bigTitle]</p>
		<p style='text-align: center;
font-size: 25px;color: #DDD;'>$sectionResult[alt]</p>
                  </div>
                </div>
                 
                  ";
            }
            
        }
        return $ParalaxScliceN3;
    }
    public function generatePage() {
          $centerId = $this->centerId;
        $getPageName="SELECT  name FROM centers WHERE id=$centerId ";
         $pageNameQuery = mysql_query($getPageName, $this->connection);
         $pNameasso = mysql_fetch_assoc($pageNameQuery);
         $name=$pNameasso['name'];
        $pageContent = '<title>'.$name.' </title>
<meta name="description" content="ALTEA One Page Paralax HTML5, CSS3, responsive, Bootstrap website template">
<meta name="author" content="Little NEKO">
<!-- Mobile Specific Metas
    ================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- CSS
    ================================================== -->
<!-- Bootstrap  -->
<link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<!-- web font  -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,800" rel="stylesheet" type="text/css">
<!-- plugin css  -->
<link rel="stylesheet" type="text/css" href="js-plugin/animation-framework/animate.css" />
<link rel="stylesheet" type="text/css" href="js-plugin/pretty-photo/css/prettyPhoto.css" />
<link rel="stylesheet" type="text/css" href="js-plugin/flexslider/flexslider.css" />
<!-- icon fonts -->
<link type="text/css" rel="stylesheet" href="font-icons/custom-icons/css/custom-icons.css">
<link type="text/css" rel="stylesheet" href="font-icons/custom-icons/css/custom-icons-ie7.css">
<link type="text/css" rel="stylesheet" href="font-icons/custom-icons/css/flat-ui.css">
<!-- Custom css -->
<link type="text/css" rel="stylesheet" href="css/layout.css">
<link type="text/css" id="colors" rel="stylesheet" href="css/orange.css">
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->
<script src="js/modernizr-2.6.1.min.js"></script>
<!-- Favicons
    ================================================== -->
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="144x144" href="images/apple-touch-icon-144x144.png">
</head>
<body data-spy="scroll" data-target="#mainMenu" data-offset="150" class="corporate">';
      
        $query = "SELECT id,section_id FROM centers_content_details WHERE center_id=$centerId ORDER BY section_priority";
        $totaPageContentQuery = mysql_query($query, $this->connection);
//        $asso=mysql_fetch_assoc($totaPageContentQuery);
//       $t=$asso['id'];
        while ($asso = mysql_fetch_assoc($totaPageContentQuery)) {

            $ttt = $asso['section_id'];
            switch ($ttt) {
                case "1":
                    $pageContent .= $this->sectionsContent;
                    break;
                case "2":
                    $pageContent .= $this->about;
                    break;
                case "4":
                    $pageContent .= $this->centersSection;
                    break;
                case "6":
                    $pageContent .= $this->newsSection;
                    break;
                case"8":
                    $pageContent .= $this->menue;
                    break;
                case"9":
                    $pageContent .= $this->ParalaxSclice;
                    break;
                case"10":
                    $pageContent .= $this->ParalaxScliceN2;
                    break;
                case"11":
                    $pageContent .= $this->ParalaxScliceN3;
                    break;
                case"12":
                    $pageContent .= $this->imgSlicer;
                    break;
                case"13":
                    $pageContent .= $this->Colorslicer;
                    break;
                 case"14":
                    $pageContent .= $this->activitiesSlideShow;
                    break;
                 case"15":
                    $pageContent .= $this->taskShow;
                    break;
             
            
            
            }
        }
        return $pageContent . '<section class="slice color1"  id="contactSlice" >
      <div class="container">
        <div class="row mb40">
          <div class="span12">
            <h1>تماس با ما</h1>
          </div>
          <div id="contactSlide">
            <div class="span3">
              <a href="" title="" id="mapTriggerLoader">
              <div class="iconWrapper iconBig">
                <i class="icon-location"></i>
              </div>
              <span class="clearfix">برای مشاهده نقشه لطفا کلیک کنید</span>
              </a>

            </div>
            <div class="span6">
             
                <label for="name"></label>
                <input type="text" id="sendername" placeholder="نام"  title="لطفا نام معتبر وارد نمایید حد اقل 2 حرف"/>
                <label for="email"></label>
                <input type="text"  id="senderemail" placeholder="ایمیل" title="لطفا ایمیل معتبر وارد کنید"/>
                <label for="phone"></label>
                <input type="text"    id="phone"  placeholder="تلفن تماس"  title="لطفا تلفن معتبر وارد نمایید"/>
                <label for="comments"></label>
                <label for="titele"></label>
                <input  type="text" id="msgtitle" size="10" value="" placeholder="عنوان پیام" title="لطفا عنوان پیام را وارد نمایید">
                <label for="comments"></label>
                <textarea  id="sendercomments" cols="3" rows="5" placeholder="پیام شما" title=" لطفا پیام خود را وارد نمایید"></textarea>

                <br/>
                <button type="submit" name="sendMsg"  id="submitMsg" class="btn" onclick="MsgSend('.$centerId.'
                                                                                                  
                                                                                                   ,$(sendername).val(),
                                                                                                      
                                                                                                    $(phone).val(),
                                                                                                    $(senderemail).val(),
                                                                                                    $(msgtitle).val(),
                                                                                                        $(sendercomments).val()
                                                                                            
                                                                                                                                           );">ارسال
                                                                                                                 </button>
              
              <div class="result">

             </div>
            </div>

              <address>

             <br/>




              <i class="icon-location"></i>آدرس:
تهران، خیابان کارگر شمالی، خیابان شهید فرشی مقدم(شانزدهم)، پارک علم و فناوری دانشگاه تهران، ساختمان شماره 1، طبقه همکف، واحد 113<br>

              <i class="icon-phone"></i>&nbsp;021-88220534 <br>
              <i class="icon-mail-alt"></i>&nbsp;
              <a href="learning@Geoit.ir">
              learning@Geoit.ir
              </a>
              <br>

               <i class="icon-road"></i>   کد پستی:1439814448<br>
           </p>


              </address>

          </div>
          <div id="mapSlide">
            <div class="span12">
              <div id="mapWrapper"></div>
              <a href="#" title="" id="mapReturn" class="btn btn-small">
              <i class="icon-left-dir"></i> بازگشت
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>  <!--contact-->
  </section>  <section  id="footerRights">
                                        <div class="container">
                                          <div class="row">
                                            <div class="span12">

                                                <p style="margin-right:400px; margin-top:15px;">کلیه حقوق متعلق به شرکت توسعه علوم ژئوماتیک رهپویان می باشد </p>
                                            </div>
                                          </div>
                                        </div>
                                      </section>
                                      <!-- End footer -->
                                    </div>








                                      <!-- End footer -->
</div> <script type="text/javascript" src="js-plugin/respond/respond.min.js"></script>
<script type="text/javascript" src="js-plugin/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="js-plugin/jquery-ui/jquery-ui-1.8.23.custom.min.js"></script>
<!-- third party plugins  -->
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap-carousel-ie.js"></script>
<script type="text/javascript" src="js-plugin/easing/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js-plugin/pretty-photo/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="js-plugin/flexslider/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="js-plugin/jquery.sharrre-1.3.4/jquery.sharrre-1.3.4.min.js"></script>
<script type="text/javascript" src="js-plugin/neko-contact-ajax-plugin/js/jquery.form.js"></script>
<script type="text/javascript" src="js-plugin/neko-contact-ajax-plugin/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js-plugin/parallax/js/jquery.scrollTo-1.4.3.1-min.js"></script>
<script type="text/javascript" src="js-plugin/parallax/js/jquery.localscroll-1.2.7-min.js"></script>
<script type="text/javascript" src="js-plugin/parallax/js/jquery.stellar.min.js"></script>
<!-- Custom  -->
<script type="text/javascript" src="js/custom.js"></script>
            <script>
            function MsgSend(centerId,msgSenderName,msgSenderTel,msgSenderMail,msgTitle,msgTxt){
                                  $.post(
                                            "business/Ajax.php"
                                            , {gettcenterIdtosendMsg: centerId,                                                
                                                gettmsgSenderName: msgSenderName,
                                                    gettmsgSenderTel:msgSenderTel,
                                                   gettmsgSenderMail:msgSenderMail,
                                                   gettmsgTitle: msgTitle,
                                                   gettmsgTxt:msgTxt}
                                    , function(data) {
                                        $(".result").html(data);


                                    }
                                    )
                                    }
                                    function addEmail(email){
                                     $.post(
                                            "business/Ajax.php"
                                            , {gettEmailNewsLetter:email}
                                    , function(data) {
                                        alert(data);


                                    }
                                    )
                                    }
            </script>
</body>
</html>';
    }

}

?>
