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
$ElementOrCompound="FeSO4";
$Linename="KL3_LINE";
$LinenameSwitch="IUPAC";
$Linename1a="K";
$Linename1b="L3";
$Linename2="KA1_LINE";
$Shell="K_SHELL";
$Energy="10.0";
$Theta=1.5707964;
$Phi=3.14159;
$MomentumTransfer=0.57032;
$CKTrans="FL12_TRANS";
$result="";

$commands = array(
	"C" => "",
	"Fortran" => "",
	"Perl" => "",
	"IDL" => "",
	"Python" => "",
	"Java" => "",
	"Csharp" => "",
	"Lua" => "",
	"Ruby" => "",
	"PHP" => ""
);

$unit="";
$shellsArray = array("K", "L1", "L2", "L3", "M1", "M2", "M3", "M4", "M5", "N1", "N2", "N3", "N4", "N5", "N6", "N7", "O1", "O2", "O3", "O4", "O5", "O6", "O7", "P1", "P2", "P3", "P4", "P5", "Q1", "Q2", "Q3");
$siegbahnArray = array("KA1", "KA2", "KB1", "KB2", "KB3", "KB4", "KB5",
"LA1", "LA2", "LB1", "LB2", "LB3", "LB4", "LB5", "LB6", "LB7", "LB9", "LB10", "LB15", "LB17",
"LG1", "LG2", "LG3", "LG4", "LG5", "LG6", "LG8", "LE", "LL", "LS", "LT", "LU", "LV");

$ElementStyle="display:block";
$ElementOrCompoundStyle="display:none";
$LinetypeStyle="display:block";
$ShellStyle="display:none";
$EnergyStyle="display:none";
$ThetaStyle="display:none";
$PhiStyle="display:none";
$MomentumTransferStyle="display:none";
$CKTransStyle="display:none";


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

if (isset($_GET["ElementOrCompound"])) {
	$ElementOrCompound = $_GET["ElementOrCompound"];
}

if (isset($_GET["Linename1a"])) {
	$Linename1a = $_GET["Linename1a"];
}

if (isset($_GET["Linename1b"])) {
	$Linename1b = $_GET["Linename1b"];
}

if (isset($_GET["Linename2"])) {
	$Linename2 = $_GET["Linename2"];
}

