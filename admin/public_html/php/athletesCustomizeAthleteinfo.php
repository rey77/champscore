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

    
    $newDate = date("d.m.Y", strtotime($athleteBirthdate));

    $countryList = array(
        'AF' => 'Afghanistan',
        'AX' => 'Aland Islands',
        'AL' => 'Albania',
        'DZ' => 'Algeria',
        'AS' => 'American Samoa',
        'AD' => 'Andorra',
        'AO' => 'Angola',
        'AI' => 'Anguilla',
        'AQ' => 'Antarctica',
        'AG' => 'Antigua and Barbuda',
        'AR' => 'Argentina',
        'AM' => 'Armenia',
        'AW' => 'Aruba',
        'AU' => 'Australia',
        'AT' => 'Austria',
        'AZ' => 'Azerbaijan',
        'BS' => 'Bahamas the',
        'BH' => 'Bahrain',
        'BD' => 'Bangladesh',
        'BB' => 'Barbados',
        'BY' => 'Belarus',
        'BE' => 'Belgium',
        'BZ' => 'Belize',
        'BJ' => 'Benin',
        'BM' => 'Bermuda',
        'BT' => 'Bhutan',
        'BO' => 'Bolivia',
        'BA' => 'Bosnia and Herzegovina',
        'BW' => 'Botswana',
        'BV' => 'Bouvet Island (Bouvetoya)',
        'BR' => 'Brazil',
        'IO' => 'British Indian Ocean Territory (Chagos Archipelago)',
        'VG' => 'British Virgin Islands',
        'BN' => 'Brunei Darussalam',
        'BG' => 'Bulgaria',
        'BF' => 'Burkina Faso',
        'BI' => 'Burundi',
        'KH' => 'Cambodia',
        'CM' => 'Cameroon',
        'CA' => 'Canada',
        'CV' => 'Cape Verde',
        'KY' => 'Cayman Islands',
        'CF' => 'Central African Republic',
        'TD' => 'Chad',
        'CL' => 'Chile',
        'CN' => 'China',
        'CX' => 'Christmas Island',
        'CC' => 'Cocos (Keeling) Islands',
        'CO' => 'Colombia',
        'KM' => 'Comoros the',
        'CD' => 'Congo',
        'CG' => 'Congo the',
        'CK' => 'Cook Islands',
        'CR' => 'Costa Rica',
        'CI' => 'Cote d\'Ivoire',
        'HR' => 'Croatia',
        'CU' => 'Cuba',
        'CY' => 'Cyprus',
        'CZ' => 'Czech Republic',
        'DK' => 'Denmark',
        'DJ' => 'Djibouti',
        'DM' => 'Dominica',
        'DO' => 'Dominican Republic',
        'EC' => 'Ecuador',
        'EG' => 'Egypt',
        'SV' => 'El Salvador',
        'GQ' => 'Equatorial Guinea',
        'ER' => 'Eritrea',
        'EE' => 'Estonia',
        'ET' => 'Ethiopia',
        'FO' => 'Faroe Islands',
        'FK' => 'Falkland Islands (Malvinas)',
        'FJ' => 'Fiji the Fiji Islands',
        'FI' => 'Finland',
        'FR' => 'France, French Republic',
        'GF' => 'French Guiana',
        'PF' => 'French Polynesia',
        'TF' => 'French Southern Territories',
        'GA' => 'Gabon',
        'GM' => 'Gambia the',
        'GE' => 'Georgia',
        'DE' => 'Germany',
        'GH' => 'Ghana',
        'GI' => 'Gibraltar',
        'GR' => 'Greece',
        'GL' => 'Greenland',
        'GD' => 'Grenada',
        'GP' => 'Guadeloupe',
        'GU' => 'Guam',
        'GT' => 'Guatemala',
        'GG' => 'Guernsey',
        'GN' => 'Guinea',
        'GW' => 'Guinea-Bissau',
        'GY' => 'Guyana',
        'HT' => 'Haiti',
        'HM' => 'Heard Island and McDonald Islands',
        'VA' => 'Holy See (Vatican City State)',
        'HN' => 'Honduras',
        'HK' => 'Hong Kong',
        'HU' => 'Hungary',
        'IS' => 'Iceland',
        'IN' => 'India',
        'ID' => 'Indonesia',
        'IR' => 'Iran',
        'IQ' => 'Iraq',
        'IE' => 'Ireland',
        'IM' => 'Isle of Man',
        'IL' => 'Israel',
        'IT' => 'Italy',
        'JM' => 'Jamaica',
        'JP' => 'Japan',
        'JE' => 'Jersey',
        'JO' => 'Jordan',
        'KZ' => 'Kazakhstan',
        'KE' => 'Kenya',
        'KI' => 'Kiribati',
        'KP' => 'Korea',
        'KR' => 'Korea',
        'KW' => 'Kuwait',
        'KG' => 'Kyrgyz Republic',
        'LA' => 'Lao',
        'LV' => 'Latvia',
        'LB' => 'Lebanon',
        'LS' => 'Lesotho',
        'LR' => 'Liberia',
        'LY' => 'Libyan Arab Jamahiriya',
        'LI' => 'Liechtenstein',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'MO' => 'Macao',
        'MK' => 'Macedonia',
        'MG' => 'Madagascar',
        'MW' => 'Malawi',
        'MY' => 'Malaysia',
        'MV' => 'Maldives',
        'ML' => 'Mali',
        'MT' => 'Malta',
        'MH' => 'Marshall Islands',
        'MQ' => 'Martinique',
        'MR' => 'Mauritania',
        'MU' => 'Mauritius',
        'YT' => 'Mayotte',
        'MX' => 'Mexico',
        'FM' => 'Micronesia',
        'MD' => 'Moldova',
        'MC' => 'Monaco',
        'MN' => 'Mongolia',
        'ME' => 'Montenegro',
        'MS' => 'Montserrat',
        'MA' => 'Morocco',
        'MZ' => 'Mozambique',
        'MM' => 'Myanmar',
        'NA' => 'Namibia',
        'NR' => 'Nauru',
        'NP' => 'Nepal',
        'AN' => 'Netherlands Antilles',
        'NL' => 'Netherlands the',
        'NC' => 'New Caledonia',
        'NZ' => 'New Zealand',
        'NI' => 'Nicaragua',
        'NE' => 'Niger',
        'NG' => 'Nigeria',
        'NU' => 'Niue',
        'NF' => 'Norfolk Island',
        'MP' => 'Northern Mariana Islands',
        'NO' => 'Norway',
        'OM' => 'Oman',
        'PK' => 'Pakistan',
        'PW' => 'Palau',
        'PS' => 'Palestinian Territory',
        'PA' => 'Panama',
        'PG' => 'Papua New Guinea',
        'PY' => 'Paraguay',
        'PE' => 'Peru',
        'PH' => 'Philippines',
        'PN' => 'Pitcairn Islands',
        'PL' => 'Poland',
        'PT' => 'Portugal, Portuguese Republic',
        'PR' => 'Puerto Rico',
        'QA' => 'Qatar',
        'RE' => 'Reunion',
        'RO' => 'Romania',
        'RU' => 'Russian Federation',
        'RW' => 'Rwanda',
        'BL' => 'Saint Barthelemy',
        'SH' => 'Saint Helena',
        'KN' => 'Saint Kitts and Nevis',
        'LC' => 'Saint Lucia',
        'MF' => 'Saint Martin',
        'PM' => 'Saint Pierre and Miquelon',
        'VC' => 'Saint Vincent and the Grenadines',
        'WS' => 'Samoa',
        'SM' => 'San Marino',
        'ST' => 'Sao Tome and Principe',
        'SA' => 'Saudi Arabia',
        'SN' => 'Senegal',
        'RS' => 'Serbia',
        'SC' => 'Seychelles',
        'SL' => 'Sierra Leone',
        'SG' => 'Singapore',
        'SK' => 'Slovakia (Slovak Republic)',
        'SI' => 'Slovenia',
        'SB' => 'Solomon Islands',
        'SO' => 'Somalia, Somali Republic',
        'ZA' => 'South Africa',
        'GS' => 'South Georgia and the South Sandwich Islands',
        'ES' => 'Spain',
        'LK' => 'Sri Lanka',
        'SD' => 'Sudan',
        'SR' => 'Suriname',
        'SJ' => 'Svalbard & Jan Mayen Islands',
        'SZ' => 'Swaziland',
        'SE' => 'Sweden',
        'CH' => 'Switzerland',
        'SY' => 'Syrian Arab Republic',
        'TW' => 'Taiwan',
        'TJ' => 'Tajikistan',
        'TZ' => 'Tanzania',
        'TH' => 'Thailand',
        'TL' => 'Timor-Leste',
        'TG' => 'Togo',
        'TK' => 'Tokelau',
        'TO' => 'Tonga',
        'TT' => 'Trinidad and Tobago',
        'TN' => 'Tunisia',
        'TR' => 'Turkey',
        'TM' => 'Turkmenistan',
        'TC' => 'Turks and Caicos Islands',
        'TV' => 'Tuvalu',
        'UG' => 'Uganda',
        'UA' => 'Ukraine',
        'AE' => 'United Arab Emirates',
        'GB' => 'United Kingdom',
        'US' => 'United States of America',
        'UM' => 'United States Minor Outlying Islands',
        'VI' => 'United States Virgin Islands',
        'UY' => 'Uruguay, Eastern Republic of',
        'UZ' => 'Uzbekistan',
        'VU' => 'Vanuatu',
        'VE' => 'Venezuela',
        'VN' => 'Vietnam',
        'WF' => 'Wallis and Futuna',
        'EH' => 'Western Sahara',
        'YE' => 'Yemen',
        'ZM' => 'Zambia',
        'ZW' => 'Zimbabwe'
    );



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
    print "                <p>$newDate</p>\n";
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
    print"<p>" . $countryList[$athleteCountry] . "</p>";
    print " </div>\n";
    print " </div>\n";
    print "\n";


    print "\n";
    print "\n";
    print " <div class = \"col-md-4\">\n";
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

