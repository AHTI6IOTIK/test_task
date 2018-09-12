<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<? if ($arResult['CORRECT'] === 'Y'): ?>

    <?$APPLICATION->IncludeComponent(
        "custom:form.user.file",
        "",
        Array(
            "FILE" => "jpg, pdf",
            "IBLOCK_ID" => $arParams['IBLOCK_ID'],
            "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE']
        )
    );?>

<? elseif ($arResult['IS_AUTH_USER']): ?>

<?$APPLICATION->IncludeComponent(
    "custom:form.user.profile",
    "",
    Array(
        'NAME' => $arResult['USER_FIELDS']['NAME'],
        'PERSONAL_BIRTHDATE' => $arResult['USER_FIELDS']['PERSONAL_BIRTHDATE'],
        'PERSONAL_PHONE' => $arResult['USER_FIELDS']['PERSONAL_PHONE'],
    )
);?>

<? else: ?>
    <h1>Нужно авторизоваться</h1>
<? endif; ?>