if (isset($_GET["LinenameSwitch"])) {
	$LinenameSwitch = $_GET["LinenameSwitch"];
	if ($LinenameSwitch == "IUPAC") {
		$Linename = $Linename1a . $Linename1b . "_LINE";
	}
	elseif ($LinenameSwitch == "Siegbahn") {
		$Linename = $Linename2;
	}
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
if (isset($_GET["CKTrans"])) {
	$CKTrans=$_GET['CKTrans'];
}
if (isset($_GET['xrlFunction']) && ($xrlFunction == "LineEnergy" ||
	$xrlFunction == "RadRate"
	)) {
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
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".$Element.", ".expand_entity($Linename, XRL_MACRO, $key).")";
		}
		unset($value);
	}
	else {
		$result = $xrlFunction(SymbolToAtomicNumber($Element), $realLinename);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, $key)."(".stringify($Element, $key)."), ".expand_entity($Linename, XRL_MACRO, $key).")";
		}
		unset($value);
	}
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	if ($xrlFunction == "LineEnergy") {
		$unit=" keV";
	}
	else {
		$unit="";
	}
	display_none_all();
	$ElementStyle="display:block";
	$LinetypeStyle="display:block";
	$codeExampleStyle="display:block";
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "EdgeEnergy" ||
	$xrlFunction == "FluorYield" ||
	$xrlFunction == "JumpFactor"
	)) {
	$realShell = @constant($Shell);
	if (is_numeric($Element)) {
		$result = $xrlFunction($Element, $realShell);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".$Element.", ".expand_entity($Shell, XRL_MACRO, $key).")";
		}
		unset($value);
	}
	else {
		$result = $xrlFunction(SymbolToAtomicNumber($Element), $realShell);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, $key)."(".stringify($Element, $key)."), ".expand_entity($Shell, XRL_MACRO, $key).")";
		}
		unset($value);
	}
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	if ($xrlFunction == "EdgeEnergy") {
		$unit=" keV";
	}
	else {
		$unit="";
	}
	display_none_all();
	$ElementStyle="display:block";
	$ShellStyle="display:block";
	$codeExampleStyle="display:block";
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "AtomicWeight" || $xrlFunction == "ElementDensity")) {
	if (is_numeric($Element)) {
		$result = $xrlFunction($Element);
		foreach ($commands as $key => &$value) {
			$value= expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".$Element.")";
		}
		unset($value);
	}
	else {
		$result = $xrlFunction(SymbolToAtomicNumber($Element));
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, $key)."(".stringify($Element, $key)."))";
		}
		unset($value);
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
	if (is_numeric($ElementOrCompound)) {
		$result = $xrlFunction($ElementOrCompound, $Energy);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".$ElementOrCompound.", ".$Energy.")";
		}
		unset($value);
	}
	elseif (SymbolToAtomicNumber($ElementOrCompound) > 0) {
		#chemical symbol found
		$result = $xrlFunction(SymbolToAtomicNumber($ElementOrCompound), $Energy);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, $key)."(".stringify($ElementOrCompound, $key)."), ".$Energy.")";
		}
		unset($value);
	}
	else {
		#compound then maybe...		
		$xrlFunction_cp = $xrlFunction."_CP";
		$result = $xrlFunction_cp($ElementOrCompound, $Energy);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction_cp, XRL_FUNCTION, $key)."(".stringify($ElementOrCompound, $key).", ".$Energy.")";
		}
		unset($value);
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
	$ElementOrCompoundStyle="display:block";
	$EnergyStyle="display:block";
	$codeExampleStyle="display:block";

}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "CS_KN")) {
	if (!is_numeric($Energy) || $Energy <= 0.0 || $Energy >= 100.0) {
		$result=0.0;
		goto error;
	}
	$result = $xrlFunction($Energy);
	foreach ($commands as $key => &$value) {
		$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".$Energy.")";
	}
	unset($value);
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
	foreach ($commands as $key => &$value) {
		$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".$Theta.")";
	}
	unset($value);
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	$unit=" cm<sup>2</sup>/g/sr";
	display_none_all();
	$ThetaStyle="display:block";
	$codeExampleStyle="display:block";
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "DCS_KN" ||
	$xrlFunction == "MomentTransf" || 
	$xrlFunction == "ComptonEnergy")) {
	if (!is_numeric($Energy) || $Energy <= 0.0 || $Energy >= 100.0) {
		$result=0.0;
		goto error;
	}
	if (!is_numeric($Theta) || $Theta < 0.0 || $Theta > PI) {
		$result=0.0;
		goto error;
	}
	$result = $xrlFunction($Energy, $Theta);
	foreach ($commands as $key => &$value) {
		$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".$Energy.", ".$Theta.")";
	}
	unset($value);
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	if ($xrlFunction == "DCS_KN") {
		$unit=" cm<sup>2</sup>/g/sr";
	}
	elseif ($xrlFunction == "ComptonEnergy") {
		$unit=" keV";
	}
	else {
		$unit = "";
	}
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
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION,  $key)."(".$Element.", ".$Energy.", ".$Theta.")";
		}
		unset($value);
	}
	else {
		$result = $xrlFunction(SymbolToAtomicNumber($Element), $Energy, $Theta);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, $key)."(".stringify($Element, $key)."), ".$Energy.", ".$Theta.")";
		}
		unset($value);
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
	foreach ($commands as $key => &$value) {
		$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".$Theta.", ".$Phi.")";
	}
	unset($value);
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
	foreach ($commands as $key => &$value) {
		$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".$Energy.", ".$Theta.", ".$Phi.")";
	}
	unset($value);
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
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".$Element.", ".$Energy.", ".$Theta.", ".$Phi.")";
		}
		unset($value);
	}
	else {
		$result = $xrlFunction(SymbolToAtomicNumber($Element), $Energy, $Theta, $Phi);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, $key)."(".stringify($Element, $key)."), ".$Energy.", ".$Theta.", ".$Phi.")";
		}
		unset($value);
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
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".$Element.", ".$MomentumTransfer.")";
		}
		unset($value);
	}
	else {
		$result = $xrlFunction(SymbolToAtomicNumber($Element), $MomentumTransfer);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, $key)."(".stringify($Element, $key)."), ".$MomentumTransfer.")";
		}
		unset($value);
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
elseif (isset($_GET['xrlFunction']) && $xrlFunction == "CosKronTransProb") {
	$realCKTrans = constant($CKTrans);
	if (is_numeric($Element)) {
		$result = $xrlFunction($Element, $realCKTrans);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".$Element.", ".expand_entity($CKTrans, XRL_MACRO, $key).")";
		}
		unset($value);
	}
	else {
		$result = $xrlFunction(SymbolToAtomicNumber($Element), $realCKTrans);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, $key)."(".stringify($Element, $key)."), ".expand_entity($CKTrans, XRL_MACRO, $key).")";
		}
		unset($value);
	}
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	$unit="";
	display_none_all();
	$ElementStyle="display:block";
	$CKTransStyle="display:block";
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
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'LineEnergy') { ?>selected="true" <?php }; ?>value="LineEnergy">Fluorescence line energy</option>
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
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'MomentTransf') { ?>selected="true" <?php }; ?>value="MomentTransf">Momentum transfer function</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'CosKronTransProb') { ?>selected="true" <?php }; ?>value="CosKronTransProb">Coster-Kronig transition probability</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'FluorYield') { ?>selected="true" <?php }; ?>value="FluorYield">Fluorescence yield</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'JumpFactor') { ?>selected="true" <?php }; ?>value="JumpFactor">Jump factor</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'RadRate') { ?>selected="true" <?php }; ?>value="RadRate">Radiative transition probability</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'ComptonEnergy') { ?>selected="true" <?php }; ?>value="ComptonEnergy">Energy after Compton scattering</option>
</select>

