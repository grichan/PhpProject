<?php
session_start();

if ( $_SESSION["logged_in"] == true){
    echo (  $_SESSION["naam"]);
} else {
    echo ("NO SESSION ");
}