<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
    return;

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock=array();
$rsIBlock = CIBlock::GetList(Array("SORT" => "ASC"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));

while ($arr=$rsIBlock->Fetch()) {

    $arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}

$arComponentParameters = [
    'PARAMETERS'=> [
        "IBLOCK_TYPE" => [
            "PARENT" => "BASE",
            "NAME" => 'Тип инфоблока',
            "TYPE" => "LIST",
            "VALUES" => $arIBlockType,
            "REFRESH" => "Y"
        ],
        "IBLOCK_ID" => [
            "PARENT" => "BASE",
            "NAME" => 'Инфоблок',
            "TYPE" => "LIST",
            "VALUES" => $arIBlock,
            "REFRESH" => "Y",
            "ADDITIONAL_VALUES" => "Y",
        ],
        'FILE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Тип загружаемых файлов',
            'TYPE' => 'STRING',
            'DEFAULT' => 'png, gif, jpg, jpeg'
        ],
        'ONLY_AUTH_USER' => [
            'PARENT' => 'BASE',
            'NAME' => 'Только авторизованным ?',
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'Y'
        ]

    ],
];
?>
