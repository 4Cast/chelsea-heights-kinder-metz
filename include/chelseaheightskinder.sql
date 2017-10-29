-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2017 at 02:44 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chelseaheightskinder`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('rosebud') NOT NULL,
  `mon_fri_open` varchar(10) NOT NULL,
  `mon_fri_close` varchar(10) NOT NULL,
  `sat_open` varchar(10) NOT NULL,
  `sat_close` varchar(10) NOT NULL,
  `sun_open` varchar(10) NOT NULL,
  `sun_close` varchar(10) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `fax` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `type`, `mon_fri_open`, `mon_fri_close`, `sat_open`, `sat_close`, `sun_open`, `sun_close`, `phone`, `fax`, `address`, `email`) VALUES
(1, 'rosebud', '09:00', '18:00', '09:00', '12:00', 'closed', 'closed', '0359861555', '0359861333', '874 Point Nepean Rd, Rosebud, VIC 3939', 'info@rosebudpetvet.com.au');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `identifier`, `filename`, `created`) VALUES
(1, '3-Year-Old-Kindergarten', '3-Year-Old-Kindergarten.pdf', '0000-00-00 00:00:00'),
(2, '3-Year-Old-Fees', '3-Year-Old-Fees.pdf', '0000-00-00 00:00:00'),
(3, '3-Year-Old-Info-Booklet', '3-Year-Old-Info-Booklet.pdf', '0000-00-00 00:00:00'),
(4, '4-Year-Old-Kindergarten', '4-Year-Old-Kindergarten.pdf', '0000-00-00 00:00:00'),
(5, '4-Year-Old-Fees', '4-Year-Old-Fees.pdf', '0000-00-00 00:00:00'),
(6, '4-Year-Old-Info-Booklet', '4-Year-Old-Info-Booklet.pdf', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `event_date` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `content`, `image`, `event_date`, `created`) VALUES
(1, 'Working bee', '<p>Come and discover why your children are so excited about kinder.</p>\r\n', 'Information-Night-Flyer-April-2016-1.png-f027236547c3da8119f7b1b27390f284.png', '2017-01-28 16:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `priority` smallint(6) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image_name`, `description`, `priority`, `created`) VALUES
(1, 'Image_Gallery1.png', 'Add image description here...', 1, '2015-12-01 00:33:23');

-- --------------------------------------------------------

--
-- Table structure for table `home_page_animation`
--

CREATE TABLE IF NOT EXISTS `home_page_animation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `link` text,
  `text` varchar(255) NOT NULL,
  `background_color` varchar(20) DEFAULT NULL,
  `order_by` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `home_page_animation`
--

INSERT INTO `home_page_animation` (`id`, `image`, `link`, `text`, `background_color`, `order_by`) VALUES
(1, 'RotatingBanner_1.jpg', NULL, 'Everything you need to know about our 4yo program >', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `image_tiles`
--

CREATE TABLE IF NOT EXISTS `image_tiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `image_tiles`
--

