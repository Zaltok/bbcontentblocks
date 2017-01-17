<?php

/**
 * Created by PhpStorm.
 * User: bbuessenschuett
 * Date: 11.11.2016
 * Time: 16:14
 */
class HeadlineBlock extends ContentBlock
{
    public static $db = array(
        "Title" => "Varchar(255)",
        "TitleType" => "Enum('h1,h2,h3,h4,h5,h6')",
        "Alignment" => "Enum('left,center,right')"
    );
    protected function onBeforeWrite() {
        if (strlen($this->BackendTitle) === 0) {
            $this->BackendTitle = $this->Title;
        }
        parent::onBeforeWrite();
    }
    public function getCMSFields()
    {
        if(Director::isLive()) {
            $fields = FieldList::create();
            $fields->add(new TextField("BackendTitle", _t("ContentBlock.BackendTitle", "Backend Title")));
            $fields->add(new TextField("Title", _t("ContentBlock.Title", "Title")));
            $fields->add(new DropdownField(
                'TitleType',
                _t("ContentBlock.TitleType", "Title Type"),
                singleton('HeadlineBlock')->dbObject('TitleType')->enumValues()
            ));
            $fields->add(new DropdownField(
                'Alignment',
                _t("ContentBlock.Alignment", "Align"),
                singleton('HeadlineBlock')->dbObject('Alignment')->enumValues()
            ));
        }
        else {
            $fields = parent::getCMSFields();
        }
        return $fields;
    }
    public function Show()
    {
        $arrayData = new ArrayData(
            array(
                "Title" => "<".$this->getField("TitleType")." class=\"section-title\">".$this->getField("Title")."</".$this->getField("TitleType").">",
                "Alignment" => $this->getField("Alignment")
            )
        );
        return $arrayData->renderWith("HeadlineBlock");
    }
    /**
     * Add a custom validator
     *
     * @access public
     * @return RequiredFields
     */
    public function getCMSValidator() {
        return new RequiredFields('Title');
    }
}