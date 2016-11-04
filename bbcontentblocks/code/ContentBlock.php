<?php

/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 13.10.2016
 * Time: 15:02
 */
class ContentBlock extends DataObject
{
    public static $db = array(
        "BackendTitle" => "Varchar(255)",
        "SortOrder" => "Int"

    );

    public static $has_one = array(
        "Page" => "Page"
    );
    
    public function Show(){
        $arrayData = new ArrayData(array());
        return $arrayData->renderWith("ContentBlock");
    }
}