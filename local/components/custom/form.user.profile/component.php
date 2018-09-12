<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult = [
    'USER_FIELDS' => [

        'NAME' => $arParams['NAME'],
        'PERSONAL_BIRTHDATE' => $arParams['PERSONAL_BIRTHDATE'],
        'PERSONAL_PHONE' => $arParams['PERSONAL_PHONE']
    ],

    'DIC' => [
        'NAME' => GetMessage('NAME'),
        'PERSONAL_BIRTHDATE' => GetMessage('PERSONAL_BIRTHDATE'),
        'PERSONAL_PHONE' => GetMessage('PERSONAL_PHONE')
    ]
];

if (!empty($_REQUEST['USERS_FIELDS'])) {

    $user_update_field = [];

    foreach ($_REQUEST['USERS_FIELDS'] as $key => $value) {

        $$key = htmlspecialchars(trim((string)$value));
        $user_update_field[$key] = $$key ;
    }

    if (!$USER->Update($USER->GetID(), $user_update_field)) {

        $arResult['ERROR_UPDATE'] .= $USER->LAST_ERROR;
    } else {
        LocalRedirect($arParams['back_url']);
    }
}
$this->includeComponentTemplate();
?>