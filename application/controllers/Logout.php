<?php 
defined('BASEPATH') OR exit('No Direct script access');

class Logout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('pelajar');
	}
	public function index()
	{
		$this->pelajar->logout('welcome');
		
	}
}