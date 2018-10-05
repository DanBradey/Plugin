<?php
   /**
	* Plugin Name: DefineAwesome MindBody
	*
	* @since 1.2.0
	*/

	// Hook for adding this shortcode
	add_shortcode('awe1', 'showData');

	
	function getMockData($url)
	{
		$response = wp_remote_get($url)['body'];
		$result = json_decode($response, true);
		return $result['items']['0'];
	}

	function printData($table, $data)
	{
		$table .= "<div id='datatable_container'><h2>Retrieved Data</h2><table>";
		$table .= "<tr><th>Key</th><th>Value</th></tr>";
		foreach($data as $key => $value)
		{
			$table .= "<tr>";
			$table .= "<td>".htmlentities($key)."</td>";
			if (is_string($value) || is_integer($value) || is_float($value))
			{
				$table .= "<td>".htmlentities($value)."</td>";
			}
			else
			{
				$table .= "<td>Data (probably an array)</td>";
			}
			$table .= "</tr>";
		}
		$table .= "</table></div>";
		return $table;
	}

	function showData()
	{
		$table = "<div><h1>Table</h1>";
		$url = "https://mb-mock-1.herokuapp.com/class";
		$data = getMockData($url);
		$table = printData($table, $data);
		$table .= "</div>";
		return $table;
	}
?>