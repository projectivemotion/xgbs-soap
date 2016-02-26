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

if($argc < 5)
    die("$argv[0] distributionchannel language username password checkin checkout");

$client =   new projectivemotion\xgbs_soap\Client();

$response = $client->Login($argv[1], $argv[2], $argv[3], $argv[4]);

$search =   new \projectivemotion\xgbs_soap\HotelSearch();
$search->setCityCode(2191230);
$search->setCheckIn($argv[5]);
$search->setCheckOut($argv[6]);
$search->setSearchRoomParams();
$search->setRoomCount(1);
$search->setAdults(2);
$search->setChildren(0);
$search->setNumHotels(5);

$hotels =   $client->getAvailableHotels($search);
var_dump($hotels);