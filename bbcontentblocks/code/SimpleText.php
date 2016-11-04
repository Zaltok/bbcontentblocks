<?php

/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 13.10.2016
 * Time: 15:22
 */
class SimpleText extends ContentBlock
{
    public static $db = array(
        "Title" => "Varchar(255)",
        "TitleType" => "Enum('h1,h2,h3,h4,h5,h6')",
        "Content" => "HTMLText"
    );
    
    public function Show() {
        $arrayData = new ArrayData(array("Title" => $this->getField("Title"), "TitleType" => $this->getField("TitleType"), "Content" => $this->getField("Content")));
        return $arrayData->renderWith("SimpleText");
    }

    

}