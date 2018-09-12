<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arUserData = [];
$arResult= [
    'CORRECT' => 'N',
    'IS_AUTH_USER' => $USER->IsAuthorized()
];

$requiredUserData = [
    'NAME',
    'PERSONAL_BIRTHDATE',
    'PERSONAL_PHONE'
];

$error = 0;

$by = 'ID';
$order='desc';
$arFilter = [
    '=ID' => $USER->GetID(),
];

$resUser = $USER->GetList($by,$order, $arFilter);

while ($arUser = $resUser->Fetch()) {

    for($i = 0, $count = count($requiredUserData); $i < $count; $i++) {

        if (empty($arUser[$requiredUserData[$i]])) {

            $error++;
        }

        $arUserData[$requiredUserData[$i]] = $arUser[$requiredUserData[$i]];
    }
}

$arResult['CORRECT'] =  $error === 0 ? 'Y' : 'N';
$arResult['USER_FIELDS'] =  $arUserData;

$this->includeComponentTemplate();
?>