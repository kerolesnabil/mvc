<?php
namespace PHPMVC\Models;

class UserGroupModel extends AbstractModel
{
    public $group_id;
    public $group_name;


    public  static $tableName ='app_users_groups';
    protected static $tableSchema= array(
           'group_id'           => self::DATA_TYPE_INT,
           'group_name'         => self::DATA_TYPE_STR,
    );
    protected static $primaryKey='group_id';

}