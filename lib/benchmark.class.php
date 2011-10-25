<?php

/**
*built in support for benchmarking
*usefull for profilling our code
*/




class Benchmark
{

private $times = array();
private $keys = array();

public function set_marker($key=null)
{
  $this->keys[] = $key;
  $this->times[] = microtime(true);
}


/*
*start the benchmarking
*/
public function initiate()
{
  $this->keys= array();
  $this->times= array();
}


/*
*prints a detailed report of the benchmarking results
*needs to be extendended,pdf,that kinad thing
*/
public function print_report()
{
  $cnt = count($this->times);
  $result = "<h1>Benchmark results</h1><br />";
  for ($i=1; $i<$cnt; $i++)
  {
    $key1 = $this->keys[$i-1];
    $key2 = $this->keys[$i];
    $seconds = $this->times[$i]-$this->times[$i-1];
    $result .= "For step '{$key1}' to '{$key2}' : {$seconds}
                                            seconds.</br>";
  }
    $total = $this->times[$i-1]-$this->times[0];
  $result .= "Total time : {$total} seconds.</br>";
  $notif = Notif::get_notif();
  $notif->add_notif(4,"$result");
  $notif->show_notif();

unset($this->keys);
unset($this->times);
flush();
}


}
###

?>

