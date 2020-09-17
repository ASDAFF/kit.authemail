<?php
/**
 * Copyright (c) 17/9/2020 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

if (class_exists('extensionModelAuthEmailClass')) return;

class extensionModelAuthEmailClass
{
    function auth()
    {
        \CModule::IncludeModule("main");

        $keys = \Bitrix\Main\Config\Option::get('extension.authemail', 'keys');
        if ($keys) {
            $keys = unserialize($keys);
        }
        if(!is_array($keys)) {
            $keys = [];
        }
        $keys[] = 'USER_LOGIN';

        $requestKey = null;
        foreach ($keys as $key) {
            if (!filter_var($_REQUEST[$key], FILTER_VALIDATE_EMAIL)) {
                continue;
            }
            $requestKey = $key;
            break;
        }
        if(!$requestKey) return;

        $rsUser = \CUser::GetList(
            ($by = "id"),
            ($order = "asc"),
            [
                "=EMAIL" => \htmlspecialcharsbx($_REQUEST[$requestKey]),
            ]
        );
        if ($arU = $rsUser->GetNext()) {
            if ($_REQUEST[$requestKey] == $arU['EMAIL']) {
                $_POST[$requestKey] = $_REQUEST[$requestKey] = $arU['LOGIN'];
            }
        }
    }
}