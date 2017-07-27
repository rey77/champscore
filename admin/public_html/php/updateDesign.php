<?php

session_start();

$bodyBgColor = $_POST['bodyBgColor'];
$logoFrameColor = $_POST['logoFrameColor'];
$wodBtnBgColor = $_POST['wodBtnBgColor'];
$wodBtnFontColor = $_POST['wodBtnFontColor'];
$wodDescColor = $_POST['wodDescColor'];
$tableHeaderBgColor = $_POST['tableHeaderBgColor'];
$tableHeaderFontColor = $_POST['tableHeaderFontColor'];
$tableBodyBgColor = $_POST['tableBodyBgColor'];
$scoreColor = $_POST['scoreColor'];
$competitorColor = $_POST['competitorColor'];
$rankColor = $_POST['rankColor'];
$tableBorderColor = $_POST['tableBorderColor'];


$compID = $_POST['compID'];

include 'Database.php';
$pdo = Database::connect();


$sql = "select design_ID from tbl_design where fk_comp_ID = ?";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($compID));

$number_of_rows = $q->fetchColumn();

if ($number_of_rows > 0) {

    $sql = "UPDATE tbl_design SET "
            . "design_body_bg_color = ?,"
            . "design_logo_frame_color = ?,"
            . "design_wod_btn_bg_color = ?,"
            . "design_wod_btn_font_color = ?,"
            . "design_wod_desc_color = ?,"
            . "design_table_header_bg_color = ?,"
            . "design_table_header_font_color = ?,"
            . "design_table_body_bg_color = ?,"
            . "design_score_color = ?,"
            . "design_competitor_color = ?,"
            . "design_rank_color = ?,"
            . "design_table_border_color = ?"
            . " WHERE fk_comp_ID = ?";
} else {

    $sql = 'INSERT INTO tbl_design ( design_body_bg_color, design_logo_frame_color, design_wod_btn_bg_color,design_wod_btn_font_color,design_wod_desc_color
        ,design_table_header_bg_color,design_table_header_font_color,design_table_body_bg_color, design_score_color, design_competitor_color, design_rank_color
        ,design_table_border_color, fk_comp_ID ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)';
}

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($bodyBgColor, $logoFrameColor, $wodBtnBgColor, $wodBtnFontColor, $wodDescColor, $tableHeaderBgColor, $tableHeaderFontColor, $tableBodyBgColor, $scoreColor, $competitorColor, $rankColor, $tableBorderColor, $compID));

Database::disconnect();
header("Location:scoreboardCustomize.php?comp_id=$compID");
?>
   







