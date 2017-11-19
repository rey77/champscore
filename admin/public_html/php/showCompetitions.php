<?php
/**
 * Created by PhpStorm.
 * User: waleed
 * Date: 15.11.17
 * Time: 10:39
 *

/**
 * @return array
 */
function getCompetitionsFromDB() {
    $pdo = Database::connect();
    $sql = "select comp_ID, comp_reg_active, comp_name, comp_start_date, comp_logo, comp_city, comp_country, comp_end_date from tbl_competition";
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);
    $q->execute(array());
    return $q->fetchAll();
}

/**
 * @param array $competitions
 * @return array
 */
function addCompToPast(array $competitions) {
    $past = [];
    foreach ($competitions as $competition) {
        $startDate = $competition['comp_start_date'];
        $endDate = $competition['comp_end_date'];
        $currentDate = date('Y-m-d');
        if ($startDate < $currentDate && $endDate < $currentDate) {
            array_push($past, $competition);
        }
    }
    Database::disconnect();
    return $past;
}

/**
 * @param array $competitions
 * @return array
 */
function addCompToNow(array $competitions) {
    $now = [];
    foreach ($competitions as $competition) {
        $startDate = $competition['comp_start_date'];
        $endDate = $competition['comp_end_date'];
        $currentDate = date('Y-m-d');
        if (($startDate === $currentDate && $endDate >= $currentDate) || (($startDate <= $currentDate && $endDate >= $currentDate))) {
            array_push($now, $competition);
        }
    }
    Database::disconnect();
    return $now;
}

/**
 * @param array $competitions
 * @return array
 */
function addCompToFuture(array $competitions) {
    $future = [];
    foreach ($competitions as $competition) {
        $startDate = $competition['comp_start_date'];
        $endDate = $competition['comp_end_date'];
        $currentDate = date('Y-m-d');
        if ($startDate > $currentDate && $endDate > $currentDate) {
            array_push($future, $competition);
        }
    }
    Database::disconnect();
    return $future;
}

/**
 * @param array $competitions
 */
function showCompetitionsInIndex(array $competitions) {
    if(!empty($competitions)) {
        foreach ($competitions as $comp) {
            $compID = $comp['comp_ID'];
            $compLogo = $comp['comp_logo'];
            $compRegActive = $comp['comp_reg_active'];
            if ($compLogo != 0) {
                $logosrc = "php/uploads/host/complogo/$compLogo";
            } else {
                $logosrc = "http://placehold.it/400x250/000/fff";
            }
            $originalDate = $comp['comp_start_date'];
            $newDate = date("d.m.Y", strtotime($originalDate));
            echo '<div class="row">';
                echo '<br><br>';
                echo '<div class="col-lg-10 col-lg-offset-2 col-md-12  col-md-offset-1 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0">';
                    echo '<div class="media col-lg-6 col-md-6 col-sm-8 col-xs-12">';
                        echo '<a class="pull-left" href="php/competitionView.php?comp_id='.$compID.'">';
                            echo '<div class="avatar">';
                                echo '<img class="media-object"  src="'.$logosrc.'">';
                            echo '</div>';
                        echo '</a>';
                        echo '<div class="media-body">';
                            echo '<a class="pull-left" href="php/competitionView.php?comp_id='.$compID.'">';
                                echo '<h4 class="media-heading" >'.$comp['comp_name'].'</h4>';
                            echo '</a>';
                            echo '<br><br>';
                            echo '<p>';
                                echo $newDate . " in " . $comp['comp_city'] . ", " . $comp['comp_country'];
                            echo '</p>';
                            echo '<a class="pull-left" href="php/ScoreboardView_2.php?comp_id='.$compID.'">';
                                echo '<b>VIEW LEADERBOARD</b>';
                            echo '</a>';
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="col-lg-3 col-md-3 col-sm-2 col-xs-12">';
                        if ($compRegActive != 0) {
                            echo '<a href="php/registrationView_1.php?comp_id='.$compID.'" class="btn btn-pinterest btn-single btn-sm ">Join!</a>';
                        }
                        else {
                            echo '<a class="btn btn-pinterest btn-single btn-sm " disabled>Registration closed!</a>';
                        }
                    echo '</div>';
                    echo '<div class="col-lg-3 col-md-2 col-sm-3 col-xs-12">';
                        echo '<p>Preis</p>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<hr>';
        }
    } else {
        echo '<h2 class="no-competitions">No Competitions</h2>';
    }
}

/**
 * @param array $competitions
 */
function showCompetitionsInAthleteAndHostSite(array $competitions) {
    if(!empty($competitions)) {
        foreach ($competitions as $comp) {
            $compID = $comp['comp_ID'];
            $compLogo = $comp['comp_logo'];
            if ($compLogo != 0) {
                $logosrc = "uploads/host/complogo/$compLogo";
            } else {
                $logosrc = "http://placehold.it/400x250/000/fff";
            }
            $originalDate = $comp['comp_start_date'];
            $newDate = date("d.m.Y", strtotime($originalDate));

            echo '<div class="col-md-4">';
                echo '<div class="card card-testimonial">';
                    echo '<div class="icon"></div>';
                    echo '<div class="footer">';
                        echo '<a  href="./competitionView.php?comp_id='.$compID.'">';
                            echo '<h4 class="card-title"><b>'.$comp['comp_name'].'</b></h4>';
                        echo '</a>';
                        echo '<p>'.$newDate.' in '.$comp['comp_city'].', '.$comp['comp_country'].'</p>';
                        echo '<div class="card-avatar">';
                            echo '<a href="./competitionView.php?comp_id='.$compID.'">';
                                echo '<img class="img" src="'.$logosrc.'">';
                            echo '</a>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<h2 class="no-competitions">No Competitions</h2>';
    }
}