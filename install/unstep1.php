<?php
/**
 * Copyright (c) 17/9/2020 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */
if(!check_bitrix_sessid()) return;
IncludeModuleLangFile(__FILE__);

CModule::IncludeModule("main");
CModule::AddAutoloadClasses(
	'',
	array(
		"kit_authemail" => '/bitrix/modules/kit.authemail/install/index.php',
	)
);
$kit_model = new kit_authemail();

COption::RemoveOption($kit_model->MODULE_ID);

UnRegisterModuleDependences("main","OnPageStart",$kit_model->MODULE_ID,"kitModelAuthEmailClass","auth");

UnRegisterModule($kit_model->MODULE_ID);

echo CAdminMessage::ShowNote(GetMessage("UNINSTALL_SUCCESS"));