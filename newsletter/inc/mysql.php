<?php //mysql.inc.php (table-xs v1.6) - by Jack (tR)


class mysql
// The data source is a mySQL database
{

	// public class variables which can be modified
	var $name          = "";
	var $handle        = "";
	var $server        = "";
	var $database      = "";
	var $login         = "";
	var $password      = "";
	var $captions      = array();
	var $tab_list      = array();
	var $list_next_pos = 0;
	var $list_max_pos  = 0;

/*

//----------------------------------------------------------------------------
//				I N T E R F A C E
//----------------------------------------------------------------------------

	// returns the captions of the table rows
	array get_captions( );

	// opens the data source
	boolean open( string mode );

	// closes the data source
	boolean close();

	// initializes the data source
	boolean init();

	// returns the number of table entries
	int entries();

	// returns an entry from the table
	get_entry( int pos, reference array rows );

	// returns the next entry from the table
	get_next_entry( reference array rows );

	// returns several successive table entries
	get_entrylist( int start, int stop, reference array entrylist );

	// appends an entry to the table
	append( array data );

	// looks for the first appearance of a date in the table
	find_entry( string data );

	// looks for the next appearance of a date in the table
	find_next_entry( string data );

	// changes an entry in the table
	change( int pos, array data );

	// removes an entry from the table
	delete( int pos )
*/


//-------------------------------- Help Functions ----------------------------


		function get_captions()
	// Task:    returns the captions of the table rows
	//
	// Input:   none
	//
	// Output:  returns the table captions in $captions
	{

		$query = "SELECT * FROM " . $this->name;
		$result = mysql_query( $query, $this->handle );
//		$num_entries = mysql_num_rows( $result );

/*		if ( $num_entries != 0 )
		{
			$tokens = mysql_fetch_array( $result, MYSQL_ASSOC );

			$keys = array_keys( $tokens );
			$i = 0;

			foreach ($keys as $key)
			{
				$this->captions[$i] = $key;
				$i++;
			}
		}*/
		
		
		$num_fields = mysql_num_fields( $result );
		if ( $num_fields != 0 )
		{
			$rows = mysql_num_rows( $result );

			for ( $i=0; $i< $num_fields; $i++ )
			{
					$this->captions[$i] = mysql_field_name( $result, $i );
			}
		}


	}


//-------------------------------- Implementation ----------------------------


	function open( $mode )
	// connects to the mySQL-RDBMS
	{

		if ( ! $this->handle = mysql_connect( $this->server, $this->login, $this->password ) )
		{
			echo "Error: Connection to mySQL-database at '$this->server' failed!";
			return false;
		}
		else
		{
			if ( mysql_select_db($this->database) )
			{
				return true;
			}
			else
			{
				echo "Error: Database '$this->database' not found!<br>";
				return false;
			}
		}

	}


	function close()
	// closes connection to the mySQL-RDBMS
	{

		return mysql_close( $this->handle );

	}


	function init()
	// initializes the data source
	{

		if ( $this->open( "" ) AND $this->close() )
		{
			return true;
		}
		return false;

		unset( $this->$tab_list );
		$this->list_next_pos = 0;

	}


	function entries()
	// Task:   returns the number of table entries
	//
	// Input:  none
	//
	// Output: number of entries
	{

		$this->open("");

		$this->get_captions();

		$query = "SELECT * FROM " . $this->name;
		if ( ! $result = @mysql_query( $query, $this->handle )  )
		{
			echo "Error: Table '$this->database.$this->name' not found...";
			exit;
		}
		$num_entries = mysql_num_rows( $result );
		$this->close();

		return $num_entries;

	}


	function get_entry( $pos, &$rows )
	// Task:   returns an entry from the table
	//
	// Input:  $line	= Number of the line from where to fetch the rows
	//
	// Output: $rows	= array containing the entries
	{

		$this->open( "r");

		$this->get_captions();

		$query = "SELECT * FROM " . $this->name;
		$this->tab_list = mysql_query( $query, $this->handle );
		$this->list_max_pos = mysql_num_rows( $this->tab_list );

		if ($this->list_next_pos <= $this->list_max_pos)
		{
			mysql_data_seek( $this->tab_list, $pos );

			$rows = mysql_fetch_array( $this->tab_list, MYSQL_ASSOC );
			$this->list_next_pos = $pos + 1;
		}
	}

	function get_next_entry( &$rows )
	// Task:   returns the next entry from the table
	//
	// Output: $rows	= array containing the entries
	{

		if ($this->list_next_pos < $this->list_max_pos)
		{
			mysql_data_seek( $this->tab_list, $this->list_next_pos );

			$rows = mysql_fetch_array( $this->tab_list, MYSQL_ASSOC );

			$this->list_next_pos++;
		}
	}


	function get_entrylist( $start, $stop, &$entrylist )
	// Task:   returns several successive table entries
	//
	// Input:  $start  = first entry to fetch
	//         $end    = last entry to fetch
	//
	// Output: $entrylist = two dimensional array containing
	//                      the red lines/entries
	{

		$this->open( "r" );

		$this->get_captions();

		$query = "SELECT * FROM " . $this->name ;
		$result = mysql_query( $query, $this->handle );

// range checking for $pos still is to be implemented !
		$i=0;
		while ($i < $start)
		{
			$tokens = mysql_fetch_array( $result, MYSQL_ASSOC );
			$i++;
		}

		while ($i <= $stop)
		{
			$entrylist[$i] = mysql_fetch_array( $result, MYSQL_ASSOC );
			$i++;
		}

		$this->close();

	}


	function append( $data )
	// Task:   Appends an entry to the table
	//
	// Input:  $data	= array with the data to save
	//
	{

		$this->open( "a" );

		$query = "INSERT INTO " . $this->name ." ( ";

		$values = array_keys( $data );
		$preset_commata = false;
		foreach ($values as $val)
		{
			if (!$preset_commata)
			{
				$query .= $val;
				$preset_commata = true;
			}
			else
			{
				$query .= "," . $val;
			}
		}
		$query .= ") VALUES ( ";

		$values = array_keys( $data );
		$preset_commata = false;
		foreach ($values as $val)
		{
			if (!$preset_commata)
			{
				$query .= "'".$data[$val]."'";
				$preset_commata = true;
			}
			else
			{
				$query .= "," . "'" . $data[$val] . "'";
			}
		}
		$query .= " );";

		$result = mysql_query( $query, $this->handle );

	}

	function find_entry( $data )
	// Task:   Searches for the first appearance of a date in the table
	//
	// Input:  $data = array with the colums to find
	//
	{
		$entry = 0;
		$this->open( "r" );
		$this->get_captions();

		$query = "SELECT * FROM " . $this->name;
		$this->tab_list = mysql_query( $query, $this->handle );

		while ( ($row = mysql_fetch_array( $this->tab_list, MYSQL_ASSOC ) ) )
		{
			$equal = true;
			
			$keys = array_keys( $data );
			foreach ($keys as $key)
			{
				if ( $data[$key] != $row[$key] )
				{
					$equal = false;
					break;
				}	
			}

			if ( $equal )
			{
				break;
			}

			$entry++;

		}
		
		$this->next_list_pos = $entry + 1;
		return $entry;

	}

	function find_next_entry( $data )
	// Task:   Searches for the next appearance of a date in the table
	//
	// Input:  $data 	= array with the columns to search
	//
	{
		$ok = false;
		$entry = $this->list_next_pos;

		if ($this->list_next_pos < $this->list_max_pos)
		{
			mysql_data_seek( $this->tab_list, $this->list_next_pos );

			while ( ($row = mysql_fetch_array( $this->tab_list, MYSQL_ASSOC ) ) )
			{
				$equal = true;
			
				$keys = array_keys( $data );
				foreach ($keys as $key)
				{
					if ( $data[$key] != $row[$key] )
					{
						$equal = false;
						break;
					}		
				}

				if ( $equal )
				{				
					break;
				}

				$entry++;
			}
		}
		$this->list_next_pos = $entry + 1;
		return $entry;

	}

	function change( $pos, $data )
	// Task:    Changes a line in the table
	//
	// Input:   $pos   = Position of the element
	//		    $data  = array containing the data to save
	//
	{

		$num_of_entries = $this->entries();

		$this->open( "r" );
		$this->get_captions();

		$i=0;
		$query = "SELECT * FROM " . $this->name;
		$result = mysql_query( $query, $this->handle );

		while ($i <= $pos)
		{
			$tokens = mysql_fetch_array( $result, MYSQL_ASSOC );
			$i++;
		}

		$id = $tokens["email"];

		$query = "UPDATE ".$this->name." SET ";

		$values = array_values( $this->captions );
		$preset_commata = false;
		foreach ($values as $val)
		{
//			if ($val != "email" )
			{
				if (!$preset_commata)
				{
					$query .= $val ." = ". '"'.$data[$val].'"'; $preset_commata = true;
				}
				else
				{
					$query .= ", " . $val ." = ". '"' . $data[$val] .'"';
				}
			}
		}
		$query .= " WHERE email = \"".$id."\"";
		$result = mysql_query( $query, $this->handle );

		$this->close();

	}

	function delete( $pos )
	// Task:  Removes a line from the table
	//
	// Input: $pos  = Position of the Element
	//
	{

		$num_of_entries = $this->entries();

		$this->open( "r" );

		$i=0;
		$query = "SELECT * FROM " . $this->name;
		$result = mysql_query( $query, $this->handle );

		while ($i <= $pos)
		{
			$tokens = mysql_fetch_array( $result, MYSQL_ASSOC );
			$i++;
		}
		$id = $tokens["email"];

		$query = "DELETE FROM ".$this->name." WHERE email = \"".$id."\"";
		$result = mysql_query( $query, $this->handle );
//		echo $query;

		$this->close();

	}

}

?>