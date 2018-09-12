<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новости банка");
?><?$APPLICATION->IncludeComponent(
	"custom:private.zone",
	".default",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"FILE" => "png,gif,jpg,jpeg",
		"IBLOCK_ID" => "3",
		"IBLOCK_TYPE" => "users_files",
		"NEED_AUTH" => "Y",
		"ONLY_AUTH_USER" => "Y",
		"SKILLS" => "",
		"SKILLS_PER" => ""
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>