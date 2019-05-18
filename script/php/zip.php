<?php

        function csv_to_array($filename='', $delimiter=',')
        {       
            //$marks = array();
            if(!file_exists($filename) || !is_readable($filename))
                return FALSE;   
            if (($handle = fopen($filename, 'r')) !== FALSE)
            {
                while (($row = fgetcsv($handle, 30, $delimiter)) !== FALSE)
                {
                    $row_temp = $row;
                    if(!$column){
                        $column = $row;                    
                    }
                    else{
                        $marks[] = array_combine($column, $row);                    
                    }
                }
                fclose($handle);
            }       
            return $marks;
        }
    
    
        $temp= csv_to_array('zip.csv');
        $place_map = [];
        //$zip_array = array();
        //$city_array = array();
        //$state_array = array();
        
        for($i=0; $i < sizeof($temp);$i++){
            $place_map[ $temp[$i]['zip'] ] = [
                'city'=>$temp[$i]['city'],
                'state'=>$temp[$i]['state']
            ];
    
        }
    
        //print_r($b);

        $zip = $_GET["zip"]; 
        if(array_key_exists($zip, $place_map))
        {
            print $place_map[$zip]['city'].",".$place_map[$zip]['state'];
        }
        else{
            print ",";
        }
     
        

?>