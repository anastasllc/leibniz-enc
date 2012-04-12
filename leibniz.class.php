<?php

class Leibniz
{
  public $alphabets = NULL;
  public $gear = NULL;
  public $debug = false;
  const default_alphabet = 'ABCDEFGHIKLMNOPQRSTUWXYZ';

  function __construct()
  {
    $this->gear = array();
    $this->alphabets = array();
  }

  public function alph_string_to_array($line)
  {
    if(strlen($line) == strlen(self::default_alphabet))
      {
	$new_alph = array();
	for($i = 0; $i < strlen($line); $i++)
	  {
	    // 'A' == 65
	    $new_alph[substr(self::default_alphabet,$i,1)] = $line[$i];
	  }
	return $new_alph;
      }
    else
      return false;
  }

  public function set_gear($line)
  {
    for($i = 0; $i < strlen($line); $i++)
      $this->gear[] = $line[$i];
    
    if($this->debug)
      $this->pre_array($this->gear);
  }

  public function read_gear_file($filename = "gears.txt")
  {
    $lines = explode("\n",file_get_contents($filename));
    $line = preg_replace('/[[:space:]]/','',$lines[0]);

    $this->set_gear($line);
  }

  public function set_alphabets($alphabets, $delimiter = "\n")
  {
    $lines = explode($delimiter, $alphabets);
    foreach($lines as $line)
      {
	$line = preg_replace('/[[:space:]]/','', $line);
	if(($new_alph = $this->alph_string_to_array($line)) !== false)
	  {
	    if($this->alphabets === NULL)
	      $this->alphabets = array();
	    $this->alphabets[count($this->alphabets)] = $new_alph;
	  }
      }

    if($this->debug)
      $this->pre_array($this->alphabets);    
  }

  public function read_cyphers_file($filename = "cyphers.txt")
  {
    $this->set_alphabets(file_get_contents($filename));
  }

  public function encrypt($msg)
  {
    $msg = $this->pad($msg);
    $enc_msg = '';
    $cur_alph = 0;

    for($i = 0; $i < strlen($msg); $i++)
      {
	$char = $msg[$i];
	if(!isset($this->alphabets[$cur_alph][$char]))
	  $this->error("Unexpected input: $char is not in the character set");
	$enc_char = $this->alphabets[$cur_alph][$char];
	if($this->gear[$i % count($this->gear)] == 1)
	  $cur_alph = ($cur_alph + 1) % count($this->alphabets);
	$enc_msg .= $enc_char;
	if($this->debug)
	  echo $char . " to " . $enc_char . "<br>";
      }
    return $enc_msg;
  }

  public function decrypt($msg)
  {
    $msg = $this->pad($msg);
    $dec_msg = '';
    $cur_alph = 0;

    for($i = 0; $i < strlen($msg); $i++)
      {
	$enc_char = $msg[$i];
	$dec_char = NULL;
	foreach($this->alphabets[$cur_alph] as $dec => $enc)
	  {
	    if($enc_char == $enc)
	      {
		$dec_char = $dec;
		break;
	      }
	  }
	if($dec_char === NULL)
	  $this->error("Unexpected input: $enc_char is not in the character set");
	if($this->gear[$i % count($this->gear)] == 1)
	  $cur_alph = ($cur_alph + 1) % count($this->alphabets);
	$dec_msg .= $dec_char;
	if($this->debug)
	  echo $enc_char . " to " . $dec_char . "<br>";
      }
    return $dec_msg;
  }


  public function error($msg, $die = true)
  {
    echo $msg;
    if($die)
      die();
  }

  public function pre_array($arr)
  {
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
  }

  public function pad($msg)
  {
    $msg = preg_replace('/[[:punct:]]/','', $msg);
    $msg = preg_replace('/[[:space:]]/','', $msg);
    return strtoupper($msg);
  }
}

?>