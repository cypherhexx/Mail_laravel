<?php
$number=2;
$ends = array('th','st','nd','rd','th','th','th','th','th','th');
if (($number %100) >= 11 && ($number%100) <= 13)
   echo $abbreviation = $number. 'th';
else
   echo $abbreviation = $number. $ends[$number % 10];