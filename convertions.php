 <?php
	function cb2s($flag){
		if ($flag === FALSE){ 
			return "FALSE";
		}
		if ($flag === TRUE){ 
			return "TRUE";
		}
		return "UNKNOWN";
	}
?>