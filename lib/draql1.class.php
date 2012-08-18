<?php

#doc
#	classname:	Draql
#	scope:		PUBLIC
#
#/doc

/*
Base class to handle the queries

*/

//dra class has utilities and stuff

class Draql  implements Sql
{
	#	internal variables

	    private $table;
        private $errors;
        public $attributes = array();
	#	Constructor

	/*
	when initialising the class we provide a table we want to manipulate
	*/

	function __construct ($table)
	{

        $this->con = Connection::getInstance();



//if we have a connection
if($this->con->conn)
    {
		# code...

	    $this->table = $table;



        //check if table exists
try
{
$result = mysql_query("show columns from {$this->table}");
if(!$result)
{
throw new Dberrors(1);
}else
{
if (mysql_num_rows($result) > 0) {
$i=0 ;
while ($i < mysql_num_rows($result) ) {
$this->attributes[$i] = mysql_result($result,$i,'Field');
$i++;
}}


//get a string from the attributes array,we shall use this later
//we use this string to pass to the records array of the find method so the result wont break
/*IMPORTANT DONT CHANGE*/
$this->attr_str = '';
foreach($this->attributes as $value)
{
$this->attr_str .= "$value,";
}
}
}catch(Dberrors $e)
{
$e->set_db($e);
}


}
	}
	###

//getter method
public function __get($attribute)
{
return $this->attributes["'$attribute'"];	# code...
}



public function clean_string($input)
{
//clean the string
$input = stripslashes($input);
if(!is_numeric($input))
    {
    $input = '"'.mysql_real_escape_string($input).'"';
    }
return $input;
}


public function backup($filename)
{


$command = "mysqldump --opt -h '".DB_HOST."' -u '".DB_USER."' -p '".DB_PASS."' --databases '".DB_NAME."' | gzip >  '".BASE_DIR."{$filename}.gz'";
system($command);

/*
$qry = "mysqldump --user '".DB_USER."' --password = '" .DB_PASS ."' --databases '".DB_NAME."' > '".BASE_DIR."{$filename}.sql'";
if(!mysql_query($qry))
    {
    die(mysql_error());
    }
*/
}




private function set_attribute($attribute_array)
{
while (list($key,$value) = each($attribute_array))
		{
	$this->attributes["'$key'"] = $value;
		}	# code...
}


/*
Trying to emulate the find method in rails activerecord objects
*/
public function find_by_sql($query)
{
$this->query = $query;
$result = mysql_query($this->query);



if($result)
{
//if we get a true result
if(substr_count(strtoupper($this->query),"SELECT")>0) {
if(mysql_num_rows($result) > 0)
{
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
 $query_array[] = $row;
}
return $query_array;
}
}
return true;
}
else
{
$this->errors["database_query_error"] = mysql_error();
return false;
}


}


/*
The find function with three parameter
The first parameter specifies the number of fields to return
(all for *,last for the last record and first for the first record found)
Conditions sets our where *__ =
Order obviuosly orders by
*/

