<?php

$env="dev";

$DB;
    switch ($env) {

        case 'dev':
            $DB['HOST']='localhost';
            $DB['USER']='root';
            $DB['PASS']='';
            $DB['DB']='un_supply_final';
            $DB['PORT']='3306';

            error_reporting(0);
            break;

        case 'prod':
            $DB['HOST']='localhost';
            $DB['USER']='unsupply1';
            $DB['PASS']='3Tzc52d&';
            $DB['DB']='bf-unsuppliers_org_db';
            $DB['PORT']='3306';

            error_reporting(1); // Turn off all error reporting
            break;
    }
?>