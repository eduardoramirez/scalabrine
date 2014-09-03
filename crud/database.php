<?php
class Database 
{
	private static $dbName = 'scalabrinedb' ; 
	private static $dbHost = 'localhost' ;
	private static $dbUsername = 'root';
	private static $dbUserPassword = 'Tw0sof+9Ly';
	
	private static $con  = null;
	
	public function __construct() {
		exit('Init function is not allowed');
	}
	
	public static function connect()
	{
	   // One connection through whole application
    if ( null == self::$con )
    {      
      try {
        $con = mysqli_connect($dbHost,$dbUsername,$dbUserPassword,$dbName);
      }
      catch(PDOException $e) 
      {
        die($e->getMessage());  
      }
    } 
   return &(self::$con);
	}
	
  public static function getNumRows($type, $param, $query)
  {
    $SQL = $con->prepare($sql);
    call_user_func_array(array($SQL, "bind_param"), array_merge(array($type), $param));
    $SQL->execute();
    $SQL->store_result();
    $numRows = $SQL->num_rows();
    $SQL->close();

    return $numRows;
  }

  public static function solo_query($sql)
  {
    mysqli_query($con, $sql);
  }

  public static function query($type, $param, $query)
  {
    $SQL = $con->prepare($query);
    call_user_func_array(array($SQL, "bind_param"), array_merge(array($type), $param));
    $SQL->execute();
    $SQL->store_result();
    $results = $SQL->fetch_assoc();
    $SQL->free();
    $SQL->close();

    return $results;
  }

	public static function disconnect()
	{
		self::$con = null;
	}
}
?>