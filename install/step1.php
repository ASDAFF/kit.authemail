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

RegisterModuleDependences("main", "OnPageStart", $extension_model->MODULE_ID, "extensionModelAuthEmailClass", "auth");

RegisterModule($extension_model->MODULE_ID);

echo CAdminMessage::ShowNote(GetMessage("INSTALL_SUCCESS"));

echo BeginNote();
	echo GetMessage("INSTALL_LAST_MSG");
EndNote();