<?php
/**
 * Created by PhpStorm.
 * User: waleed
 * Date: 19.04.17
 * Time: 11:43
 */

    // Datenbankverbindung
    include "loginsec/db.inc.php";

    $link = mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
    mysqli_select_db($link, $dbname) or die("Datenbank nicht gefunden!");

    $abfrage = "SELECT comp_name, comp_id FROM `tbl_competition`";
    $ergebnis = mysqli_query($link, $abfrage) or die("no competitions");

    $arr = [];

    while ($obj= mysqli_fetch_object($ergebnis)) {
        $row = array();

        $row['comp_name'] = $obj->comp_name;
        $row['comp_id'] = $obj->comp_id;
        $arr[] = $row;

    }
    mysqli_free_result($ergebnis);
    echo json_encode($arr);
