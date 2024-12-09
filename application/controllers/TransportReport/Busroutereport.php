<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Busroutereport extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function bus_route_report(){
		$data['stoppage'] = $this->dbcon->GetStoppageMaster();
		$this->render_template('Transportreport/busroutereport',$data);
	}
	public function load_data(){
		$vehicleno = $this->input->post('vehicleno');
		$trip = $this->input->post('trip');
		$prefrence = $this->input->post('prefrence');
		if(!empty($vehicleno)){
			$vehicleno = $vehicleno;
		}else{
			$vehicleno = "%";
		}
		if(!empty($trip)){
			$trip = $trip;
		}else{
			$trip = "%";
		}
		if(!empty($prefrence)){
			$prefrence = $prefrence;
		}else{
			$prefrence = "%";
		}
		$data['busroute']=$this->dbcon->StoppageRouteMaster($vehicleno,$trip,$prefrence);
		$this->load->view('Transportreport/busRoutedetails',$data);
		// echo "<pre>";
		// print_r($data);
		// exit;
	}
	public function gettripid()
	{
		$vehicleno = $this->input->post('vehicleno');
		$data = $this->dbcon->GetTrip_BusRouteReport($vehicleno);
		echo json_encode($data);
	}
	public function getpreference()
	{
		$vehicleno = $this->input->post('vehicleno');
		$trip_id   = $this->input->post('trip');
		
		$prefid = $this->dbcon->select('bus_route_master','*',"BusCode='$vehicleno' AND Trip_ID='$trip_id' GROUP BY Prefer_ID");
		?>
			<option value=''>Select</option>
		<?php
		foreach($prefid as $key=>$value){
			?>
				<option value='<?php echo $value->Prefer_ID; ?>'><?php if($value->Prefer_ID == 1){ echo "Boys";}elseif($value->Prefer_ID == 2){echo "Girls";}elseif($value->Prefer_ID == 3){echo "Co.Ed";} ?></option>
			<?php
		}
	}
}