<?php

/**
 * Created by PhpStorm.
 * User: bbuessenschuett
 * Date: 02.11.2016
 * Time: 16:44
 */
class GeneralSiteConfig extends DataExtension
{
    private static $db = array(
        "ClassicModeEnable" => "Boolean"
    );
    private static $has_one = array(
        "Logo" => "Image"
    );
    public function updateCMSFields(FieldList $fields) {
        $fields->addFieldToTab("Root.Main",
            new UploadField("Logo", "Logo")
        );
        $fields->addFieldToTab("Root.Main", new CheckboxField("ClassicModeEnable", "ClassicModeEnable"));
    }
}