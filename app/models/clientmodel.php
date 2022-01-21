<?php
namespace PHPMVC\Models;

class ClientModel extends AbstractModel
{
    public $cat_client_id;
    public $cat_name;
    public $cat_phoneNumber;
    public $cat_email;
    public $cat_address;


    public  static $tableName ='app_clients';
    protected static $tableSchema= array(

           'cat_name'                  => self::DATA_TYPE_STR,
           'cat_phoneNumber'           => self::DATA_TYPE_STR,
           'cat_email'                 => self::DATA_TYPE_STR,
           'cat_address'               => self::DATA_TYPE_STR,

    );
    protected static $primaryKey='cat_client_id';

}