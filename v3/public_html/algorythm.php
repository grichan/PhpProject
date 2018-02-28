<?php


    $str = "11232";
    $sorted = str_split($str);
    sort($sorted);
    $str = implode($sorted);

    echo "string: " . $str . "<br>";
    echo "length: " . strlen($str) . "<br>";

    $last_key = end($sorted);

    for ( $i = 0; $i < strlen($str); $i++){
        $ctr = 1;
        if ( $i == (strlen($str) - 2 ) ){
            break;
        }
        while ( $str[$i] == $str[$i+1]  ){
            $ctr+=1;
            if ( $i >= (strlen($str)-1)){

            } else {
                $i++;
            }
        }

        echo  $str[$i]. "=" . $ctr . "<br>";
    }
echo "<br>";    

    $array1 = array();
    for ( $i = 0; $i < strlen($str); $i++){
        $array1[$str[$i]] = 1;
        for ($j = $i+1; $j < strlen($str); $j++) {
            if ($str[$i] == $str[$j]) {
                $array1[$str[$i]] += 1;
                $i = $j;
            }
        }
    }
    foreach($array1 as $key => $value) {

        if ( ($value % 2) != 0 ){
            echo "$key = $value " . "odd number of repeats";
            echo "<br>";
        }

    }


echo "<br>";

// i i x
    function countcount($i, $counter, $string){
       if ( $i < strlen($string)-1){
           if ( $string[$i] == $string[$i+1]){
               $counter+=1;
               $counter = countcount(++$i, $counter, $string);
               return $i;
           } else return $i;
       } else return $i;
    }

    for ($i = 0; $i < strlen($str)-1; $i++){
        $j = countcount($i , 1, $str);
        echo $j;
        $i = $j;
    }


// Matrix Print Out
echo "<br>";
echo "<br>";
$n = 4;
$m = 4;
$array = array();



for ( $i = 0; $i < $n; $i++){
    for( $j = 0; $j < $m; $j++){
        if ( $i == $j){
            $array[$i][$j] = 1;
        } else
            $array[$i][$j] = 0;
    }
}

for ( $i = 0; $i < $n; $i++){
    for( $j = 0; $j < $m; $j++){
        echo $array[$i][$j];
    }
    echo "<br>";
}
echo "<br>";

// 1, 1, 2, 3, 2
$numbers = array( 1, 1, 2, 3, 2);
sort($numbers);
foreach ($numbers as $number) {
    echo $number;
}
echo "<br>";


for ( $i = 0; $i < count($numbers); $i++ ){
    $temp = 0;
    $result =0;
    for ( $j = $i; $j < count($numbers); $j++){
        if ( $numbers[$i] == $numbers[$j]){
            $result += $numbers[$i];
            $temp = $i;
        }
    }
    if ( ($result % (int)$numbers[$i]) == 0 ){
        echo $numbers[$i] . "  is " . $result ."<br>";
    }
}

echo "<br>";

$array1 = array();
for ( $i = 0; $i < strlen($str); $i++){
    $array1[$str[$i]] = 1;
    for ($j = $i+1; $j < strlen($str); $j++) {
        if ($str[$i] == $str[$j]) {
            $array1[$str[$i]] += 1;
            $i = $j;
        }
    }
}
foreach($array1 as $key => $value) {

    if ( ($value % 2) != 0 ){
        echo $key;
        echo "<br>";
    }
}

$masiv = array(1, 1, 2, 3, 2);
$result = 0;
foreach ( $masiv as $element){
    $result = $result ^ $element;
        
            }
echo $result;


echo "<br>";


?>