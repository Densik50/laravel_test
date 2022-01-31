<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class TasksController extends Controller
{
    public function task1()
    {
        $totalEntries_good = 0;
        $totalEntries_bad = 0;
        $output = "";
        
        $dataobject = Http::get('https://fecko.org/php-test');
        $data = json_decode($dataobject, true);
        
        $datacollection = collect($data);
        $totalEntries = $datacollection->count();

        //clearing entries from colletion that dont contain all attributes
        $datacollection = $datacollection->filter(function($value, $key) {
            //echo json_encode($value);
            if(array_key_exists("id", $value) and 
            array_key_exists("name", $value) and 
            array_key_exists("first", $value) and 
            array_key_exists("second", $value) and 
            array_key_exists("third", $value) and 
            array_key_exists("math", $value) and 
            array_key_exists("created", $value))
            { 
                $returnv = true;
            } else
            {
                $returnv = false;
                //echo json_encode($value);
            }
            return $returnv;
        });

        //creating collection that contains first name
        $firstName = "laravel";
        $firstName_rev = strrev($firstName);
        $filteredCollection1 = $datacollection->where('name', $firstName_rev);
        
        //creating collection that contains second name
        $secondName = "envoyer";
        $secondName_rev = strrev($secondName);
        $filteredCollection2 = $datacollection->where('name', $secondName_rev);
        
        //merging collections
        $filteredCollection = $filteredCollection1->merge($filteredCollection2);
        $totalEntries_good = $filteredCollection->count();
        $totalEntries_bad = $totalEntries - $totalEntries_good;
        
        $filteredArray = $filteredCollection->toarray();
        if(!empty($filteredArray))
        {
            $output .= json_encode($filteredArray);
        }

        $array = array(
            "goodEntries" => $totalEntries_good,
            "badEntries" => $totalEntries_bad,
            "entries" => $output
        );
        
        return $array;
    }

    public function task2()
    {
        $totalEntries_good = 0;
        $totalEntries_bad = 0;
        $output = "";

        $dataobject = Http::get('https://fecko.org/php-test');
        $data = json_decode($dataobject, true);
        $datacollection = collect($data);
        $totalEntries = $datacollection->count();

        //clearing entries from colletion that dont contain all attributes
        $datacollection = $datacollection->filter(function($value, $key) {
            if(array_key_exists("id", $value) and 
            array_key_exists("name", $value) and 
            array_key_exists("first", $value) and 
            array_key_exists("second", $value) and 
            array_key_exists("third", $value) and 
            array_key_exists("math", $value) and 
            array_key_exists("created", $value))
            { 
                $returnv = true;
            } else
            {
                $returnv = false;
            }
            return $returnv;
        });

        //filtering collections and keeping only those whaere first / second = third
        $datacollection = $datacollection->filter(function($value, $key) {
            if(($value["first"] / $value["second"]) == $value["third"]){
                return true;
            }
            return false;
        });

        //filtering collections and keeping those where third % 4 = 0
        $datacollection = $datacollection->filter(function($value, $key) {
            if(($value["third"] % 4) == 0){
                return true;
            }
            return false;
        });

        //filtering collections and keeping only hose where third % 6 = 0 or where third % 5 = 0
        $datacollection = $datacollection->filter(function($value, $key) {
            if((($value["third"] % 5) == 0) or (($value["third"] % 6) == 0))
            {
                return true;
            }
            return false;
        });

        $totalEntries_good = $datacollection->count();
        $totalEntries_bad = $totalEntries - $totalEntries_good;

        $filteredArray = $datacollection->toarray();
        if(!empty($filteredArray))
        {
            $output .= json_encode($filteredArray);
        }

        $array = array(
            "goodEntries" => $totalEntries_good,
            "badEntries" => $totalEntries_bad,
            "entries" => $output
        );

        return $array;
    }

    public function task3()
    {
        $totalEntries_good = 0;
        $totalEntries_bad = 0;
        $output = "";

        $dataobject = Http::get('https://fecko.org/php-test');
        $data = json_decode($dataobject, true);
        
        $datacollection = collect($data);
        $totalEntries = $datacollection->count();

        //clearing entries from colletion that dont contain all attributes
        $datacollection = $datacollection->filter(function($value, $key) {
            //echo json_encode($value);
            if(array_key_exists("id", $value) and 
            array_key_exists("name", $value) and 
            array_key_exists("first", $value) and 
            array_key_exists("second", $value) and 
            array_key_exists("third", $value) and 
            array_key_exists("math", $value) and 
            array_key_exists("created", $value))
            { 
                $returnv = true;
            } else
            {
                $returnv = false;
                //echo json_encode($value);
            }
            return $returnv;
        });
        
        //filtering and keeping only those where created date matches regex
        $datacollection = $datacollection->filter(function($value, $key) {
            //2014-**-02 21:**:30 -> regex /2014-[0-1][0-9]-02 21:[0-5][0-9]:30/
            if(preg_match("/2014-[0-1][0-9]-02 21:[0-5][0-9]:30/", $value["created"]))
            {
                return true;
            }
            else
            {
                return false;
            }
        });
        $totalEntries_good = $datacollection->count();
        $totalEntries_bad = $totalEntries - $totalEntries_good;
        
        $filteredArray = $datacollection->toarray();
        if(!empty($filteredArray))
        {
            $output .= json_encode($filteredArray);
        }

        $array = array(
            "goodEntries" => $totalEntries_good,
            "badEntries" => $totalEntries_bad,
            "entries" => $output
        );

        return $array;
    }

    //helping function for task4, returns precendence value of operator
    private function get_precedence_value($operator)
    {
        if($operator == '+' || $operator == '-')
        {
            return 1;
        }
        
        if($operator == '*' || $operator == '/')
        {
            return 2;
        }

        return 0;
    }

    //helping function for task4, solving 2 operands with operator
    private function apply_operator($operand1, $operand2, $operator)
    {
        if($operator == '+')
        {
            $new_value = $operand1 + $operand2;
        }
        else if($operator == '-')
        {
            $new_value = $operand1 - $operand2;
        }
        else if($operator == '*')
        {
            $new_value = $operand1 * $operand2;
        }
        else if($operator == '/')
        {
            $new_value = $operand1 / $operand2;
        }
        return $new_value;
    }

    public function task4(){
        $totalEntries_good = 0;
        $totalEntries_bad = 0;
        $output = "";

        $dataobject = Http::get('https://fecko.org/php-test');
        $data = json_decode($dataobject, true);
        
        $datacollection = collect($data);
        $totalEntries = $datacollection->count();

        //clearing entries from colletion that dont contain all attributes
        $datacollection = $datacollection->filter(function($value, $key) {
            //echo json_encode($value);
            if(array_key_exists("id", $value) and 
            array_key_exists("name", $value) and 
            array_key_exists("first", $value) and 
            array_key_exists("second", $value) and 
            array_key_exists("third", $value) and 
            array_key_exists("math", $value) and 
            array_key_exists("created", $value))
            { 
                $returnv = true;
            } else
            {
                $returnv = false;
                //echo json_encode($value);
            }
            return $returnv;
        });
        

        // https://en.wikipedia.org/wiki/Shunting-yard_algorithm
        //i wont comment this one, its just following already created algorithm, link ^
        $datacollection = $datacollection->filter(function($value, $key) {
            $divided = explode('=', $value["math"]);
            $math = $divided[0];
            $givenResult = trim($divided[1]);
            $length = strlen($math);
            
            $value_stack = [];
            $operator_stack = [];
            
            $index = 0;
            for($index; $index < $length; $index++){
                if(($math[$index] == ' ') or ($math[$index] == '\\')) continue;
                else if($math[$index] == '('){
                    array_push($operator_stack, $math[$index]);
                }
                else if(ctype_digit($math[$index])){
                    $number = "";
                    //$value = 0;

                    while(($index < $length) and (ctype_digit($math[$index]))){
                        $number .= $math[$index];
                        //$value = ($value * 10) + ($math[$index]-'0');
                        $index++;
                    }

                    $value = intval($number);
                    array_push($value_stack, $value);
                    $index--;
                }
                else if($math[$index] == ')'){
                    while((!empty($operator_stack)) and (end($operator_stack) != '(')){
                        $operand2 = array_pop($value_stack);
                        $operand1 = array_pop($value_stack);
                        $operator = array_pop($operator_stack);
                        array_push($value_stack, TasksController::apply_operator($operand1, $operand2, $operator));
                    }
                    if(!empty($operator_stack)){
                        array_pop($operator_stack);
                    }
                }
                else{
                    while(!empty($operator_stack) and (TasksController::get_precedence_value(end($operator_stack)) >= TasksController::get_precedence_value($math[$index]))){
                        $operand2 = array_pop($value_stack);
                        $operand1 = array_pop($value_stack);
                        $operator = array_pop($operator_stack);
                        array_push($value_stack, TasksController::apply_operator($operand1, $operand2, $operator));
                    }
                    array_push($operator_stack, $math[$index]);
                }
            }
            while(!empty($operator_stack))
            {
                $operand2 = array_pop($value_stack);
                $operand1 = array_pop($value_stack);
                $operator = array_pop($operator_stack);
                array_push($value_stack, TasksController::apply_operator($operand1, $operand2, $operator));
            }

            $result = array_pop($value_stack);

            return ($result == $givenResult);
        });

        $totalEntries_good = $datacollection->count();
        $totalEntries_bad = $totalEntries - $totalEntries_good;
        
        $filteredArray = $datacollection->toarray();
        if(!empty($filteredArray))
        {
            $output .= json_encode($filteredArray);
        }

        $array = array(
            "goodEntries" => $totalEntries_good,
            "badEntries" => $totalEntries_bad,
            "entries" => $output
        );
        
        return $array;
    }

    //function for obtaining data about user (useragent and ip)
    public function getUserData(){
        $ip = "Unknown address";
        $user_agent = "Unknown user agent";
        $device = "Unknown device";

        //get ip address
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ip = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ip = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ip = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ip = $_SERVER['REMOTE_ADDR'];

        //get user agent
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        $array = array(
            "ip" => $ip,
            "useragent" => $user_agent
        );
        return $array;
    }
}
