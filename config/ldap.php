<?php

return [
    'server' => env('LDAP_SERVER', '10.1.1.2'),
    'user_domain' => env('LDAP_USER_DOMAIN', 'bsn.local\\'),
    'tree' => env('LDAP_TREE', 'DC=BSN,DC=local'),
];
