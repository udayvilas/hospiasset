<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/*

|--------------------------------------------------------------------------

| Display Debug backtrace

|--------------------------------------------------------------------------

|

| If set to TRUE, a backtrace will be displayed along with php errors. If

| error_reporting is disabled, the backtrace will not display, regardless

| of this setting

|

*/

defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);



/* User defined */

defined('EXT') OR define('EXT', '.php');

defined('STARTED') OR define('STARTED', 'STARTED');

defined('SUCCESSDATA') OR define('SUCCESSDATA', 'success');

defined('FAILEDATA') OR define('FAILEDATA', 'failed');

defined('ERRORDATA') OR define('ERRORDATA', 'error');

defined('EMPTYDATA') OR define('EMPTYDATA', 'empty');

defined('EXPIREDATA') OR define('EXPIREDATA', 'expired');

defined('EXISTSDATA') OR define('EXISTSDATA', 'exists');

defined('ACTIVESTS') OR define('ACTIVESTS', 'A');

defined('INACTIVESTS') OR define('INACTIVESTS', 'I');

defined('YESSTATE') OR define('YESSTATE', 'YES');

defined('NOSTATE') OR define('NOSTATE', 'NO');

defined('HOSPITAL') OR define('HOSPITAL', 'Hospital');

defined('CLIENT') OR define('CLIENT', 'Client');

defined('VENDOR') OR define('VENDOR', 'VENDOR');

defined('DW') OR define('DW', 'Working');

defined('DNW') OR define('DNW', 'Not Working');

defined('REPAIRING') OR define('REPAIRING', 'Repairing');

defined('UMAINTENCE') OR define('UMAINTENCE', 'Under Maintenance');

defined('ALL') OR define('ALL', 'ALL');

defined('OTHER') OR define('OTHER', 'Other');

defined('UNKNOWN') OR define('UNKNOWN', 'unknown');

defined('QR_URL') OR define('QR_URL', 'http://chart.apis.google.com/chart?chs=400x400&cht=qr&chl=');

defined('FIRE_BASE_URL') OR define('FIRE_BASE_URL','https://fcm.googleapis.com/fcm/send');

//defined('GOOGLE_FB_KEY') OR define('GOOGLE_FB_KEY', 'AIzaSyBwdolM_naSj0FDO0aytmNrAeO3WZEdCfk');

defined('GOOGLE_FB_KEY') OR define('GOOGLE_FB_KEY', 'AIzaSyAhS5bPZzQqa3hE7jIUuqFuPOBGiYWMe00');

defined('HA_ADMIN') OR define('HA_ADMIN', 'HA_ADMIN');

defined('HA') OR define('HA', 'HA');

defined('CB') OR define('CB', 'CB');

defined('ORG') OR define('ORG', 'ORG');
defined('ORGALL') OR define('ORGALL','ORGALL');

defined('HBADMIN') OR define('HBADMIN', 'HBADMIN');

defined('HBHOD') OR define('HBHOD', 'HBHOD');

defined('HBBME') OR define('HBBME', 'HBBME');

defined('HMADMIN') OR define('HMADMIN', 'HMADMIN');

defined('PURCHASE') OR define('PURCHASE', 'PURCHASE');

defined('HBUSER') OR define('HBUSER', 'HBUSER');

defined('PENDING') OR define('PENDING', 'Pending');

defined('COMPLETED') OR define('COMPLETED', 'Completed');

defined('APPROVED') OR define('APPROVED', 'Approved');

defined('CANCELLED') OR define('CANCELLED', 'Cancelled');

defined('TEMPORARY') OR define('TEMPORARY', 'temporary');

defined('PERMANENT') OR define('PERMANENT', 'permanent');

defined('RENTAL') OR define('RENTAL', 'RENTAL');

defined('NEWEQ') OR define('NEWEQ', 'New');

defined('EXSITSEQ') OR define('EXSITSEQ', 'Exsits');

defined('DEVICE_UPLOAD_PATH') OR define('DEVICE_UPLOAD_PATH', 'assets/devices_docs/');

defined('QC_UPLOAD_PATH') OR define('QC_UPLOAD_PATH', 'assets/qc_docs/');

defined('PMS_UPLOAD_PATH') OR define('PMS_UPLOAD_PATH', 'assets/pms_docs/');

defined('ROUNDS_UPLOAD_PATH') OR define('ROUNDS_UPLOAD_PATH','assets/rounds_docs/');

defined('INDENT_UPLOAD_PATH') OR define('INDENT_UPLOAD_PATH', 'assets/indent_docs/');

defined('ASSETS_UPLOAD_PATH') OR define('ASSETS_UPLOAD_PATH', 'assets/asset_sheets');

defined ('BASE_URL') OR define('BASE_URL', "http://missionhospiasset.com/hospiasset/");

defined('ICON_PATH') OR define('ICON_PATH',BASE_URL.'assets/images/');

defined('MINUTES') OR define('MINUTES', 'Minutes');

defined('HOURS') OR define('HOURS', 'Hours');

defined('DAYS') OR define('DAYS', 'Days');

defined('DFFPASS') OR define('DFFPASS', 'asset123');

defined('OPEN') OR define('OPEN', 'O');

defined('CLOSE') OR define('CLOSE', 'C');

defined('FCLOSE') OR define('FCLOSE', 'F');

defined('WARRANTY') OR define('WARRANTY', 'Warranty');

defined('ACCESS') OR define('ACCESS', 'Accessories');

defined('SPARES') OR define('SPARES', 'Spares');

defined('EQPMNT') OR define('EQPMNT', 'Equipment');

defined('ACT') OR define('ACT', 'ACT');

defined('CUSTOM_LOGO') OR define('CUSTOM_LOGO', 'assets/images/hospiasset_logo_final.png');





/*

|--------------------------------------------------------------------------

| File and Directory Modes

|--------------------------------------------------------------------------

|

| These prefs are used when checking and setting modes when working

| with the file system.  The defaults are fine on servers with proper

| security, but you may wish (or even need) to change the values in

| certain environments (Apache running a separate process for each

| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should

| always be used to set the mode correctly.

|

*/

defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);

defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);

defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);

defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);



/*

|--------------------------------------------------------------------------

| File Stream Modes

|--------------------------------------------------------------------------

|

| These modes are used when working with fopen()/popen()

|

*/

defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');

defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');

defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care

defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care

defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');

defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');

defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');

defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');



/*

|--------------------------------------------------------------------------

| Exit Status Codes

|--------------------------------------------------------------------------

|

| Used to indicate the conditions under which the script is exit()ing.

| While there is no universal standard for error codes, there are some

| broad conventions.  Three such conventions are mentioned below, for

| those who wish to make use of them.  The CodeIgniter defaults were

| chosen for the least overlap with these conventions, while still

| leaving room for others to be defined in future versions and user

| applications.

|

| The three main conventions used for determining exit status codes

| are as follows:

|

|    Standard C/C++ Library (stdlibc):

|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html

|       (This link also contains other GNU-specific conventions)

|    BSD sysexits.h:

|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits

|    Bash scripting:

|       http://tldp.org/LDP/abs/html/exitcodes.html

|

*/

defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors

defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error

defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error

defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found

defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class

defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member

defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input

defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error

defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code

defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

