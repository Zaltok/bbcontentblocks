<?php

class ThreeColBlock extends ContentBlock
{

    public static $db = array(
        "Title" => "Varchar(255)",
        "TitleType" => "Enum('h1,h2,h3,h4,h5,h6')",
        "Alignment" => "Enum('left,center,right')",
        "TitleLeftBlock" => "Varchar(255)",
        "ContentLeftBlock" => "HTMLText",

        "TitleMiddleBlock" => "Varchar(255)",
        "ContentMiddleBlock" => "HTMLText",
        "IconLeft" => "Enum('facilitymanagement,immobilienverwaltung,einstellungen,hausmeister')",
        "IconMiddle" => "Enum('facilitymanagement,immobilienverwaltung,einstellungen,hausmeister')",
        "IconRight" => "Enum('facilitymanagement,immobilienverwaltung,einstellungen,hausmeister')",
        "TitleRightBlock" => "Varchar(255)",
        "ContentRightBlock" => "HTMLText"
    );



    protected function onBeforeWrite()
    {
        if (strlen($this->BackendTitle) === 0) {
            $this->BackendTitle = $this->Title;
        }
        parent::onBeforeWrite();
    }

    public function getCMSFields()
    {
        if (Director::isLive()) {
            $fields = FieldList::create();
            $fields->add(new HeaderField("General", _t("ThreeColBlock.SINGULARNAME", "3-Column Block")));
            $fields->add(new TextField("BackendTitle", _t("ContentBlock.BackendTitle", "Backend Title")));
            $fields->add(new TextField("Title", _t("ContentBlock.Title", "Title")));


            $fields->add(new DropdownField(
                'TitleType',
                _t("ContentBlock.TitleType", "Title Type"),
                singleton('ThreeColBlock')->dbObject('TitleType')->enumValues()
            ));
            $fields->add(new DropdownField(
                'Alignment',
                _t("ContentBlock.Alignment", "Align"),
                singleton('ThreeColBlock')->dbObject('Alignment')->enumValues()
            ));
            $fields->add(new HeaderField("LeftBlock", _t("ThreeColBlock.LeftBlock", "Left Block")));
//            $fields->add(UploadField::create('IconLeft', _t("ThreeColBlock.Icon", "Icon")));
            $fields->add(new TextField("TitleLeftBlock", _t("ContentBlock.Title", "Title")));
            $fields->add(new HtmlEditorField("ContentLeftBlock", _t("ContentBlock.Content", "Content")));
            $fields->add(new HeaderField("MiddleBlock", _t("ThreeColBlock.MiddleBlock", "Middle Block")));
//            $fields->add(UploadField::create('IconMiddle', _t("ThreeColBlock.Icon", "Icon")));
            $fields->add(new TextField("TitleMiddleBlock", _t("ContentBlock.Title", "Title")));
            $fields->add(new HtmlEditorField("ContentMiddleBlock", _t("ContentBlock.Content", "Content")));
            $fields->add(new HeaderField("RightBlock", _t("ThreeColBlock.RightBlock", "Right Block")));
//            $fields->add(UploadField::create('IconRight', _t("ThreeColBlock.Icon", "Icon")));
            $fields->add(new DropdownField(
                'IconRight',
                _t("ContentBlock.IconRight", "Icon Right"),
                singleton('ThreeColBlock')->dbObject('IconRight')->enumValues()
            ));
            $fields->add(new TextField("TitleRightBlock", _t("ContentBlock.Title", "Title")));
            $fields->add(new HtmlEditorField("ContentRightBlock", _t("ContentBlock.Content", "Content")));
            $fields->insertBefore("TitleMiddleBlock",new DropdownField(
                'IconMiddle',
                _t("ContentBlock.Icon", "Icon"),
                singleton('ThreeColBlock')->dbObject('IconMiddle')->enumValues()
            ));
            $fields->insertBefore("TitleLeftBlock",new DropdownField(
                'IconLeft',
                _t("ContentBlock.Icon", "Icon"),
                singleton('ThreeColBlock')->dbObject('IconLeft')->enumValues()
            ));

        } else {
            $fields = parent::getCMSFields();
        }
        return $fields;
    }

    public function Show()
    {
        $Title = "";
        if (strlen($this->getField("Title")) > 0) {
            $Title = "<" . $this->getField("TitleType") . ">" . $this->getField("Title") . "</" . $this->getField("TitleType") . ">";
        }

        $arrayData = new ArrayData(
            array(
                "Title" => $Title,
                "Alignment" => $this->getField("Alignment"),
                "LeftBlock" => array("Title" => $this->getField("TitleLeftBlock"), "Content" => $this->getField("ContentLeftBlock")),
                "MiddleBlock" => array("Title" => $this->getField("TitleMiddleBlock"), "Content" => $this->getField("ContentMiddleBlock")),
                "RightBlock" => array("Title" => $this->getField("TitleRightBlock"), "Content" => $this->getField("ContentRightBlock")),
                "IconRight" => $this->getField("IconRight"),
                "IconMiddle" => $this->getField("IconMiddle"),
                "IconLeft" => $this->getField("IconLeft"),

            )
        );
        return $arrayData->renderWith("ThreeColBlock");
    }

    /**
     * Add a custom validator
     *
     * @access public
     * @return RequiredFields
     */
    public function getCMSValidator()
    {
        return new RequiredFields('BackendTitle');
    }

}