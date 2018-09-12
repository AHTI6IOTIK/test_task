<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = [
    'PARAMETERS'=> [
        'NAME' => [
            'PARENT' => 'BASE',
            'NAME' => 'Имя',
            'TYPE' => 'STRING',
            'DEFAULT' => ''
        ],
        'PERSONAL_BIRTHDATE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Дата рождения',
            'TYPE' => 'STRING',
            'DEFAULT' => ''
        ],
        'PERSONAL_PHONE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Номер телефона',
            'TYPE' => 'STRING',
            'DEFAULT' => ''
        ],
        'back_url' => [
            'PARENT' => 'BASE',
            'NAME' => 'Путь редиректа',
            'TYPE' => 'STRING',
            'DEFAULT' => '/'
        ]

    ],
];
?>
