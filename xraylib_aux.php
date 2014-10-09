<?php

include("geshi.php");
define("XRL_MACRO", 0);
define("XRL_FUNCTION", 1);
define("XRL_PROCEDURE", 2);

function expand_entity($entity, $type, $lang) {
	$rv;
	switch($lang) {
		case "C":
			$rv = $entity;
			break;
		case "Fortran":
			$rv = strtolower($entity);
			break;
		case "Perl":
			if ($type == XRL_MACRO){
				$rv = "\$xraylib::".$entity;
			}
			elseif ($type == XRL_FUNCTION){
				$rv = "xraylib::".$entity;
			}
			break;
		case "IDL":
			$rv = strtoupper($entity);
			break;
		case "Python":
			$rv = "xraylib.".$entity;
			break;
		case "Java":
			$rv = "xraylib.".$entity;
			break;
		case "Csharp":
			$rv = "XrayLib.".$entity;
			break;
		case "Lua":
			$rv = "xraylib.".$entity;
			break;
		case "Ruby":
			if ($type == XRL_MACRO){
				$rv = "Xraylib::".$entity;
			}
			elseif ($type == XRL_FUNCTION){
				$rv = "Xraylib.".$entity;
			}
			break;
		case "PHP":
			$rv = $entity;
			break;
	}

	return $rv;
}



function xraylib_enable($lang) {
	$rv;
	if ($lang == "C"){
		$rv = "#include <xraylib.h>";
	}
	elseif ($lang == "Fortran"){
		$rv = "use :: xraylib";
	}
	elseif ($lang == "Perl"){
		$rv = "use xraylib.pm;";
	}
	elseif ($lang == "IDL"){
		$rv = "@xraylib";
	}
	elseif ($lang == "Python"){
		$rv = "import xraylib";
	}
	elseif ($lang == "Java"){
		$rv = "static {
	System.loadLibrary(\"xraylib\");
}";
	}
	elseif ($lang == "Csharp"){
		$rv = "using Science;";
	}
	elseif ($lang == "Lua"){
		$rv = "require(\"xraylib\")";
	}
	elseif ($lang == "Ruby"){
		$rv = "require 'xraylib'";
	}
	elseif ($lang == "PHP"){
		$rv = "include(\"xraylib.php\");";
	}
	$geshi = new GeSHi($rv, strtolower($lang));
	$rv2 = $geshi->parse_code();
	return $rv2;
}

function stringify($string, $lang){
	$rv="";
	switch ($lang) {
		case "C":
		case "Perl":
		case "Python":
		case "Java":
		case "Csharp":
		case "Lua":
		case "Ruby":
		case "PHP":
			$rv = "\"".$string."\"";
			break;
		case "Fortran":
		case "IDL":
			$rv = "'".$string."'";
			break;
	}
	return $rv;
}

function display_none_all(){
	global $ElementStyle;
	global $CompoundStyle;
	global $ElementOrCompoundStyle;
	global $ShellStyle;
	global $EnergyStyle;
	global $ThetaStyle;
	global $PhiStyle;
	global $LinetypeStyle;
	global $MomentumTransferStyle;
	global $CKTransStyle;
	global $DensityStyle;
	global $PZStyle;
	global $AugerTransStyle;

	$ElementStyle="display:none";
	$CompoundStyle="display:none";
	$ElementOrCompoundStyle="display:none";
	$ShellStyle="display:none";
	$EnergyStyle="display:none";
	$ThetaStyle="display:none";
	$PhiStyle="display:none";
	$LinetypeStyle="display:none";
	$MomentumTransferStyle="display:none";
	$CKTransStyle="display:none";
	$DensityStyle="display:none";
	$PZStyle="display:none";
	$AugerTransStyle="display:none";
}

?>
