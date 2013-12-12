<!DOCTYPE html>

<html lang=en>
<head>
<title>xraylib online calculator</title>

</head>
<body>
<?php 
if ($_SERVER['REMOTE_ADDR'] != "127.0.0.1") {
	//no need for this when using the localhost for testing
	include_once("analyticstracking.php");
}

include("xraylib.php");
include("xraylib_aux.php");
//error_reporting(E_WARNING);
//init
$xrlFunction="LineEnergy";
$Element="26";
$Linename="KL3_LINE";
$Shell="K_SHELL";
$Energy="10.0";
$Theta=1.5707964;
$Phi=3.14159;
$MomentumTransfer=0.57032;
$result="";
$commandC="";
$commandFortran="";
$commandPerl="";
$commandIDL="";
$commandPython="";
$commandJava="";
$commandCsharp="";
$commandLua="";
$commandRuby="";
$commandPHP="";
$unit="";

$ElementStyle="display:block";
$LinetypeStyle="display:block";
$ShellStyle="display:none";
$EnergyStyle="display:none";
$ThetaStyle="display:none";
$PhiStyle="display:none";
$MomentumTransferStyle="display:none";

$Language="C";
$codeExampleStyle="display:none";
$codeExampleCStyle="display:block";
$codeExampleFortranStyle="display:none";
$codeExamplePerlStyle="display:none";
$codeExampleIDLStyle="display:none";
$codeExamplePythonStyle="display:none";
$codeExampleJavaStyle="display:none";
$codeExampleCsharpStyle="display:none";
$codeExampleLuaStyle="display:none";
$codeExampleRubyStyle="display:none";
$codeExamplePHPStyle="display:none";

$includeSupportCStyle="display:block";
$includeSupportFortranStyle="display:none";
$includeSupportPerlStyle="display:none";
$includeSupportIDLStyle="display:none";
$includeSupportPythonStyle="display:none";
$includeSupportJavaStyle="display:none";
$includeSupportCsharpStyle="display:none";
$includeSupportLuaStyle="display:none";
$includeSupportRubyStyle="display:none";
$includeSupportPHPStyle="display:none";



