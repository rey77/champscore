<?php

namespace AjaxLiveSearch\core;

if (count(get_included_files()) === 1) {
    exit('Direct access not permitted.');
}

/**
 * Class Config
 */
class Config
{
    /**
     * @var array
     */
    private static $configs = [
        // ***** Database ***** //
        'dataSources'           => [
            'ls_query1' => [
                'host'               => 'localhost',
                'database'           => 'champscore_net',
                'username'           => 'root',
                'pass'               => '',
                'table'              => 'tbl_athlete',
                // specify the name of search columns
                'searchColumns'      => ['athlete_firstname'],
                // specify order by column. This is optional
                'orderBy'            => '',
                // specify order direction e.g. ASC or DESC. This is optional
                'orderDirection'     => '',
                /**
                 * filter the result by entering table column names
                 * to get all the columns, remove filterResult or make it an empty array
                 */
                'filterResult'       => ['athlete_firstname','athlete_lastname', 'athlete_email'],
                /**
                 * specify search query comparison operator.
                 * possible values for comparison operators are: 'LIKE' and '='. this is required
                 */
                'comparisonOperator' => 'LIKE',
                /**
                 * searchPattern is used to specify how the query is searched.
                 * possible values are: 'q', '*q', 'q*', '*q*'. this is required
                 */
                'searchPattern'      => 'q*',
                // specify search query case sensitivity
                'caseSensitive'      => false,
                // to limit the maximum number of result uncomment this:
                'maxResult' => 5,
                // to display column header, change 'active' value to true
                'displayHeader' => [
                    'active' => true,
                    'mapper' => [
                        'athlete_firstname' => 'First Name',
                        'athlete_lastname' => 'Last Name',
                        'athlete_email' => 'Email',
//                        'your_second_column' => 'Your Desired Second Title'
                    ]
                ],
                'type'               => 'mysql',
            ],
            
            'ls_query2' => [
                'host'               => 'localhost',
                'database'           => 'champscore_net',
                'username'           => 'root',
                'pass'               => '',
                'table'              => 'tbl_athlete',
                // specify the name of search columns
                'searchColumns'      => ['athlete_firstname'],
                // specify order by column. This is optional
                'orderBy'            => '',
                // specify order direction e.g. ASC or DESC. This is optional
                'orderDirection'     => '',
                /**
                 * filter the result by entering table column names
                 * to get all the columns, remove filterResult or make it an empty array
                 */
                'filterResult'       => ['athlete_firstname','athlete_lastname', 'athlete_email'],
                /**
                 * specify search query comparison operator.
                 * possible values for comparison operators are: 'LIKE' and '='. this is required
                 */
                'comparisonOperator' => 'LIKE',
                /**
                 * searchPattern is used to specify how the query is searched.
                 * possible values are: 'q', '*q', 'q*', '*q*'. this is required
                 */
                'searchPattern'      => 'q*',
                // specify search query case sensitivity
                'caseSensitive'      => false,
                // to limit the maximum number of result uncomment this:
                'maxResult' => 5,
                // to display column header, change 'active' value to true
                'displayHeader' => [
                    'active' => true,
                    'mapper' => [
                        'athlete_firstname' => 'First Name',
                        'athlete_lastname' => 'Last Name',
                        'athlete_email' => 'Email',
//                        'your_second_column' => 'Your Desired Second Title'
                    ]
                ],
                'type'               => 'mysql',
            ],
            
            'ls_query3' => [
                'host'               => 'localhost',
                'database'           => 'champscore_net',
                'username'           => 'root',
                'pass'               => '',
                'table'              => 'tbl_athlete',
                // specify the name of search columns
                'searchColumns'      => ['athlete_firstname'],
                // specify order by column. This is optional
                'orderBy'            => '',
                // specify order direction e.g. ASC or DESC. This is optional
                'orderDirection'     => '',
                /**
                 * filter the result by entering table column names
                 * to get all the columns, remove filterResult or make it an empty array
                 */
                'filterResult'       => ['athlete_firstname','athlete_lastname', 'athlete_email'],
                /**
                 * specify search query comparison operator.
                 * possible values for comparison operators are: 'LIKE' and '='. this is required
                 */
                'comparisonOperator' => 'LIKE',
                /**
                 * searchPattern is used to specify how the query is searched.
                 * possible values are: 'q', '*q', 'q*', '*q*'. this is required
                 */
                'searchPattern'      => 'q*',
                // specify search query case sensitivity
                'caseSensitive'      => false,
                // to limit the maximum number of result uncomment this:
                'maxResult' => 5,
                // to display column header, change 'active' value to true
                'displayHeader' => [
                    'active' => true,
                    'mapper' => [
                        'athlete_firstname' => 'First Name',
                        'athlete_lastname' => 'Last Name',
                        'athlete_email' => 'Email',
//                        'your_second_column' => 'Your Desired Second Title'
                    ]
                ],
                'type'               => 'mysql',
            ],
            
            'ls_query4' => [
                'host'               => 'localhost',
                'database'           => 'champscore_net',
                'username'           => 'root',
                'pass'               => '',
                'table'              => 'tbl_athlete',
                // specify the name of search columns
                'searchColumns'      => ['athlete_firstname'],
                // specify order by column. This is optional
                'orderBy'            => '',
                // specify order direction e.g. ASC or DESC. This is optional
                'orderDirection'     => '',
                /**
                 * filter the result by entering table column names
                 * to get all the columns, remove filterResult or make it an empty array
                 */
                'filterResult'       => ['athlete_firstname','athlete_lastname', 'athlete_email'],
                /**
                 * specify search query comparison operator.
                 * possible values for comparison operators are: 'LIKE' and '='. this is required
                 */
                'comparisonOperator' => 'LIKE',
                /**
                 * searchPattern is used to specify how the query is searched.
                 * possible values are: 'q', '*q', 'q*', '*q*'. this is required
                 */
                'searchPattern'      => 'q*',
                // specify search query case sensitivity
                'caseSensitive'      => false,
                // to limit the maximum number of result uncomment this:
                'maxResult' => 5,
                // to display column header, change 'active' value to true
                'displayHeader' => [
                    'active' => true,
                    'mapper' => [
                        'athlete_firstname' => 'First Name',
                        'athlete_lastname' => 'Last Name',
                        'athlete_email' => 'Email',
//                        'your_second_column' => 'Your Desired Second Title'
                    ]
                ],
                'type'               => 'mysql',
            ],
            
            'ls_query_2' => [
                'host'               => 'localhost',
                'database'           => 'champscore_net',
                'username'           => 'root',
                'pass'               => '',
                'table'              => 'tbl_athlete',
                'searchColumns'      => ['athlete_firstname'],
                'orderBy'            => '',
                'orderDirection'     => '',
                'filterResult'       => [],
                'comparisonOperator' => 'LIKE',
                'searchPattern'      => 'q*',
                'caseSensitive'      => false,
                'displayHeader' => [
                    'active' => false,
                    'mapper' => []
                ],
                'type'               => 'mysql',
            ],
            'mainMongo' => [
                'server'       => 'your_server',
                'database'     => 'local',
                'collection'   => 'your_collection',
                'filterResult' => [],
                'searchField'  => 'your_collection_search_field',
                'type'         => 'mongo',
            ]
        ],
        // ***** Form ***** //
        'antiBot'               => "ajaxlivesearch_guard",
        // Assigning more than 3 seconds is not recommended
        'searchStartTimeOffset' => 2,
        // ***** Search Input ***** //
        'maxInputLength'        => 20,
        // ***** Template ***** //
        'template' => 'default.php',
    ];

    /**
     *
     * @param  $key
     * @throws \Exception
     * @return mixed
     */
    public static function getConfig($key)
    {
        if (!array_key_exists($key, static::$configs)) {
            throw new \Exception("Key: {$key} does not exist in the configs");
        }

        return static::$configs[$key];
    }
}
