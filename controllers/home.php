<?php 

	$confidencial="Como se el encapsulamiento";
	$titulo='MejorandoPHP';
	//require 'conig.php';
	$language='PHP';

	//view('view',['language'=> $language,'titulo' =>$titulo]);

	view('home', compact('language','titulo'));

 ?>