public function find($args_records = null,$args_conditions = null,$args_order = null)
{
if ($args_records ==  null) {

//if no argument is given we return everything from the table
if($result = mysql_query("select * from {$this->table}"))
{
$query_array = mysql_fetch_array($result);
$this->set_attribute($query_array);
return $query_array;
}else
{
$this->errors["database_query_error"] = mysql_error();
}
} else {
  $passed_params = func_get_args();

  //for clarity
  $params['records'] = explode(",",$args_records);
  $params['conditions'] = explode(",",$args_conditions);
  $params['order'] = $args_order;

//build a query according to the parameters supplied


//lets begin with the first parameters(all,last,first...)
//first we get the count of the array
//if the count is one we assumme,all,first or last

list($records) = $params['records'];
if(count($params['records']) == 1)
{
//if its equal to all,last or first
//if its an integer we find by id
if($records == 'all')
{
//male sure that we assign the value from the SHOW COLUMNS to the records variable
/*IMPORTANT DONT CHANGE*/
$params['records'] = explode(",",$this->attr_str);
$this->sql =  ' select *  from '. $this->table;
}
elseif($records == 'last')
{
$this->sql = ' select *  from '.$this->table .' ORDER BY id desc limit 1 ' ;
}
elseif($records == 'first')
{
$this->sql = 'select *  from '. $this->table ;
}
elseif(preg_match('/[0-9]+$/',$records))
{
$this->sql = ' select *  from '.$this->table.' where id = '.$this->clean_string($records);
}else
{
$this->sql = ' select '. $this->table .'.'.$params['records'][0].' from '. $this->table;
}
}


//if the records demanded are more than one
elseif(count($params['records']) > 1)
{
$this->sql = 'select ';
//create a string
//this is a very dirty way of doing this
//hope this pays off
//remove the , from the first
for($n = 0;$n < count($params['records']);$n++)
{
if($n == 0)
{
$this->sql  .=  ''. $this->table  .'.'.$params['records'][$n];
}else
{
$this->sql  .=  ','. $this->table  .'.'.$params['records'][$n];
}
}
$this->sql .= ' from '. $this->table ;
}



//we now jump to the conditions
//where
//if the count we assume its only one conditions
list($conditions) = $params['conditions'];


if(count($params['conditions']) == 1 && strlen($conditions) > 0)
{
//we now perform the query
//break down the select arguments and clean them for attacks
$params['conditions'][0] = $this->prepareFindStatment($params['conditions'][0]);
$this->sql  .= " where {$this->table}.{$params['conditions'][0]}";
}
elseif(count($params['conditions']) > 1)
{
$this->sql .= " where";
for($n = 0;$n < count($params['conditions']);$n++)
{
//break down the select arguments and clean them for attacks
$params['conditions'][$n] = $this->prepareFindStatment($params['conditions'][$n]);
if($n == 0)
{
$this->sql  .= "  {$this->table}.{$params['conditions'][$n]}";
}else
{
$this->sql  .= " AND {$this->table}.{$params['conditions'][$n]}";
}
}
}


//Util::pre($this->sql);
//if the the third parameter is an array we raise an error
//order by should be a string eg order by id

$order = $params['order'];

if(is_array($order))
{
$this->errors["database_query_error"] = "Cannot Provide An Array for Third Parameter <br /> It has to be a string e,g 'order by id desc '";
return;
}
elseif(is_string($order) && !is_null($order))
{
$this->sql  .= " ORDER BY {$params['order']} ";
}





//if the query is executed
if($result = mysql_query($this->sql))
{
//if we get a true result
if(mysql_num_rows($result) > 0)
{
$num = mysql_num_rows($result);
$i=0 ;
$array_number = 1;
while ($i < mysql_fetch_array($result) ) {
//get the attributes and insert values
foreach($this->attributes as $value)
{
//only execute if it is contained in the array
/*IMPORTANT*/
if(in_array("$value",$params['records']))
{
$query_array[$array_number]["$value"] = mysql_result($result,$i,"$value");
}
}
$array_number++;
$i++;
}
return $query_array;
}
//if we get an empty result
else
{
return false;
}
}
//if the quey fails
else
{
$this->errors["database_query_error"] = mysql_error();

}
}
}


