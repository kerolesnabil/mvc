<?php
namespace PHPMVC\Models;

class UserModel extends AbstractModel
{
    public $user_id;
    public $user_name;
    public $password;
    public $email ;
    public $phone_number;
    public $subscription_date;
    public $last_login;
    public $group_id;
    public $status;
    /**
     * @var UserProfileModel
     */
    public $profile;
    public $privileges;


    public  static $tableName ='app_users';
    protected static $tableSchema= array(

           'user_id'            => self::DATA_TYPE_INT,
           'user_name'          => self::DATA_TYPE_STR,
           'password'           => self::DATA_TYPE_STR,
           'email'              => self::DATA_TYPE_STR,
           'phone_number'       => self::DATA_TYPE_STR,
           'subscription_date'  => self::DATA_TYPE_DATE,
           'last_login'         => self::DATA_TYPE_STR,
           'group_id'           => self::DATA_TYPE_INT,
           'status'             => self::DATA_TYPE_INT,
    );
    protected static $primaryKey='user_id';
    public function cryptPassword($password)
    {

        $this->password = crypt($password ,APP_SALT);
    }
    //TODO:: FIX THE TABLE ALIASING
    public static function getUsers(UserModel $user)
    {
        return self::get(
            'select au.* , aug.group_name as group_name From ' . self::$tableName .
            ' au INNER JOIN app_users_groups aug ON aug.group_id =au.group_id WHERE au.user_id !=' .$user->user_id
        );
    }

    public static function userExists($username)
    {
        return self::get('
            SELECT * FROM ' . self::$tableName . ' WHERE user_name = "' . $username . '"
        ');
    }

    public static function authenticate($username ,$password, $session)
    {

       $password = crypt($password ,APP_SALT);
        $sql = 'SELECT *,
        (SELECT group_name FROM app_users_groups WHERE app_users_groups.group_id ='.self::$tableName.'.group_id) 
             as group_name FROM '.self::$tableName.' WHERE user_name= "'.$username.'" AND password="'.$password.'"';


        $foundUser =self::getOne($sql);
        if(false !== $foundUser){
            if($foundUser->status==2)
            {
                return 2;
            }
            $foundUser->last_login = date('y-m-d H:i:s');
            $foundUser->save();
            $foundUser->profile =UserProfileModel::getByPK($foundUser->user_id);

            $foundUser->privileges = UserGroupPrivilegeModel::getPrivilegesForGroup($foundUser->group_id);

            $session->u = $foundUser;

            return 1;
        }
        return false;
    }


}