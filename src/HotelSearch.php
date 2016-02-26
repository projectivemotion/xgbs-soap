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


class HotelSearch
{
    protected $Adults;
    protected $AllowRequest;
    protected $Board;
    protected $CheckIn;
    protected $CheckOut;
    protected $Children;
    protected $ChildrenAges;
    protected $CityCode;
    protected $FromHotel;
    protected $FromPrice;
    protected $GetBoardTypes;
    protected $HotelName;
    protected $IncludeCancellationTerms;
    protected $NumHotels;
    protected $OffersOnly;
    protected $OverrideMarkup;
    protected $ResultType;
    protected $RoomCount;
    protected $SearchRoomParams;
    protected $SortBy;
    protected $strCurrency;
    protected $ToPrice;
    protected $ZoneCode;

    public function setHotelName($HotelName)
    {
        $this->HotelName = $HotelName;
    }

    public function setCityCode($CityCode)
    {
        $this->CityCode = $CityCode;
    }

    public function setZoneCode($ZoneCode)
    {
        $this->ZoneCode = $ZoneCode;
    }

    public function setCheckIn($CheckIn)
    {        
        $this->CheckIn = Util::ParamToDate($CheckIn);
    }

    public function setCheckOut($CheckOut)
    {
        $this->CheckOut = Util::ParamToDate($CheckOut);
    }

    public function setBoard($Board)
    {
        $this->Board = $Board;
    }

    public function setIncludeCancellationTerms($IncludeCancellationTerms)
    {
        $this->IncludeCancellationTerms = $IncludeCancellationTerms;
    }

    public function setSearchRoomParams($roomCount = 1, $numAdults = 2, $numChildren = 0, $childrenAges = 0)
    {
        $this->SearchRoomParams = array(array(
            'RoomCount' =>  $roomCount,
            'Adults'    =>  $numAdults,
            'Children'  =>  $numChildren,
            'ChildrenAges'  =>  $childrenAges
        ));
    }
    /** set search params */

    public function setRoomCount($RoomCount)
    {
        $this->RoomCount = $RoomCount;
    }

    public function setAdults($Adults)
    {
        $this->Adults = $Adults;
    }

    public function setChildren($Children)
    {
        $this->Children = $Children;
    }

    public function setChildrenAges($ChildrenAges)
    {
        $this->ChildrenAges = $ChildrenAges;
    }

    public function setOverrideMarkup($OverrideMarkup)
    {
        $this->OverrideMarkup = $OverrideMarkup;
    }

    public function setFromPrice($FromPrice)
    {
        $this->FromPrice = $FromPrice;
    }

    public function setToPrice($ToPrice)
    {
        $this->ToPrice = $ToPrice;
    }

    public function setNumHotels($NumHotels)
    {
        $this->NumHotels = $NumHotels;
    }

    public function setFromHotel($FromHotel)
    {
        $this->FromHotel = $FromHotel;
    }

    public function setStrCurrency($strCurrency)
    {
        $this->strCurrency = $strCurrency;
    }

    public function setSortBy($SortBy)
    {
        $this->SortBy = $SortBy;
    }

    public function setAllowRequest($AllowRequest)
    {
        $this->AllowRequest = $AllowRequest;
    }

    public function setResultType($ResultType)
    {
        $this->ResultType = $ResultType;
    }

    public function setOffersOnly($OffersOnly)
    {
        $this->OffersOnly = $OffersOnly;
    }

    public function getArray()
    {
        return array_filter(get_object_vars($this));
    }
}