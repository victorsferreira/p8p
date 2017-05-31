<?php

<?php

function regex_replace_recursively($pattern,$replace,$input){
  while(true){
    $new_input = preg_replace('/'.$pattern.'/',$replace,$input);
    if($input == $new_input) break;
    else $input = $new_input;
  }

  return $input;
}

function is_multidimensional_array($array){
  return is_array($array) && count($array) == count($array, COUNT_RECURSIVE);
}

function is_associative_array($array){
  if(!is_array($array)) return false;
  if (array() === $array) return false;
  return array_keys($array) !== range(0, count($array) - 1);
}

function camel_case_to_lisp_case($input){
  return camel_case_to_snake_case(snake_case_to_lisp_case($input));
}

function snake_case_to_lisp_case($input){
  return strtolower(str_replace('_','-',$input));
}

function lisp_case_to_camel_case($input){
  return snake_case_to_camel_case(lisp_case_to_snake_case($input));
}

function lisp_case_to_snake_case($input){
  return strtolower(str_replace('-','_',$input));
}

function snake_case_to_camel_case($input,$ucfirst=false){
  $output = str_replace(' ','',ucwords(str_replace('_',' ', $input)));
  if(!$ucfirst) $output = lcfirst($output);
  return $output;
}

function camel_case_to_snake_case($input) {
  preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
  $ret = $matches[0];
  foreach ($ret as &$match) {
    $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
  }
  return implode('_', $ret);
}

function array_flatten($a){
    $r = array();

    foreach($a as $i){
        if(!is_null($i)) $r[] = $i;
    }

    return $r;
}

function array_max_key($a){
	if(count($a)) return max(array_keys($a));
	return 0;
}

function array_insert($a,$b,$index){
	if(!is_array($b)) $b = array($b);

	$max = array_max_key($a);
    if($index > $max) $max = $index;
    $ab = array();
    $max++;

    for($i=0;$i<$max;$i++){
        if(isset($a[$i]) && $i<$index){
            $ab[$i] = $a[$i];
        }else if($i == $index){
            $_max = count($b);
            for($j=0;$j<$_max;$j++){
                $ab[$i+$j] = $b[$j];
            }

            if(isset($a[$i])) $ab[] = $a[$i];
        }else if(isset($a[$i])){
			if(isset($ab[$i])) $ab[] = $a[$i];
            else $ab[$i] = $a[$i];
        }
    }

    return $ab;
}

function is_even($a){
  return $a % 2 == 0;
}

function is_odd($a){
  return $a % 2 != 0;
}

function array_select($callback, $a){
    $r = array();

    foreach($a as $i){
        if(call_user_func($callback, $i)) $r[] = $i;
    }

    return $r;
}

function array_random($a,$amount=false){
  if(!$amount) $amount = 1;
  $l = count($a);
  if($amount > $l) $amount = $l;

  $a_ = array();
  for($i=0;$i<$amount;$i++){
    $pos = array_rand($a);
    $a_[] = array_splice($a,$pos,1);
  }

  if($amount == 1) return $a_[0];
  return $a_;
}

function debug($input,$exit=true){
  ?>
  <pre style="color:red"><?php var_dump($input); ?></pre>
  <?php
  if($exit) exit();
}

?>
