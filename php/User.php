<?php
namespace Fbreuer\Cms;

use ActiveRecord\Model as ActiveRecord;

class User extends ActiveRecord
{
    public function userLogin($PostUsername, $PostPassword)
    {
        $options = array("username" => $PostUsername, "password" => $PostPassword);
        $User = User::find('all', $options);
        if(!empty($User)){
            $_SESSION['UserID'] = $User[0]->userid;
            return true;
        }else{
            return false;
        }
    }

    public function getUserData($UserUid)
    {
        $options = array("UserID" => $UserUid);
        $User = User::find('all', $options);
        return $User[0];
    }
}