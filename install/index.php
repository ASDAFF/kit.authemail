<?php
/**
 * Copyright (c) 17/9/2020 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

IncludeModuleLangFile(__FILE__);

if(class_exists("extension_authemail")) return;

Class extension_authemail extends CModule
{
    var $MODULE_ID = "extension.authemail";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_GROUP_RIGHTS = "Y";

    function extension_authemail(){
        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path."/version.php");
        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)){
                $this->MODULE_VERSION = $arModuleVersion["VERSION"];
                $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        } else {
                $this->MODULE_VERSION = '1.0.0';
                $this->MODULE_VERSION_DATE = '2016-05-30 15:00:00';
        }
        $this->MODULE_NAME = GetMessage("EXTENSION_MODULE_NAME_AUTHEMAIL");
        $this->MODULE_DESCRIPTION = GetMessage("EXTENSION_MODULE_DESCRIPTION_AUTHEMAIL");
        $this->PARTNER_NAME = "ASDAFF";
        $this->PARTNER_URI = "https://asdaff.github.io/";
    }

    function DoInstall(){
        global $APPLICATION;
        if(!check_bitrix_sessid()) return;
        
        $APPLICATION->IncludeAdminFile(GetMessage("STEP1"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/step1.php");
    }

    function DoUninstall(){
        global $APPLICATION;
        if(!check_bitrix_sessid()) return;

        $APPLICATION->IncludeAdminFile(GetMessage("UNSTEP1"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/unstep1.php");
    }
}
?>