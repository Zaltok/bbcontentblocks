<?php

/**
 * Created by PhpStorm.
 * User: bbuessenschuett
 * Date: 01.11.2016
 * Time: 17:29
 */
class OnePager extends Page
{
    private static $allowed_children = array("OnePagerSection");
    private static $db = array(
        "ActiveImageSlider" => "Boolean"
    );

    public static $has_many = array(
        "Slider" => "SliderImage"
    );
    function getSettingsFields() {
        $fields = parent::getSettingsFields();
        $customizeSettings = new FieldGroup(
            new CheckboxField("ActiveImageSlider", _t("OnePager.ActiveImageSlider","Active Image Slider"))
        );
        $customizeSettings->setTitle(_t("OnePager.Customizing","Customizing"));
        $fields->addFieldToTab("Root.Settings", $customizeSettings);

        return $fields;
    }
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeFieldFromTab("Root.Main","ContentBlocksToggle");
        if($this->ActiveImageSlider) {
            $gridfield = new GridField("Slider", _t("SliderImage.PLURALNAME","Slider"), $this->Slider());
            $config = GridFieldConfig_RelationEditor::create();
            $dataColumns = $config->getComponentByType('GridFieldDataColumns');

            $dataColumns->setDisplayFields(array(
                'Title' => 'Title',
                'Thumbnail' => 'Thumbnail'
            ));
            $gridfield->setConfig($config);
            $gridfield->getConfig()->addComponent(new GridFieldOrderableRows('SortOrder'));
            $fields->findOrMakeTab("Root.Slider",_t("SliderImage.PLURALNAME","Slider"));
            $fields->addFieldToTab("Root.Slider", $gridfield);
        }
        return $fields;
    }


}