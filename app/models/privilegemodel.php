<?php
namespace PHPMVC\Models;

class privilegeModel extends AbstractModel
{
    public $privilege_id;
    public $privilege;
    public $privilege_title;


    public  static $tableName ='app_users_privileges';
    protected static $tableSchema= array(
           'privilege_id'              => self::DATA_TYPE_INT,
           'privilege'                 => self::DATA_TYPE_STR,
           'privilege_title'           => self::DATA_TYPE_STR
    );
    protected static $primaryKey='privilege_id';


}