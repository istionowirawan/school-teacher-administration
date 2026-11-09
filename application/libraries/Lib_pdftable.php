<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lib_pdftable
{
    public function __construct()
    {
		define('FPDF_FONTPATH',APPPATH.'third_party/pdftable/font/');
        require_once APPPATH.'third_party/pdftable/lib/pdftable.inc.php';
    }
}