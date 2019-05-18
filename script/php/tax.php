<?php


        function csv_to_array($filename='', $delimiter=',')
        {       
            //$marks = array();
            if(!file_exists($filename) || !is_readable($filename))
                return FALSE;   
            if (($handle = fopen($filename, 'r')) !== FALSE)
            {
                while (($row = fgetcsv($handle, 300, $delimiter)) !== FALSE)
                {
                    //$row_temp = $row;
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
    
    
        $temp= csv_to_array('tax.csv');
        $place_map = [];
        
        for($i=0; $i < sizeof($temp); $i++){
            $place_map[ $temp[$i]['zip'] ] = [
                'county'=>$temp[$i]['county'],
                'rate'=>$temp[$i]['rate']
            ];
    
        }
    
        $zip = $_GET["zip"]; 
        if(array_key_exists($zip, $place_map))
        {
            print $place_map[$zip]['rate'];
        }
        else{
            print "0";
        }
     

?>