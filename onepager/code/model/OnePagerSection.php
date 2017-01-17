<?php

/**
 * Created by PhpStorm.
 * User: bbuessenschuett
 * Date: 02.11.2016
 * Time: 14:44
 */
class OnePagerSection extends Page
{
    public static $db = array(
        'Icon' => 'Varchar(255)'
    );

    public static $has_one = array(
    );

    public function getCMSFields()
    {
        $iconPickerField = FontAwesomeField::create('Icon', 'Icon');
        $fields = parent::getCMSFields();
        $fields->insertAfter('MenuTitle',$iconPickerField);
        return $fields;
    }


}