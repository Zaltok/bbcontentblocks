<?php

class FormBlock extends ContentBlock
{

    public static $db = array(
        "Title" => "Varchar(255)",
        "TitleType" => "Enum('h1,h2,h3,h4,h5,h6')",
        "Alignment" => "Enum('left,center,right')",
        "SideBarTitle" => "Varchar(255)",
        "SideBarContent" => "HTMLText"
    );
    public static $has_one = array(
        "ParentForm" => "UserDefinedForm"
    );

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
            $field = DropdownField::create('ParentFormID', 'Formular', UserDefinedForm::get()->map('ID', 'Title'))
                ->setEmptyString('(Bitte auswählen)');
            $fields->add($field);
            $fields->add(new TextField("SideBarTitle", _t("FormBlock.SideBarTitle", "SideBarTitle")));
            $fields->add(new HtmlEditorField("SideBarContent", _t("FormBlock.SidebarContent", "SideBarContent")));
        }
        else {
            $fields = parent::getCMSFields();
        }
        return $fields;
    }
    public function Show()
    {
        $form = UserDefinedForm::get_by_id("UserDefinedForm",$this->ParentFormID);
        $controller = new UserDefinedForm_Controller($form);
        $formular = $controller->Form();
        $arrayData = new ArrayData(
            array(
                "Title" => "<".$this->getField("TitleType")." class=\"section-title\">".$this->getField("Title")."</".$this->getField("TitleType").">",
                "Alignment" => $this->getField("Alignment"),
                "Form" => "<div id='contact_form'>".$formular->forTemplate()."</div>",
                "SideBarTitle" => $this->getField("SideBarTitle"),
                "SideBarContent" => $this->getField("SideBarContent")
            )
        );
        return $arrayData->renderWith("FormBlock");
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