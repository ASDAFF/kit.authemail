<?php
/**
 * @author dev2fun (darkfriend)
 * @copyright (c) 2020, darkfriend
 * @version 1.0.4
 */

if (class_exists('dev2funModelAuthEmailClass')) return;

class dev2funModelAuthEmailClass
{
    function auth()
    {
        \CModule::IncludeModule("main");

        $keys = \Bitrix\Main\Config\Option::get('dev2fun.authemail', 'keys');
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