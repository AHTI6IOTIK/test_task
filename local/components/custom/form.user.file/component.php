<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

\Bitrix\Main\Loader::includeModule('iblock');

if (!empty($_FILES['userfile'])) {

    if (preg_match('{application\/(.*)|image\/(.*)}', $_FILES['userfile']['type'], $match)) {

        $el = new CIBlockElement;
        $arFields = Array(
            "MODIFIED_BY"    => $USER->GetID(),
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID"      => 3,
            "PROPERTY_VALUES" => array(
                "USER_ID" => $USER->getID(),
                "FILE_USER" => $_FILES['userfile'],
            ),
            "NAME"           => date("d.m.Y H:i:s").' '.$USER->GetFirstName(),
            "ACTIVE"         => "Y",            // активен
        );

        if($file_id = $el->Add($arFields, false, false, true))
            echo "New ID: ".$file_id;
        else
            echo "Error: ".$el->LAST_ERROR;
    }
}

$this->includeComponentTemplate();
?>