if ($_SERVER["REQUEST_METHOD"] == "GET"){
if (isset($_GET["Element"])) {
	$Element = $_GET["Element"];
}
if (isset($_GET["Linename"])) {
	$Linename= $_GET["Linename"];
}
if (isset($_GET["Shell"])) {
	$Shell = $_GET["Shell"];
}
if (isset($_GET["xrlFunction"])) {
	$xrlFunction=$_GET['xrlFunction'];
}
if (isset($_GET["Language"])) {
	$Language=$_GET['Language'];
	$codeExampleCStyle="display:none";
	$codeExampleFortranStyle="display:none";
	$codeExamplePerlStyle="display:none";
	$codeExampleIDLStyle="display:none";
	$codeExamplePythonStyle="display:none";
	$codeExampleJavaStyle="display:none";
	$codeExampleCsharpStyle="display:none";
	$codeExampleLuaStyle="display:none";
	$codeExampleRubyStyle="display:none";
	$codeExamplePHPStyle="display:none";
	$includeSupportCStyle="display:none";
	$includeSupportFortranStyle="display:none";
	$includeSupportPerlStyle="display:none";
	$includeSupportIDLStyle="display:none";
	$includeSupportPythonStyle="display:none";
	$includeSupportJavaStyle="display:none";
	$includeSupportCsharpStyle="display:none";
	$includeSupportLuaStyle="display:none";
	$includeSupportRubyStyle="display:none";
	$includeSupportPHPStyle="display:none";

	switch ($Language) {
		case "C":
			$codeExampleCStyle="display:block";
			$includeSupportCStyle="display:block";
			break;
		case "Fortran":
			$codeExampleFortranStyle="display:block";
			$includeSupportFortranStyle="display:block";
			break;
		case "Perl":
			$codeExamplePerlStyle="display:block";
			$includeSupportPerlStyle="display:block";
			break;
		case "IDL":
			$codeExampleIDLStyle="display:block";
			$includeSupportIDLStyle="display:block";
			break;
		case "Python":
			$codeExamplePythonStyle="display:block";
			$includeSupportPythonStyle="display:block";
			break;
		case "Java":
			$codeExampleJavaStyle="display:block";
			$includeSupportJavaStyle="display:block";
			break;
		case "Csharp":
			$codeExampleCsharpStyle="display:block";
			$includeSupportCsharpStyle="display:block";
			break;
		case "Lua":
			$codeExampleLuaStyle="display:block";
			$includeSupportLuaStyle="display:block";
			break;
		case "Ruby":
			$codeExampleRubyStyle="display:block";
			$includeSupportRubyStyle="display:block";
			break;
		case "PHP":
			$codeExamplePHPStyle="display:block";
			$includeSupportPHPStyle="display:block";
			break;
	}
}
if (isset($_GET["Energy"])) {
	$Energy=$_GET['Energy'];
}
if (isset($_GET["Theta"])) {
	$Theta=$_GET['Theta'];
}
if (isset($_GET["Phi"])) {
	$Phi=$_GET['Phi'];
}
if (isset($_GET["MomentumTransfer"])) {
	$MomentumTransfer=$_GET['MomentumTransfer'];
}
if (isset($_GET['xrlFunction']) && $xrlFunction == "LineEnergy") {
	if (!is_numeric($Linename)) {
		//Linename is not an integer, so it should be one of the constants
		$realLinename = @constant($Linename);
		if (!isset($realLinename)) {
			$result=0.0;
			goto error;
		}
	}
	else {
		$result=0.0;
		goto error;
	}
	if (is_numeric($Element)) {
		$result = $xrlFunction($Element, $realLinename);
		$commandC = expand_entity($xrlFunction, XRL_FUNCTION, "C")."(".$Element.", ".expand_entity($Linename, XRL_MACRO, "C").")";
		$commandFortran = expand_entity($xrlFunction, XRL_FUNCTION, "Fortran")."(".$Element.", ".expand_entity($Linename, XRL_MACRO, "Fortran").")";
		$commandPerl = expand_entity($xrlFunction, XRL_FUNCTION, "Perl")."(".$Element.", ".expand_entity($Linename, XRL_MACRO, "Perl").")";
		$commandIDL = expand_entity($xrlFunction, XRL_FUNCTION, "IDL")."(".$Element.", ".expand_entity($Linename, XRL_MACRO, "IDL").")";
		$commandPython = expand_entity($xrlFunction, XRL_FUNCTION, "Python")."(".$Element.", ".expand_entity($Linename, XRL_MACRO, "Python").")";
		$commandJava = expand_entity($xrlFunction, XRL_FUNCTION, "Java")."(".$Element.", ".expand_entity($Linename, XRL_MACRO, "Java").")";
		$commandCsharp = expand_entity($xrlFunction, XRL_FUNCTION, "Csharp")."(".$Element.", ".expand_entity($Linename, XRL_MACRO, "Csharp").")";
		$commandLua = expand_entity($xrlFunction, XRL_FUNCTION, "Lua")."(".$Element.", ".expand_entity($Linename, XRL_MACRO, "Lua").")";
		$commandRuby = expand_entity($xrlFunction, XRL_FUNCTION, "Ruby")."(".$Element.", ".expand_entity($Linename, XRL_MACRO, "Ruby").")";
	}
	else {
		$result = $xrlFunction(SymbolToAtomicNumber($Element), $realLinename);
		$commandC = expand_entity($xrlFunction, XRL_FUNCTION, "C")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "C")."(".stringify($Element, "C")."), ".expand_entity($Linename, XRL_MACRO, "C").")";
		$commandFortran = expand_entity($xrlFunction, XRL_FUNCTION, "Fortran")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Fortran")."(".stringify($Element, "Fortran")."), ".expand_entity($Linename, XRL_MACRO, "Fortran").")";
		$commandPerl = expand_entity($xrlFunction, XRL_FUNCTION, "Perl")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Perl")."(".stringify($Element, "Perl")."), ".expand_entity($Linename, XRL_MACRO, "Perl").")";
		$commandIDL = expand_entity($xrlFunction, XRL_FUNCTION, "IDL")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "IDL")."(".stringify($Element, "IDL")."), ".expand_entity($Linename, XRL_MACRO, "IDL").")";
		$commandPython = expand_entity($xrlFunction, XRL_FUNCTION, "Python")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Python")."(".stringify($Element, "Python")."), ".expand_entity($Linename, XRL_MACRO, "Python").")";
		$commandJava = expand_entity($xrlFunction, XRL_FUNCTION, "Java")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Java")."(".stringify($Element, "Java")."), ".expand_entity($Linename, XRL_MACRO, "Java").")";
		$commandCsharp = expand_entity($xrlFunction, XRL_FUNCTION, "Csharp")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Csharp")."(".stringify($Element, "Csharp")."), ".expand_entity($Linename, XRL_MACRO, "Csharp").")";
		$commandLua = expand_entity($xrlFunction, XRL_FUNCTION, "Lua")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Lua")."(".stringify($Element, "Lua")."), ".expand_entity($Linename, XRL_MACRO, "Lua").")";
		$commandRuby = expand_entity($xrlFunction, XRL_FUNCTION, "Ruby")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Ruby")."(".stringify($Element, "Ruby")."), ".expand_entity($Linename, XRL_MACRO, "Ruby").")";
		$commandPHP = expand_entity($xrlFunction, XRL_FUNCTION, "PHP")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "PHP")."(".stringify($Element, "PHP")."), ".expand_entity($Linename, XRL_MACRO, "PHP").")";
	}
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	$unit=" keV";
	display_none_all();
	$ElementStyle="display:block";
	$LinetypeStyle="display:block";
	$codeExampleStyle="display:block";
}
elseif (isset($_GET['xrlFunction']) && $xrlFunction == "EdgeEnergy") {
	if (!is_numeric($Shell)) {
		//Shell is not an integer, so it should be one of the constants
		$realShell = @constant($Shell);
		if (!isset($realShell)) {
			$result=0.0;
			goto error;
		}
	}
	else {
		$result=0.0;
		goto error;
	}
	if (is_numeric($Element)) {
		$result = $xrlFunction($Element, $realShell);
		$commandC = expand_entity($xrlFunction, XRL_FUNCTION, "C")."(".$Element.", ".expand_entity($Shell, XRL_MACRO, "C").")";
		$commandFortran = expand_entity($xrlFunction, XRL_FUNCTION, "Fortran")."(".$Element.", ".expand_entity($Shell, XRL_MACRO, "Fortran").")";
		$commandPerl = expand_entity($xrlFunction, XRL_FUNCTION, "Perl")."(".$Element.", ".expand_entity($Shell, XRL_MACRO, "Perl").")";
		$commandIDL = expand_entity($xrlFunction, XRL_FUNCTION, "IDL")."(".$Element.", ".expand_entity($Shell, XRL_MACRO, "IDL").")";
		$commandPython = expand_entity($xrlFunction, XRL_FUNCTION, "Python")."(".$Element.", ".expand_entity($Shell, XRL_MACRO, "Python").")";
		$commandJava = expand_entity($xrlFunction, XRL_FUNCTION, "Java")."(".$Element.", ".expand_entity($Shell, XRL_MACRO, "Java").")";
		$commandCsharp = expand_entity($xrlFunction, XRL_FUNCTION, "Csharp")."(".$Element.", ".expand_entity($Shell, XRL_MACRO, "Csharp").")";
		$commandLua = expand_entity($xrlFunction, XRL_FUNCTION, "Lua")."(".$Element.", ".expand_entity($Shell, XRL_MACRO, "Lua").")";
		$commandRuby = expand_entity($xrlFunction, XRL_FUNCTION, "Ruby")."(".$Element.", ".expand_entity($Shell, XRL_MACRO, "Ruby").")";
		$commandPHP = expand_entity($xrlFunction, XRL_FUNCTION, "PHP")."(".$Element.", ".expand_entity($Shell, XRL_MACRO, "PHP").")";
	}
	else {
		$result = $xrlFunction(SymbolToAtomicNumber($Element), $realShell);
		$commandC = expand_entity($xrlFunction, XRL_FUNCTION, "C")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "C")."(".stringify($Element, "C")."), ".expand_entity($Shell, XRL_MACRO, "C").")";
		$commandFortran = expand_entity($xrlFunction, XRL_FUNCTION, "Fortran")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Fortran")."(".stringify($Element, "Fortran")."), ".expand_entity($Shell, XRL_MACRO, "Fortran").")";
		$commandPerl = expand_entity($xrlFunction, XRL_FUNCTION, "Perl")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Perl")."(".stringify($Element, "Perl")."), ".expand_entity($Shell, XRL_MACRO, "Perl").")";
		$commandIDL = expand_entity($xrlFunction, XRL_FUNCTION, "IDL")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "IDL")."(".stringify($Element, "IDL")."), ".expand_entity($Shell, XRL_MACRO, "IDL").")";
		$commandPython = expand_entity($xrlFunction, XRL_FUNCTION, "Python")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Python")."(".stringify($Element, "Python")."), ".expand_entity($Shell, XRL_MACRO, "Python").")";
		$commandJava = expand_entity($xrlFunction, XRL_FUNCTION, "Java")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Java")."(".stringify($Element, "Java")."), ".expand_entity($Shell, XRL_MACRO, "Java").")";
		$commandCsharp = expand_entity($xrlFunction, XRL_FUNCTION, "Csharp")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Csharp")."(".stringify($Element, "Csharp")."), ".expand_entity($Shell, XRL_MACRO, "Csharp").")";
		$commandLua = expand_entity($xrlFunction, XRL_FUNCTION, "Lua")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Lua")."(".stringify($Element, "Lua")."), ".expand_entity($Shell, XRL_MACRO, "Lua").")";
		$commandRuby = expand_entity($xrlFunction, XRL_FUNCTION, "Ruby")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Ruby")."(".stringify($Element, "Ruby")."), ".expand_entity($Shell, XRL_MACRO, "Ruby").")";
		$commandPHP = expand_entity($xrlFunction, XRL_FUNCTION, "PHP")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "PHP")."(".stringify($Element, "PHP")."), ".expand_entity($Shell, XRL_MACRO, "PHP").")";
	}
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	$unit=" keV";
	display_none_all();
	$ElementStyle="display:block";
	$ShellStyle="display:block";
	$codeExampleStyle="display:block";
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "AtomicWeight" || $xrlFunction == "ElementDensity")) {
	if (is_numeric($Element)) {
		$result = $xrlFunction($Element);
		$commandC = expand_entity($xrlFunction, XRL_FUNCTION, "C")."(".$Element.")";
		$commandFortran = expand_entity($xrlFunction, XRL_FUNCTION, "Fortran")."(".$Element.")";
		$commandPerl = expand_entity($xrlFunction, XRL_FUNCTION, "Perl")."(".$Element.")";
		$commandIDL = expand_entity($xrlFunction, XRL_FUNCTION, "IDL")."(".$Element.")";
		$commandPython = expand_entity($xrlFunction, XRL_FUNCTION, "Python")."(".$Element.")";
		$commandJava = expand_entity($xrlFunction, XRL_FUNCTION, "Java")."(".$Element.")";
		$commandCsharp = expand_entity($xrlFunction, XRL_FUNCTION, "Csharp")."(".$Element.")";
		$commandLua = expand_entity($xrlFunction, XRL_FUNCTION, "Lua")."(".$Element.")";
		$commandRuby = expand_entity($xrlFunction, XRL_FUNCTION, "Ruby")."(".$Element.")";
		$commandPHP = expand_entity($xrlFunction, XRL_FUNCTION, "PHP")."(".$Element.")";
	}
	else {
		$result = $xrlFunction(SymbolToAtomicNumber($Element));
		$commandC = expand_entity($xrlFunction, XRL_FUNCTION, "C")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "C")."(".stringify($Element, "C")."))";
		$commandFortran = expand_entity($xrlFunction, XRL_FUNCTION, "Fortran")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Fortran")."(".stringify($Element, "Fortran")."))";
		$commandPerl = expand_entity($xrlFunction, XRL_FUNCTION, "Perl")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Perl")."(".stringify($Element, "Perl")."))";
		$commandIDL = expand_entity($xrlFunction, XRL_FUNCTION, "IDL")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "IDL")."(".stringify($Element, "IDL")."))";
		$commandPython = expand_entity($xrlFunction, XRL_FUNCTION, "Python")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Python")."(".stringify($Element, "Python")."))";
		$commandJava = expand_entity($xrlFunction, XRL_FUNCTION, "Java")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Java")."(".stringify($Element, "Java")."))";
		$commandCsharp = expand_entity($xrlFunction, XRL_FUNCTION, "Csharp")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Csharp")."(".stringify($Element, "Csharp")."))";
		$commandLua = expand_entity($xrlFunction, XRL_FUNCTION, "Lua")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Lua")."(".stringify($Element, "Lua")."))";
		$commandRuby = expand_entity($xrlFunction, XRL_FUNCTION, "Ruby")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Ruby")."(".stringify($Element, "Ruby")."))";
		$commandPHP = expand_entity($xrlFunction, XRL_FUNCTION, "PHP")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "PHP")."(".stringify($Element, "PHP")."))";
	}
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	if ($xrlFunction == "AtomicWeight"){
		$unit=" g/mol";
	}
	elseif ($xrlFunction == "ElementDensity"){
		$unit=" g/cm<sup>3</sup>";
	}
	display_none_all();
	$ElementStyle="display:block";
	$codeExampleStyle="display:block";

}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "CS_Total" || $xrlFunction == "CS_Photo" ||
	$xrlFunction == "CS_Rayl" || $xrlFunction == "CS_Compt" ||
	$xrlFunction == "CSb_Total" || $xrlFunction == "CSb_Photo" ||
	$xrlFunction == "CSb_Rayl" || $xrlFunction == "CSb_Compt" ||
	$xrlFunction == "CS_Energy"
	)) {
	if (!is_numeric($Energy) || $Energy <= 0.0 || $Energy >= 100.0) {
		$result=0.0;
		goto error;
	}
	if (is_numeric($Element)) {
		$result = $xrlFunction($Element, $Energy);
		$commandC = expand_entity($xrlFunction, XRL_FUNCTION, "C")."(".$Element.", ".$Energy.")";
		$commandFortran = expand_entity($xrlFunction, XRL_FUNCTION, "Fortran")."(".$Element.", ".$Energy.")";
		$commandPerl = expand_entity($xrlFunction, XRL_FUNCTION, "Perl")."(".$Element.", ".$Energy.")";
		$commandIDL = expand_entity($xrlFunction, XRL_FUNCTION, "IDL")."(".$Element.", ".$Energy.")";
		$commandPython = expand_entity($xrlFunction, XRL_FUNCTION, "Python")."(".$Element.", ".$Energy.")";
		$commandJava = expand_entity($xrlFunction, XRL_FUNCTION, "Java")."(".$Element.", ".$Energy.")";
		$commandCsharp = expand_entity($xrlFunction, XRL_FUNCTION, "Csharp")."(".$Element.", ".$Energy.")";
		$commandLua = expand_entity($xrlFunction, XRL_FUNCTION, "Lua")."(".$Element.", ".$Energy.")";
		$commandRuby = expand_entity($xrlFunction, XRL_FUNCTION, "Ruby")."(".$Element.", ".$Energy.")";
		$commandPHP = expand_entity($xrlFunction, XRL_FUNCTION, "PHP")."(".$Element.", ".$Energy.")";
	}
	else {
		$result = $xrlFunction(SymbolToAtomicNumber($Element), $Energy);
		$commandC = expand_entity($xrlFunction, XRL_FUNCTION, "C")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "C")."(".stringify($Element, "C")."), ".$Energy.")";
		$commandFortran = expand_entity($xrlFunction, XRL_FUNCTION, "Fortran")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Fortran")."(".stringify($Element, "Fortran")."), ".$Energy.")";
		$commandPerl = expand_entity($xrlFunction, XRL_FUNCTION, "Perl")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Perl")."(".stringify($Element, "Perl")."), ".$Energy.")";
		$commandIDL = expand_entity($xrlFunction, XRL_FUNCTION, "IDL")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "IDL")."(".stringify($Element, "IDL")."), ".$Energy.")";
		$commandPython = expand_entity($xrlFunction, XRL_FUNCTION, "Python")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Python")."(".stringify($Element, "Python")."), ".$Energy.")";
		$commandJava = expand_entity($xrlFunction, XRL_FUNCTION, "Java")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Java")."(".stringify($Element, "Java")."), ".$Energy.")";
		$commandCsharp = expand_entity($xrlFunction, XRL_FUNCTION, "Csharp")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Csharp")."(".stringify($Element, "Csharp")."), ".$Energy.")";
		$commandLua = expand_entity($xrlFunction, XRL_FUNCTION, "Lua")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Lua")."(".stringify($Element, "Lua")."), ".$Energy.")";
		$commandRuby = expand_entity($xrlFunction, XRL_FUNCTION, "Ruby")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Ruby")."(".stringify($Element, "Ruby")."), ".$Energy.")";
		$commandPHP = expand_entity($xrlFunction, XRL_FUNCTION, "PHP")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "PHP")."(".stringify($Element, "PHP")."), ".$Energy.")";
	}
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	if (substr($xrlFunction,0,3) == "CSb"){
		$unit=" barns/atom";
	}
	else {
		$unit=" cm<sup>2</sup>/g";
	}
	display_none_all();
	$ElementStyle="display:block";
	$EnergyStyle="display:block";
	$codeExampleStyle="display:block";

}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "CS_KN")) {
	if (!is_numeric($Energy) || $Energy <= 0.0 || $Energy >= 100.0) {
		$result=0.0;
		goto error;
	}
	$result = $xrlFunction($Energy);
	$commandC = expand_entity($xrlFunction, XRL_FUNCTION, "C")."(".$Energy.")";
	$commandFortran = expand_entity($xrlFunction, XRL_FUNCTION, "Fortran")."(".$Energy.")";
	$commandPerl = expand_entity($xrlFunction, XRL_FUNCTION, "Perl")."(".$Energy.")";
	$commandIDL = expand_entity($xrlFunction, XRL_FUNCTION, "IDL")."(".$Energy.")";
	$commandPython = expand_entity($xrlFunction, XRL_FUNCTION, "Python")."(".$Energy.")";
	$commandJava = expand_entity($xrlFunction, XRL_FUNCTION, "Java")."(".$Energy.")";
	$commandCsharp = expand_entity($xrlFunction, XRL_FUNCTION, "Csharp")."(".$Energy.")";
	$commandLua = expand_entity($xrlFunction, XRL_FUNCTION, "Lua")."(".$Energy.")";
	$commandRuby = expand_entity($xrlFunction, XRL_FUNCTION, "Ruby")."(".$Energy.")";
	$commandPHP = expand_entity($xrlFunction, XRL_FUNCTION, "PHP")."(".$Energy.")";
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	$unit=" cm<sup>2</sup>/g";
	display_none_all();
	$EnergyStyle="display:block";
	$codeExampleStyle="display:block";
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "DCS_Thoms")) {
	if (!is_numeric($Theta) || $Theta < 0.0 || $Theta > PI) {
		$result=0.0;
		goto error;
	}
	$result = $xrlFunction($Theta);
	$commandC = expand_entity($xrlFunction, XRL_FUNCTION, "C")."(".$Theta.")";
	$commandFortran = expand_entity($xrlFunction, XRL_FUNCTION, "Fortran")."(".$Theta.")";
	$commandPerl = expand_entity($xrlFunction, XRL_FUNCTION, "Perl")."(".$Theta.")";
	$commandIDL = expand_entity($xrlFunction, XRL_FUNCTION, "IDL")."(".$Theta.")";
	$commandPython = expand_entity($xrlFunction, XRL_FUNCTION, "Python")."(".$Theta.")";
	$commandJava = expand_entity($xrlFunction, XRL_FUNCTION, "Java")."(".$Theta.")";
	$commandCsharp = expand_entity($xrlFunction, XRL_FUNCTION, "Csharp")."(".$Theta.")";
	$commandLua = expand_entity($xrlFunction, XRL_FUNCTION, "Lua")."(".$Theta.")";
	$commandRuby = expand_entity($xrlFunction, XRL_FUNCTION, "Ruby")."(".$Theta.")";
	$commandPHP = expand_entity($xrlFunction, XRL_FUNCTION, "PHP")."(".$Theta.")";
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	$unit=" cm<sup>2</sup>/g/sr";
	display_none_all();
	$ThetaStyle="display:block";
	$codeExampleStyle="display:block";
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "DCS_KN")) {
	if (!is_numeric($Energy) || $Energy <= 0.0 || $Energy >= 100.0) {
		$result=0.0;
		goto error;
	}
	if (!is_numeric($Theta) || $Theta < 0.0 || $Theta > PI) {
		$result=0.0;
		goto error;
	}
	$result = $xrlFunction($Energy, $Theta);
	$commandC = expand_entity($xrlFunction, XRL_FUNCTION, "C")."(".$Energy.", ".$Theta.")";
	$commandFortran = expand_entity($xrlFunction, XRL_FUNCTION, "Fortran")."(".$Energy.", ".$Theta.")";
	$commandPerl = expand_entity($xrlFunction, XRL_FUNCTION, "Perl")."(".$Energy.", ".$Theta.")";
	$commandIDL = expand_entity($xrlFunction, XRL_FUNCTION, "IDL")."(".$Energy.", ".$Theta.")";
	$commandPython = expand_entity($xrlFunction, XRL_FUNCTION, "Python")."(".$Energy.", ".$Theta.")";
	$commandJava = expand_entity($xrlFunction, XRL_FUNCTION, "Java")."(".$Energy.", ".$Theta.")";
	$commandCsharp = expand_entity($xrlFunction, XRL_FUNCTION, "Csharp")."(".$Energy.", ".$Theta.")";
	$commandLua = expand_entity($xrlFunction, XRL_FUNCTION, "Lua")."(".$Energy.", ".$Theta.")";
	$commandRuby = expand_entity($xrlFunction, XRL_FUNCTION, "Ruby")."(".$Energy.", ".$Theta.")";
	$commandPHP = expand_entity($xrlFunction, XRL_FUNCTION, "PHP")."(".$Energy.", ".$Theta.")";
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	$unit=" cm<sup>2</sup>/g/sr";
	display_none_all();
	$EnergyStyle="display:block";
	$ThetaStyle="display:block";
	$codeExampleStyle="display:block";
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "DCS_Rayl" ||
	$xrlFunction == "DCS_Compt" ||
	$xrlFunction == "DCSb_Rayl" ||
	$xrlFunction == "DCSb_Compt")) {
	if (!is_numeric($Energy) || $Energy <= 0.0 || $Energy >= 100.0) {
		$result=0.0;
		goto error;
	}
	if (!is_numeric($Theta) || $Theta < 0.0 || $Theta > PI) {
		$result=0.0;
		goto error;
	}
	if (is_numeric($Element)) {
		$result = $xrlFunction($Element, $Energy, $Theta);
		$commandC = expand_entity($xrlFunction, XRL_FUNCTION,  "C")."(".$Element.", ".$Energy.", ".$Theta.")";
		$commandFortran = expand_entity($xrlFunction, XRL_FUNCTION,  "Fortran")."(".$Element.", ".$Energy.", ".$Theta.")";
		$commandPerl = expand_entity($xrlFunction, XRL_FUNCTION,  "Perl")."(".$Element.", ".$Energy.", ".$Theta.")";
		$commandIDL = expand_entity($xrlFunction, XRL_FUNCTION,  "IDL")."(".$Element.", ".$Energy.", ".$Theta.")";
		$commandPython = expand_entity($xrlFunction, XRL_FUNCTION,  "Python")."(".$Element.", ".$Energy.", ".$Theta.")";
		$commandJava = expand_entity($xrlFunction, XRL_FUNCTION,  "Java")."(".$Element.", ".$Energy.", ".$Theta.")";
		$commandCsharp = expand_entity($xrlFunction, XRL_FUNCTION,  "Csharp")."(".$Element.", ".$Energy.", ".$Theta.")";
		$commandLua = expand_entity($xrlFunction, XRL_FUNCTION,  "Lua")."(".$Element.", ".$Energy.", ".$Theta.")";
		$commandRuby = expand_entity($xrlFunction, XRL_FUNCTION,  "Ruby")."(".$Element.", ".$Energy.", ".$Theta.")";
		$commandPHP = expand_entity($xrlFunction, XRL_FUNCTION,  "PHP")."(".$Element.", ".$Energy.", ".$Theta.")";
	}
	else {
		$result = $xrlFunction(SymbolToAtomicNumber($Element), $Energy, $Theta);
		$commandC = expand_entity($xrlFunction, XRL_FUNCTION, "C")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "C")."(".stringify($Element, "C")."), ".$Energy.", ".$Theta.")";
		$commandFortran = expand_entity($xrlFunction, XRL_FUNCTION, "Fortran")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Fortran")."(".stringify($Element, "Fortran")."), ".$Energy.", ".$Theta.")";
		$commandPerl = expand_entity($xrlFunction, XRL_FUNCTION, "Perl")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Perl")."(".stringify($Element, "Perl")."), ".$Energy.", ".$Theta.")";
		$commandIDL = expand_entity($xrlFunction, XRL_FUNCTION, "IDL")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "IDL")."(".stringify($Element, "IDL")."), ".$Energy.", ".$Theta.")";
		$commandPython = expand_entity($xrlFunction, XRL_FUNCTION, "Python")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Python")."(".stringify($Element, "Python")."), ".$Energy.", ".$Theta.")";
		$commandJava = expand_entity($xrlFunction, XRL_FUNCTION, "Java")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Java")."(".stringify($Element, "Java")."), ".$Energy.", ".$Theta.")";
		$commandCsharp = expand_entity($xrlFunction, XRL_FUNCTION, "Csharp")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Csharp")."(".stringify($Element, "Csharp")."), ".$Energy.", ".$Theta.")";
		$commandLua = expand_entity($xrlFunction, XRL_FUNCTION, "Lua")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Lua")."(".stringify($Element, "Lua")."), ".$Energy.", ".$Theta.")";
		$commandRuby = expand_entity($xrlFunction, XRL_FUNCTION, "Ruby")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Ruby")."(".stringify($Element, "Ruby")."), ".$Energy.", ".$Theta.")";
		$commandPHP = expand_entity($xrlFunction, XRL_FUNCTION, "PHP")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "PHP")."(".stringify($Element, "PHP")."), ".$Energy.", ".$Theta.")";
	}
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	if (substr($xrlFunction,0,4) == "DCSb"){
		$unit=" barns/atom/sr";
	}
	else {
		$unit=" cm<sup>2</sup>/g/sr";
	}
	display_none_all();
	$EnergyStyle="display:block";
	$ThetaStyle="display:block";
	$ElementStyle="display:block";
	$codeExampleStyle="display:block";
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "DCSP_Thoms")) {
	if (!is_numeric($Theta) || $Theta < 0.0 || $Theta > PI) {
		$result=0.0;
		goto error;
	}
	if (!is_numeric($Phi) || $Phi < 0.0 || $Phi > 2*PI) {
		$result=0.0;
		goto error;
	}
	$result = $xrlFunction($Theta, $Phi);
	$commandC = expand_entity($xrlFunction, XRL_FUNCTION, "C")."(".$Theta.", ".$Phi.")";
	$commandFortran = expand_entity($xrlFunction, XRL_FUNCTION, "Fortran")."(".$Theta.", ".$Phi.")";
	$commandPerl = expand_entity($xrlFunction, XRL_FUNCTION, "Perl")."(".$Theta.", ".$Phi.")";
	$commandIDL = expand_entity($xrlFunction, XRL_FUNCTION, "IDL")."(".$Theta.", ".$Phi.")";
	$commandPython = expand_entity($xrlFunction, XRL_FUNCTION, "Python")."(".$Theta.", ".$Phi.")";
	$commandJava = expand_entity($xrlFunction, XRL_FUNCTION, "Java")."(".$Theta.", ".$Phi.")";
	$commandCsharp = expand_entity($xrlFunction, XRL_FUNCTION, "Csharp")."(".$Theta.", ".$Phi.")";
	$commandLua = expand_entity($xrlFunction, XRL_FUNCTION, "Lua")."(".$Theta.", ".$Phi.")";
	$commandRuby = expand_entity($xrlFunction, XRL_FUNCTION, "Ruby")."(".$Theta.", ".$Phi.")";
	$commandPHP = expand_entity($xrlFunction, XRL_FUNCTION, "PHP")."(".$Theta.", ".$Phi.")";
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	$unit=" cm<sup>2</sup>/g/sr";
	display_none_all();
	$ThetaStyle="display:block";
	$PhiStyle="display:block";
	$codeExampleStyle="display:block";
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "DCSP_KN")) {
	if (!is_numeric($Energy) || $Energy <= 0.0 || $Energy >= 100.0) {
		$result=0.0;
		goto error;
	}
	if (!is_numeric($Theta) || $Theta < 0.0 || $Theta > PI) {
		$result=0.0;
		goto error;
	}
	if (!is_numeric($Phi) || $Phi < 0.0 || $Phi > 2*PI) {
		$result=0.0;
		goto error;
	}
	$result = $xrlFunction($Energy, $Theta, $Phi);
	$commandC = expand_entity($xrlFunction, XRL_FUNCTION, "C")."(".$Energy.", ".$Theta.", ".$Phi.")";
	$commandFortran = expand_entity($xrlFunction, XRL_FUNCTION, "Fortran")."(".$Energy.", ".$Theta.", ".$Phi.")";
	$commandPerl = expand_entity($xrlFunction, XRL_FUNCTION, "Perl")."(".$Energy.", ".$Theta.", ".$Phi.")";
	$commandIDL = expand_entity($xrlFunction, XRL_FUNCTION, "IDL")."(".$Energy.", ".$Theta.", ".$Phi.")";
	$commandPython = expand_entity($xrlFunction, XRL_FUNCTION, "Python")."(".$Energy.", ".$Theta.", ".$Phi.")";
	$commandJava = expand_entity($xrlFunction, XRL_FUNCTION, "Java")."(".$Energy.", ".$Theta.", ".$Phi.")";
	$commandCsharp = expand_entity($xrlFunction, XRL_FUNCTION, "Csharp")."(".$Energy.", ".$Theta.", ".$Phi.")";
	$commandLua = expand_entity($xrlFunction, XRL_FUNCTION, "Lua")."(".$Energy.", ".$Theta.", ".$Phi.")";
	$commandRuby = expand_entity($xrlFunction, XRL_FUNCTION, "Ruby")."(".$Energy.", ".$Theta.", ".$Phi.")";
	$commandPHP = expand_entity($xrlFunction, XRL_FUNCTION, "PHP")."(".$Energy.", ".$Theta.", ".$Phi.")";
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	$unit=" cm<sup>2</sup>/g/sr";
	display_none_all();
	$EnergyStyle="display:block";
	$ThetaStyle="display:block";
	$PhiStyle="display:block";
	$codeExampleStyle="display:block";
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "DCSP_Rayl" ||
	$xrlFunction == "DCSP_Compt" ||
	$xrlFunction == "DCSPb_Rayl" ||
	$xrlFunction == "DCSPb_Compt")) {
	if (!is_numeric($Energy) || $Energy <= 0.0 || $Energy >= 100.0) {
		$result=0.0;
		goto error;
	}
	if (!is_numeric($Theta) || $Theta < 0.0 || $Theta > PI) {
		$result=0.0;
		goto error;
	}
	if (!is_numeric($Phi) || $Phi < 0.0 || $Phi > 2*PI) {
		$result=0.0;
		goto error;
	}
	if (is_numeric($Element)) {
		$result = $xrlFunction($Element, $Energy, $Theta, $Phi);
		$commandC = expand_entity($xrlFunction, XRL_FUNCTION, "C")."(".$Element.", ".$Energy.", ".$Theta.", ".$Phi.")";
		$commandFortran = expand_entity($xrlFunction, XRL_FUNCTION, "Fortran")."(".$Element.", ".$Energy.", ".$Theta.", ".$Phi.")";
		$commandPerl = expand_entity($xrlFunction, XRL_FUNCTION, "Perl")."(".$Element.", ".$Energy.", ".$Theta.", ".$Phi.")";
		$commandIDL = expand_entity($xrlFunction, XRL_FUNCTION, "IDL")."(".$Element.", ".$Energy.", ".$Theta.", ".$Phi.")";
		$commandPython = expand_entity($xrlFunction, XRL_FUNCTION, "Python")."(".$Element.", ".$Energy.", ".$Theta.", ".$Phi.")";
		$commandJava = expand_entity($xrlFunction, XRL_FUNCTION, "Java")."(".$Element.", ".$Energy.", ".$Theta.", ".$Phi.")";
		$commandCsharp = expand_entity($xrlFunction, XRL_FUNCTION, "Csharp")."(".$Element.", ".$Energy.", ".$Theta.", ".$Phi.")";
		$commandLua = expand_entity($xrlFunction, XRL_FUNCTION, "Lua")."(".$Element.", ".$Energy.", ".$Theta.", ".$Phi.")";
		$commandRuby = expand_entity($xrlFunction, XRL_FUNCTION, "Ruby")."(".$Element.", ".$Energy.", ".$Theta.", ".$Phi.")";
		$commandPHP = expand_entity($xrlFunction, XRL_FUNCTION, "PHP")."(".$Element.", ".$Energy.", ".$Theta.", ".$Phi.")";
	}
	else {
		$result = $xrlFunction(SymbolToAtomicNumber($Element), $Energy, $Theta, $Phi);
		$commandC = expand_entity($xrlFunction, XRL_FUNCTION, "C")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "C")."(".stringify($Element, "C")."), ".$Energy.", ".$Theta.", ".$Phi.")";
		$commandFortran = expand_entity($xrlFunction, XRL_FUNCTION, "Fortran")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Fortran")."(".stringify($Element, "Fortran")."), ".$Energy.", ".$Theta.", ".$Phi.")";
		$commandPerl = expand_entity($xrlFunction, XRL_FUNCTION, "Perl")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Perl")."(".stringify($Element, "Perl")."), ".$Energy.", ".$Theta.", ".$Phi.")";
		$commandIDL = expand_entity($xrlFunction, XRL_FUNCTION, "IDL")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "IDL")."(".stringify($Element, "IDL")."), ".$Energy.", ".$Theta.", ".$Phi.")";
		$commandPython = expand_entity($xrlFunction, XRL_FUNCTION, "Python")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Python")."(".stringify($Element, "Python")."), ".$Energy.", ".$Theta.", ".$Phi.")";
		$commandJava = expand_entity($xrlFunction, XRL_FUNCTION, "Java")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Java")."(".stringify($Element, "Java")."), ".$Energy.", ".$Theta.", ".$Phi.")";
		$commandCsharp = expand_entity($xrlFunction, XRL_FUNCTION, "Csharp")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Csharp")."(".stringify($Element, "Csharp")."), ".$Energy.", ".$Theta.", ".$Phi.")";
		$commandLua = expand_entity($xrlFunction, XRL_FUNCTION, "Lua")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Lua")."(".stringify($Element, "Lua")."), ".$Energy.", ".$Theta.", ".$Phi.")";
		$commandRuby = expand_entity($xrlFunction, XRL_FUNCTION, "Ruby")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Ruby")."(".stringify($Element, "Ruby")."), ".$Energy.", ".$Theta.", ".$Phi.")";
		$commandPHP = expand_entity($xrlFunction, XRL_FUNCTION, "PHP")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "PHP")."(".stringify($Element, "PHP")."), ".$Energy.", ".$Theta.", ".$Phi.")";
	}
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	if (substr($xrlFunction,0,5) == "DCSPb"){
		$unit=" barns/atom/sr";
	}
	else {
		$unit=" cm<sup>2</sup>/g/sr";
	}
	display_none_all();
	$EnergyStyle="display:block";
	$ThetaStyle="display:block";
	$ElementStyle="display:block";
	$PhiStyle="display:block";
	$codeExampleStyle="display:block";
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "FF_Rayl" ||
	$xrlFunction == "SF_Compt")) {
	if (!is_numeric($MomentumTransfer)) {
		$result=0.0;
		goto error;
	}
	if (is_numeric($Element)) {
		$result = $xrlFunction($Element, $MomentumTransfer);
		$commandC = expand_entity($xrlFunction, XRL_FUNCTION, "C")."(".$Element.", ".$MomentumTransfer.")";
		$commandFortran = expand_entity($xrlFunction, XRL_FUNCTION, "Fortran")."(".$Element.", ".$MomentumTransfer.")";
		$commandPerl = expand_entity($xrlFunction, XRL_FUNCTION, "Perl")."(".$Element.", ".$MomentumTransfer.")";
		$commandIDL = expand_entity($xrlFunction, XRL_FUNCTION, "IDL")."(".$Element.", ".$MomentumTransfer.")";
		$commandPython = expand_entity($xrlFunction, XRL_FUNCTION, "Python")."(".$Element.", ".$MomentumTransfer.")";
		$commandJava = expand_entity($xrlFunction, XRL_FUNCTION, "Java")."(".$Element.", ".$MomentumTransfer.")";
		$commandCsharp = expand_entity($xrlFunction, XRL_FUNCTION, "Csharp")."(".$Element.", ".$MomentumTransfer.")";
		$commandLua = expand_entity($xrlFunction, XRL_FUNCTION, "Lua")."(".$Element.", ".$MomentumTransfer.")";
		$commandRuby = expand_entity($xrlFunction, XRL_FUNCTION, "Ruby")."(".$Element.", ".$MomentumTransfer.")";
		$commandPHP = expand_entity($xrlFunction, XRL_FUNCTION, "PHP")."(".$Element.", ".$MomentumTransfer.")";
	}
	else {
		$result = $xrlFunction(SymbolToAtomicNumber($Element), $MomentumTransfer);
		$commandC = expand_entity($xrlFunction, XRL_FUNCTION, "C")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "C")."(".stringify($Element, "C")."), ".$MomentumTransfer.")";
		$commandFortran = expand_entity($xrlFunction, XRL_FUNCTION, "Fortran")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Fortran")."(".stringify($Element, "Fortran")."), ".$MomentumTransfer.")";
		$commandPerl = expand_entity($xrlFunction, XRL_FUNCTION, "Perl")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Perl")."(".stringify($Element, "Perl")."), ".$MomentumTransfer.")";
		$commandIDL = expand_entity($xrlFunction, XRL_FUNCTION, "IDL")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "IDL")."(".stringify($Element, "IDL")."), ".$MomentumTransfer.")";
		$commandPython = expand_entity($xrlFunction, XRL_FUNCTION, "Python")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Python")."(".stringify($Element, "Python")."), ".$MomentumTransfer.")";
		$commandJava = expand_entity($xrlFunction, XRL_FUNCTION, "Java")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Java")."(".stringify($Element, "Java")."), ".$MomentumTransfer.")";
		$commandCsharp = expand_entity($xrlFunction, XRL_FUNCTION, "Csharp")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Csharp")."(".stringify($Element, "Csharp")."), ".$MomentumTransfer.")";
		$commandLua = expand_entity($xrlFunction, XRL_FUNCTION, "Lua")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Lua")."(".stringify($Element, "Lua")."), ".$MomentumTransfer.")";
		$commandRuby = expand_entity($xrlFunction, XRL_FUNCTION, "Ruby")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "Ruby")."(".stringify($Element, "Ruby")."), ".$MomentumTransfer.")";
		$commandPHP = expand_entity($xrlFunction, XRL_FUNCTION, "PHP")."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, "PHP")."(".stringify($Element, "PHP")."), ".$MomentumTransfer.")";
	}
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
		$unit = "";
	}
	display_none_all();
	$ElementStyle="display:block";
	$MomentumTransferStyle="display:block";
	$codeExampleStyle="display:block";
	
}

