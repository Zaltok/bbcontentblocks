<?php


class SimpleText extends ContentBlock
{
    public static $db = array(
        "Title" => "Varchar(255)",
        "TitleType" => "Enum('h1,h2,h3,h4,h5,h6')",
        "Alignment" => "Enum('left,center,right')",
        "Content" => "HTMLText"
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
                singleton('SimpleText')->dbObject('TitleType')->enumValues()
            ));
            $fields->add(new DropdownField(
                'Alignment',
                _t("ContentBlock.Alignment", "Align"),
                singleton('SimpleText')->dbObject('Alignment')->enumValues()
            ));
            $fields->add(new HtmlEditorField("Content", _t("ContentBlock.Content", "Content")));
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
                "Title" => "<".$this->getField("TitleType").">".$this->getField("Title")."</".$this->getField("TitleType").">",
                "Alignment" => $this->getField("Alignment"),
                "Content" => $this->getField("Content")
            )
        );
        return $arrayData->renderWith("SimpleText");
    }
    /**
     * Add a custom validator
     *
     * @access public
     * @return RequiredFields
     */
    public function getCMSValidator() {
        return new RequiredFields('Title', 'Content');
    }

}