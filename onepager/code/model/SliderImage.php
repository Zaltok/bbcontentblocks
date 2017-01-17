<?php

class SliderImage extends DataObject
{
    public static $db = array(
        "BackendTitle" => "Varchar(255)",
        "Title" => "Varchar(255)",
        "SortOrder" => "Int",
        "ShowTitleInSlide" => "Boolean"
    );

    public static $has_one = array(
        "Parent" => "Page",
        "Image" => "Image"
    );
    private static $default_sort = "SortOrder ASC";

    public function getCMSFields()
    {
        if(Director::isLive()) {
            $fields = FieldList::create();
            $fields->add(new TextField("BackendTitle", "Backend Title"));
            $fields->add(new TextField("Title", "Title"));
            $fields->add(new CheckboxField("ShowTitleInSlide", _t("SliderImage.ShowTitleInSlider", "Show Title in Slider Animation")));
            $fields->add(new UploadField("Image", "Image"));
        }
        else {
            $fields = parent::getCMSFields();
        }
        return $fields;
    }

    protected function onBeforeWrite() {
        if(strlen($this->BackendTitle) == 0) {

        }
        if (!$this->SortOrder) {
            $this->SortOrder = SliderImage::get()->max('SortOrder') + 1;
        }
        parent::onBeforeWrite();
    }
    /**
     * Add a custom validator
     *
     * @access public
     * @return RequiredFields
     */
    public function getCMSValidator() {
        return new RequiredFields('Image', 'Title');
    }
    public function getThumbnail() {
        if ($Image = $this->Image()->ID) {
            return $this->Image()->SetWidth(80);
        } else {
            return '(No Image)';
        }
    }
}