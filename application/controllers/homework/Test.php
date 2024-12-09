<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$data = $this->alam->selectA('homework','*');
        
		foreach($data as $key =>$val){
			$id = $val['id'];
			$array = array($val['img']);
			$updData = array(
				'img' => serialize($array)
			);
			
			$this->alam->update('homework',$updData,"id='$id' AND img <> ''");
		}
		redirect('homework/Test/fetch');
	}
	
	public function fetch(){
		$data = $this->alam->selectA('homework','*');
		foreach($data as $key => $val){
			$name = unserialize($val['img']);
			foreach($name as $key1 => $val1){
				echo $val1 ."<br />";
			}
		}
	}
}
