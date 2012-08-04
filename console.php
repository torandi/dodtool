#!/usr/bin/php
<?
/**
 * PHP Console
 * Written by Andreas Tarandi for NitroXy
 * https://github.com/torandi/php_console
 */

require dirname(__FILE__)."/includes.php";
echo "PHP ".phpversion()."\n";

$PROMPT = "php >> ";

$debug_console = true;

if(file_exists(".console_history")) {
	readline_read_history(".console_history");
}

readline_completion_function('tab_completion');

set_error_handler('exception_error_handler');

while(true) {
		try {
			$input = readline($PROMPT);
			if($input === false) {
				echo "\n";
				break;
			}
			if(trim($input) != "") {
				readline_add_history($input);
				$input = trim($input);
				if(strpos($input, ";") === false) {
					$input = "print_r($input);";
				}
				if($input[strlen($input)-1] != ";") {
					$input = "$input;";
				}
				try {
					readline_write_history(".console_history");
					eval("$input echo '\n';");
				} catch (ErrorException $e) {
					echo_error($e);
				} catch (Exception $e) {
					echo $e."\n";
				}
			}
		} catch (Exception $e) {
			if($debug_console) {
				echo "[DEBUG]: $e\n";
			}
		}
}

readline_write_history(".console_history");

function echo_error($e) {
	global $debug_console;	

    $errortype = array (
			 E_ERROR              => 'Error',
			 E_WARNING            => 'Warning',
			 E_PARSE              => 'Parsing Error',
			 E_NOTICE             => 'Notice',
			 E_CORE_ERROR         => 'Core Error',
			 E_CORE_WARNING       => 'Core Warning',
			 E_COMPILE_ERROR      => 'Compile Error',
			 E_COMPILE_WARNING    => 'Compile Warning',
			 E_USER_ERROR         => 'User Error',
			 E_USER_WARNING       => 'User Warning',
			 E_USER_NOTICE        => 'User Notice',
			 E_STRICT             => 'Runtime Notice',
			 E_RECOVERABLE_ERROR  => 'Catchable Fatal Error'
			 );
	echo "PHP ".$errortype[$e->getSeverity()].": ".$e->getMessage()."\n";
	if($debug_console) {
		echo "In ".$e->getFile()."(".$e->getLine().")\n";
	}
}


function exception_error_handler($errno, $errstr, $errfile, $errline ) {
	    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

function tab_completion($string, $index) {
	global $debug_console, $GLOBALS, $PROMPT;
	// Get info about the current buffer
	$rl_info = readline_info();
	// Figure out what the entire input is
	$full_input = substr($rl_info['line_buffer'], 0, $rl_info['end']);
	$next_space = strpos($full_input, " ", $index); 
	if($next_space === false) {
		$next_space = strlen($full_input);
	}
	$pre_input = substr($full_input, 0, $next_space); //Input to be tabcompleted (before cursor position)
	if($index > 0 && strpos($pre_input,"->")>0) {
		$split = explode("->",$pre_input);
		try {
			$obj_str = $split[count($split)-2];
			$obj = null;
			if($obj_str[0] == '$') {
				//Is variable
				$v_ = substr($obj_str,1); //Remove $
				if(isset($GLOBALS[$v_])) {
					$obj = $GLOBALS[$v_]; //Fetch object
				} else {
					echo "\nUndefined variable \$$v_\n$PROMPT$full_input";
				}
			}
			
			if(is_object($obj)) {
				$class_name = get_class($obj);
				$matches = array_merge(
					get_class_methods($class_name),
					array_keys(get_class_vars($class_name))
				);
			} else {
				$matches = array("");
			}
		} catch (ErrorException $e) {
			echo "\n".$e->getMessage()."\n$PROMPT$full_input";
			
			$matches = array("");
		} catch (Exception $e) {
			if($debug_console) {
				echo "\n$e\n$PROMPT$full_input";
			}
			$matches = array("");
		}
	} else {
		$matches = array_merge(
			array_keys($GLOBALS),
			array_values(get_declared_classes()),
			array_flatten(get_defined_functions())
		);
	}

	return $matches;
}

/**
 * Flattens an array, or returns FALSE on fail.
 */
function array_flatten($array) {
	if (!is_array($array)) {
		return FALSE;
	}
	$result = array();
	foreach ($array as $key => $value) {
		if (is_array($value)) {
			$result = array_merge($result, array_flatten($value));
		} else {
			$result[$key] = $value;
		}
	}
	return $result;
} 
