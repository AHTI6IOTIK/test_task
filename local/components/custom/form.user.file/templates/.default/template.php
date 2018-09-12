<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<form id="file_form" enctype="multipart/form-data"  method="post" action="/">

    <label for="file">загрузить файл:</label>
    <input name="userfile" id="file" type="file" >

    <input type="submit" value="Отправить" name="upsubmit" >
</form>