public function find_distinct($args_records = null ,$args_conditions = null,$args_order = null)
{
if ($args_records ==  null ) {

//if no argument is given we return everything from the table
if($result = mysql_query("select * from {$this->table}"))
{
$query_array = mysql_fetch_array($result);
$this->set_attribute($query_array);
return $query_array;
}else
{
$this->errors["database_query_error"] = mysql_error();
}
} else {
  $passed_params = func_get_args();

  //for clarity
  $params['records'] = explode(",",$args_records);
  $params['conditions'] = explode(",",$args_conditions);
  $params['order'] = $args_order;

//build a query according to the parameters supplied


//lets begin with the first parameters(all,last,first...)
//first we get the count of the array
//if the count is one we assumme,all,first or last







list($records) = $params['records'];
if(count($params['records']) == 1)
{
//if its equal to all,last or first
//if its an integer we find by id
if($records == 'all')
{
//male sure that we assign the value from the SHOW COLUMNS to the records variable
/*IMPORTANT DONT CHANGE*/
$params['records'] = explode(",",$this->attr_str);
$this->sql = 'select *  from '. $this->table;

}
elseif($records == 'last')
{
$this->sql = 'select *  from '. $this->table;
}
elseif($records == 'first')
{
$this->sql = 'select *  from'. $this->table;
}
elseif(preg_match('/[0-9]+$/',$records))
{
$this->sql = 'select *  from '. $this->table .'where id ='.$records;
}else
{

$this->sql = 'select  DISTINCT '. $this->table .'.'.$params['records'][0]  .' from '. $this->table;

}

}
elseif(count($params['records']) > 1)
{
$this->sql = ' select DISTINCT  ';

//create a string
//this is a very dirty way of doing this
//hope this pays off
//remove the , from the first
for($n = 0;$n < count($params['records']);$n++)
{
if($n == 0)
{
$this->sql  .=  ''. $this->table  .'.'.$params['records'][$n];

}else
{
$this->sql  .=  ','. $this->table  .'.'.$params['records'][$n];
}
}

$this->sql .= ' from '. $this->table;


}



//we now jump to the conditions
//where
//if the count we assume its only one conditions
list($conditions) = $params['conditions'];
if(count($params['conditions']) == 1 && strlen($conditions) > 0)
{
$this->sql  .= " where {$this->table}.{$params['conditions'][0]}";
}
elseif(count($params['conditions']) > 1)
{
$this->sql .= " where";

for($n = 0;$n < count($params['conditions']);$n++)
{
if($n == 0)
{
$this->sql  .= "  {$this->table}.{$params['conditions'][$n]}";
}else
{
$this->sql  .= " AND {$this->table}.{$params['conditions'][$n]}";
}
}
}

//if the the third parameter is an array we raise an error
//order by should be a string eg order by id

$order = $params['order'];

if(is_array($order))
{
$this->errors["database_query_error"] = "Cannot Provide An Array for Third Parameter <br /> It has to be a string e,g 'order by id desc '";
return;
}
elseif(is_string($order) && !is_null($order))
{
$this->sql  .= " ORDER BY {$params['order']} ";
}



//if the query is executed
if($result = mysql_query($this->sql))
{

//if we get a true result
if(mysql_num_rows($result) > 0)
{


$num = mysql_num_rows($result);



$i=0 ;
$array_number = 1;
while ($i < mysql_fetch_array($result) ) {

//get the attributes and insert values
foreach($this->attributes as $value)
{

//only execute if it is contained in the array
/*IMPORTANT*/

if(in_array("$value",$params['records']))
{

$query_array[$array_number]["$value"] = mysql_result($result,$i,"$value");

}


}

/*
while (list($key,$value) = each($this->attributes))
		{

		}
*/
$array_number++;
$i++;
}

/*return the reult in the format
$query_array[$array_number]["$value"]
*/


return $query_array;
}
//if we get an empty result
else
{
return false;
}



}
//if the quey fails
else
{
$this->errors["database_query_error"] = mysql_error();

}
}
}

//prepare the find or select to prevent sql injection
private function prepareFindStatment($data)
{
/*
Util::pre($data);
$matches = array('AND','and','OR','or','=');
foreach ($matches as $key => $value)
{
if(preg_match('/ '.$value.' /',$data))
    {


    }
}
*/
return $data;
}

