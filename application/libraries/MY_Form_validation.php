<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 * InvoicePlane
 *
 * @author		InvoicePlane Developers & Contributors
 * @copyright	Copyright (c) 2012 - 2018 InvoicePlane.com
 * @license		https://invoiceplane.com/license.txt
 * @link		https://invoiceplane.com
 */

#[AllowDynamicProperties]
class MY_Form_validation extends CI_Form_validation
{
    public $CI;

    public function is_unique($str, $field)
    {
        if (substr_count($field, '.') == 3) {
            [$table, $field, $id_field, $id_val] = explode('.', $field);
            $query = $this->CI->db->limit(1)->where($field, $str)->where($id_field.' != ', $id_val)->get($table);
        } else {
            [$table, $field] = explode('.', $field);
            $query = $this->CI->db->limit(1)->get_where($table, [$field => $str]);
        }

        return $query->num_rows() === 0;
    }

    public function run($config = null, &$data = null)
    {
        $module = '';
        (is_object($module)) and $this->CI = &$module;

        return parent::run($data);
    }
}
