<?php

session_start();
if (isset($_GET["id"])) {

    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        die();
    }

    $athleteID = filter_var($_GET["id"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

    include 'Database.php';
    $pdo = Database::connect();

    $sql_athlete = "select * from tbl_athlete "
            . "where tbl_athlete.athlete_ID = ?";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q_athlete = $pdo->prepare($sql_athlete);
    $q_athlete->execute(array($athleteID));


    while ($zeile = $q_athlete->fetch(/* PDO::FETCH_ASSOC */)) {
        $athleteFirstname = $zeile["athlete_firstname"];
        $athleteLastname = $zeile["athlete_lastname"];
        $athleteStreet = $zeile["athlete_street"];
        $athleteZip = $zeile["athlete_zip"];
        $athleteCity = $zeile["athlete_city"];
        $athleteCountry = $zeile["athlete_country"];
        $athleteBirthdate = $zeile["athlete_birthdate"];
        $athleteGender = $zeile["athlete_gender"];
        $athleteAffiliate = $zeile["athlete_affiliate"];
        $athleteBestScore = $zeile["athlete_bestscore"];
        $athleteShirtsize = $zeile["athlete_shirtsize"];
        $athleteEmail = $zeile["athlete_email"];
        $athleteAvatar = $zeile["athlete_avatar"];
        $athleteActionpicture = $zeile["athlete_actionpicture"];
    }


    if ($athleteAvatar != 0) {
        $avatarsrc = "uploads/athlete/profile/$athleteAvatar";
    } else {
        $avatarsrc = "img/default-avatar.png";
    }

    if ($athleteActionpicture != 0) {
        $athleteActionpictureSrc = "uploads/athlete/actionpicture/$athleteActionpicture";
    } else {
        $athleteActionpictureSrc = "img/actionpicture_placeholder.jpg";
    }

    print "<div class=\"row\">\n";
    print "\n";
    print "\n";
    print "        <div class=\"col-lg-4 col-lg-offset-4 fileinput fileinput-new text-center\" data-provides=\"fileinput\">\n";
    print "            <div class=\"fileinput-new thumbnail img-circle img-raised\">\n";
    print "                <img src=\"
                                    $avatarsrc\" alt=\"...\">\n";
    print "            </div>\n";
    print "\n";
    print "            <div class=\"fileinput-preview fileinput-exists thumbnail img-circle img-raised\"></div>\n";
    print "            <h4 class=\"card-title\">$athleteFirstname $athleteLastname </h4>\n";
    print "            <p class=\"description\">\n";
    print "     $athleteAffiliate \n";
    print "            </p>\n";
    print "            <div>\n";
    
    print "\n";
    print "\n";
    print "            </div>\n";
    print "        </div>\n";
    print "    </div>\n";
    print "    <div class=\"row\">\n";
    print "\n";
    print "        <div class=\"col-md-4\">\n";
    print "            <div class=\"form-group label-floating\">\n";
    print "                <label class=\"control-label\">Email address</label>\n";
    print "                <p>$athleteEmail</p>\n";
    print "            </div>\n";
    print "        </div>\n";
    print "        <div class=\"col-md-4\">\n";
    print "            <div class=\"form-group label-floating\">\n";
    print "                <label class=\"control-label\">Affiliate</label>\n";
    print "                <p>$athleteAffiliate</p>\n";
    print "            </div>\n";
    print "        </div>\n";
   
   
    print "        <div class=\"col-md-4\">\n";
    print "            <div class=\"form-group label-floating\">\n";
    print "                <label class=\"control-label\">First Name</label>\n";
    print "                <p>$athleteFirstname</p>\n";
    print "            </div>\n";
    print "        </div>\n";
     print "        </div>\n";
     print "    <div class=\"row\">\n";
    print "        <div class=\"col-md-4\">\n";
    print "            <div class=\"form-group label-floating\">\n";
    print "                <label class=\"control-label\">Last Name</label>\n";
    print "                <p>$athleteLastname</p>\n";
    print "            </div>\n";
    print "        </div>\n";
    print "        <div class=\"col-md-4\">\n";
    print "            <div class=\"form-group label-floating\">\n";
    print "                <label class=\"control-label\">Date of Birth</label>\n";
    print "                <p>$athleteBirthdate</p>\n";
    print "            </div>\n";
    print "        </div>\n";
    
    print "        <div class=\"col-md-4\">\n";
    print "            <div class=\"form-group label-floating\">\n";
    print "                <label class=\"control-label\">Gender</label>\n";
    if ($athleteGender == 1) {
        $genderText = "<p>female</p>";
    } else {
        $genderText = "<p>male</p>";
    }
    print $genderText;
    print "                                                                 </div>\n";
    print "        </div>\n";
    print "        </div>\n";
   
    print "    <div class=\"row\">\n";
    print "        <div class=\"col-md-4\">\n";
    print "            <div class=\"form-group label-floating\">\n";
    print "                <label class=\"control-label\">Street</label>\n";
    print "                <p>$athleteStreet</p>\n";
    print "            </div>\n";
    print "        </div>\n";
    
    
    print "        <div class=\"col-md-4\">\n";
    print "            <div class=\"form-group label-floating\">\n";
    print "                <label class=\"control-label\">ZIP</label>\n";
    print "                <p>$athleteZip</p>\n";
    print "            </div>\n";
    print "        </div>\n";
    print "\n";
    print "        <div class=\"col-md-4\">\n";
    print "            <div class=\"form-group label-floating\">\n";
    print "                <label class=\"control-label\">City</label>\n";
    print "                <p>$athleteCity</p>\n";
    print "            </div>\n";
    print "        </div>\n";
    print "        </div>\n";
    print "    <div class=\"row\">\n";
    print "        <div class=\"col-md-4\">\n";
    print "            <div class=\"form-group label-floating\">\n";
    print "                <label class=\"control-label\">Country</label>\n";
    print "                <select id=\"country\" class=\"form-control\" disabled>\n";
    print "                    <option value=\"AF\">Afghanistan</option>\n";
    print "                    <option value=\"AX\">Åland Islands</option>\n";
    print "                    <option value=\"AL\">Albania</option>\n";
    print "                    <option value=\"DZ\">Algeria</option>\n";
    print "                    <option value=\"AS\">American Samoa</option>\n";
    print "                    <option value=\"AD\">Andorra</option>\n";
    print "                    <option value=\"AO\">Angola</option>\n";
    print "                    <option value=\"AI\">Anguilla</option>\n";
    print "                    <option value=\"AQ\">Antarctica</option>\n";
    print "                    <option value=\"AG\">Antigua and Barbuda</option>\n";
    print "                    <option value=\"AR\">Argentina</option>\n";
    print "                    <option value=\"AM\">Armenia</option>\n";
    print "                    <option value=\"AW\">Aruba</option>\n";
    print "                    <option value=\"AU\">Australia</option>\n";
    print "                    <option value=\"AT\">Austria</option>\n";
    print "                    <option value=\"AZ\">Azerbaijan</option>\n";
    print "                    <option value=\"BS\">Bahamas</option>\n";
    print "                    <option value=\"BH\">Bahrain</option>\n";
    print "                    <option value=\"BD\">Bangladesh</option>\n";
    print "                    <option value=\"BB\">Barbados</option>\n";
    print "                    <option value=\"BY\">Belarus</option>\n";
    print "                    <option value=\"BE\">Belgium</option>\n";
    print "                    <option value=\"BZ\">Belize</option>\n";
    print "                    <option value=\"BJ\">Benin</option>\n";
    print "                    <option value=\"BM\">Bermuda</option>\n";
    print "                    <option value=\"BT\">Bhutan</option>\n";
    print "                    <option value=\"BO\">Bolivia, Plurinational State of</option>\n";
    print "                    <option value=\"BQ\">Bonaire, Sint Eustatius and Saba</option>\n";
    print "                    <option value=\"BA\">Bosnia and Herzegovina</option>\n";
    print "                    <option value=\"BW\">Botswana</option>\n";
    print "                    <option value=\"BV\">Bouvet Island</option>\n";
    print "                    <option value=\"BR\">Brazil</option>\n";
    print "                    <option value=\"IO\">British Indian Ocean Territory</option>\n";
    print "                    <option value=\"BN\">Brunei Darussalam</option>\n";
    print "                    <option value=\"BG\">Bulgaria</option>\n";
    print "                    <option value=\"BF\">Burkina Faso</option>\n";
    print "                    <option value=\"BI\">Burundi</option>\n";
    print "                    <option value=\"KH\">Cambodia</option>\n";
    print "                    <option value=\"CM\">Cameroon</option>\n";
    print "                    <option value=\"CA\">Canada</option>\n";
    print "                    <option value=\"CV\">Cape Verde</option>\n";
    print "                    <option value=\"KY\">Cayman Islands</option>\n";
    print "                    <option value=\"CF\">Central African Republic</option>\n";
    print "                    <option value=\"TD\">Chad</option>\n";
    print "                    <option value=\"CL\">Chile</option>\n";
    print "                    <option value=\"CN\">China</option>\n";
    print "                    <option value=\"CX\">Christmas Island</option>\n";
    print "                    <option value=\"CC\">Cocos (Keeling) Islands</option>\n";
    print "                    <option value=\"CO\">Colombia</option>\n";
    print "                    <option value=\"KM\">Comoros</option>\n";
    print "                    <option value=\"CG\">Congo</option>\n";
    print "                    <option value=\"CD\">Congo, the Democratic Republic of the</option>\n";
    print "                    <option value=\"CK\">Cook Islands</option>\n";
    print "                    <option value=\"CR\">Costa Rica</option>\n";
    print "                    <option value=\"CI\">Côte d'Ivoire</option>\n";
    print "                    <option value=\"HR\">Croatia</option>\n";
    print "                    <option value=\"CU\">Cuba</option>\n";
    print "                    <option value=\"CW\">Curaçao</option>\n";
    print "                    <option value=\"CY\">Cyprus</option>\n";
    print "                    <option value=\"CZ\">Czech Republic</option>\n";
    print "                    <option value=\"DK\">Denmark</option>\n";
    print "                    <option value=\"DJ\">Djibouti</option>\n";
    print "                    <option value=\"DM\">Dominica</option>\n";
    print "                    <option value=\"DO\">Dominican Republic</option>\n";
    print "                    <option value=\"EC\">Ecuador</option>\n";
    print "                    <option value=\"EG\">Egypt</option>\n";
    print "                    <option value=\"SV\">El Salvador</option>\n";
    print "                    <option value=\"GQ\">Equatorial Guinea</option>\n";
    print "                    <option value=\"ER\">Eritrea</option>\n";
    print "                    <option value=\"EE\">Estonia</option>\n";
    print "                    <option value=\"ET\">Ethiopia</option>\n";
    print "                    <option value=\"FK\">Falkland Islands (Malvinas)</option>\n";
    print "                    <option value=\"FO\">Faroe Islands</option>\n";
    print "                    <option value=\"FJ\">Fiji</option>\n";
    print "                    <option value=\"FI\">Finland</option>\n";
    print "                    <option value=\"FR\">France</option>\n";
    print "                    <option value=\"GF\">French Guiana</option>\n";
    print "                    <option value=\"PF\">French Polynesia</option>\n";
    print "                    <option value=\"TF\">French Southern Territories</option>\n";
    print "                    <option value=\"GA\">Gabon</option>\n";
    print "                    <option value=\"GM\">Gambia</option>\n";
    print "                    <option value=\"GE\">Georgia</option>\n";
    print "                    <option value=\"DE\">Germany</option>\n";
    print "                    <option value=\"GH\">Ghana</option>\n";
    print "                    <option value=\"GI\">Gibraltar</option>\n";
    print "                    <option value=\"GR\">Greece</option>\n";
    print "                    <option value=\"GL\">Greenland</option>\n";
    print "                    <option value=\"GD\">Grenada</option>\n";
    print "                    <option value=\"GP\">Guadeloupe</option>\n";
    print "                    <option value=\"GU\">Guam</option>\n";
    print "                    <option value=\"GT\">Guatemala</option>\n";
    print "                    <option value=\"GG\">Guernsey</option>\n";
    print "                    <option value=\"GN\">Guinea</option>\n";
    print "                    <option value=\"GW\">Guinea-Bissau</option>\n";
    print "                    <option value=\"GY\">Guyana</option>\n";
    print "                    <option value=\"HT\">Haiti</option>\n";
    print "                    <option value=\"HM\">Heard Island and McDonald Islands</option>\n";
    print "                    <option value=\"VA\">Holy See (Vatican City State)</option>\n";
    print "                    <option value=\"HN\">Honduras</option>\n";
    print "                    <option value=\"HK\">Hong Kong</option>\n";
    print "                    <option value=\"HU\">Hungary</option>\n";
    print "                    <option value=\"IS\">Iceland</option>\n";
    print "                    <option value=\"IN\">India</option>\n";
    print "                    <option value=\"ID\">Indonesia</option>\n";
    print "                    <option value=\"IR\">Iran, Islamic Republic of</option>\n";
    print "                    <option value=\"IQ\">Iraq</option>\n";
    print "                    <option value=\"IE\">Ireland</option>\n";
    print "                    <option value=\"IM\">Isle of Man</option>\n";
    print "                    <option value=\"IL\">Israel</option>\n";
    print "                    <option value=\"IT\">Italy</option>\n";
    print "                    <option value=\"JM\">Jamaica</option>\n";
    print "                    <option value=\"JP\">Japan</option>\n";
    print "                    <option value=\"JE\">Jersey</option>\n";
    print "                    <option value=\"JO\">Jordan</option>\n";
    print "                    <option value=\"KZ\">Kazakhstan</option>\n";
    print "                    <option value=\"KE\">Kenya</option>\n";
    print "                    <option value=\"KI\">Kiribati</option>\n";
    print "                    <option value=\"KP\">Korea, Democratic People's Republic of</option>\n";
    print "                    <option value=\"KR\">Korea, Republic of</option>\n";
    print "                    <option value=\"KW\">Kuwait</option>\n";
    print "                    <option value=\"KG\">Kyrgyzstan</option>\n";
    print "                    <option value=\"LA\">Lao People's Democratic Republic</option>\n";
    print "                    <option value=\"LV\">Latvia</option>\n";
    print "                    <option value=\"LB\">Lebanon</option>\n";
    print "                    <option value=\"LS\">Lesotho</option>\n";
    print "                    <option value=\"LR\">Liberia</option>\n";
    print "                    <option value=\"LY\">Libya</option>\n";
    print "                    <option value=\"LI\">Liechtenstein</option>\n";
    print "                    <option value=\"LT\">Lithuania</option>\n";
    print "                    <option value=\"LU\">Luxembourg</option>\n";
    print "                    <option value=\"MO\">Macao</option>\n";
    print "                    <option value=\"MK\">Macedonia, the former Yugoslav Republic of</option>\n";
    print "                    <option value=\"MG\">Madagascar</option>\n";
    print "                    <option value=\"MW\">Malawi</option>\n";
    print "                    <option value=\"MY\">Malaysia</option>\n";
    print "                    <option value=\"MV\">Maldives</option>\n";
    print "                    <option value=\"ML\">Mali</option>\n";
    print "                    <option value=\"MT\">Malta</option>\n";
    print "                    <option value=\"MH\">Marshall Islands</option>\n";
    print "                    <option value=\"MQ\">Martinique</option>\n";
    print "                    <option value=\"MR\">Mauritania</option>\n";
    print "                    <option value=\"MU\">Mauritius</option>\n";
    print "                    <option value=\"YT\">Mayotte</option>\n";
    print "                    <option value=\"MX\">Mexico</option>\n";
    print "                    <option value=\"FM\">Micronesia, Federated States of</option>\n";
    print "                    <option value=\"MD\">Moldova, Republic of</option>\n";
    print "                    <option value=\"MC\">Monaco</option>\n";
    print "                    <option value=\"MN\">Mongolia</option>\n";
    print "                    <option value=\"ME\">Montenegro</option>\n";
    print "                    <option value=\"MS\">Montserrat</option>\n";
    print "                    <option value=\"MA\">Morocco</option>\n";
    print "                    <option value=\"MZ\">Mozambique</option>\n";
    print "                    <option value=\"MM\">Myanmar</option>\n";
    print "                    <option value=\"NA\">Namibia</option>\n";
    print "                    <option value=\"NR\">Nauru</option>\n";
    print "                    <option value=\"NP\">Nepal</option>\n";
    print "                    <option value=\"NL\">Netherlands</option>\n";
    print "                    <option value=\"NC\">New Caledonia</option>\n";
    print "                    <option value=\"NZ\">New Zealand</option>\n";
    print "                    <option value=\"NI\">Nicaragua</option>\n";
    print "                    <option value=\"NE\">Niger</option>\n";
    print "                    <option value=\"NG\">Nigeria</option>\n";
    print "                    <option value=\"NU\">Niue</option>\n";
    print "                    <option value=\"NF\">Norfolk Island</option>\n";
    print "                    <option value=\"MP\">Northern Mariana Islands</option>\n";
    print "                    <option value=\"NO\">Norway</option>\n";
    print "                    <option value=\"OM\">Oman</option>\n";
    print "                    <option value=\"PK\">Pakistan</option>\n";
    print "                    <option value=\"PW\">Palau</option>\n";
    print "                    <option value=\"PS\">Palestinian Territory, Occupied</option>\n";
    print "                    <option value=\"PA\">Panama</option>\n";
    print "                    <option value=\"PG\">Papua New Guinea</option>\n";
    print "                    <option value=\"PY\">Paraguay</option>\n";
    print "                    <option value=\"PE\">Peru</option>\n";
    print "                    <option value=\"PH\">Philippines</option>\n";
    print "                    <option value=\"PN\">Pitcairn</option>\n";
    print "                    <option value=\"PL\">Poland</option>\n";
    print "                    <option value=\"PT\">Portugal</option>\n";
    print "                    <option value=\"PR\">Puerto Rico</option>\n";
    print "                    <option value=\"QA\">Qatar</option>\n";
    print "                    <option value=\"RE\">Réunion</option>\n";
    print "                    <option value=\"RO\">Romania</option>\n";
    print "                    <option value=\"RU\">Russian Federation</option>\n";
    print "                    <option value=\"RW\">Rwanda</option>\n";
    print "                    <option value=\"BL\">Saint Barthélemy</option>\n";
    print "                    <option value=\"SH\">Saint Helena, Ascension and Tristan da Cunha</option>\n";
    print "                    <option value=\"KN\">Saint Kitts and Nevis</option>\n";
    print "                    <option value=\"LC\">Saint Lucia</option>\n";
    print "                    <option value=\"MF\">Saint Martin (French part)</option>\n";
    print "                    <option value=\"PM\">Saint Pierre and Miquelon</option>\n";
    print "                    <option value=\"VC\">Saint Vincent and the Grenadines</option>\n";
    print "                    <option value=\"WS\">Samoa</option>\n";
    print "                    <option value=\"SM\">San Marino</option>\n";
    print "                    <option value=\"ST\">Sao Tome and Principe</option>\n";
    print "                    <option value=\"SA\">Saudi Arabia</option>\n";
    print "                    <option value=\"SN\">Senegal</option>\n";
    print "                    <option value=\"RS\">Serbia</option>\n";
    print "                    <option value=\"SC\">Seychelles</option>\n";
    print "                    <option value=\"SL\">Sierra Leone</option>\n";
    print "                    <option value=\"SG\">Singapore</option>\n";
    print "                    <option value=\"SX\">Sint Maarten (Dutch part)</option>\n";
    print "                    <option value=\"SK\">Slovakia</option>\n";
    print "                    <option value=\"SI\">Slovenia</option>\n";
    print "                    <option value=\"SB\">Solomon Islands</option>\n";
    print "                    <option value=\"SO\">Somalia</option>\n";
    print "                    <option value=\"ZA\">South Africa</option>\n";
    print "                    <option value=\"GS\">South Georgia and the South Sandwich Islands</option>\n";
    print "                    <option value=\"SS\">South Sudan</option>\n";
    print "                    <option value=\"ES\">Spain</option>\n";
    print "                    <option value=\"LK\">Sri Lanka</option>\n";
    print "                    <option value=\"SD\">Sudan</option>\n";
    print "                    <option value=\"SR\">Suriname</option>\n";
    print "                    <option value=\"SJ\">Svalbard and Jan Mayen</option>\n";
    print "                    <option value=\"SZ\">Swaziland</option>\n";
    print "                    <option value=\"SE\">Sweden</option>\n";
    print "                    <option value=\"CH\">Switzerland</option>\n";
    print "                    <option value=\"SY\">Syrian Arab Republic</option>\n";
    print "                    <option value=\"TW\">Taiwan, Province of China</option>\n";
    print "                    <option value=\"TJ\">Tajikistan</option>\n";
    print "                    <option value=\"TZ\">Tanzania, United Republic of</option>\n";
    print "                    <option value=\"TH\">Thailand</option>\n";
    print "                    <option value=\"TL\">Timor-Leste</option>\n";
    print "                    <option value=\"TG\">Togo</option>\n";
    print "                    <option value=\"TK\">Tokelau</option>\n";
    print "                    <option value=\"TO\">Tonga</option>\n";
    print "                    <option value=\"TT\">Trinidad and Tobago</option>\n";
    print "                    <option value=\"TN\">Tunisia</option>\n";
    print "                    <option value=\"TR\">Turkey</option>\n";
    print "                    <option value=\"TM\">Turkmenistan</option>\n";
    print "                    <option value=\"TC\">Turks and Caicos Islands</option>\n";
    print "                    <option value=\"TV\">Tuvalu</option>\n";
    print "                    <option value=\"UG\">Uganda</option>\n";
    print "                    <option value=\"UA\">Ukraine</option>\n";
    print "                    <option value=\"AE\">United Arab Emirates</option>\n";
    print "                    <option value=\"GB\">United Kingdom</option>\n";
    print "                    <option value=\"US\">United States</option>\n";
    print "                    <option value=\"UM\">United States Minor Outlying Islands</option>\n";
    print "                    <option value=\"UY\">Uruguay</option>\n";
    print "                    <option value=\"UZ\">Uzbekistan</option>\n";
    print "                    <option value=\"VU\">Vanuatu</option>\n";
    print "                    <option value=\"VE\">Venezuela, Bolivarian Republic of</option>\n";
    print "                    <option value=\"VN\">Viet Nam</option>\n";
    print "                    <option value=\"VG\">Virgin Islands, British</option>\n";
    print "                    <option value=\"VI\">Virgin Islands, U.S.</option>\n";
    print "                    <option value=\"WF\">Wallis and Futuna</option>\n";
    print "                    <option value=\"EH\">Western Sahara</option>\n";
    print "                    <option value=\"YE\">Yemen</option>\n";
    print "                    <option value=\"ZM\">Zambia</option>\n";
    print "                    <option value=\"ZW\">Zimbabwe</option>\n";
    print "                </select>\n";
    print "            </div>\n";
    print "        </div>\n";
    print "\n";
   
   
    print "\n";
    print "\n";
    print "        <div class=\"col-md-4\">\n";
    print "            <div class=\"form-group label-floating\">\n";
    print "                <label class=\"control-label\">T-Shirt Size</label>\n";
    print "                <p>$athleteShirtsize</p>\n";
    print "            </div>\n";
    print "        </div>\n";
    print "        <div class=\"col-md-4\">\n";
    print "            <div class=\"form-group label-floating\">\n";
    print "                <label class=\"control-label\">Personal Best</label>\n";
    print "                <p>$athleteBestScore</p>\n";
    print "            </div>\n";
    print "        </div>\n";
    print "    </div>\n";
    print "\n";
    print "\n";
    print "\n";
    print "    <div class=\"row\">\n";
    print "        <br>\n";
    print "        <div class=\"col-lg-12\" align=\"center\">\n";
    print "\n";
    print "            <div class=\"col-lg-12 fileinput fileinput-new text-center\" data-provides=\"fileinput\" disabled>\n";
    print "                <div class=\"fileinput-new thumbnail\">\n";
    print "                    <img src=\"$athleteActionpictureSrc\" alt=\"...\">\n";
    print "                </div>\n";
    print "                <div class=\"fileinput-preview fileinput-exists thumbnail\"></div>\n";
    print "                <div>\n";
    
    print "\n";
    print "            </div>\n";
    print "        </div>\n";
    print "    </div>\n";
    print "</div>";



    Database::disconnect();
}
?>

