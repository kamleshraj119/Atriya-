<?php
class DBHelper {

	function DBHelper() {

	}
    
    function getDataFromQuery($mysqli, $query) {
        $data = array();
        //echo $query;
        $result = $mysqli -> query($query);
        while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
            array_push($data, $row);
        }
        return $data;
    }
    
    function performFromQuery($mysqli, $query) {
        $result='';
        if($mysqli -> query($query)=== TRUE){
            $result = "Success";
        }else{
            $result = mysqli_error($mysqli);
        }
        return $result;
    }

	// select
	function getData($mysqli, $storedProcedure, array $params) {
		$data = array();
		$query = $this -> prepare($storedProcedure, $params);
		//echo $query;
        $result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
		}
		$this -> clearStoredResults($mysqli);
		return $data;
	}

	//insert,update,delete
	function performOperation($mysqli, $storedProcedure, array $params) {
		$query = $this -> prepare($storedProcedure, $params);
        //echo $query;
		$result='';
		if($mysqli -> query($query)=== TRUE){
			$result = "Success";
		}else{
			$result = mysqli_error($mysqli);
		}
		$this -> clearStoredResults($mysqli);
		return $result;
		
	}
    
    function multiquery($mysqli, $storedProcedure, array $params,$select,array $outPrams) {
        $query = $this -> prepareMultiQuery($storedProcedure, $params,$outPrams);
        $data=array();
        $result='';
        if($mysqli -> query($query)=== TRUE){
            $result = "Success";
            $resultSelect=$mysqli -> query($select);
            while ($row = $resultSelect -> fetch_array(MYSQLI_ASSOC)) {
                $data[]=$result;
                for($i=0;$i<count($outPrams);$i++)
                    $data[]= $row[$outPrams[$i]];
            }
           $this -> clearStoredResults($mysqli);
        }else{
            $result = mysqli_error($mysqli);
            $data[]=$result;
        }
        return $data;
    }

	function prepare($storedProcedure, array $params) {
		$count = count($params);
		$query = "";
		if($count==0)
		$query = "CALL " . $storedProcedure . "()";	
		else{
			$query = "CALL " . $storedProcedure . "(";
			for ($i = 0; $i < $count; $i++) {
				$query = $query . "'" . $params[$i] . "'";
				if ($i == $count - 1) {
					$query = $query . ")";
				} else {
					$query = $query . ",";
				}
			}	
		}
		return $query;
	}
    
    function prepareMultiQuery($storedProcedure, array $params,array $outParams) {
        $count = count($params);
        $query = "";
        if($count==0)
        $query = "CALL " . $storedProcedure . "()"; 
        else{
            $query = "CALL " . $storedProcedure . "(";
            for ($i = 0; $i < $count; $i++) {
                $query = $query . "'" . $params[$i] . "'";
                if ($i == $count - 1) {
                    for($j=0;$j<count($outParams);$j++){
                        if($j==0)
                            $count>0 ? $query = $query ."," : $query ;
                        if ($j == count($outParams) - 1) {
                             $query = $query .$outParams[$j];
                        }else $query = $query .$outParams[$j].",";
                    }
                    $query = $query . ")";
                } else {
                    $query = $query . ",";
                }
            }   
        }
        return $query;
    }

	function clearStoredResults($mysqli) {
		do {
			if ($res = $mysqli -> store_result()) {
				$res -> free();
			}
		} while ($mysqli->more_results() && $mysqli->next_result());

	}

}
?>