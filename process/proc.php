<?php

	$data = "|||";
    $descs = array(
                0 => array( 'pipe' , 'r' ),
				//1 => array( 'pipe' , 'w' ),
				//2 => array( 'pipe' , 'w' ),
                1 => array( 'file' , 'output' , 'w' ),
                2 => array( 'file' , 'errors' , 'w' ),
            );

    $res = proc_open( 'D:\xampp\php\php.exe' , $descs , $pipes );


    if( is_resource( $res ) )
    {
        fputs( $pipes[ 0 ] , '<?php echo \'Hello you!\n\'; ?>' );
        fclose( $pipes[ 0 ] );

        /*
        while( ! feof( $pipes[1] ) )
        {
            $line = fgets( $pipes[ 1 ] );
            echo urlencode( $line );
        }
		*/
        
		proc_close( $res );
    }
	
	
	$lots_of_data = '<?php echo \'Hello you!\n\'; ?>';
	
	echo "=====> ".$data;
	$descriptorspec = array(
		0 => array('pipe', 'r'),  // stdin is a pipe that the child will read from
		1 => array('pipe', 'w'),  // stdout is a pipe that the child will write to
		2 => array('pipe', 'w')   // stderr is a pipe the child will write to
	);
	$process = proc_open('D:\xampp\php\php.exe', $descriptorspec, $pipes);
	if(!is_resource($process)) {
		throw new Exception('bad_program could not be started.');
	}
	//pass some input to the program
	fwrite($pipes[0], $lots_of_data);
	//close stdin. By closing stdin, the program should exit
	//after it finishes processing the input
	fclose($pipes[0]);

	//do some other stuff ... the process will probably still be running
	//if we check on it right away

	$status = proc_get_status($process);

	if($status['running'] == true) { //process ran too long, kill it
		//close all pipes that are still open
		fclose($pipes[1]); //stdout
		fclose($pipes[2]); //stderr
		//get the parent pid of the process we want to kill
		$ppid = $status['pid'];
		//use ps to get all the children of this process, and kill them
		$pids = array($ppid);
		var_dump($ppid);
		
		foreach($pids as $pid) {
			if(is_numeric($pid)) {
				echo "Killing $pid\n";
				posix_kill($pid, 9); //9 is the SIGKILL signal
			}
		}
			
		proc_close($process);
	}

?>