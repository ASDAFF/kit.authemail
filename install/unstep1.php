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
		"extension_authemail" => '/bitrix/modules/extension.authemail/install/index.php',
	)
);
$extension_model = new extension_authemail();

COption::RemoveOption($extension_model->MODULE_ID);

UnRegisterModuleDependences("main","OnPageStart",$extension_model->MODULE_ID,"extensionModelAuthEmailClass","auth");

UnRegisterModule($extension_model->MODULE_ID);

echo CAdminMessage::ShowNote(GetMessage("UNINSTALL_SUCCESS"));