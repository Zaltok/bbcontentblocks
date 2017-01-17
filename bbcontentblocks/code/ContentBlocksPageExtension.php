<?php

class ContentBlocksPageExtension extends DataExtension
{
    public static $db = array(
        "ClassicMode" => "boolean"
    );

    public static $has_many = array(
        "ContentBlocks" => "ContentBlock"
    );

    public function updateCMSFields(FieldList $fields) {
        if(SiteConfig::current_site_config()->ClassicModeEnable)
            $fields->addFieldToTab("Root.Main", new CheckboxField('ClassicMode'));
        if($this->owner->ClassicMode != true) {
            $config = GridFieldConfig_RelationEditor::create();
            // Set the names and data for our gridfield columns
            $config->getComponentByType('GridFieldDataColumns')->setDisplayFields(array(
                'BackendTitle' => 'BackendTitle',
            ));
            // Create a gridfield to hold the Content Blocks
            $contentBlocks = new GridField(
                'ContentBlocks', // Field name
                _t("ContentBlock.PLURALNAME", "Content Blocks"), // Field title
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
            $contentBlocks->getConfig()->getComponentByType("GridFieldAddExistingAutocompleter")->setSearchFields(array("BackendTitle"));
            $contentBlocks->getConfig()->removeComponentsByType("GridFieldAddExistingAutocompleter");
            $contentBlocks->getConfig()->addComponent(new GridFieldOrderableRows('SortOrder'));
            // Create a tab named "Students" and add our field to it
            //$fields->addFieldToTab('Root.Main', $contentBlocks, "Metadata");
            $fields->addFieldToTab('Root.Main', ToggleCompositeField::create('ContentBlocksToggle', _t('SiteTree.ContentBlocks', 'ContentBlocks'),
                array(
                    $contentBlocks
                )
            )->setHeadingLevel(4), "Metadata");

            $fields->removeByName("Content");
        }
    }
}