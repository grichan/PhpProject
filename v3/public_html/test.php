<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/12/2018
 * Time: 1:13 PM
 */


$cars = array
(
    array("Volvo",22,18),
    array("BMW",15,13),
    array("Saab",5,2),
    array("Land Rover",17,15)
);

$cars[0][2] = "Whatevs";
echo $cars[0][2];


$array = [[]];
$i = 0;
while ($row = mysqli_fetch_array($queryResult)){
    array[$i][0] = $row['id'];
    array[$i][1] = $row['name1'];
    array[$i][2] = $row['name2'];
    array[$i][3] = $row['phone'];
    array[$i][4] = $row['address'];
    array[$i][5] = $row['dep_id'];
    i++;
}
$db_arr=[$id, $name, $family, $phone, $address, $dep_id];
return $db_arr;
}