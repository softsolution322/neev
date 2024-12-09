<?php
class Custom_lib
{
	public function getApplicableFor()
	{
		return array(
			'1'	=> 'Vacational Staff',
			'2'	=> 'Non Vacational Staff',
			'3'	=> 'All',
		);
	}

	public function getGender()
	{
		return array(
			'1'	=> 'MALE',
			'2'	=> 'FEMALE',
			'3'	=> 'NOT ALLOWED',
		);
	}

	public function getEmployeeType()
	{
		return array(
			'1'	=> 'Vacational Staff',
			'2'	=> 'Non Vacational Staff',
		);
	}

	public function getStaffType()
	{
		return array(
			'1'	=> 'Teaching',
			'2'	=> 'Non Teaching',
		);
	}

	public function getTASlab()
	{
		return array(
			'1'	=> 'Slab 1',
			'2'	=> 'Slab 2',
			'3'	=> 'Slab 3',
		);
	}

	public function leaveType()
	{
		return array(
			'1'	=> 'CASUAL LEAVE',
			'2'	=> 'MEDICAL LEAVE',
			'3'	=> 'EARNED LEAVE'
		);
	}

	public function leaveRequestLiveType()
	{
		return array(
			'1'	=> 'CASUAL LEAVE',
			'2'	=> 'MEDICAL LEAVE',
			'3'	=> 'EARNED LEAVE',
			'4'	=> 'LEAVE WITHOUT PAY(LWP)',
			'5'	=> 'DEFFERED DAY LEAVE',
		);
	}

	public function shortLeaveRequestType()
	{
		return array(
			'1'	=> 'CL',
			'2'	=> 'ML',
			'3'	=> 'EL',
			'4'	=> 'LWP',
			'5'	=> 'DDL',
		);
	}

	public function getRelationType()
	{
		return array(
			'1'	=> 'Father',
			'2'	=> 'Mother',
			'3'	=> 'Spouse',
			'4'	=> 'Son',
			'5'	=> 'Daughter'
		);
	}

	public function getLeaveReason()
	{
		return array(
			'1'	=> 'OD',
			'2'	=> 'Hospital',
			'3'	=> 'Examination',
			'4'	=> 'Medical',
			'5'	=> 'Miscellaneous',
			'6'	=> 'Deferred Day Leave',
			'7'	=> 'Others'
		);
	}

	public function getEmpLevel()
	{
		return array(
			'1'	=> 'Basic',
			'2'	=> 'Senior',
			'3'	=> 'Selection',
		);
	}

	public function getTeacherType()
	{
		return array(
			'TGT'	=> 'TGT',
			'PGT'	=> 'PGT',
			'PRT'	=> 'PRT',
			'OTHER'	=> 'OTHER',
		);
	}

	public function getEmployeeSeparatedStatus()
	{
		return array(
			'1'		=> 'On Roll',
			'2'		=> 'Resigned',
			'3'		=> 'Death',
			'4'		=> 'End of contract period',
			'5'		=> 'Volunteer Retirement',
			'6'		=> 'Suspended',
		);
	}

	//time calculation

	function CalculateTime($time1, $time2) {
      $time1 = date('H:i:s',strtotime($time1));
      $time2 = date('H:i:s',strtotime($time2));
      $times = array($time1, $time2);
      $seconds = 0;
      foreach ($times as $time)
      {
        list($hour,$minute,$second) = explode(':', $time);
        $seconds += $hour*3600;
        $seconds += $minute*60;
        $seconds += $second;
      }
      $hours = floor($seconds/3600);
      $seconds -= $hours*3600;
      $minutes  = floor($seconds/60);
      $seconds -= $minutes*60;
      if($seconds < 9)
      {
      $seconds = "0".$seconds;
      }
      if($minutes < 9)
      {
      $minutes = "0".$minutes;
      }
        if($hours < 9)
      {
      $hours = "0".$hours;
      }
      return "{$hours}:{$minutes}:{$seconds}";
    }
}