//error handling
error:
if (isset($_GET['xrlFunction']) && $result == 0.0) {
	$result = $xrlFunction.": Invalid input or zero was returned";
	$unit = "";
	$command = "";
	$codeExampleStyle="display:none";
}
}
?>

<h1>xraylib: the official online calculator!</h1>

<p>This webpage is built around <i>xraylib</i>, an ANSI-C library designed to provide convenient access to physical data in the field of interactions of X-rays with matter. The library comes with bindings to a large number of languages such as Python, Perl, Fortran, PHP (used to power this website) and several others. For all information concerning the library, have a look at the <a href="http://github.com/tschoonj/xraylib"><i>xraylib Github repository</i></a>.</p>
<br/>
<p>Through the interface provided here, you should be able to perform simple queries from the database. With the instructions provided in the <a href="http://github.com/tschoonj/xraylib/wiki"><i>online manual</i></a>, you will be able to integrate similar queries directly into your own applications using one of the bindings we offer.</p>
<br/>
<p>This website is currently under construction, and will be expanded soon over the next couple of weeks. The goal is to make all functions that make up the <i>xraylib</i> API, available through this interface.</p>

<br/>
<p>
<form method="get" action="<?php echo $_SERVER["PHP_SELF"];?>">
Function: <select onchange="optionCheckFunction(this)" name="xrlFunction" id="xrlFunction">
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'LineEnergy') { ?>selected="true" <?php }; ?>value="LineEnergy" selected="selected">Fluorescence line energy</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'EdgeEnergy') { ?>selected="true" <?php }; ?>value="EdgeEnergy">Absorption edge energy</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'AtomicWeight') { ?>selected="true" <?php }; ?>value="AtomicWeight">Atomic weight</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'ElementDensity') { ?>selected="true" <?php }; ?>value="ElementDensity">Elemental density</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'CS_Total') { ?>selected="true" <?php }; ?>value="CS_Total">Total absorption cross section</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'CS_Photo') { ?>selected="true" <?php }; ?>value="CS_Photo">Photoionization cross section</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'CS_Rayl') { ?>selected="true" <?php }; ?>value="CS_Rayl">Rayleigh scattering cross section</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'CS_Compt') { ?>selected="true" <?php }; ?>value="CS_Compt">Compton scattering cross section</option>
<!--  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'CSb_Total') { ?>selected="true" <?php }; ?>value="CSb_Total">CSb_Total</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'CSb_Photo') { ?>selected="true" <?php }; ?>value="CSb_Photo">CSb_Photo</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'CSb_Rayl') { ?>selected="true" <?php }; ?>value="CSb_Rayl">CSb_Rayl</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'CSb_Compt') { ?>selected="true" <?php }; ?>value="CSb_Compt">CSb_Compt</option>-->
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'CS_KN') { ?>selected="true" <?php }; ?>value="CS_KN">Klein-Nishina cross section</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'CS_Energy') { ?>selected="true" <?php }; ?>value="CS_Energy">Mass energy-absorption cross section</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'DCS_KN') { ?>selected="true" <?php }; ?>value="DCS_KN">Differential unpolarized Klein-Nishina cross section</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'DCS_Thoms') { ?>selected="true" <?php }; ?>value="DCS_Thoms">Differential unpolarized Thomson cross section</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'DCS_Rayl') { ?>selected="true" <?php }; ?>value="DCS_Rayl">Differential unpolarized Rayleigh cross section</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'DCS_Compt') { ?>selected="true" <?php }; ?>value="DCS_Compt">Differential unpolarized Compton cross section</option>
<!--  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'DCSb_Rayl') { ?>selected="true" <?php }; ?>value="DCSb_Rayl">DCSb_Rayl</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'DCSb_Compt') { ?>selected="true" <?php }; ?>value="DCSb_Compt">DCSb_Compt</option>-->
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'DCSP_KN') { ?>selected="true" <?php }; ?>value="DCSP_KN">Differential polarized Klein-Nishina cross section</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'DCSP_Thoms') { ?>selected="true" <?php }; ?>value="DCSP_Thoms">Differential polarized Thomson cross section</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'DCSP_Rayl') { ?>selected="true" <?php }; ?>value="DCSP_Rayl">Differential polarized Rayleigh cross section</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'DCSP_Compt') { ?>selected="true" <?php }; ?>value="DCSP_Compt">Differential polarized Compton cross section</option>
<!--  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'DCSPb_Rayl') { ?>selected="true" <?php }; ?>value="DCSPb_Rayl">DCSPb_Rayl</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'DCSPb_Compt') { ?>selected="true" <?php }; ?>value="DCSPb_Compt">DCSPb_Compt</option>-->
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'FF_Rayl') { ?>selected="true" <?php }; ?>value="FF_Rayl">Atomic form factor</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'SF_Compt') { ?>selected="true" <?php }; ?>value="SF_Compt">Incoherent scattering function</option>
</select>

