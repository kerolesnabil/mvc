<?php
namespace PHPMVC\Models;

class ProductCategoryModel extends AbstractModel
{
    public $cat_id;
    public $cat_name;
    public $cat_image;

    public  static $tableName ='app_products_categories';
    protected static $tableSchema= array(

           'cat_name'            => self::DATA_TYPE_STR,
           'cat_image'           => self::DATA_TYPE_STR,
    );
    protected static $primaryKey='cat_id';

}