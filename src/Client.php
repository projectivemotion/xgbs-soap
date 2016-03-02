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
    private $wsdl  =   [
            'test'  =>  [
                'basic' => 'http://test.xgbs.net/PublicWSDL/Base/v2.0/Basic.wsdl',
                'hotelavailability' =>  'http://test.xgbs.net/PublicWSDL/Hotel/v2.0/HotelAvailability.wsdl'
            ],
            'production' => [
                'basic' =>  'http://www.xgbs.net/PublicWSDL/Base/v2.0/Basic.wsdl',
                'hotelavailability' =>  'http://www.xgbs.net/PublicWSDL/Hotel/v2.0/HotelAvailability.wsdl'
            ]
        ];

    protected $session  =   '';

    protected $client   =   NULL;

    /**
     * Return a wsdl url
     *
     * @param $wsdl
     * @param string $mode test|production
     */
    public function getWsdlUrl($wsdl, $mode    =   'production')
    {
        return $this->wsdl[$mode][$wsdl];
    }

    public function createClient($wsdlurl)
    {
        return new \SoapClient($wsdlurl);
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
        $session    =   $this->wsdl('basic')->call('Login', $Request);

        $this->setSession($session);

        return true;
    }

    public function getAvailableHotels(HotelSearch $search)
    {
        $response   =   $this->wsdl('hotelavailability')
                        ->call('getAvailableHotels', $this->session, $search->getArray());

        return $response;
    }

    public function setSession($session)
    {
        $this->session = $session;
    }

    public function wsdl($wsd, $mode = 'production')
    {
        $url    =   $this->getWsdlUrl($wsd, $mode);
        $this->client   =   $this->createClient($url);

        return $this;
    }
}