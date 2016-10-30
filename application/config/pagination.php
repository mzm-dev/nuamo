<?php if(!defined('BASEPATH')) exit('Direct Access Not Allowed');

//which uri segment indicates pagination number
$config['uri_segment'] = 3;
$config['use_page_numbers'] = TRUE;
//max links on a page will be shown
$config['num_links'] = 5;

/* This Application Must Be Used With BootStrap 3 *  */
$config['full_tag_open'] = '<ul class="pagination">';
$config['full_tag_close'] = '</ul>';
$config['first_link'] = false;
$config['last_link'] = false;
$config['first_tag_open'] = '<li>';
$config['first_tag_close'] = '</li>';
$config['prev_link'] = '&laquo';
$config['prev_tag_open'] = '<li class="prev">';
$config['prev_tag_close'] = '</li>';
$config['next_link'] = '&raquo';
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '</li>';
$config['last_tag_open'] = '<li>';
$config['last_tag_close'] = '</li>';
$config['cur_tag_open'] = '<li class="active"><a href="#">';
$config['cur_tag_close'] = '</a></li>';
$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';

// end of file Pagination.php
// Location config/pagination.php