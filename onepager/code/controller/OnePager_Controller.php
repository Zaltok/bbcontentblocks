<?php

/**
 * Created by PhpStorm.
 * User: bbuessenschuett
 * Date: 08.11.2016
 * Time: 14:58
 */
class OnePager_Controller extends Page_Controller
{
    public function init() {
        parent::init();
        Requirements::javascript('framework/thirdparty/jquery/jquery.js');
        Requirements::javascript($this->owner->ThemeDir() . '/javascript/vendor/jquery.form.js');
        Requirements::javascript($this->owner->ThemeDir() . '/javascript/vendor/UserDefinedForm.js');
    }
}