<div id="inputParameter">
  <div id="element" style="<?php echo $ElementStyle;?>">
  Element: <input type="text" name="Element" value="<?php echo $Element;?>"/>
  </div>
  <div id="linetype" style="<?php echo $LinetypeStyle;?>">
  XRF linename: <input type="text" name="Linename" value="<?php echo $Linename;?>"/>
  </div>
  <div id="shell" style="<?php echo $ShellStyle;?>">
  Shell: <input type="text" name="Shell" value="<?php echo $Shell;?>"/>
  </div>
  <div id="energy" style="<?php echo $EnergyStyle;?>">
  Energy: <input type="text" name="Energy" value="<?php echo $Energy;?>"/> keV
  </div>
  <div id="theta" style="<?php echo $ThetaStyle;?>">
  Scatter angle: <input type="text" name="Theta" value="<?php echo $Theta;?>"/> rad
  </div>
  <div id="phi" style="<?php echo $PhiStyle;?>">
  Azimuthal angle: <input type="text" name="Phi" value="<?php echo $Phi;?>"/> rad
  </div>
  <div id="momentumtransfer" style="<?php echo $MomentumTransferStyle;?>">
  Momentum transfer: <input type="text" name="MomentumTransfer" value="<?php echo $MomentumTransfer;?>"/>
  </div>
