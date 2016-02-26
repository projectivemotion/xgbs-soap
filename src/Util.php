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


class Util
{
    public static function ParamToDate($date)
    {
        if(is_string($date))
        {
            if(preg_match('#\d{2}-\d{2}-\d{4}#', $date))
                return $date;
            $stamp  =   strtotime($date);
        }
        elseif(is_integer($date))
            $stamp    =   $date;
        else
            throw new \Exception("Invalid timestamp.");
        
        return date('d-m-Y', $stamp);
    }
}