INSERT INTO `image_tiles` (`id`, `text`, `url`, `image`, `type`) VALUES
(1, 'For Parents', 'parents/arrival-at-kinder', 'Tile_1.png', 'home'),
(2, 'Program', 'program/program-3-year-olds', 'Tile_2.png', 'home'),
(3, 'News', 'news', 'Tile_3.png', 'home'),
(4, '', '', 'df4f760db4129bfa45c0beef9128aa4a.png', 'why-choose-us'),
(5, '', '', '290631b9ec87e90c887b5306b8cc950d.png', 'why-choose-us'),
(6, '', '', '9981571050e79c5adf4ed7f3759c7034.png', 'why-choose-us'),
(7, '', '', 'c3f3eec7ecd50cfd7002777a59215460.png', 'our-service'),
(8, '', '', 'bd5aa34d4646e78844e8a39bda02292a.png', 'our-service'),
(9, '', '', '2f76226fe876b901b857cc102af4412c.png', 'our-service');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `news_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `pdf`, `image`, `content`, `news_date`) VALUES
(1, 'December 2016 Newsletter', '', '', '<p>Here is our term 4 newsletter.</p>\r\n<p>Please remember all important dates are located at the back of the newsletter.</p>', '2016-12-14'),
(2, 'September 2016 Newsletter', '', '', '<p>Better late than never. Here is our term 3 newsletter.<p>', '2016-10-17'),
(3, '3yo Meet and Greet Morning', '', '', '\r\n						<p>Chelsea Heights Kindergarten would like to invite your child and yourselves to our meet and greet morning on, </p>\r\n<p style="text-align: center; font-weight:bold; font-size:24px;">Saturday 10th of September 2016</p>\r\n<p style="text-align: center; font-weight:bold; font-size:24px;">from</p>\r\n<p style="text-align: center; font-weight:bold; font-size:24px;">10.00am to 11.30am </p>\r\n<p>This is fantastic opportunity for your child to become familiar with the kinder, teachers, other children and their families.<br>\r\nOn the day you will receive the final enrolment pack. Forms in this pack are to be returned on our AGM night. </p>\r\n<p>In the meantime here is <a href="https://indd.adobe.com/view/c363f0ca-d6a5-41cf-932c-865674518c36">a link to our brand new Information Booklet</a> about our kindergarten. It is also a reference for some of the forms you will be asked to sign. </p>\r\n<p>Please note other siblings are welcome to attend but are to be supervised at all times. This day is for your 3 year old or soon to be 3 year old to enjoy, explore and make new friends. </p>\r\n<p>As part of our Risk Minimisation for anaphylaxis and allergies we request no food containing nuts, sesame seeds or egg are brought into the kindergarten. </p>\r\n<p>If you are unable to attend we will post an information pack with all your final enrolment forms to you.</p>\r\n<p>If you have further questions please feel free to either ask myself or our teachers on the day or email us on<br>\r\n<a href="mailto:3yo.enrolments@chelseaheightskinder.vic.edu.au">3yo.enrolments@chelseaheightskinder.vic.edu.au</a></p>\r\n<p>Hope to see you at Meet &amp; Greet day,</p>\r\n<p>Kind regards<br>\r\nMandy Kuznetsov – 3YO Enrolment Officer</p>\r\n					', '2016-08-26'),
(4, 'Electrical Services. Commercial electricians at Outlook Electrical', 'newsletter-cc1fd85bf059cdb35c1e63a54c85179e', 'Image_Philosophy.png-b31564f0baa2046b6bbe6cdcedf5d47d.png', '<p>All areas of development are catered for and learning through play is the focus of our program.&nbsp; At kindergarten we work to build independence, positive self-esteem and respect for others.&nbsp; We promote a positive attitude to education, believing that we are all &ldquo;learners for life&rdquo;.</p>\r\n', '2016-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `page_descriptions`
--

CREATE TABLE IF NOT EXISTS `page_descriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `page_descriptions`
--

