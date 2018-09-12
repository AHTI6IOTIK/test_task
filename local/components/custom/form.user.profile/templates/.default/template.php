<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<div>
    <p>Есть не заполненные поля профиля</p>
    <? if (!empty($arResult['ERROR_UPDATE'])):?>
        <div>
            <p>Ошибка обновления профиля</p>
            <p><?=$arResult['ERROR_UPDATE']?></p>
        </div>
    <? endif;?>
</div>

<form method="post" id="update_user_data">
    <?=bitrix_sessid_post()?>
    <? foreach ($arResult['USER_FIELDS'] as $key => $value): ?>
        <label for="<?=$key?>"><?= $arResult['DIC'][$key]?></label>
        <input type="text" id="<?=$key?>" name="USERS_FIELDS[<?=$key?>]" required value="<?= !empty($value)? $value : '' ?>"> <br>
    <? endforeach;?>
    <button>сохранить</button>
</form>