</div>
<br/>
<input type="submit" name="submit" value="Go!">

<p>
<?php 
echo "<h2>Result</h2>";
echo "<p style=\"font-size:20px\">";
echo $result,$unit;
?>
<p/>
<div id="codeExample" style=<?php echo $codeExampleStyle;?>>
<p>Call in <select name="Language" id="Language" onchange="optionCheckLanguage(this)">
  <option <?php if (isset($_GET['Language']) && $_GET['Language'] == 'C') { ?>selected="true" <?php }; ?>value="C">C/C++/Objective-C</option>
  <option <?php if (isset($_GET['Language']) && $_GET['Language'] == 'Fortran') { ?>selected="true" <?php }; ?>value="Fortran">Fortran 2003/2008</option>
  <option <?php if (isset($_GET['Language']) && $_GET['Language'] == 'Perl') { ?>selected="true" <?php }; ?>value="Perl">Perl</option>
  <option <?php if (isset($_GET['Language']) && $_GET['Language'] == 'IDL') { ?>selected="true" <?php }; ?>value="IDL">IDL</option>
  <option <?php if (isset($_GET['Language']) && $_GET['Language'] == 'Python') { ?>selected="true" <?php }; ?>value="Python">Python</option>
  <option <?php if (isset($_GET['Language']) && $_GET['Language'] == 'Java') { ?>selected="true" <?php }; ?>value="Java">Java</option>
  <option <?php if (isset($_GET['Language']) && $_GET['Language'] == 'Csharp') { ?>selected="true" <?php }; ?>value="Csharp">C#/.NET</option>
  <option <?php if (isset($_GET['Language']) && $_GET['Language'] == 'Lua') { ?>selected="true" <?php }; ?>value="Lua">Lua</option>
  <option <?php if (isset($_GET['Language']) && $_GET['Language'] == 'Ruby') { ?>selected="true" <?php }; ?>value="Ruby">Ruby</option>
  <option <?php if (isset($_GET['Language']) && $_GET['Language'] == 'PHP') { ?>selected="true" <?php }; ?>value="PHP">PHP</option>