<div id="inputParameter">
  <div id="element" style="<?php echo $ElementStyle;?>">
  Element: <input type="text" name="Element" value="<?php echo $Element;?>"/>
  </div>
  <div id="elementOrCompound" style="<?php echo $ElementOrCompoundStyle;?>">
  Element or Compound: <input type="text" name="ElementOrCompound" value="<?php echo $ElementOrCompound;?>"/>
  </div>
  <div id="linetype" style="<?php echo $LinetypeStyle;?>">
  <table border="0" style="border-spacing:0px">
  <tr>
  <td style="padding-left:0px;border-left-width:0px">Transition</td>
  <td>
  <input type="radio" name="LinenameSwitch" id="IUPAC"
   value="IUPAC" <?php if ($LinenameSwitch == 'IUPAC') { ?> checked <?php }?>/>
   <label for="IUPAC">IUPAC notation</label>
   <select name="Linename1a" id="Linename1a" onchange="Linename1aChanged(this)">
	<?php 
		foreach (array_slice($shellsArray, 0, -1) as $shell) {
			echo "<option value=\"$shell\"";
			if ($Linename1a == $shell) {
				echo "selected=\"true\" ";
			}
			echo "> $shell</option>";
		}
	?>
   </select> &larr; <select name="Linename1b" id="Linename1b">
	<?php
		$res = array_search($Linename1a, $shellsArray, true);
		$slice = array_slice($shellsArray, $res+1);
		$i = 0;
		foreach ($slice as $shell) {
			echo "<option value=\"$shell\"";
			if (($i++ == 0 && array_search($Linename1b, $slice) === FALSE) || $Linename1b == $shell) {
				echo "selected=\"true\" ";
			}
			echo "> $shell</option>";
		}
	?>
   </select><br/>
  <input type="radio" name="LinenameSwitch" id="Siegbahn"
   value="Siegbahn" <?php if ($LinenameSwitch == 'Siegbahn') { ?> checked <?php }?>/>
   <label for="Siegbahn">Siegbahn notation</label>
   <select name="Linename2" id="Linename2">
   	<?php
		foreach($siegbahnArray as $siegbahn) {
			$siegbahnFull = $siegbahn."_LINE";
			echo "<option value=\"$siegbahnFull\"";
			if ($Linename2 == $siegbahnFull) {
				echo "selected=\"true\" ";
			}
			echo "> $siegbahn</option>";
		}
	?>
   </select>
   </td>
   </tr>
   </table>
  </div>
  <div id="shell" style="<?php echo $ShellStyle;?>">
  Shell: <select name="Shell" id="Shell">
  <?php foreach ($shellsArray as $shell) {
  		$shellFull = $shell."_SHELL";
  		echo "<option value=\"$shellFull\"";
		if ($Shell == $shellFull) {
				echo "selected=\"true\" ";
		}
		echo "> $shell</option>";
  	}	
  ?>
  </select>
  </div>
  <div id="energy" style="<?php echo $EnergyStyle;?>">
  Energy: <input type="text" name="Energy" value="<?php echo $Energy;?>"/> keV
  </div>
  <div id="theta" style="<?php echo $ThetaStyle;?>">
  Scattering angle: <input type="text" name="Theta" value="<?php echo $Theta;?>"/> rad
  </div>
  <div id="phi" style="<?php echo $PhiStyle;?>">
  Azimuthal angle: <input type="text" name="Phi" value="<?php echo $Phi;?>"/> rad
  </div>
  <div id="momentumtransfer" style="<?php echo $MomentumTransferStyle;?>">
  Momentum transfer: <input type="text" name="MomentumTransfer" value="<?php echo $MomentumTransfer;?>"/>
  </div>
  <div id="cktrans" style="<?php echo $CKTransStyle;?>">
  Transition <select name="CKTrans" id="CKTrans">
  <option <?php if (isset($_GET['CKTrans']) && $_GET['CKTrans'] == 'FL12_TRANS') { ?> selected="true" <?php }; ?>value="FL12_TRANS">L1 &rarr; L2</option>
  <option <?php if (isset($_GET['CKTrans']) && $_GET['CKTrans'] == 'FL13_TRANS') { ?> selected="true" <?php }; ?>value="FL13_TRANS">L1 &rarr; L3</option>
  <option <?php if (isset($_GET['CKTrans']) && $_GET['CKTrans'] == 'FL23_TRANS') { ?> selected="true" <?php }; ?>value="FL23_TRANS">L2 &rarr; L3</option>
  <option <?php if (isset($_GET['CKTrans']) && $_GET['CKTrans'] == 'FM12_TRANS') { ?> selected="true" <?php }; ?>value="FM12_TRANS">M1 &rarr; M2</option>
  <option <?php if (isset($_GET['CKTrans']) && $_GET['CKTrans'] == 'FM13_TRANS') { ?> selected="true" <?php }; ?>value="FM13_TRANS">M1 &rarr; M3</option>
  <option <?php if (isset($_GET['CKTrans']) && $_GET['CKTrans'] == 'FM14_TRANS') { ?> selected="true" <?php }; ?>value="FM14_TRANS">M1 &rarr; M4</option>
  <option <?php if (isset($_GET['CKTrans']) && $_GET['CKTrans'] == 'FM15_TRANS') { ?> selected="true" <?php }; ?>value="FM15_TRANS">M1 &rarr; M5</option>
  <option <?php if (isset($_GET['CKTrans']) && $_GET['CKTrans'] == 'FM23_TRANS') { ?> selected="true" <?php }; ?>value="FM23_TRANS">M2 &rarr; M3</option>
  <option <?php if (isset($_GET['CKTrans']) && $_GET['CKTrans'] == 'FM24_TRANS') { ?> selected="true" <?php }; ?>value="FM24_TRANS">M2 &rarr; M4</option>
  <option <?php if (isset($_GET['CKTrans']) && $_GET['CKTrans'] == 'FM25_TRANS') { ?> selected="true" <?php }; ?>value="FM25_TRANS">M2 &rarr; M5</option>
  <option <?php if (isset($_GET['CKTrans']) && $_GET['CKTrans'] == 'FM34_TRANS') { ?> selected="true" <?php }; ?>value="FM34_TRANS">M3 &rarr; M4</option>
  <option <?php if (isset($_GET['CKTrans']) && $_GET['CKTrans'] == 'FM35_TRANS') { ?> selected="true" <?php }; ?>value="FM35_TRANS">M3 &rarr; M5</option>
  <option <?php if (isset($_GET['CKTrans']) && $_GET['CKTrans'] == 'FM45_TRANS') { ?> selected="true" <?php }; ?>value="FM45_TRANS">M4 &rarr; M5</option>
  </select>
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
<div id="codeExampleC" style=<?php echo $codeExampleCStyle;?>><?php $geshi = new GeSHi($commands["C"], "c"); echo $geshi->parse_code();?></div>
<div id="codeExampleFortran" style=<?php echo $codeExampleFortranStyle;?>><?php $geshi = new GeSHi($commands["Fortran"], "fortran"); echo $geshi->parse_code();?></div>
<div id="codeExamplePerl" style=<?php echo $codeExamplePerlStyle;?>><?php $geshi = new GeSHi($commands["Perl"], "perl"); echo $geshi->parse_code();?></div>
<div id="codeExampleIDL" style=<?php echo $codeExampleIDLStyle;?>><?php $geshi = new GeSHi($commands["IDL"], "idl"); echo $geshi->parse_code();?></div>
<div id="codeExamplePython" style=<?php echo $codeExamplePythonStyle;?>><?php $geshi = new GeSHi($commands["Python"], "python"); echo $geshi->parse_code();?></div>
<div id="codeExampleJava" style=<?php echo $codeExampleJavaStyle;?>><?php $geshi = new GeSHi($commands["Java"], "java"); echo $geshi->parse_code();?></div>
<div id="codeExampleCsharp" style=<?php echo $codeExampleCsharpStyle;?>><?php $geshi = new GeSHi($commands["Csharp"], "csharp"); echo $geshi->parse_code();?></div>
<div id="codeExampleLua" style=<?php echo $codeExampleLuaStyle;?>><?php $geshi = new GeSHi($commands["Lua"], "lua"); echo $geshi->parse_code();?></div>
<div id="codeExampleRuby" style=<?php echo $codeExampleRubyStyle;?>><?php $geshi = new GeSHi($commands["Ruby"], "ruby"); echo $geshi->parse_code();?></div>
<div id="codeExamplePHP" style=<?php echo $codeExamplePHPStyle;?>><?php $geshi = new GeSHi($commands["PHP"], "php"); echo $geshi->parse_code();?></div>
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
	document.getElementById("elementOrCompound").style.display= "none";
	document.getElementById("linetype").style.display= "none";
	document.getElementById("shell").style.display= "none";
	document.getElementById("energy").style.display= "none";
	document.getElementById("theta").style.display= "none";
	document.getElementById("phi").style.display= "none";
	document.getElementById("momentumtransfer").style.display= "none";
	document.getElementById("cktrans").style.display= "none";
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

