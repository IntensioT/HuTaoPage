<?php
		// Get the data 
		$data = array	(array 	(array	(  array( 	array("розы", 100 , 15),
                  						array("тюльпаны", 60 , 25),
                  						array("орхидеи", 180 , 7) 
                  					),
                  				   array( 	array("apelsin", 200 , 5),
                  						array("mandarin", 30 , 5),
                  						array("bakhlazhan", 110 , 3) 
                  					)                  				     
                  				),
                  			(array	( array(	array("samie", 10.9999 , 15),
                  						array("luchie", 6.11111 , 25),
                  						array("орхидеи", 18.21312 , 7) 
                  					),
                  				  array( 	array("unas", 20.123123 , 5),
                  						array("vsegda", 3.999 , 5),
                  						array("vmagazine", 11.2 , 300) 
                  					)
                  				)
                  			)
                  			) 
                  	); 

		for ( $layer5 = 0; $layer5 < 1; $layer5++ )
		{
    			echo "Номер слоя $layer5 \n";
    
    			for ( $layer4 = 0; $layer4 < 2; $layer4++ )
    			{
       				echo "Номер строки $layer4 \n";
      
        			for ( $layer3 = 0; $layer3 < 2; $layer3++ )
        			{
        				for ( $layer2 = 0; $layer2 < 3; $layer2++ )
        				{
        					for ( $layer1 = 0; $layer1 < 3; $layer1++ )
        					{
        						echo "--".$data[$layer5][$layer4][$layer3][$layer2][$layer1]."\n";
        						$fullData .= $data[$layer5][$layer4][$layer3][$layer2][$layer1];
        						$fullData .= ",";
        					}
        				}
          				
        			}

    			}
		}  
		$array = explode(",", $fullData);
		//echo "\n".$fullData."\n";
		//echo "$array";
		

		// Remove all integers
		foreach ($array as $key => $value) {
			if (is_numeric($value) && intval($value) == $value) {
				unset($array[$key]);
			}
		}

		// Round fractions
		foreach ($array as $key => $value) {
			if (is_numeric($value) && floatval($value) != intval($value)) {
				$array[$key] = round($value, 2);
			}
		}

		// Convert all text elements to uppercase
		foreach ($array as $key => $value) {
			if (!is_numeric($value)) {
				$array[$key] = strtoupper($value);
			}
		}

		// Sort the array in ascending order in string mode
		sort($array, SORT_STRING);
		sort($array, SORT_STRING);

		// Display the source and received arrays in tabular form
		echo "Source Array:\n";
		foreach (explode(",", $fullData) as $value) {
			echo "$value\n";
		}
		echo "\n-------------------------------------\n";
		echo "Received Array:";
		foreach ($array as $value) {
			echo "$value\n";
		}
	?>
