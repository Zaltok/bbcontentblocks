<?php

/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 13.10.2016
 * Time: 16:17
 */
class TabBox extends ContentBlock
{
    public static $has_many = array(
        "Tabs" => "TabBoxElement"
    );
    /*public function getCmsFields() {
        $config = GridFieldConfig_RelationEditor::create();
        // Set the names and data for our gridfield columns
        $config->getComponentByType('GridFieldDataColumns')->setDisplayFields(array(
            'Title' => 'Title'
        ));
        // Create a gridfield to hold the Content Blocks
        $tabs = new GridField(
            'TabBoxElement', // Field name
            'TabBoxElement', // Field title
            $this->getField("Tabs"), // List of all related students
            $config
        );

        $fields = FieldList::create(
            $tabs
        );
        return $fields;
    }*/
    public function Show() {
        $arrayData = new ArrayData(array("Tabs" => $this->Tabs()));
        return $arrayData->renderWith("TabBox");
    }
}