<?php
// sql/config.example.php by Eduardo Bussien
//
// Copy this file to `sql/config.local.php` and edit the values to
// override the default database credentials used by sql/db.php.
// `config.local.php` is gitignored so your private credentials
// never reach the repository.

$GLOBALS['OLYMPUS_DB_HOST'] = '127.0.0.1';
$GLOBALS['OLYMPUS_DB_PORT'] = '3307';      // XAMPP default is 3306; this project uses 3307
$GLOBALS['OLYMPUS_DB_USER'] = 'root';
$GLOBALS['OLYMPUS_DB_PASS'] = '';
$GLOBALS['OLYMPUS_DB_NAME'] = 'olympus_db';