function Linename1aChanged(Linename1a) {
    var shellsArray = ["K", "L1", "L2", "L3", "M1", "M2", "M3", "M4", "M5", "N1", "N2", "N3", "N4", "N5", "N6", "N7", "O1", "O2", "O3", "O4", "O5", "O6", "O7", "P1", "P2", "P3", "P4", "P5", "Q1", "Q2", "Q3"];

    var Linename1b = document.getElementById("Linename1b");
    //get selected value
    var selected = Linename1b.options[Linename1b.selectedIndex].value;

    //clear Linename1b
    Linename1b.options.length = 0;
    var res = shellsArray.indexOf(Linename1a.options[Linename1a.selectedIndex].value);
    var match = false;
    for (var i = res+1 ; i < shellsArray.length ; i++) {
    	Linename1b.options.add(new Option(shellsArray[i], shellsArray[i]));
	if (shellsArray[i] == selected) {
		Linename1b.options[i-res-1].selected = true;
		match = true;
	}
    }
    if (match == false) {
        //select the first option if previously selected value is not found
	Linename1b.options[0].selected = true;
    }
} 

function optionCheckFunction(combo) {
    /*jslint browser:true */
    var selectedValue = combo.options[combo.selectedIndex].value;

    displayNoneAllFunction();
    if (selectedValue === "LineEnergy" ||
      selectedValue === "RadRate") {
	document.getElementById("element").style.display= "block";
	document.getElementById("linetype").style.display= "block";
    } else if (selectedValue === "EdgeEnergy" ||
      selectedValue === "JumpFactor" ||
      selectedValue === "FluorYield") {
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
	document.getElementById("elementOrCompound").style.display= "block";
    } else if (selectedValue === "CS_KN") {
	document.getElementById("energy").style.display= "block";
    } else if (selectedValue === "DCS_Thoms") {
	document.getElementById("theta").style.display= "block";
    } else if (selectedValue === "DCS_KN" ||
      selectedValue === "MomentTransf" ||
      selectedValue === "ComptonEnergy") {
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
    } else if (selectedValue === "CosKronTransProb") {
	document.getElementById("element").style.display= "block";
	document.getElementById("cktrans").style.display= "block";
    }
}
</script>
<footer>
<address>
Maintained by <a href="mailto:Tom.Schoonjans@gmail.com">Tom Schoonjans</a><br/>
Thanks to Prof. Laszlo Vincze of Ghent University for providing the webspace.<br/>
Built using xraylib <?php echo XRAYLIB_MAJOR.".".XRAYLIB_MINOR?>.
Development occurs at the <a href="http://github.com/tschoonj/xraylib-web"><i>xraylib-web Github repository</i></a>
</address>
</footer>
</body>
</html>