</select> as:</p>
<div id="codeExampleC" style=<?php echo $codeExampleCStyle;?>><?php $geshi = new GeSHi($commandC, "c"); echo $geshi->parse_code();?></div>
<div id="codeExampleFortran" style=<?php echo $codeExampleFortranStyle;?>><?php $geshi = new GeSHi($commandFortran, "fortran"); echo $geshi->parse_code();?></div>
<div id="codeExamplePerl" style=<?php echo $codeExamplePerlStyle;?>><?php $geshi = new GeSHi($commandPerl, "perl"); echo $geshi->parse_code();?></div>
<div id="codeExampleIDL" style=<?php echo $codeExampleIDLStyle;?>><?php $geshi = new GeSHi($commandIDL, "idl"); echo $geshi->parse_code();?></div>
<div id="codeExamplePython" style=<?php echo $codeExamplePythonStyle;?>><?php $geshi = new GeSHi($commandPython, "python"); echo $geshi->parse_code();?></div>
<div id="codeExampleJava" style=<?php echo $codeExampleJavaStyle;?>><?php $geshi = new GeSHi($commandJava, "java"); echo $geshi->parse_code();?></div>
<div id="codeExampleCsharp" style=<?php echo $codeExampleCsharpStyle;?>><?php $geshi = new GeSHi($commandCsharp, "csharp"); echo $geshi->parse_code();?></div>
<div id="codeExampleLua" style=<?php echo $codeExampleLuaStyle;?>><?php $geshi = new GeSHi($commandLua, "lua"); echo $geshi->parse_code();?></div>
<div id="codeExampleRuby" style=<?php echo $codeExampleRubyStyle;?>><?php $geshi = new GeSHi($commandRuby, "ruby"); echo $geshi->parse_code();?></div>
<div id="codeExamplePHP" style=<?php echo $codeExamplePHPStyle;?>><?php $geshi = new GeSHi($commandPHP, "php"); echo $geshi->parse_code();?></div>
<?php
echo "Enable support for xraylib in your program using:<br/>";
//$geshi = new GeSHi(xraylib_enable($Language),strtolower($Language));
//echo $geshi->parse_code();
?>
<div id="includeSupportC" style=<?php echo $includeSupportCStyle;?>><?php echo xraylib_enable("C");?></div>
<div id="includeSupportFortran" style=<?php echo $includeSupportFortranStyle;?>><?php echo xraylib_enable("Fortran");?></div>
<div id="includeSupportPerl" style=<?php echo $includeSupportPerlStyle;?>><?php echo xraylib_enable("Perl");?></div>
<div id="includeSupportIDL" style=<?php echo $includeSupportIDLStyle;?>><?php echo xraylib_enable("IDL");?></div>
<div id="includeSupportPython" style=<?php echo $includeSupportPythonStyle;?>><?php echo xraylib_enable("Python");?></div>
<div id="includeSupportJava" style=<?php echo $includeSupportJavaStyle;?>><?php echo xraylib_enable("Java");?></div>
<div id="includeSupportCsharp" style=<?php echo $includeSupportCsharpStyle;?>><?php echo xraylib_enable("Csharp");?></div>
<div id="includeSupportLua" style=<?php echo $includeSupportLuaStyle;?>><?php echo xraylib_enable("Lua");?></div>
<div id="includeSupportRuby" style=<?php echo $includeSupportRubyStyle;?>><?php echo xraylib_enable("Ruby");?></div>
<div id="includeSupportPHP" style=<?php echo $includeSupportPHPStyle;?>><?php echo xraylib_enable("PHP");?></div>
</p>
</div>

