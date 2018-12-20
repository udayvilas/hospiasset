<?php
defined('BASEPATH') OR exit('No direct Script access allowed');
require_once dirname(__FILE__).'/phpexcel/Classes/PHPExcel.php';
class Excel extends PHPExcel
{
    function __construct()
    {
        parent::__construct();
    }
}
?>