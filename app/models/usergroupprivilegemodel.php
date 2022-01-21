<?php
namespace PHPMVC\Models;

class UserGroupPrivilegeModel extends AbstractModel
{
    public 	$id;
    public 	$group_id;
    public $privilege_id;


    public  static $tableName ='app_users_groups_privileges';
    protected static $tableSchema= array(
           'group_id'                => self::DATA_TYPE_INT,
           'privilege_id'            => self::DATA_TYPE_INT,
    );
    protected static $primaryKey='id';

    public static function getGroupPrivilege(UserGroupModel $group)
    {
        $groupPrivileges            = self::getBy(['group_id'=> $group->group_id]);
        $extractedPrivilegesIds = [];
        if(false !==$groupPrivileges){
            foreach ($groupPrivileges as $privilege){
                $extractedPrivilegesIds[] =$privilege->privilege_id;
            }
        }
        return $extractedPrivilegesIds;
    }

    public static function getPrivilegesForGroup($group_id)
    {
        $sql  =' SELECT augp.* ,aup.privilege FROM '.self::$tableName .' as augp ';
        $sql .=' INNER JOIN app_users_privileges aup ON aup.privilege_id =  augp.privilege_id';
        $sql .=' WHERE augp.group_id ='.$group_id ;


        $privileges = self::get($sql);
        $extractedUrls =[];
        if(false !==$privileges){
            foreach ($privileges as $privilege){
                $extractedUrls[] =$privilege->privilege;
            }
        }
        return $extractedUrls;
    }

}