</form>

<script type="text/javascript">
function displayNoneAllLanguage() {
	document.getElementById("codeExampleC").style.display= "none";
	document.getElementById("codeExampleFortran").style.display= "none";
	document.getElementById("codeExamplePerl").style.display= "none";
	document.getElementById("codeExampleIDL").style.display= "none";
	document.getElementById("codeExamplePython").style.display= "none";
	document.getElementById("codeExampleJava").style.display= "none"; 
	document.getElementById("codeExampleCsharp").style.display= "none"; 
	document.getElementById("codeExampleLua").style.display= "none"; 
	document.getElementById("codeExampleRuby").style.display= "none"; 
	document.getElementById("codeExamplePHP").style.display= "none"; 
	document.getElementById("includeSupportC").style.display= "none";
	document.getElementById("includeSupportFortran").style.display= "none";
	document.getElementById("includeSupportPerl").style.display= "none";
	document.getElementById("includeSupportIDL").style.display= "none";
	document.getElementById("includeSupportPython").style.display= "none";
	document.getElementById("includeSupportJava").style.display= "none"; 
	document.getElementById("includeSupportCsharp").style.display= "none"; 
	document.getElementById("includeSupportLua").style.display= "none"; 
	document.getElementById("includeSupportRuby").style.display= "none"; 
	document.getElementById("includeSupportPHP").style.display= "none"; 
}

