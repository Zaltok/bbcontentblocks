<?php

/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 13.10.2016
 * Time: 16:18
 */
class TabBoxElement extends DataObject
{
    public static $db = array(

        "TabTitle" => "Varchar(255)",
        "Title" => "Varchar(255)",
        "Content" => "HTMLText"
    );
    public static $has_one = array(
        "TabBox" => "TabBox"
    );

}