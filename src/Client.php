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

namespace projectivemotion\xgbs_soap;

class Client
{
    const wsdl  =   'http://test.xgbs.net/PublicWSDL/Base/v2.0/Basic.wsdl';
    const wsdl_hotelavail   =   'http://test.xgbs.net/PublicWSDL/Hotel/v2.0/HotelAvailability.wsdl';

    protected $session  =   '';

    protected $client   =   NULL;

    public function createClient($wsd)
    {
        return new \SoapClient($wsd);
    }

    public function call($method, $args)
    {
        $client =   $this->client;

        try {
            $f_args =   func_get_args();

            array_shift($f_args);

            $response = call_user_func_array(array($client, $method), $f_args);

        }catch(\SoapFault $f)
        {
            print_r($f);
            exit;
        }
        return $response;
    }

    public function Login($distributionChannelID, $lang, $userName, $userPassword)
    {
        $Request    =   [
            'UserName' => $userName,
            'UserPassword' => $userPassword,
            'DistributionChannelID' => $distributionChannelID,
            "Language" => $lang
            ];
        $session    =   $this->wsd(self::wsdl)->call('Login', $Request);

        $this->setSession($session);

        return true;
    }

    public function getAvailableHotels(HotelSearch $search)
    {
        $response   =   $this->wsd(self::wsdl_hotelavail)
                        ->call('getAvailableHotels', $this->session, $search->getArray());

        return $response;
    }

    public function setSession($session)
    {
        $this->session = $session;
    }

    public function wsd($wsd)
    {
        $this->client   =   $this->createClient($wsd);

        return $this;
    }
}