<?php



#doc
#	classname:	Test
#	scope:		PUBLIC
#
#/doc


/*
trying to do something unit testing in rails
by the end of writing this i should have learnt alot about coding
*/

class Test
{
	#	internal variables
	private $class;
        private $pass = array();
        private $fail = array();
	private $errors = array();
	#	Constructor
	function __construct ()
	{
		
	}
	###	

/*
assert
return error if param is not true

*/
//print array
public function pre($array)
{
echo"<pre>";
print_r($array);
echo"</pre>";
}

public function dump($array)
{
echo"<pre>";
var_dump($array);
echo"</pre>";
}
public function assert($param)
{
if(is_null($param))
{

//fail

$this->fail[] = "Assert test #{$param} Failed";
}elseif(!is_null($param))
{

//pass
$this->pass[] = "Assert test #{$param} Passed";
}
}
/*
assert_equal
sound familiar?
*/

public function assert_equal($expectation,$testcase)
{
if($expectation != $testcase)
{
$this->fail[] = "Assert_equal test Failed -> #{'$expectation'} expected but #{'$testcase'} received ";
}
elseif($expectation == $testcase)
{
$this->pass[] = "Assert_equal test  Passed -> #{'$expectation'} expected and #{'$testcase'} received ";
}
}


/*
Display our errors
When tests have failed have and stuff
*/

public function errors()
{

//passed tests
$passed = count($this->pass);
$failed = count($this->fail);
$total_tests = $passed + $failed;

if($total_tests > 0)
{






echo"
<pre>........<b>Total Tests : $total_tests </b><br />
			 <b style='color:red'>................Failed Tests : $failed </b><br />";
			 

while (list($key,$value) = each($this->fail))
		{

			                  echo "<pre>
			 
			                  .... $value 
			                  </pre>";
		};

echo
"
                        <b style='color:green'>................Passed Tests : $passed </b><br />";

while (list($key,$value) = each($this->pass))
		{

			                 echo "<pre>
			 
			                 .... $value 
			                 </pre>";
		}}            

}



##does this get called all the time?
function __destruct()
{
$this->errors();
}



}
###

?>
