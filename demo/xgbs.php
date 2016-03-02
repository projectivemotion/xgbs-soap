<?php
/**
 *
 * @license    GPL3.0
 * @author     Amado Martinez
 * @copyright (c) 2016 Amado Martinez
 *
 */

/**
 * Project: XgbsSoapClient
 *
 * @author Amado Martinez <amado@projectivemotion.com>
 */

// copied this from doctrine's bin/doctrine.php
$autoload_files = array( __DIR__ . '/../vendor/autoload.php',
    __DIR__ . '/../../../autoload.php');

foreach($autoload_files as $autoload_file)
{
    if(!file_exists($autoload_file)) continue;
    require_once $autoload_file;
}
// end autoloader finder

if($argc < 6)
    die("$argv[0] distributionchannel language username password checkin checkout citycode");

$distributionChannel    =   $argv[1];
$language               =   $argv[2];
$username               =   $argv[3];
$password               =   $argv[4];
$checkin                =   $argv[5];
$checkout               =   $argv[6];
$citycode               =   $argv[7];

$client =   new projectivemotion\xgbs_soap\Client();

$response = $client->Login($distributionChannel, $language, $username, $password);

$search =   new \projectivemotion\xgbs_soap\HotelSearch();
$search->setCheckIn($checkin);
$search->setCheckOut($checkout);
$search->setCityCode($citycode);
$search->setSearchRoomParams();
$search->setRoomCount(1);
$search->setAdults(2);
$search->setChildren(0);
$search->setNumHotels(5);

$results =   $client->getAvailableHotels($search);

printf("Found %d hotels. Hotel 1: %s\n", $results->HotelsCount,
        $results->Hotels[0]->PropertyName);

