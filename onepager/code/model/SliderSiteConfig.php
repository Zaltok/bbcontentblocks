<?php

/**
 * Created by PhpStorm.
 * User: bbuessenschuett
 * Date: 02.11.2016
 * Time: 16:44
 */
class SliderSiteConfig extends DataExtension
{
    private static $db = array(
        "ShowThumbnails" => "Boolean"
    );

    public function updateCMSFields(FieldList $fields) {
        $fields->findOrMakeTab("Root.Slider", _t("SliderSiteConfig.SliderTab", "Slider"));
        $fields->addFieldToTab("Root.Slider",
            new CheckboxField("ShowThumbnails",_t("SliderSiteConfig.ShowThumbnails", "Show Thumbnails"))
        );
    }
}