function displayNoneAllFunction() {
	document.getElementById("element").style.display= "none";
	document.getElementById("linetype").style.display= "none";
	document.getElementById("shell").style.display= "none";
	document.getElementById("energy").style.display= "none";
	document.getElementById("theta").style.display= "none";
	document.getElementById("phi").style.display= "none";
	document.getElementById("momentumtransfer").style.display= "none";
}

function optionCheckLanguage(combo) {
    var selectedValue = combo.options[combo.selectedIndex].value;

    	displayNoneAllLanguage();
	switch (selectedValue) {
		case "C":
			document.getElementById("codeExampleC").style.display= "block";
			document.getElementById("includeSupportC").style.display= "block";
			break;
		case "Fortran":
			document.getElementById("codeExampleFortran").style.display= "block";
			document.getElementById("includeSupportFortran").style.display= "block";
			break;
		case "Perl":
			document.getElementById("codeExamplePerl").style.display= "block";
			document.getElementById("includeSupportPerl").style.display= "block";
			break;
		case "IDL":
			document.getElementById("codeExampleIDL").style.display= "block";
			document.getElementById("includeSupportIDL").style.display= "block";
			break;
		case "Python":
			document.getElementById("codeExamplePython").style.display= "block";
			document.getElementById("includeSupportPython").style.display= "block";
			break;
		case "Java":
			document.getElementById("codeExampleJava").style.display= "block";
			document.getElementById("includeSupportJava").style.display= "block";
			break;
		case "Csharp":
			document.getElementById("codeExampleCsharp").style.display= "block";
			document.getElementById("includeSupportCsharp").style.display= "block";
			break;
		case "Lua":
			document.getElementById("codeExampleLua").style.display= "block";
			document.getElementById("includeSupportLua").style.display= "block";
			break;
		case "Ruby":
			document.getElementById("codeExampleRuby").style.display= "block";
			document.getElementById("includeSupportRuby").style.display= "block";
			break;
		case "PHP":
			document.getElementById("codeExamplePHP").style.display= "block";
			document.getElementById("includeSupportPHP").style.display= "block";
			break;
			
	}
}

function optionCheckFunction(combo) {
    /*jslint browser:true */
    var selectedValue = combo.options[combo.selectedIndex].value;

    displayNoneAllFunction();
    if (selectedValue === "LineEnergy") {
	document.getElementById("element").style.display= "block";
	document.getElementById("linetype").style.display= "block";
    } else if (selectedValue === "EdgeEnergy") {
	document.getElementById("element").style.display= "block";
	document.getElementById("shell").style.display= "block";
    } else if (selectedValue === "AtomicWeight" || selectedValue === "ElementDensity") {
	document.getElementById("element").style.display= "block";
    } else if (selectedValue === "CS_Total" || 
      selectedValue === "CS_Photo" ||
      selectedValue === "CS_Rayl" ||
      selectedValue === "CS_Compt" ||
      selectedValue === "CSb_Total" ||
      selectedValue === "CSb_Photo" ||
      selectedValue === "CSb_Rayl" ||
      selectedValue === "CSb_Compt" ||
      selectedValue === "CS_Energy") {
	document.getElementById("energy").style.display= "block";
	document.getElementById("element").style.display= "block";
    } else if (selectedValue === "CS_KN") {
	document.getElementById("energy").style.display= "block";
    } else if (selectedValue === "DCS_Thoms") {
	document.getElementById("theta").style.display= "block";
    } else if (selectedValue === "DCS_KN") {
	document.getElementById("energy").style.display= "block";
	document.getElementById("theta").style.display= "block";
    } else if (selectedValue === "DCS_Rayl" ||
      selectedValue === "DCS_Compt" ||
      selectedValue === "DCSb_Rayl" ||
      selectedValue === "DCSb_Compt") {
	document.getElementById("theta").style.display= "block";
	document.getElementById("energy").style.display= "block";
	document.getElementById("element").style.display= "block";
    } else if (selectedValue === "DCSP_Thoms") {
	document.getElementById("theta").style.display= "block";
	document.getElementById("phi").style.display= "block";
    } else if (selectedValue === "DCSP_KN") {
	document.getElementById("energy").style.display= "block";
	document.getElementById("theta").style.display= "block";
	document.getElementById("phi").style.display= "block";
    } else if (selectedValue === "DCSP_Rayl" ||
      selectedValue === "DCSP_Compt" ||
      selectedValue === "DCSPb_Rayl" ||
      selectedValue === "DCSPb_Compt") {
	document.getElementById("theta").style.display= "block";
	document.getElementById("energy").style.display= "block";
	document.getElementById("element").style.display= "block";
	document.getElementById("phi").style.display= "block";
    } else if (selectedValue === "FF_Rayl" ||
      selectedValue === "SF_Compt") {
	document.getElementById("momentumtransfer").style.display= "block";
	document.getElementById("element").style.display= "block";
    }
}
</script>
<footer>
<address>
Maintained by <a href="mailto:Tom.Schoonjans@gmail.com">Tom Schoonjans</a><br/>
Thanks to Prof. Laszlo Vincze of Ghent University for providing the webspace.<br/>
Built using xraylib <?php echo XRAYLIB_MAJOR.".".XRAYLIB_MINOR?>.
</address>
</footer>
</body>
</html>

