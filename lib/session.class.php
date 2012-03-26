<?php


class Session
{
	#	internal variables

	#	Constructor
	public function __construct ()
	{
        $this->sess_conn = new Draql('sessions');


session_set_save_handler(
    array($this,'open'),
    array($this,'close'),
    array($this,'read'),
    array($this,'write'),
    array($this,'destroy'),
    array($this,'gc')
);
@session_start();
	}
	###

public function set($name, $value)
{
  $_SESSION[$name] = $value;
}


public function get($name)
{
  if (isset($_SESSION[$name]))
  {
    return $_SESSION[$name];
  }
  else
  {
    return false;
  }
}

public function get_userid()
{
if($this->get(SESS_KEY))
{
return $this->get(SESS_KEY);
}else
{
return null;
}
}






public function open($path,$name)
{
if(!$this->sess_conn)
{
return false;
}else
{
return true;
}
}

  public function del($name)
  {
    unset($_SESSION[$name]);
  }





/*
The close method is called when we end a session, and must return either true or
false. It isn’t uncommon to manually call the garbage collection (gc) method here,
though it isn’t strictly necessary—PHP will do its own garbage collection throughout.
We remove our database connection by setting the close method to null.
*/
public function close()
{

  $this->sess_conn = null;

  return true;

}


public function read($this_id)
{
$id = $this->sess_conn->find('sess_data',"sess_id = '$this_id'");
if($id)
{
$read_sess_data = $id[1]['sess_data'];
return $read_sess_data;
}else
{
return false;
}
}


public function write($this_id,$data)
{
$id = $this->sess_conn->find('sess_id',"sess_id = '$this_id'");
if($id)
{
//optimise the table

$wrt = $this->sess_conn->find_by_sql("UPDATE sessions set sess_data = '$data',sess_last_acc = NOW() WHERE sess_id = '$this_id'");
}else
{
$wrt = $this->sess_conn->insert("$this_id,NOW(),NOW(),$data",'sess_id,sess_start,sess_last_acc,sess_data');
}
return true;
}


public function destroy($this_id)
{
$del = $this->sess_conn->find_by_sql("delete sessions from sessions where sess_id = '$this_id'");
session_destroy();
return true;
}

/*
The final function we are required to implement is the gc, or garbage collection,
function, which is used to clean out any old sessions that were never closed properly.
It receives an integer argument for the “time to live” (TTL) value for a session. In
our class method, gc, we delete any session record where the last access time is less
then the current time, minus the TTL value:
*/

public function gc($ttl)
{
$end = date('Y-m-d H:i:s', time() - $ttl);
$del = $this->sess_conn->find_by_sql("delete sessions from sessions where sess_last_acc < '$end' ");
//optimise the table
$this->sess_conn->find_by_sql('OPTIMIZE table sessions');
return true;
}

public function __destruct()
{
session_write_close();
}




}

