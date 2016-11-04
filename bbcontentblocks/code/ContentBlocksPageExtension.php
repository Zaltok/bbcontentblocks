<?php

/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 13.10.2016
 * Time: 15:00
 */
class ContentBlocksPageExtension extends DataExtension
{
    public static $db = array(
        "ClassicMode" => "boolean"
    );

    public static $has_many = array(
        "ContentBlocks" => "ContentBlock"
    );

    public function updateCMSFields(FieldList $fields) {
        $fields->addFieldToTab("Root.Main", new CheckboxField('ClassicMode'));
        if($this->owner->ClassicMode != true) {
            $config = GridFieldConfig_RelationEditor::create();
            // Set the names and data for our gridfield columns
            $config->getComponentByType('GridFieldDataColumns')->setDisplayFields(array(
                'Title' => 'Title'
            ));
            // Create a gridfield to hold the Content Blocks
            $contentBlocks = new GridField(
                'ContentBlocks', // Field name
                'ContentBlocks', // Field title
                $this->owner->ContentBlocks(), // List of all related students
                $config
            );
            $contentBlockMultiClassBtn = new GridFieldAddNewMultiClass();
            $classes = $contentBlockMultiClassBtn->getClasses($contentBlocks);
            unset($classes["ContentBlock"]);
            $contentBlockMultiClassBtn->setClasses($classes);
            $contentBlocks->getConfig()
                ->removeComponentsByType('GridFieldAddNewButton')
                ->addComponent($contentBlockMultiClassBtn);
            // Create a tab named "Students" and add our field to it
            $fields->addFieldToTab('Root.ContentBlocks', $contentBlocks);
            $fields->removeByName("Content");
        }
    }
}