//method to update data in  the database
public function update($args_columns,$args_values,$args_parameters)
{

//cannot update nothing
if($args_columns != null)
{

  #start the sql
 $this->sql = "update {$this->table} set ";
  #the conditions to be meet
  $params['conditions'] = explode(",",$args_parameters);
  #the values to be inserted in the parameters
  $params['values'] = explode(",",$args_values);

 //Util::pre($params['values']);

  #the parameters to be updated
  $params['columns'] = explode(",",$args_columns);

//if the number of values is not equal to that of the parameters supplied,die
if(count($params['values']) != count($params['columns']))
{
$this->errors["update_error"] = "The value arguments are supposed to be the same as the column arguments";

return false;
}



//we update the columns in the order they where listed
//first value for first column,second value for second column and so on
for($v = 0;$v < count($params['columns']);$v++)
{
$params['values'][$v] = str_replace('\'','',$params['values'][$v]);
//if the its the second value we add a ,
if($v > 0)
{
 $this->sql .=  ' , '. $params['columns'][$v] .' ='.$this->clean_string($params['values'][$v]).'';
}else
{
 $this->sql .= ''. $params['columns'][$v] .' = '.$this->clean_string($params['values'][$v]).'';
}
}





//add the conditions
//we now jump to the conditions
//where
//if the count we assume its only one conditions
list($conditions) = $params['conditions'];
if(count($params['conditions']) == 1 && strlen($conditions) > 0)
{
$this->sql  .= " where {$this->table}.{$params['conditions'][0]}";
}
elseif(count($params['conditions']) > 1)
{
$this->sql .= " where";

for($n = 0;$n < count($params['conditions']);$n++)
{
if($n == 0)
{
$this->sql  .= "  {$this->table}.{$params['conditions'][$n]}";
}else
{
$this->sql  .= " AND {$this->table}.{$params['conditions'][$n]}";
}
}
}








if($result = mysql_query($this->sql))
{
if(mysql_affected_rows() > 0)
{

return true;
}else
{
return false;
}
}else
{
$this->errors["database_query_error"] = mysql_error();

}
}else
{
$this->errors["database_insert_error"] = "cannot update empty data";
}
}

//method to update data in  the database
//perform a replace
public function replace($args_columns,$args_values)
{

//cannot update nothing
if($args_columns != null)
{

  #start the sql
 $this->sql = "REPLACE INTO {$this->table} ( ";

  #the values to be inserted in the parameters
  $params['values'] = explode(",",$args_values);
  #the parameters to be updated
  $params['columns'] = explode(",",$args_columns);

//if the number of values is not equal to that of the parameters supplied,die
if(count($params['values']) != count($params['columns']))
{
$this->errors["update_error"] = "The value arguments are supposed to be the same as the column arguments";

return false;
}




//add the tables
list($conditions) = $params['columns'];
if(count($params['columns']) == 1 && strlen($conditions) > 0)
{
$this->sql  .= " {$this->table}.{$params['columns'][0]} ";
}
elseif(count($params['columns']) > 1)
{
for($n = 0;$n < count($params['columns']);$n++)
{
if($n == 0)
{
$this->sql  .= "  {$this->table}.{$params['columns'][$n]}";
}else
{
$this->sql  .= " , {$this->table}.{$params['columns'][$n]}";
}
}
}


$this->sql  .= " ) VALUES( ";



//first value for first column,second value for second column and so on
for($v = 0;$v < count($params['columns']);$v++)
{
//if the its the second value we add a ,
if($v == 0)
{
 $this->sql .=  '\''.$this->clean_string($params['values'][$v]).'\'';
}else
{
 $this->sql .= ' , \''.$this->clean_string($params['values'][$v]).'\'';
}
}

$this->sql  .= " )";



if($result = mysql_query($this->sql))
{
if(mysql_affected_rows() > 0)
{

return true;
}else
{
return false;
}
}else
{
$this->errors["database_query_error"] = mysql_error();

}
}else
{
$this->errors["database_insert_error"] = "cannot update empty data";
}
}


