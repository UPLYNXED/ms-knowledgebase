<?php
/* - Connectivity Functions - */

	function database_connect() {
		$GLOBALS['database']['connection'] = mysqli_connect($GLOBALS['database']['ip'], $GLOBALS['database']['user'], $GLOBALS['database']['password'], $GLOBALS['database']['database']);
		if (mysqli_connect_errno($GLOBALS['database']['connection']))
		{
			return "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		else
		{
			return true;
		}
	}

	function database_disconnect() {
		@mysqli_close($GLOBALS['database']['connection']);
	}

/* - Misc Functions - */

	function SQL_rows_to_JSON($query) {
		$results = mysqli_query($GLOBALS['database']['connection'], $query);

		$json = "{\n\"data\": [";

		while($result = mysqli_fetch_assoc($results)) {
			$json .= "\n" . json_encode($result) . ",";
		}

		$json = rtrim($json, ',') . "\n]\n}";

		return $json;
	}

	function SQL_row_to_JSON($query) {
		$results = mysqli_query($GLOBALS['database']['connection'], $query);
		$result = mysqli_fetch_assoc($results);

		$json = "{\n\"data\": [\n";
		$json .= json_encode($result);
		$json .= "\n]\n}";

		return $json;
	}

	function SQL_rows_to_JSON_tree($query) {
		$results = mysqli_query($GLOBALS['database']['connection'], $query);

		$json = "{\n\"data\": [";

		print_r( mysqli_fetch_assoc($results));

		while($result = mysqli_fetch_assoc($results)) {
			if ($result['parent'] == $parent_id) {
				$json .= "\n" . json_encode($result) . ",";
				SQL_rows_parent_children_to_JSON($query, $parent_id);
			}
		}

		$json = rtrim($json, ',') . "\n]\n}";

		return $json;
	}

	function buildTree(array &$elements, $parentId = 0) {
    $branch = array();
    foreach ($elements as &$element) {
      if ($element['parent'] == $parentId) {
        $children = buildTree($elements, $element['id']);
        if ($children) {
          $element['children'] = $children;
        }
        $branch[$element['id']] = $element;
        unset($element);
      }
    }
    return $branch;
	}

	function JSON_combine() {
		$json = "{\n\"data\": {\n";
    foreach (func_get_args() as $param) {
			$param[1] = json_decode($param[1], true);
			$param[1] = json_encode($param[1]["data"]);
			if ($param[2]) {
				$param[1] = trim($param[1], "[]");
			}
			$json .=  "\"" . $param[0] . "\": \n" . $param[1] . "\n,";
    }

		$json = rtrim($json,',') . "\n}\n}";

		return $json;
	}

	// function JSON_concatenate($parent_JSON) {
	// 	$json = "{\n\"data\": {\n";
	// 	$parent_JSON = json_decode($parent_JSON, true);
  //   foreach (array_slice(func_get_args(), 1) as $param) {
	// 		$param[1] = json_decode($param[1], true);
	// 		$param[1] = json_encode($param[1]["data"]);
	// 		$json .=  "\"" . $param[0] . "\": \n" . $param[1] . "\n,";
  //   }
	// 	$json = rtrim($json,',') . "\n}\n}";
	//
	// 	$parent_JSON = json_encode($parent_JSON);
	//
	// 	return $json;
	// }

	function SQL_assoc_JSON($query) {
		$results = mysqli_query($GLOBALS['database']['connection'], $query);

		$json = "{\n\"data\": [";

		while($result = mysqli_fetch_assoc($results)) {
			$result['list'] = json_decode($result['list']);
			$json .= "\n" . json_encode($result) . ",";
		}

		$json = rtrim($json, ',') . "\n]\n}";

		return $json;
	}


?>
