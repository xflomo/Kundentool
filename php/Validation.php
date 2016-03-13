<?php
namespace Fbreuer\Cms;


class Validation
{

    static function checkMail($mail){
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return true;
        }else{
            return false;
        }
    }

}