//method to insert data into the database
public function insert($args_values,$args_parameters = null)
{

//cannot insert nothing
if($args_values != null)
{
	# code...
  #the parameters to update
  $params['update_params'] = explode(",",$args_parameters);



  #the values to be inserted in the parameters
  $params['values'] = explode(",",$args_values);




//deal with the parameters
//if there are no parameters then we assumme the user is updating all so the query is
list($update_params) = $params['update_params'];
if($args_parameters == null)
{
#start building the query
$this->sql = "insert into {$this->table} ";
}else
{
$this->sql = "insert into {$this->table}( ";

if(count($params['update_params']) >= 1)
{
for($n = 0;$n < count($params['update_params']);$n++)
{
if($n == 0)
{
$this->sql  .= ' '. $params['update_params'][$n];
}else
{
$this->sql  .= ','. $params['update_params'][$n];
}
}
}
$this->sql .= ' ) ';
}


//deal with the values
list($insert_values) = $params['values'];
if(count($params['values']) >= 1)
{
$this->sql .= ' values ( ';
if(count($params['values']) >= 1)
{
for($v = 0;$v < count($params['values']);$v++)
{
$values = $this->clean_string($params['values'][$v]);
if($v == 0)
{
$this->sql  .=  $values;

}else
{
$this->sql  .=  ','. $values;
}
}
}
$this->sql .= ' ) ';
}

//Util::pre($this->sql);

if($result = mysql_query($this->sql))
{
$id = mysql_insert_id();
if(mysql_affected_rows() > 0)
{
return $id;
}else
{
return false;
}
}else
{
$this->errors["database_query_error"] = mysql_error();

}
}else
{
$this->errors["database_insert_error"] = "cannot insert empty data";
}
}



//get the last insert id
function insert_id()
{
return mysql_insert_id();
}


//method to return a count of entries in a table
//optional parameter of conditions
public function count($args_parameters = null )
{





//cannot insert nothing
if($args_parameters == null )
{
$this->sql = "select COUNT(*) FROM $this->table";
}
else
{

//clean the damn strings
//$args_parameters = $this->clean_string("$args_parameters");

#the parameters to update
$params['params'] = explode(",",$args_parameters);


//build the query
$this->sql = "select COUNT(*) FROM {$this->table} where {$params['params'][0]} = ".$this->clean_string($params['params'][1]);
}


//we now perform the query
$this->query = $this->sql;

//if the query is executed
if($result = mysql_query($this->query))
{

//if we get a true result
if(mysql_num_rows($result) > 0)
{

$arr = mysql_fetch_array($result);
return $arr;
}
else
{
return false;
}

}else
{
$this->errors["database_query_error"] = mysql_error();

}

}



//method to remove data into the database
//this is extra deadly
//clean every form of input
public function remove($args_parameters,$args_values)
{

//clean the damn strings
//$args_parameters = $this->clean_string("$args_parameters");
//$args_values = $this->clean_string("$args_values");


//cannot insert nothing
if($args_values != null)
{


  #the parameters to update
  $params['params'] = explode(",",$args_parameters);
  #the values to be inserted in the parameters
  $params['values'] = explode(",",$args_values);


if(count($params['params']) != count($params['values']))
{
$this->errors["database_query_error"] = "delete error, values have to be the same number as parameters";

}


$this->sql = "delete from $this->table where ";


//build the query
for($v = 0;$v < count($params['params']);$v++)
{

if($v > 0 )
{
$this->sql .= " AND {$this->table}.{$params['params'][$v]} = ".$this->clean_string($params['values'][$v]);
}else
{
$this->sql .= "  {$this->table}.{$params['params'][$v]} =".$this->clean_string($params['values'][$v]);
}
}

//we now perform the query
$this->query = $this->sql;





if($result = mysql_query($this->query))
{
if(mysql_affected_rows() > 0)
{
return true;
}else
{
return false;
}
}else
{
$this->errors["database_query_error"] = mysql_error();

}
}else
{
$this->errors["database_insert_error"] = "cannot remove empty data";
}


}

function __destruct()
{
if(DEVELOPMENT_ENVIRONMENT)
{
if(is_array($this->errors))
    {
    $notif = notif::get_notif();
    foreach ($this->errors as $key => $value)
    {
    $notif->add_notif(1,$value);
    }
    $notif->show_notif();
    }
}
}




}
###

?>

