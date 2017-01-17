<?php

class ImageWithText extends ContentBlock
{
    public static $db = array(
        "Title" => "Varchar(255)",
        "TitleType" => "Enum('h1,h2,h3,h4,h5,h6')",
        "Alignment" => "Enum('left,center,right')",
        "ImageAlign" => "Enum('left,right')",
        "Content" => "HTMLText"

    );
    public static $has_one = array(
        "Image" => "Image"
    );
    protected function onBeforeWrite() {
        if (strlen($this->BackendTitle) === 0) {
            $this->BackendTitle = $this->Title;
        }
        parent::onBeforeWrite();
    }
    public function getCMSFields()
    {
        if (Director::isLive()) {
            $fields = FieldList::create();
            $fields->add(new TextField("BackendTitle", _t("ContentBlock.BackendTitle", "Backend Title")));
            $fields->add(new TextField("Title", _t("ContentBlock.Title", "Title")));

            $fields->add(new DropdownField(
                'TitleType',
                _t("ContentBlock.TitleType", "Title Type"),
                singleton('ImageWithText')->dbObject('TitleType')->enumValues()
            ));
            $fields->add(new DropdownField(
                'Alignment',
                _t("ContentBlock.Alignment", "Align"),
                singleton('ImageWithText')->dbObject('Alignment')->enumValues()
            ));
            $fields->add(new DropdownField(
                'ImageAlign',
                _t("ImageWithText.ImageAlign", "Image Align"),
                singleton('ImageWithText')->dbObject('ImageAlign')->enumValues()
            ));
            $fields->add(new HtmlEditorField("Content", _t("ImageWithText.Content", "Content")));
            $fields->add(new UploadField("Image", _t("ImageWithText.Image", "Image")));

        } else {
            $fields = parent::getCMSFields();
        }
        return $fields;
    }

    public function Show()
    {
        $image = Image::get_by_id('Image', $this->getField("ImageID"))->ScaleWidth(300);
        $arrayData = new ArrayData(
            array(
                "Title" => "<" . $this->getField("TitleType") . ">" . $this->getField("Title") . "</" . $this->getField("TitleType") . ">",
                "Content" => $this->getField("Content"),
                "Image" => $image,
                "ImageAlign" => $this->getField("ImageAlign")
            )
        );
        return $arrayData->renderWith("ImageWithText");
    }
    /**
     * Add a custom validator
     *
     * @access public
     * @return RequiredFields
     */
    public function getCMSValidator() {
        return new RequiredFields('Title', 'Image');
    }

}