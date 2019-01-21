<?php


return [
    'PAGINATION_LIMIT_NUMBER' => 10,
    'PAGINATION_LIMIT_TAG' => 16,
    'PAGINATION_LIMIT_USER' => 16,
    'PAGINATION_LIMIT_TREDINGPOST' => 10,
    'PAGINATION_LIMIT_OWN_TAG' => 30,
    'MAX_FILE_UPLOAD_SIZE' => 20971520,
    'TOTAL_VIEW_HOT' => 100,
    'LIMIT_WORD' => 400,
    'UNVOTED' => 'unvoted',
    'UNFOLLOWED' => 'unfollowed',
    'NUMBER_FOLLOW_USER' => 1,
    'NUMBER_FOLLOW_TAG' => 2,
    'MAX_TAG' => 6,
    'MIN_TAG' => 2,
    'RANDOM_NUMBER_NAME' => 10,
    'NOTIFICATIONS_LIMIT' => 5,
    'IMAGE_UPLOAD_PATH' => 'uploads/images/user/',
    'DEFAULT_USER_IMAGE' => 'image-default-',
    'DEFAULT_USER_FULLNAME' => 'Your Fullname',
    'DEFAULT_USER_GENDER' => '1',
    'DEFAULT_USER_ROLE_ID' => '2',
    'DEFAULT_USER_STATUS' => '1',
    'PNG' => '.png',
    'DRIVER_PATH' => '/uploads/driver/',
    'GENDER' => [
        '1' => 'male',
        '2' => 'female',
    ],
    'ROLE' => [
        '1' => 'admin',
        '2' => 'category.user',
    ],
    'STATUS' => [
        '1' => 'active',
        '0' => 'deactive',
    ],
    'CHECKBOX' => [
        '1' => true,
        '0' => false,
    ],
    'REPORT_MESSAGES' => [
        '0' => 'spam',
        '1' => 'rulesViolation',
        '2' => 'harashment',
        '3' => 'infringesCopyright',
        '4' => 'orther',
    ],
    'REPORT_DELETE_ADMIN' => [
        'true' => '',
        'false' => 'disabled',
    ],
    'USER_DETELE_ADMIN' => [
        '1' => 'disabled',
        '2' => '',
    ],
    'EXECUTE_PATH' => '/uploads/execute.php',
];
?>
