<?php


class ContentBlock extends DataObject
{
    public static $db = array(
        "BackendTitle" => "Varchar(255)",
        "SortOrder" => "Int"
    );

    public static $has_one = array(
        "Page" => "Page"
    );
    static $default_sort = "SortOrder ASC";

    public function Show(){
        $arrayData = new ArrayData(array());
        return $arrayData->renderWith("ContentBlock");
    }
    public function getCMSFields()
    {
        if(Director::isLive()) {
            $fields = FieldList::create();
            $fields->add(new TextField("BackendTitle", _t("ContentBlock.BackendTitle", "Backend Title")));
        }
        else {
            $fields = parent::getCMSFields();
        }
        return $fields;
    }
    protected function onBeforeWrite() {
        if (!$this->SortOrder) {
            $this->SortOrder = ContentBlock::get()->max('SortOrder') + 1;
        }
        parent::onBeforeWrite();
    }

    
}