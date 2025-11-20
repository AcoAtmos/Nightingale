<?php 

function faktorial($n){
	if($n==1){
		return 1;
	}
	$hasil=$n*faktorial($n-1);
	// echo $hasil." ";
	return $hasil;
}


// 0 1 2 3 5 8 
fibonaci(6);
function fibonaci($n){
	if($n<=1){
		return $n;
	}
	$hasil=fibonaci($n-1)+fibonaci($n-2);
	echo "$n (".($n-1).") (".($n-2).") => $hasil<br>";
	return $hasil;
}

// 6 => f5 + f4
//      (f4 + f3) + (f3+f2)
//      (f3+f2) 			+ (f2+f1) + (f2+f1) + (f1)
//      (f2+f1) + (f2+f1)	+ (f1) + (f1) + (f1) +(f1)