INSERT INTO `page_descriptions` (`id`, `page_name`, `content`, `modified`) VALUES
(1, 'index', '<h1>Our aim at Chelsea Heights Kindergarten is to provide\na secure, inclusive, high-quality learning environment.</h1>\n<p>All areas of development are catered for and learning through play is the\nfocus of our program. At kindergarten we work to build independence,\npositive self-esteem and respect for others. We promote a positive\nattitude to education, believing that we are all "learners for life".</p>\n<p>Find out What’s on at Chelsea Heights Kindergarten during 2016 and\nbeyond. Click the date in the calendar or visit latest news page for more\ninformation on the upcoming events.</p>', '2015-12-04 14:14:23'),
(2, 'our-philosophy', '<img class=''content-right-image'' src=''../images/content/Image_Philosophy.png'' />\n<p>At Chelsea Heights Kindergarten we aim to provide an environment that is safe, inviting and stimulating for all children. We welcome all kinder families and warmly invite them to take part in our program whenever possible. We firmly believe that each child’s kinder experience and overall development is enhanced by families and staff working together.</p>\n<p>Our curriculum is play based and offers a variety of activities that are initiated by the children’s emerging interests as well as those that are connected to the community and environment. Children are encouraged to make independent choices and individual needs are supported and catered for.</p>\n<p>Our program offers the children numerous music, art, literacy, language, maths and Science activities, presented in a fun and engaging manner. Several incursions and excursions are planned each year to develop and extend learning interests. We are committed to strengthening each child’s self-esteem and confidence: we encourage their ability to develop and share their ideas and knowledge.</p>\n<p>We promote respect for others through small group and partnered experiences, working as part of a team and through the sharing and taking turns of equipment and resources.</p>\n<p>Children attending our kindergarten are part of an inclusive environment that offers equal opportunity for all and provides a program that reflects and values diversity. Our philosophy recognises and follows the learning outcomes of the National Quality Framework (NQF) and the Victorian Early Years Learning Framework (VEYLF). We believe that children have the right to enjoy a valuable year of fun and play and to establish a positive attitude to learning for the future.</p>', '2015-11-30 00:15:40'),
(3, 'our-staff', '<img class=''content-right-image'' src=''../images/content/Image_OurStaff.png'' />\n<p>Our team of educators are qualified and experienced in the Early Childhood sector.</p>\n<p>They have been part of the Chelsea Heights Kinder Community for many years and have strong attachments to the local children and their families.</p>\n<p>We have an open door policy at our kindergarten. Sharon, Teresa, Judy and Liz welcome you at any time.</p>', '2015-11-30 00:26:49'),
(4, 'committee-of-management', '<img class=''content-right-image'' src=''../images/content/Image_COM.png'' />\n<h3>The Committee of Management is comprised of volunteer parents.</h3>\n<p>The Committee is responsible for all aspects of the kindergarten service, including policies, financial and administrative tasks, staffing, regulatory compliance and fundraising. Nominations are open to all parents of children enrolled at the kindergarten.</p>\n<p>The kindergarten encourages active participation by all members.</p>\n<p>Committee members are required to attend monthly meetings.</p>', '2015-12-04 13:56:16'),
(5, 'program-3-year-olds', '<img class=''content-right-image'' src=''../images/content/Image_3YO.png'' />\n<h4>3 year-olds</h4>\n<h5>We work hard to ensure a safe but stimulating environment is available to our 3 year olds.</h5>\n<p>For many of the children, kindergarten allows them to develop self-reliance and independence.</p>\n<p>At the same time they are discovering the implications of being part of a group; for example the need to wait, share and take turns.</p>\n<p>This occurs within the supportive guidelines and reassurance provided by attentive and caring Staff.</p>\n<p>All planned experiences are designed to be inviting and non-threatening.</p>\n<p>During Term 1 the 3 year olds are able to participate in our Rabbit Rearing Program.</p>\n<p>Prior to Mother’s day we share some of our favourite rhymes and songs with visiting mothers and others.</p>\n<p>Later in the year we have fun with Pyjama Day and a Teddy Bear’s Picnic. We also have a special persons day!</p>\n<p>Our Chicken Hatching Program is also a highlight and the Kidathalon is a valuable fundraiser as well as another opportunity for family involvement.</p>\n<p>As the year progresses, the changes in the children’s play reflect their readiness for the greater demands of the 4-year-old program. Play is more co-operative and sustained. Focus and concentration improve. Increasingly, children develop an awareness of the needs and rights of others; all essential life-skills that are built on early learning at kindergarten and at home.</p>', '2015-12-04 13:57:07'),
(6, 'program-4-year-olds', '<img class=''content-right-image'' src=''../images/content/Image_4YO.png'' />\n<h4>4 year-olds</h4>\n<h5>15 hours of contact time with the older children provides great continuity of learning and opportunity for uninterrupted play.</h5>\n<p>The children have time to develop quite sophisticated games and play scenarios both inside and out.<p>\n<p>They have ample time to plan and complete challenging, creative or problem-solving tasks without feeling rushed.</p>\n<p>We follow a traditional routine as we have found that this works best for most children.</p>\n<p>Visual cues are used to guide positive behaviour and the children are involved in creating acceptable limits and boundaries.</p>\n<p>An extensive array of Incursions and excursions supply us with interesting ways to address children’s needs and development.</p>\n<p>Areas of focus include Marine Life, Bodies and Health, Road and Fire Safety, Dinosaurs and Fossils, Australiana etc.</p>\n<p>At all times we are mindful of children’s learning as described in the Victorian Early years Learning Framework;</p>\n<p>That children develop;</p>\n<ul>\n<li>A strong sense of identity</li>\n<li>A strong sense of wellbeing</li>\n<li>The ability to connect and contribute to their world</li>\n<li>Communication skills</li>\n<li>The ability to be confident and involved learners</li>\n</ul>\n<p>We manage all this while having lots of FUN!!</p>', '2015-12-04 13:56:44'),
(7, 'term-dates', '<img class=''content-right-image'' src=''../images/content/Image_TermDates.png'' />\n<h4>Kindergarten generally operates to the school term dates set by the Department of Education and Early Childhood.</h4>\n\n<h5>Starting kindergarten</h5>\n<ul>\n<li><strong>Interview day:</strong> Parent and child attend for an hour. Interviews are conducted in small groups with the opportunity for confidential discussion if required. The children are able to choose their bathroom peg and play both indoors and outside, supervised by the co-educator.</li>\n<li><strong>Staggered sessions:</strong> a modified timetable operates for the first week. Only half the class attends each session and times are shorter to allow the children time to adjust to the full program.</li>\n</ul>\n<div class=''columns large-6 medium-6 small-12''>\n<h4>2016 term dates</h4>\n<p><strong>Term 1:</strong> 27 January – 24 March<br />\n<strong>Term 2:</strong> 11 April – 24 June<br />\n<strong>Term 3:</strong> 11 July – 16 September<br />\n<strong>Term 4:</strong> 4 October – 16 December (for students)</p>\n</div>\n<div class=''columns large-6 medium-6 small-12''>\n<h4>Public holidays</h4>\n<p><strong>There is no kinder on public holidays.</strong></p>\n<p>Labour Day – 14 March<br />\nGood Friday - 25 March<br />\nEaster Monday – 28 March<br />\nAnzac Day- 25 April<br />\nQueen’s Birthday - 13 June<br />\nMelbourne Cup – 1 November</p>\n</div>', '0000-00-00 00:00:00'),
(8, 'timetable', '<h4>2016 Timetable</h4>\n<img src=''../images/content/Table_Timetable.png'' />\n<div class=''column large-3 medium-3 small-12''>\n<h4>Possums</h4>\n\n<h5>Teacher</h5>	\n<p><strong>Sharon Cummins</strong></p>\n<p>Diploma in Teaching</p>\n\n<h5>Educator</h5>	\n<p>Teresa Fyfe</p>\n</div>\n\n<div class=''column large-3 medium-3 small-12''>\n<h4>Wombats</h4>\n\n<h5>Teacher</h5>	\n<p><strong>Judy Curnow</strong></p>\n<p>Bachelor of Teaching</br />\n(Early Childhood)</p>\n\n<h5>Educator</h5>	\n<p><strong>Elizabeth Thornell</strong></p>\n<p>Integration Support Module 1</p>\n\n</div>\n\n<div class=''column large-3 medium-3 small-12''>\n<h4>Koalas</h4>\n\n<h5>Teacher</h5>	\n<p><strong>Sharon Cummins</strong></p>\n<p>Diploma in Teaching</p>\n\n<h5>Educator</h5>	\n<p><strong>Elizabeth Thornell</strong></p>\n<p>Integration Support<br />\nModule 1</p>\n\n</div>\n\n<div class=''column large-3 medium-3 small-12''>\n<img src=''../images/content/Image_Timetable.png'' />\n</div>', '0000-00-00 00:00:00'),
(9, 'arrival-at-kinder', '<img class=''content-right-image'' src=''../images/content/Image_ForParents.png'' />\n<p>The kindergarten environment provides a wide range of learning opportunities for all children. Experiences may be planned or incidental but children are invited to explore, experiment and discover in our beautiful and stimulating spaces.</p>\n<p>Our experienced Staff offer a variety of teaching strategies to build each child’s confidence and self-esteem.</p>\n<p>Establishing secure and trusting relationships with children and their families is a key priority.</p>\n<p><strong>Drop off/pick up</strong></p>\n<p>Children enter via the bathroom door, where they then hang their bag, towel and sun-hat or jacket.</p>\n<p>Snack boxes remain in bags but drink bottles are placed on a trolley just inside the playroom door.</p>\n<p>Please give children responsibility for this routine when possible.</p>\n<p>It is important to be on time to collect your child or they may become anxious.</p>\n<p>Please inform us if you are going to be late so we can so we can reassure your child.</p>\n<p></p>\n<p><strong>Attendance book</strong></p>\n<p>An attendance book is located within the playroom. Please make sure you sign your child in and out at every session and enter the arrival and departure times. These are important requirements under the regulations that apply to all kindergartens.</p>\n<p>If someone else is dropping off or picking up your child, please make them aware of the above procedure.</p>\n<p>Please also let them know about no parking or turning in the kinder driveway and remind them to close kinder gates for the safety of all children.</p>\n<p>Our policy requires a person over the age of 18 to drop off and pick up your child.</p>\n<p>Thank you for your cooperation.</p>\n<p></p>\n<p><strong>Authorisation</strong></p>\n<p>On enrolment parents are required to nominate people authorised to collect their child.</p>\n<p>To add someone to the authorised persons list please speak to Staff.</p>\n<p>In the case of a play date or other reason for temporary authorisation, a yellow permission slip is available near</p>\n<p>the Attendance book. Please complete and hand this to a staff member.</p>\n<p></p>\n<p><strong>Settling in</strong></p>\n<p>Our ''Kick-Start to Kinder'' timetable at the beginning of the year means that the children attend in smaller groups for a shorter amount of time.</p>\n<p>This enables us to easily establish secure, nurturing relationships and to quickly deal with any separation issues that may occur. Children need to feel safe and happy to effectively learn and develop; we aim for an environment where this happens.</p>\n<p>The Parent Survey is a great way for you to provide feedback to the kindergarten.</p>\n<p>At the beginning of the year we ask you to bring in a family photo this can help strengthen the connection between home and Kindergarten and the children are frequently involved in sharing information about themselves and their families.</p>\n<p>A sense of ownership is encouraged as the children make choices and decisions; we promote independence and problem-solving whenever possible.</p>', '0000-00-00 00:00:00'),
(10, 'authorisation', '', '0000-00-00 00:00:00'),
(11, 'birthdays-and-celebrations', '<p>Chelsea Heights kinder welcome you to bring Natural Confectionery lollies for your child to celebrate their birthday.</p>\n<p>This is done at the end of the session as children are leaving.</p>\n<p>We cannot share cakes due to allergies and risk of anaphylaxis. </p>\n<p>When bringing food for special occasions at kinder please ensure food does not contain high risk ingredients such as nuts, sesame and eggs. </p>\n<p>Parents of children with dietary restrictions or food allergies are required to let staff know of their requirements and make sure that the necessary paper work is filled out once you become aware of any dietary restrictions or allergies. Please feel free to chat to the teachers if you have any questions or concerns.  </p>\n<p>Thank you.</p>', '0000-00-00 00:00:00'),
(12, 'complaints-and-concerns', '<p>If you have any concerns about your child or the kindergarten program, please do not hesitate to approach your child’s educator to make a suitable time to meet.  </p>\n<p>If you are not satisfied with the response or have concerns with the management or operation of the service, you are encouraged to contact our Grievance Officer as soon as possible. </p>\n<p>Please email vice.president@chelseaheightskinder.vic.edu.au</p>\n<p>If you feel the complaint is of a more serious nature, please contact the DEECD Southern Metropolitan Region Early Education Services on (03) 8765 5787 or (03) 8765 5600</p>', '0000-00-00 00:00:00'),
(13, 'illness', '<p><strong>Illness</strong></p>\n<p>During the year it is quite possible that your child may be ill.</p>\n\n<p>Please do not send your child to kinder with the following symptoms </p>\n\n<ul><li>An illness which may be infectious including an infectious runny nose</li>\n<li>A fever or bad cough</li>\n<li>vomiting / diarrhoea</li></ul>\n\n<p>Sending your child to kinder with the following symptoms will not only prolong the illness, but they may infect other children and the staff.</p>\n\n<p>Illness can cause the child to show signs of distress or discomfort which can be upsetting for both them and their peers. </p>\n\n<p> In the case of an infectious runny nose please only let your child return when it is running clear.</p>\n\n<p>Health Regulations require that in the case of certain illnesses, children must stay away from kindergarten for a specified period. Please see speck to Sharon or Judy if you have any concerns. </p>\n\n<p>Please click the following link for the complete exclusion table </p>\n\n<p>Shane can you please do something better with this link? </p>\n<p>https://www.nhmrc.gov.au/_files_nhmrc/publications/.../ch43poster4.pdf</p>\n\n\n<p> Please do not send them to kinder.</p>\n<p><strong>Immunisations</strong></p>\n\n<p>Recent changes in the Immunisation policy of the Victorian State government require that every child is fully vaccinated when attending an early education center to protect our children from preventable childhood diseases. </p>\n<p>Chelsea Heights Kindergarten therefore needs proof of your child’s immunisation status or in some cases medical evidence that your child cannot be vaccinated. </p>\n\n<p>The Kindergarten will accept the following as evidence of your child’s up to date immunisation; </p>\n\n<ul><li>An Immunisation History Statement, obtained from Medicare </li>\n\n<li>An Immunisation Status Certificate, obtained from a medical doctor or local council immunisation service. </li></ul>\n\n<p>Other immunisation records, such as the immunisation pages from your child''s health book, homeopathic immunisations and statutory declaration from you are not acceptable. </p>\n<p>Immunisation History Statements are available on request at any time by contacting the immunisation register on 1800 653 809 or you can get an up to date copy from the following website www.medicareaustralia.gov.au/online or email acir@medicareaustralia.gov.au  </p>\n<p>If you are experiencing difficulties accessing vaccinations or required documents, please contact us for assistance. In some cases, children can commence at the kindergarten while the required documents are obtained. If your child does have exemption from immunisation due to valid medical reasons please contact the kindergarten and you will be advised what documents we need.  </p>', '0000-00-00 00:00:00'),
(14, 'what-to-bring', '<p><strong>Healthy snack</strong></p>\n<p>We play an active role in promoting healthy eating and caring for our environment. Parents are asked to help us by packing healthy snacks with minimal packaging for children. We have a number of children with severe nut and allergies so please don’t pack any snacks that contain nuts of any kind. </p>\n<p>Ideas for healthy snack boxes  https://www.betterhealth.vic.gov.au/health/healthyliving/lunch-box-tips</p>\n\n<p><strong>Spare clothes</strong></p>\n<p>Please pack a change of clothes (including socks) in a plastic bag in case of accidents (toileting or otherwise).</p>\n<p>We often engage in messy play experiences and sometimes our protective measures fail!</p>\n<p>The kinder has some spare clothes but the children usually prefer their own.</p>\n<p><strong>Bringing toys</strong></p>\n<p>Please ensure children do not bring toys from home to kindergarten. </p>\n<p>Toys from home are easily lost or broken at kindergarten and personal toys can detract from the experiences set up for children to explore. </p>\n<p>The only exception is if specifically asked by the teacher to bring something appropriate from home for your child to talk about at show and tell etc. The learning experience at kindergarten does not support toy guns, swords, super hero dress-ups where aggressive or violent behaviour is displayed. Your support in following these guidelines is appreciated.</p>', '0000-00-00 00:00:00'),
(15, 'what-to-wear', '<p><strong>Clothing</strong></p>\n<p>Children should wear comfortable, easy to manage clothing.  Casual clothes allow the children to engage in messy play experiences without feeling upset or worried about getting dirty.</p>\n\n<p>We provide smocks for water-play, painting and clay plus gumboots and dungarees for the digging patch. </p>\n\n<p>Please dress children T-shirt sleeve for sun protection. No singlet tops or shoestring straps. Long dresses are also not suitable for safe outdoor play.  Children should bring a warm coat on colder days as we always venture outside Please name all clothing.</p>\n\n<p><strong>Spare clothes</strong></p>\n\n<p>Please pack a change of clothes (including socks) in a plastic bag. The kindergarten has spare clothing, however, children usually prefer to wear their own. If your child borrows some kindergarten clothing, please wash and return these items as soon as possible, as our supplies are limited.</p>\n\n<p><strong>Footwear</strong></p>\n\n<p>Please ensure your child wears appropriate, sturdy footwear. Thongs, crocs and slippery soled shoes are not suitable for safe play.</p>\n\n<p><strong>Merchandise</strong></p>\n\n<p>T-shirts and hats featuring the Chelsea Heights Kindergarten logo are available for purchase in a range of colours. </p>\n<p>You can even purchase hand-towels in a variety of colours. </p>\n<p>For any enquiries please contact our merchandising officer on merchandising@chelseaheightskinder.vic.edu.au </p>\n\n<p><strong>Hats</strong></p>\n<p>Bucket, broad –brimmed or legionnaire style hats are required for optimum sun protection. </p>\n\n<p><strong>Sunscreen</strong></p>\n<p>Chelsea Heights Kindergarten is committed to promoting awareness of sun protection and sun safe strategies and ensuring that program planning minimises exposure to the sun on days of high UV levels. Parents/guardians are responsible for applying sunscreen to their child before the start of each session between September and the end of April. </p>', '0000-00-00 00:00:00'),
(16, 'your-child''s-progress', '<p>Being on kinder duty is an opportune time to gain some insight on how your child is managing at kinder.</p>\n<p>While on duty, you can observe interactions with others, interests and strengths, get to know your child’s friends and chat with teachers.\n<p>Teachers do not conduct formal parent - teacher interviews however parents are welcome to make an appointment to discuss their child''s progress or any concerns.</p>\n<p>Drop-off and pick-up times are often busy and don’t enable private discussion so please chat with Staff to find out a more  convenient time.</p>', '0000-00-00 00:00:00'),
(17, 'policies', '\n<img class=''content-right-image'' src=''../images/content/Image_Policy.png'' /><ul><li>Acceptance and Refusal of Authorisations Policy</li>\n<li>Administration of Medication Policy</li>\n<li>Administration of First Aid Policy</li>\n<li>Anaphylaxis Policy</li>\n<li>Attachment 1Allergy Alert 2016</li>\n<li>Attachment 2 Enrolment Checklist</li>\n<li>Attachment 3 Child Allergy Risk Minimisation Checklist</li>\n<li>Attachment 4 Communication Plan</li>\n<li>Attachment 5 Induction Procedures for Relief Staff</li>\n<li>Attachment 6 Induction Procedures for Work experience</li>\n<li>Students and Student Teachers</li>\n<li>Asthma Policy</li>\n<li>Child Protection Policy</li>\n<li>Child Safe Environment Policy</li>\n<li>Curriculum Development Policy</li>\n<li>Complaints and Grievances Policy</li>\n<li>Code of Conduct Policy</li>\n<li>Delivery and Collection of Children Policy</li>\n<li>Dealing with Infectious Diseases Policy</li>\n<li>Determining Responsible Person Policy</li>\n<li>Dealing with Medical Conditions Policy</li>\n<li>Diabetes Policy</li>\n<li>Environmental Sustainability Policy</li>\n<li>Enrolment and Orientation Policy</li>\n<li>Epilepsy Policy</li>\n<li>Emergency and Evacuation Policy</li>\n<li>Excursions and Service Events Policy</li>\n<li>Fees Policy</li>\n<li>General Definitions (v4)</li>\n<li>Food Safety Policy</li>\n<li>Governance and Management of the Service Policy</li>\n<li>Hygiene Policy</li>\n<li>Inclusion and Equity Policy</li>\n<li>Incident Injury Trauma and Illness Policy</li>\n<li>Interactions with Children Policy</li>\n<li>Occupational Health and Safety Policy</li>\n<li>Information and Communication Technology Policy</li>\n<li>Privacy and Confidentiality Policy</li>\n<li>Nutrition and Active Play Policy</li>\n<li>Relaxation and Sleep Policy</li>\n<li>Staffing Policy</li>\n<li>Road Safety And Safe Transport Policy</li>\n<li>Sun Protection Policy</li>\n<li>Supervision of Children Policy</li>\n<li>Participation of Volunteers and Students Policy</li>\n<li>Water Safety Policy</li></ul>', '0000-00-00 00:00:00'),
(18, '3-year-olds-enrolments', '<img class=''content-right-image'' src=''../images/content/Image_3YOEnrolments.png'' />\n<p>Thank you for your expression of interest in our 3 year old program for 2017. Our experienced educators are committed to providing quality play based learning opportunities for your child.</p>\n<p><strong>For more information download the application form.</strong></p>\n<p><a href=''../documents/3-Year-Old-Kindergarten''><img src=''../images/content/Button_3YO.png'' class=''roll-over download-document'' /></a></p>\n\n<p><strong>Fees</strong></p>\n<p>Please download and fill in the form.</p>\n<p><a href=''../documents/3-Year-Old-Fees''><img src=''../images/content/Button_3YOFees.png'' class=''roll-over download-document'' /></a></p>\n<p><a href=''../documents/3-Year-Old-Info-Booklet''><img src=''../images/content/Button_3YOInfo.png'' class=''roll-over download-document'' /></a></p>', '0000-00-00 00:00:00'),
(19, '4-year-olds-enrolments', '<img class=''content-right-image'' src=''../images/content/4yo.png'' />\n<p><strong>Eligibility</strong></p>\n<p>Children turning four before 30 April in the year they start kindergarten can enrol.</p>\n\n<p><strong>Applications</strong></p>\n<p>Applications for four year old kindergarten are managed by Kingston City Council. A small application fee is payable to Kingston City Council on submitting an application. No fee is payable for Health Care/Pension Card Holders.</p>\n<p><strong>Application forms can be obtained from Kingston City Council website, click the button below.</strong></p>\n\n<p><a href=''../documents/4-Year-Old-Kindergarten''><img src=''../images/content/Button_4YO.png'' class=''roll-over download-document'' /></a></p>\n\n<p><strong>Process</strong></p>\n<p>Children allocated a place will receive a letter of offer from Chelsea Heights Kindergarten in August/September the year prior to starting kinder. Parents who wish to accept the placement must deposit a non refundable $75 to secure your child''s place.</p>\n\n<p><strong>Group allocations</strong></p>\n<p>Children will be allocated to groups at the discretion of Chelsea Heights Kindergarten. Factors taken into account in allocating children include:</p>\n\n<ul><li>development needs of children</li>\n<li>working commitments of parents</li>\n<li>gender ratios and age</li></ul>\n<p>Every endeavor will be made to accommodate parents'' work commitments or care arrangements. However, allocation to a particular group cannot be guaranteed.</p>\n\n<p><strong>Waiting list</strong></p>\n<p>From time to time vacancies arise through children moving away or deferring kindergarten. A waiting list is maintained to fill vacancies. For the most up to date information on vacancies and the waiting list please email 4yo.enrolments@chelseaheightskinder.vic.edu.au</p>\n\n<p><a href=''../documents/4-Year-Old-Fees''><img src=''../images/content/Button_4YOFees.png'' class=''roll-over download-document'' /></a></p>\n<p><a href=''../documents/4-Year-Old-Info-Booklet''><img src=''../images/content/Button_4YOInfo.png'' class=''roll-over download-document'' /></a></p>', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
