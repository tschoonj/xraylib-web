<!DOCTYPE html>

<html lang=en>
<head>
<title>xraylib online calculator</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php 
if ($_SERVER['REMOTE_ADDR'] != "127.0.0.1") {
	//no need for this when using the localhost for testing
	include_once("analyticstracking.php");
}

include("xraylib.php");
include("xraylib_aux.php");
require_once 'HTML/Table.php';
//error_reporting(E_WARNING);
error_reporting(error_reporting() & ~E_STRICT);
//init
$xrlFunction="LineEnergy";
$Element="26";
$ElementOrCompound="FeSO4";
$Compound="Ca5(PO4)3";
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
$Density="1.0";
$PZ="1.0";
$AugerTransa="K";
$AugerTransb="L2";
$AugerTransc="M3";
$NISTcompound="Gadolinium Oxysulfide";
$RadioNuclide="55Fe";
$result="";

define("MAX_ENERGY", 300.0);

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
$NISTcompoundArray = GetCompoundDataNISTList(); 
$RadioNuclideArray = GetRadioNuclideDataList();


$ElementStyle="display:block";
$ElementOrCompoundStyle="display:none";
$compoundStyle="display:none";
$LinetypeStyle="display:block";
$ShellStyle="display:none";
$EnergyStyle="display:none";
$ThetaStyle="display:none";
$PhiStyle="display:none";
$MomentumTransferStyle="display:none";
$CKTransStyle="display:none";
$DensityStyle="display:none";
$PZStyle="display:none";
$AugerTransStyle="display:none";
$NISTcompoundStyle="display:none";
$RadioNuclideStyle="display:none";


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

if (isset($_GET["Compound"])) {
	$Compound = $_GET["Compound"];
}

if (isset($_GET["NISTcompound"])) {
	$NISTcompound = $_GET["NISTcompound"];
}

if (isset($_GET["RadioNuclide"])) {
	$RadioNuclide = $_GET["RadioNuclide"];
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
	elseif ($LinenameSwitch == "ALL") {
		$Linename = "ALL";
	}
}

if (isset($_GET["Shell"])) {
	$Shell = $_GET["Shell"];
}

if (isset($_GET["AugerTransa"])) {
	$AugerTransa = $_GET["AugerTransa"];
}

if (isset($_GET["AugerTransb"])) {
	$AugerTransb = $_GET["AugerTransb"];
}

if (isset($_GET["AugerTransc"])) {
	$AugerTransc = $_GET["AugerTransc"];
}

$AugerTrans = $AugerTransa."_".$AugerTransb.$AugerTransc."_AUGER";

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

if (isset($_GET["Density"])) {
	$Density=$_GET['Density'];
}
if (isset($_GET["PZ"])) {
	$PZ=$_GET['PZ'];
}

if (isset($_GET['xrlFunction']) && ($xrlFunction == "LineEnergy" ||
	$xrlFunction == "RadRate"
	)) {
	display_none_all();
	$ElementStyle="display:block";
	$LinetypeStyle="display:block";
	if ($Linename == "ALL") {
		if (is_numeric($Element)) {
			$myElement = $Element;
		}
		else {
			$myElement = SymbolToAtomicNumber($Element);
		}
		if ($myElement < 1 || $myElement > 94) {
			$result=0.0;
			goto error;
		}
		$result = "";
		$table = new HTML_Table(array('width' => '200px'));
		$table->setAutoGrow(true);
		$table->setHeaderContents(0, 0, 'Transition');
		$table->setHeaderContents(0, 1, $xrlFunction);
		$counter=1;
  		foreach ($shellsArray as $index => $shell) {
  			foreach (array_slice($shellsArray, $index+1) as $shell2) {
				$realLinename = $shell.$shell2."_LINE";
				if (defined($realLinename) && ($value = $xrlFunction($myElement, @constant($realLinename))) > 0.0) {
					$value = sprintf("%g", $value);
					if ($xrlFunction == "LineEnergy") {
						$value .=" keV";
					}
					$table->setCellContents($counter,0, $shell.$shell2);
					$table->setCellAttributes($counter,0, array('class' => 'cellattr'));
					$table->setCellContents($counter,1, $value);
					$table->setCellAttributes($counter,1, array('class' => 'cellattr'));
					$counter++;
				}
			}
		}
		$result=$table->toHtml();
		$unit="";
		$command = "";


		$codeExampleStyle="display:none";
	}
	else {
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
		$codeExampleStyle="display:block";
	}
	goto past_error;
}
else if (isset($_GET['xrlFunction']) && ($xrlFunction == "AugerRate")) {
	display_none_all();
	$ElementStyle="display:block";
	$AugerTransStyle="display:block";
	$codeExampleStyle="display:block";
	if (!is_numeric($AugerTrans)) {
		$realAugerTrans = @constant($AugerTrans);
		if (!isset($realAugerTrans)) {
			$result=0.0;
			goto error;
		}
	}
	else {
		$result=0.0;
		goto error;
	}
	if (is_numeric($Element)) {
		$result = $xrlFunction($Element, $realAugerTrans);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".$Element.", ".expand_entity($AugerTrans, XRL_MACRO, $key).")";
		}
		unset($value);
	}
	else {
		$result = $xrlFunction(SymbolToAtomicNumber($Element), $realAugerTrans);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, $key)."(".stringify($Element, $key)."), ".expand_entity($AugerTrans, XRL_MACRO, $key).")";
		}
		unset($value);
	}
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	$unit="";
}
else if (isset($_GET['xrlFunction']) && ($xrlFunction == "Refractive_Index")) {
	display_none_all();
	$ElementOrCompoundStyle="display:block";
	$EnergyStyle="display:block";
	$DensityStyle="display:block";
	$codeExampleStyle="display:block";
	if (!is_numeric($Energy) || $Energy <= 0.0 || $Energy > MAX_ENERGY) {
		$result=0.0;
		goto error;
	}
	if (!is_numeric($Density) || $Energy <= 0.0) {
		$result=0.0;
		goto error;
	}
	if (is_numeric($ElementOrCompound)) {
		$result = $xrlFunction(AtomicNumberToSymbol($ElementOrCompound), $Energy, $Density);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".expand_entity("AtomicNumberToSymbol", XRL_FUNCTION, $key)."(".$ElementOrCompound.")".", ".$Energy.", ".$Density.")";
		}
		unset($value);
	}
	else {
		$result = $xrlFunction($ElementOrCompound, $Energy, $Density);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".stringify($ElementOrCompound,$key).", ".$Energy.", ".$Density.")";
		}
		unset($value);
	}
	if ($result["re"] == 0.0 && $result["im"]) {
		$result=0.0;
	}
	else {
		$result = sprintf("%g + %gi", $result["re"],$result["im"]);
	}
	$unit="";

}
else if (isset($_GET['xrlFunction']) && ($xrlFunction == "CS_FluorLine_Kissel_Cascade" ||
	$xrlFunction == "CS_FluorLine_Kissel_Nonradiative_Cascade" ||
	$xrlFunction == "CS_FluorLine_Kissel_Radiative_Cascade" ||
	$xrlFunction == "CS_FluorLine_Kissel_no_Cascade"
	)) {
	display_none_all();
	$ElementStyle="display:block";
	$LinetypeStyle="display:block";
	$EnergyStyle="display:block";
	if (!is_numeric($Energy) || $Energy <= 0.0 || $Energy > MAX_ENERGY) {
		$result=0.0;
		goto error;
	}
	if ($Linename == "ALL") {
		if (is_numeric($Element)) {
			$myElement = $Element;
		}
		else {
			$myElement = SymbolToAtomicNumber($Element);
		}
		if ($myElement < 1 || $myElement > 94) {
			$result=0.0;
			goto error;
		}
		$result = "";
		$table = new HTML_Table(array('width' => '200px'));
		$table->setAutoGrow(true);
		$table->setHeaderContents(0, 0, 'Transition');
		$table->setHeaderContents(0, 1, $xrlFunction);
		$counter=1;
  		foreach ($shellsArray as $index => $shell) {
  			foreach (array_slice($shellsArray, $index+1) as $shell2) {
				$realLinename = $shell.$shell2."_LINE";
				if (defined($realLinename) && ($value = $xrlFunction($myElement, @constant($realLinename), $Energy)) > 0.0) {
					$value = sprintf("%g", $value);
					$value .=" cm<sup>2</sup>/g";
					$table->setCellContents($counter,0, $shell.$shell2);
					$table->setCellAttributes($counter,0, array('class' => 'cellattr'));
					$table->setCellContents($counter,1, $value);
					$table->setCellAttributes($counter,1, array('class' => 'cellattr'));
					$counter++;
				}
			}
		}
		$result=$table->toHtml();
		$unit="";
		$command = "";


		$codeExampleStyle="display:none";
	}
	else {
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
			$result = $xrlFunction($Element, $realLinename, $Energy);
			foreach ($commands as $key => &$value) {
				$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".$Element.", ".expand_entity($Linename, XRL_MACRO, $key).", ".$Energy.")";
			}
			unset($value);
		}
		else {
			$result = $xrlFunction(SymbolToAtomicNumber($Element), $realLinename, $Energy);
			foreach ($commands as $key => &$value) {
				$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, $key)."(".stringify($Element, $key)."), ".expand_entity($Linename, XRL_MACRO, $key).", ".$Energy.")";
			}
			unset($value);
		}
		if ($result != 0.0) {
			$result = sprintf("%g", $result);
		}
		$unit=" cm<sup>2</sup>/g";
		$codeExampleStyle="display:block";
	}
	goto past_error;
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "EdgeEnergy" ||
	$xrlFunction == "FluorYield" ||
	$xrlFunction == "JumpFactor" ||
	$xrlFunction == "AtomicLevelWidth" ||
	$xrlFunction == "AugerYield" ||
	$xrlFunction == "ElectronConfig"
	)) {
	display_none_all();
	$ElementStyle="display:block";
	$ShellStyle="display:block";
	if ($Shell == "ALL") {
		if (is_numeric($Element)) {
			$myElement = $Element;
		}
		else {
			$myElement = SymbolToAtomicNumber($Element);
		}
		if ($myElement < 1 || $myElement > 92) {
			$result=0.0;
			goto error;
		}
		$result = "";
		$table = new HTML_Table(array('width' => '200px'));
		$table->setAutoGrow(true);
		$table->setHeaderContents(0, 0, 'Shell');
		$table->setHeaderContents(0, 1, $xrlFunction);
		$counter=1;
  		foreach ($shellsArray as $shell) {
			$realShell = @constant($shell."_SHELL");
			if (($value = $xrlFunction($myElement, $realShell)) > 0.0) {
				$value = sprintf("%g", $value);
				if ($xrlFunction == "EdgeEnergy" || $xrlFunction == "AtomicLevelWidth") {
					$value .=" keV";
				}
				else if ($xrlFunction == "ElectronConfig") {
					$value .=" electrons"; 
				}
				$table->setCellContents($counter,0, $shell);
				$table->setCellAttributes($counter,0, array('class' => 'cellattr'));
				$table->setCellContents($counter,1, $value);
				$table->setCellAttributes($counter,1, array('class' => 'cellattr'));
				$counter++;
			}
		}
		$result=$table->toHtml();
		$unit="";
		$command = "";
		$codeExampleStyle="display:none";
	}
	else {
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
		else {
			goto error;
		}
		if ($xrlFunction == "EdgeEnergy" || $xrlFunction == "AtomicLevelWidth") {
			$unit=" keV";
		}
		else if ($xrlFunction == "ElectronConfig") {
			$unit =" electrons"; 
		}
		else {
			$unit="";
		}
		$codeExampleStyle="display:block";
	}
	goto past_error;
	
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "CS_Photo_Partial"
	)) {
	display_none_all();
	$ElementStyle="display:block";
	$EnergyStyle="display:block";
	$ShellStyle="display:block";
	if (!is_numeric($Energy) || $Energy <= 0.0 || $Energy > MAX_ENERGY) {
		$result=0.0;
		goto error;
	}
	if ($Shell == "ALL") {
		if (is_numeric($Element)) {
			$myElement = $Element;
		}
		else {
			$myElement = SymbolToAtomicNumber($Element);
		}
		if ($myElement < 1 || $myElement > 99) {
			$result=0.0;
			goto error;
		}
		$result = "";
		$table = new HTML_Table(array('width' => '200px'));
		$table->setAutoGrow(true);
		$table->setHeaderContents(0, 0, 'Shell');
		$table->setHeaderContents(0, 1, $xrlFunction);
		$counter=1;
  		foreach ($shellsArray as $shell) {
			$realShell = @constant($shell."_SHELL");
			if (($value = $xrlFunction($myElement, $realShell, $Energy)) > 0.0) {
				$value = sprintf("%g", $value);
				if ($xrlFunction == "CS_Photo_Partial") {
					$value .=" cm<sup>2</sup>/g";
				}
				$table->setCellContents($counter,0, $shell);
				$table->setCellAttributes($counter,0, array('class' => 'cellattr'));
				$table->setCellContents($counter,1, $value);
				$table->setCellAttributes($counter,1, array('class' => 'cellattr'));
				$counter++;
			}
		}
		$result=$table->toHtml();
		$unit="";
		$command = "";

		$codeExampleStyle="display:none";
	}
	else {
		$realShell = @constant($Shell);
		if (is_numeric($Element)) {
			$result = $xrlFunction($Element, $realShell, $Energy);
			foreach ($commands as $key => &$value) {
				$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".$Element.", ".expand_entity($Shell, XRL_MACRO, $key).", ".$Energy.")";
			}
			unset($value);
		}
		else {
			$result = $xrlFunction(SymbolToAtomicNumber($Element), $realShell, $Energy);
			foreach ($commands as $key => &$value) {
				$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, $key)."(".stringify($Element, $key)."), ".expand_entity($Shell, XRL_MACRO, $key).", ".$Energy.")";
			}
			unset($value);
		}
		if ($result != 0.0) {
			$result = sprintf("%g", $result);
		}
		else {
			goto error;
		}
		if ($xrlFunction == "CS_Photo_Partial") {
			$unit=" cm<sup>2</sup>/g";
		}
		else {
			$unit="";
		}
		$codeExampleStyle="display:block";
	}
	goto past_error;
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "AtomicWeight" || $xrlFunction == "ElementDensity")) {
	display_none_all();
	$ElementStyle="display:block";
	$codeExampleStyle="display:block";
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
	else {
		goto error;
	}
	if ($xrlFunction == "AtomicWeight"){
		$unit=" g/mol";
	}
	elseif ($xrlFunction == "ElementDensity"){
		$unit=" g/cm<sup>3</sup>";
	}

}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "CS_Total" || $xrlFunction == "CS_Photo" ||
	$xrlFunction == "CS_Rayl" || $xrlFunction == "CS_Compt" ||
	$xrlFunction == "CSb_Total" || $xrlFunction == "CSb_Photo" ||
	$xrlFunction == "CSb_Rayl" || $xrlFunction == "CSb_Compt" ||
	$xrlFunction == "CS_Energy"
	)) {
	display_none_all();
	$ElementOrCompoundStyle="display:block";
	$EnergyStyle="display:block";
	$codeExampleStyle="display:block";

	if (!is_numeric($Energy) || $Energy <= 0.0 || $Energy > MAX_ENERGY) {
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
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "Fi" || 
	$xrlFunction == "Fii"
	)) {
	display_none_all();
	$ElementStyle="display:block";
	$EnergyStyle="display:block";
	$codeExampleStyle="display:block";
	if (!is_numeric($Energy) || $Energy <= 0.0 || $Energy > MAX_ENERGY) {
		$result=0.0;
		goto error;
	}
	if (is_numeric($Element)) {
		$result = $xrlFunction($Element, $Energy);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".$Element.", ".$Energy.")";
		}
		unset($value);
	}
	else {
		#chemical symbol found
		$result = $xrlFunction(SymbolToAtomicNumber($Element), $Energy);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, $key)."(".stringify($Element, $key)."), ".$Energy.")";
		}
		unset($value);
	}
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	if (substr($xrlFunction,0,2) == "Fi"){
		$unit="";
	}

}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "ComptonProfile")) {
	display_none_all();
	$ElementStyle="display:block";
	$PZStyle="display:block";
	$codeExampleStyle="display:block";
	if (!is_numeric($PZ) || $PZ < 0.0) {
		$result=0.0;
		goto error;
	}
	if (is_numeric($Element)) {
		$result = $xrlFunction($Element, $PZ);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".$Element.", ".$PZ.")";
		}
		unset($value);
	}
	else {
		#chemical symbol found
		$result = $xrlFunction(SymbolToAtomicNumber($Element), $PZ);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, $key)."(".stringify($Element, $key)."), ".$PZ.")";
		}
		unset($value);
	}
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	$unit="";
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "ComptonProfile_Partial")) {
	display_none_all();
	$ElementStyle="display:block";
	$PZStyle="display:block";
	$ShellStyle="display:block";
	$codeExampleStyle="display:block";
	if (!is_numeric($PZ) || $PZ < 0.0) {
		$result=0.0;
		goto error;
	}
	if ($Shell == "ALL") {
		if (is_numeric($Element)) {
			$myElement = $Element;
		}
		else {
			$myElement = SymbolToAtomicNumber($Element);
		}
		if ($myElement < 1 || $myElement > 102) {
			$result=0.0;
			goto error;
		}
		$result = "";
		$table = new HTML_Table(array('width' => '200px'));
		$table->setAutoGrow(true);
		$table->setHeaderContents(0, 0, 'Shell');
		$table->setHeaderContents(0, 1, $xrlFunction);
		$counter=1;
  		foreach ($shellsArray as $shell) {
			$realShell = @constant($shell."_SHELL");
			if (($value = $xrlFunction($myElement, $realShell, $PZ)) > 0.0) {
				$value = sprintf("%g", $value);
				$table->setCellContents($counter,0, $shell);
				$table->setCellAttributes($counter,0, array('class' => 'cellattr'));
				$table->setCellContents($counter,1, $value);
				$table->setCellAttributes($counter,1, array('class' => 'cellattr'));
				$counter++;
			}
		}
		$result=$table->toHtml();
		$unit="";
		$command = "";
		$codeExampleStyle="display:none";
	}
	else {
		$realShell = @constant($Shell);
		if (is_numeric($Element)) {
			$result = $xrlFunction($Element, $realShell, $PZ);
			foreach ($commands as $key => &$value) {
				$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".$Element.", ".expand_entity($Shell, XRL_MACRO, $key).", ".$PZ.")";
			}
			unset($value);
		}
		else {
			#chemical symbol found
			$result = $xrlFunction(SymbolToAtomicNumber($Element), $realShell, $PZ);
			foreach ($commands as $key => &$value) {
				$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, $key)."(".stringify($Element, $key)."), ".expand_entity($Shell, XRL_MACRO, $key).", ".$PZ.")";
			}
			unset($value);
		}
		if ($result != 0.0) {
			$result = sprintf("%g", $result);
		}
		else {
			goto error;
		}
		$unit="";
		$codeExampleStyle="display:block";
	}
	goto past_error;
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "CS_KN")) {
	if (!is_numeric($Energy) || $Energy <= 0.0 || $Energy > MAX_ENERGY) {
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
	display_none_all();
	$ThetaStyle="display:block";
	$codeExampleStyle="display:block";
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
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "DCS_KN" ||
	$xrlFunction == "MomentTransf" || 
	$xrlFunction == "ComptonEnergy")) {
	display_none_all();
	$EnergyStyle="display:block";
	$ThetaStyle="display:block";
	$codeExampleStyle="display:block";
	if (!is_numeric($Energy) || $Energy <= 0.0 || $Energy > MAX_ENERGY) {
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
	else {
		goto error;
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
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "DCS_Rayl" ||
	$xrlFunction == "DCS_Compt" ||
	$xrlFunction == "DCSb_Rayl" ||
	$xrlFunction == "DCSb_Compt")) {
	display_none_all();
	$EnergyStyle="display:block";
	$ThetaStyle="display:block";
	$ElementOrCompoundStyle="display:block";
	$codeExampleStyle="display:block";
	if (!is_numeric($Energy) || $Energy <= 0.0 || $Energy > MAX_ENERGY) {
		$result=0.0;
		goto error;
	}
	if (!is_numeric($Theta) || $Theta < 0.0 || $Theta > PI) {
		$result=0.0;
		goto error;
	}
	if (is_numeric($ElementOrCompound)) {
		$result = $xrlFunction($ElementOrCompound, $Energy, $Theta);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION,  $key)."(".$ElementOrCompound.", ".$Energy.", ".$Theta.")";
		}
		unset($value);
	}
	elseif (SymbolToAtomicNumber($ElementOrCompound) > 0) {
		$result = $xrlFunction(SymbolToAtomicNumber($ElementOrCompound), $Energy, $Theta);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, $key)."(".stringify($ElementOrCompound, $key)."), ".$Energy.", ".$Theta.")";
		}
		unset($value);
	}
	else {
		#compound then maybe...		
		$xrlFunction_cp = $xrlFunction."_CP";
		$result = $xrlFunction_cp($ElementOrCompound, $Energy, $Theta);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction_cp, XRL_FUNCTION, $key)."(".stringify($ElementOrCompound, $key).", ".$Energy.", ".$Theta.")";
		}
		unset($value);
	}
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	else {
		goto error;
	}
	if (substr($xrlFunction,0,4) == "DCSb"){
		$unit=" barns/atom/sr";
	}
	else {
		$unit=" cm<sup>2</sup>/g/sr";
	}
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "DCSP_Thoms")) {
	display_none_all();
	$ThetaStyle="display:block";
	$PhiStyle="display:block";
	$codeExampleStyle="display:block";
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
	else {
		goto error;
	}
	$unit=" cm<sup>2</sup>/g/sr";
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "DCSP_KN")) {
	display_none_all();
	$EnergyStyle="display:block";
	$ThetaStyle="display:block";
	$PhiStyle="display:block";
	$codeExampleStyle="display:block";
	if (!is_numeric($Energy) || $Energy <= 0.0 || $Energy > MAX_ENERGY) {
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
	else {
		goto error;
	}
	$unit=" cm<sup>2</sup>/g/sr";
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "DCSP_Rayl" ||
	$xrlFunction == "DCSP_Compt" ||
	$xrlFunction == "DCSPb_Rayl" ||
	$xrlFunction == "DCSPb_Compt")) {
	display_none_all();
	$EnergyStyle="display:block";
	$ThetaStyle="display:block";
	$ElementOrCompoundStyle="display:block";
	$PhiStyle="display:block";
	$codeExampleStyle="display:block";
	if (!is_numeric($Energy) || $Energy <= 0.0 || $Energy > MAX_ENERGY) {
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
	if (is_numeric($ElementOrCompound)) {
		$result = $xrlFunction($ElementOrCompound, $Energy, $Theta, $Phi);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".$ElementOrCompound.", ".$Energy.", ".$Theta.", ".$Phi.")";
		}
		unset($value);
	}
	elseif (SymbolToAtomicNumber($ElementOrCompound) > 0) {
		$result = $xrlFunction(SymbolToAtomicNumber($ElementOrCompound), $Energy, $Theta, $Phi);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, $key)."(".stringify($ElementOrCompound, $key)."), ".$Energy.", ".$Theta.", ".$Phi.")";
		}
		unset($value);
	}
	else {
		#compound then maybe...		
		$xrlFunction_cp = $xrlFunction."_CP";
		$result = $xrlFunction_cp($ElementOrCompound, $Energy, $Theta, $Phi);
		foreach ($commands as $key => &$value) {
			$value = expand_entity($xrlFunction_cp, XRL_FUNCTION, $key)."(".stringify($ElementOrCompound, $key).", ".$Energy.", ".$Theta.", ".$Phi.")";
		}
		unset($value);
	}
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	else {
		goto error;
	}
	if (substr($xrlFunction,0,5) == "DCSPb"){
		$unit=" barns/atom/sr";
	}
	else {
		$unit=" cm<sup>2</sup>/g/sr";
	}
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "FF_Rayl" ||
	$xrlFunction == "SF_Compt")) {
	display_none_all();
	$ElementStyle="display:block";
	$MomentumTransferStyle="display:block";
	$codeExampleStyle="display:block";
	
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
	else {
		goto error;
	}
}
elseif (isset($_GET['xrlFunction']) && $xrlFunction == "CosKronTransProb") {
	display_none_all();
	$ElementStyle="display:block";
	$CKTransStyle="display:block";
	$codeExampleStyle="display:block";
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
	else {
		goto error;
	}
	$unit="";
}
elseif (isset($_GET['xrlFunction']) && $xrlFunction == "GetCompoundDataNISTList") {
	$nistCompounds = GetCompoundDataNISTList();
	$result = "";

	$table = new HTML_Table(NULL);
	$table->setAutoGrow(true);
	$table->setHeaderContents(0, 0, 'NIST compound name');
	$table->setCellAttributes(0, 0, array('class' => 'cellattrl'));
	for ($i = 0 ; $i < count($nistCompounds) ; $i++) {
	        //$result .= sprintf("  Compound %d: %s<br/>", $i, $nistCompounds[$i]);
		$table->setCellContents($i+1, 0, $nistCompounds[$i]);
		$table->setCellAttributes($i+1, 0, array('class' => 'cellattrl'));
	}
	$result=$table->toHtml();

	foreach ($commands as $key => &$value) {
		if ($key == "C") {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(NULL)";
		}
		else {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."()";
		}
	}
	unset($value);
	$unit="";
	display_none_all();
	$codeExampleStyle="display:block";
	goto past_error;
}
elseif (isset($_GET['xrlFunction']) && $xrlFunction == "GetRadioNuclideDataList") {
	$radioNuclides = GetRadioNuclideDataList();
	$result = "";

	$table = new HTML_Table(NULL);
	$table->setAutoGrow(true);
	$table->setHeaderContents(0, 0, 'Radionuclide');
	$table->setCellAttributes(0, 0, array('class' => 'cellattrl'));
	for ($i = 0 ; $i < count($radioNuclides) ; $i++) {
	        //$result .= sprintf("  Compound %d: %s<br/>", $i, $nistCompounds[$i]);
		$table->setCellContents($i+1, 0, $radioNuclides[$i]);
		$table->setCellAttributes($i+1, 0, array('class' => 'cellattrl'));
	}
	$result=$table->toHtml();

	foreach ($commands as $key => &$value) {
		if ($key == "C") {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(NULL)";
		}
		else {
			$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."()";
		}
	}
	unset($value);
	$unit="";
	display_none_all();
	$codeExampleStyle="display:block";
	goto past_error;
}
elseif (isset($_GET['xrlFunction']) && $xrlFunction == "CompoundParser") {
	display_none_all();
	$codeExampleStyle="display:block";
	$compoundStyle="display:block";
	$compoundData = CompoundParser($Compound);
	if ($compoundData == NULL) {
		goto error;
	}
	$result = "";
	//$result .= sprintf("  Number of elements: %d<br/>", $compoundData["nElements"]);
	//$result .= sprintf("  Number of atoms: %g<br/>", $compoundData["nAtomsAll"]);
	//$result .= sprintf("  Composition:<br/>");
	$table = new HTML_Table(array('width' => '250px'));
	$table->setAutoGrow(true);
	//$table->setCellContents(0, 0, "Number of elements");
	//$table->setCellContents(0, 1, sprintf("%d", $compoundData["nElements"]));
	//$table->setCellAttributes(0, 0, array('align' => 'left'));
	//$table->setCellContents(1, 0, "Number of atoms");
	//$table->setCellContents(1, 1, sprintf("%g", $compoundData["nAtomsAll"]));
	//$table->setCellAttributes(1, 0, array('align' => 'left'));
	$table->setHeaderContents(0, 0, "Element");
	$table->setHeaderContents(0, 1, "Weight fraction");
	$counter=1;
	for ($i = 0 ; $i < $compoundData["nElements"] ; $i++) {
		//$result .= sprintf("    %s: %g %%<br/>", $compoundData["Elements"][$i], $compoundData["massFractions"][$i]);
		$table->setCellContents($counter,0, sprintf("%s", AtomicNumberToSymbol($compoundData["Elements"][$i])));
		$table->setCellAttributes($counter,0, array('class' => 'cellattr'));
		$table->setCellContents($counter,1, sprintf("%g %%",$compoundData["massFractions"][$i]*100.0));
		$table->setCellAttributes($counter,1, array('class' => 'cellattr'));
		$counter++;
	}
	$result=$table->toHtml();
	foreach ($commands as $key => &$value) {
		$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".stringify($Compound, $key).")";
	}
	unset($value);
	$unit="";
	goto past_error;
}
elseif (isset($_GET['xrlFunction']) && $xrlFunction == "GetCompoundDataNISTByName") {
	display_none_all();
	$codeExampleStyle="display:block";
	$NISTcompoundStyle="display:block";
	$compoundData = GetCompoundDataNISTByName($NISTcompound);
	if ($compoundData == NULL) {
		goto error;
	}
	$result = "";
	//$result .= sprintf("  Number of elements: %d<br/>", $compoundData["nElements"]);
	//$result .= sprintf("  Density: %g<br/>", $compoundData["density"]);
	//$result .= sprintf("  Composition:<br/>");
	$table = new HTML_Table(array('width' => '200px'));
	$table->setAutoGrow(true);
	//$table->setCellContents(0, 0, "Number of elements");
	//$table->setCellContents(0, 1, sprintf("%d", $compoundData["nElements"]));
	//$table->setCellAttributes(0, 0, array('align' => 'left'));
	$table->setHeaderContents(0, 0, "Density");
	$table->setCellAttributes(0,0, array('class' => 'cellattr'));
	$table->setCellContents(0, 1, sprintf("%g g/cm<sup>3</sup>", $compoundData["density"]));
	$table->setCellAttributes(0,1, array('class' => 'cellattr'));
	$table->setHeaderContents(1, 0, "Element");
	$table->setHeaderContents(1, 1, "Weight fraction");
	$counter=2;
	for ($i = 0 ; $i < $compoundData["nElements"] ; $i++) {
		//$result .= sprintf("    %s: %g %%<br/>", $compoundData["Elements"][$i], $compoundData["massFractions"][$i]);
		$table->setCellContents($counter,0, sprintf("%s", AtomicNumberToSymbol($compoundData["Elements"][$i])));
		$table->setCellAttributes($counter,0, array('class' => 'cellattr'));
		$table->setCellContents($counter,1, sprintf("%g %%",$compoundData["massFractions"][$i]*100.0));
		$table->setCellAttributes($counter,1, array('class' => 'cellattr'));
		$counter++;
	}
	$result=$table->toHtml();
	foreach ($commands as $key => &$value) {
		$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".stringify($Compound, $key).")";
	}
	unset($value);
	$unit="";
	goto past_error;
}
elseif (isset($_GET['xrlFunction']) && $xrlFunction == "GetRadioNuclideDataByName") {
	display_none_all();
	$codeExampleStyle="display:block";
	$RadioNuclideStyle="display:block";
	$nuclideData = GetRadioNuclideDataByName($RadioNuclide);
	if ($nuclideData == NULL) {
		goto error;
	}
	$result = "";
	//$result .= sprintf("  Number of elements: %d<br/>", $compoundData["nElements"]);
	//$result .= sprintf("  Density: %g<br/>", $compoundData["density"]);
	//$result .= sprintf("  Composition:<br/>");
	$table = new HTML_Table(NULL);
	$table->setAutoGrow(true);
	//$table->setCellContents(0, 0, "Number of elements");
	//$table->setCellContents(0, 1, sprintf("%d", $compoundData["nElements"]));
	//$table->setCellAttributes(0, 0, array('align' => 'left'));
	$table->setHeaderContents(0, 0, "X-ray energy");
	$table->setCellAttributes(0,0, array('class' => 'cellattr'));
	$table->setHeaderContents(0, 1, "Disintegrations per second");
	$table->setCellAttributes(0,1, array('class' => 'cellattr'));
	$counter=1;
	for ($i = 0 ; $i < $nuclideData["nXrays"] ; $i++) {
		//$result .= sprintf("    %s: %g %%<br/>", $compoundData["Elements"][$i], $compoundData["massFractions"][$i]);
		$table->setCellContents($counter,0, sprintf("%g keV", LineEnergy($nuclideData["Z_xray"], $nuclideData["XrayLines"][$i])));
		$table->setCellAttributes($counter,0, array('class' => 'cellattr'));
		$table->setCellContents($counter,1, sprintf("%g",$nuclideData["XrayIntensities"][$i]));
		$table->setCellAttributes($counter,1, array('class' => 'cellattr'));
		$counter++;
	}
	$table->setHeaderContents($counter, 0, "Gamma-ray energy");
	$table->setCellAttributes($counter,0, array('class' => 'cellattr'));
	$table->setHeaderContents($counter, 1, "Disintegrations per second");
	$table->setCellAttributes($counter,1, array('class' => 'cellattr'));
	$counter++;
	for ($i = 0 ; $i < $nuclideData["nGammas"] ; $i++) {
		//$result .= sprintf("    %s: %g %%<br/>", $compoundData["Elements"][$i], $compoundData["massFractions"][$i]);
		$table->setCellContents($counter,0, sprintf("%g keV", $nuclideData["GammaEnergies"][$i]));
		$table->setCellAttributes($counter,0, array('class' => 'cellattr'));
		$table->setCellContents($counter,1, sprintf("%g",$nuclideData["GammaIntensities"][$i]));
		$table->setCellAttributes($counter,1, array('class' => 'cellattr'));
		$counter++;
	}


	$result=$table->toHtml();
	foreach ($commands as $key => &$value) {
		$value = expand_entity($xrlFunction, XRL_FUNCTION, $key)."(".stringify($RadioNuclide, $key).")";
	}
	unset($value);
	$unit="";
	goto past_error;
}
//error handling
error:
if (isset($_GET['xrlFunction']) && $result == 0.0) {
	$result = $xrlFunction.": Invalid input or zero was returned";
	$unit = "";
	$command = "";
	$codeExampleStyle="display:none";
}
past_error:
}
?>

<h1>xraylib: the official online calculator!</h1>

<p>This webpage is built around <i>xraylib</i>, an ANSI-C library designed to provide convenient access to physical data in the field of interactions of X-rays with matter. The library comes with bindings to a large number of languages such as Python, Perl, Fortran, PHP (used to power this website) and several others. For all information concerning the library, have a look at the <a href="http://github.com/tschoonj/xraylib"><i>xraylib Github repository</i></a>.</p>
<br/>
<p>Through the interface provided here, you should be able to perform simple queries from the database. With the instructions provided in the <a href="http://github.com/tschoonj/xraylib/wiki"><i>online manual</i></a>, you will be able to integrate similar queries directly into your own applications using one of the bindings we offer.</p>
<br/>
<p><i>xraylib</i> is the result of an ongoing research collaboration between the <a href="http://www.esrf.eu">European Synchrotron Radiation Facility (Grenoble, France)</a>, <a href="http://www.ugent.be">Ghent University (Flanders, Belgium)</a> and the <a href="http://www.uniss.it">University of Sassari (Sardinia, Italy)</a>.
When using this website, or <i>xraylib</i> itself, please cite our <a href="http://dx.doi.org/10.1016/j.sab.2011.09.011">work</a> in your publications.
</p>

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
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'CS_Photo_Partial') { ?>selected="true" <?php }; ?>value="CS_Photo_Partial">Partial photoionization cross section</option>
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
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'Fi') { ?>selected="true" <?php }; ?>value="Fi">Anomalous scattering factor &phi;&prime;</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'Fii') { ?>selected="true" <?php }; ?>value="Fii">Anomalous scattering factor &phi;&Prime;</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'ElectronConfig') { ?>selected="true" <?php }; ?>value="ElectronConfig">Electronic configuration</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'CS_FluorLine_Kissel_Cascade') { ?>selected="true" <?php }; ?>value="CS_FluorLine_Kissel_Cascade">X-ray fluorescence production cross section (with full cascade)</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'CS_FluorLine_Kissel_Radiative_Cascade') { ?>selected="true" <?php }; ?>value="CS_FluorLine_Kissel_Radiative_Cascade">X-ray fluorescence production cross section (with radiative cascade)</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'CS_FluorLine_Kissel_Nonradiative_Cascade') { ?>selected="true" <?php }; ?>value="CS_FluorLine_Kissel_Nonradiative_Cascade">X-ray fluorescence production cross section (with non-radiative cascade)</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'CS_FluorLine_Kissel_no_Cascade') { ?>selected="true" <?php }; ?>value="CS_FluorLine_Kissel_no_Cascade">X-ray fluorescence production cross section (without cascade)</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'AtomicLevelWidth') { ?>selected="true" <?php }; ?>value="AtomicLevelWidth">Atomic level width</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'AugerYield') { ?>selected="true" <?php }; ?>value="AugerYield">Auger yield</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'AugerRate') { ?>selected="true" <?php }; ?>value="AugerRate">Auger rate</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'Refractive_Index') { ?>selected="true" <?php }; ?>value="Refractive_Index">Refractive index</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'ComptonProfile') { ?>selected="true" <?php }; ?>value="ComptonProfile">Compton broadening profile</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'ComptonProfile_Partial') { ?>selected="true" <?php }; ?>value="ComptonProfile_Partial">Partial Compton broadening profile</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'GetCompoundDataNISTList') { ?>selected="true" <?php }; ?>value="GetCompoundDataNISTList">List of NIST catalog compounds</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'GetCompoundDataNISTByName') { ?>selected="true" <?php }; ?>value="GetCompoundDataNISTByName">Get composition of NIST catalog compound</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'GetRadioNuclideDataList') { ?>selected="true" <?php }; ?>value="GetRadioNuclideDataList">List of X-ray emitting radionuclides</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'GetRadioNuclideDataByName') { ?>selected="true" <?php }; ?>value="GetRadioNuclideDataByName">Get excitation profile of X-ray emitting radionuclide</option>
  <option <?php if (isset($_GET['xrlFunction']) && $_GET['xrlFunction'] == 'CompoundParser') { ?>selected="true" <?php }; ?>value="CompoundParser">Compoundparser</option>
</select>

<div id="inputParameter">
  <div id="element" style="<?php echo $ElementStyle;?>">
  Element: <input type="text" name="Element" value="<?php echo $Element;?>"/>
  </div>
  <div id="elementOrCompound" style="<?php echo $ElementOrCompoundStyle;?>">
  Element or Compound: <input type="text" name="ElementOrCompound" value="<?php echo $ElementOrCompound;?>"/>
  </div>
  <div id="compound" style="<?php echo $compoundStyle;?>">
  Compound: <input type="text" name="Compound" value="<?php echo $Compound;?>"/>
  </div>
  <div id="augertrans" style="<?php echo $AugerTransStyle;?>">
   Excited shell: <select name="AugerTransa" id="AugerTransa" onchange="AugerTransaChanged(this)">
	<?php 
		foreach (array_slice($shellsArray, 0, 8) as $shell) {
			echo "<option value=\"$shell\"";
			if ($AugerTransa == $shell) {
				echo "selected=\"true\" ";
			}
			echo "> $shell</option>";
		}
	?>
   </select><br/>
   Transition shell: <select name="AugerTransb" id="AugerTransb" onchange="AugerTransbChanged(this)">
	<?php
		$res = array_search($AugerTransa, $shellsArray, true);
		$slice = array_slice($shellsArray, $res+1,9-$res-1);
		$i = 0;
		foreach ($slice as $shell) {
			echo "<option value=\"$shell\"";
			if (($i++ == 0 && array_search($AugerTransb, $slice) === FALSE) || $AugerTransb == $shell) {
				echo "selected=\"true\" ";
			}
			echo "> $shell</option>";
		}
	?>
   </select><br/>
   Auger electron shell: <select name="AugerTransc" id="AugerTransc">
	<?php
		$res = array_search($AugerTransb, $shellsArray, true);
		$slice = array_slice($shellsArray, $res);
		$i = 0;
		foreach ($slice as $shell) {
			echo "<option value=\"$shell\"";
			if (($i++ == 0 && array_search($AugerTransc, $slice) === FALSE) || $AugerTransc == $shell) {
				echo "selected=\"true\" ";
			}
			echo "> $shell</option>";
		}
	?>
   </select><br/>
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
   </select><br/>
  <input type="radio" name="LinenameSwitch" id="ALL"
   value="ALL" <?php if ($LinenameSwitch == 'ALL') { ?> checked <?php }?>/>
   <label for="ALL">All transitions</label>
   </td>
   </tr>
   </table>
  </div>
  <div id="nistcompound" style="<?php echo $NISTcompoundStyle;?>">
  NIST compound: <select name="NISTcompound" id="NISTcompound">
  <?php
  foreach ($NISTcompoundArray as $nistcompound) {
  	echo "<option value=\"$nistcompound\"";
	if ($nistcompound == $NISTcompound) {
		echo "selected=\"true\" ";
  	} 
	echo ">$nistcompound</option>";
  } 
  ?>
  </select>
  </div>
  <div id="radionuclide" style="<?php echo $RadioNuclideStyle;?>">
  Radionuclide: <select name="RadioNuclide" id="RadioNuclide">
  <?php
  foreach ($RadioNuclideArray as $radionuclide) {
  	echo "<option value=\"$radionuclide\"";
	if ($radionuclide == $RadioNuclide) {
		echo "selected=\"true\" ";
  	} 
	echo ">$radionuclide</option>";
  } 
  ?>
  </select>
  </div>
  <div id="shell" style="<?php echo $ShellStyle;?>">
  Shell: <select name="Shell" id="Shell">
  <?php 
  echo "<option value=\"ALL\"";
  if ($Shell == "ALL") {
	echo "selected=\"true\" ";
  }
  echo ">All shells</option>";
  foreach ($shellsArray as $shell) {
  		$shellFull = $shell."_SHELL";
  		echo "<option value=\"$shellFull\"";
		if ($Shell == $shellFull) {
				echo "selected=\"true\" ";
		}
		echo ">$shell</option>";
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
  Transition: <select name="CKTrans" id="CKTrans">
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
  <div id="density" style="<?php echo $DensityStyle;?>">
  Density: <input type="text" name="Density" value="<?php echo $Density;?>"/> g/cm<sup>3</sup>
  </div>
  <div id="pz" style="<?php echo $PZStyle;?>">
  Electron momentum p<sub>z</sub>: <input type="text" name="PZ" value="<?php echo $PZ;?>"/>
  </div>

</div>
<br/>
<input type="submit" name="submit" value="Go!">
<br/><br/>
<p>
<?php 
echo "<h2>Result</h2>";
echo "<p style=\"font-size:20px\">";
echo $result,$unit;
?>
<p/>
<br/><br/>
<div id="codeExample" style=<?php echo $codeExampleStyle;?>>
<p>
<h2>Code example</h2>
Call in <select name="Language" id="Language" onchange="optionCheckLanguage(this)">
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
<br/><br/>

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
	document.getElementById("compound").style.display= "none";
	document.getElementById("linetype").style.display= "none";
	document.getElementById("shell").style.display= "none";
	document.getElementById("energy").style.display= "none";
	document.getElementById("theta").style.display= "none";
	document.getElementById("phi").style.display= "none";
	document.getElementById("momentumtransfer").style.display= "none";
	document.getElementById("cktrans").style.display= "none";
	document.getElementById("density").style.display= "none";
	document.getElementById("pz").style.display= "none";
	document.getElementById("augertrans").style.display= "none";
	document.getElementById("nistcompound").style.display= "none";
	document.getElementById("radionuclide").style.display= "none";
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

function AugerTransaChanged(AugerTransa) {
    var shellsArray = ["K", "L1", "L2", "L3", "M1", "M2", "M3", "M4", "M5", "N1", "N2", "N3", "N4", "N5", "N6", "N7", "O1", "O2", "O3", "O4", "O5", "O6", "O7", "P1", "P2", "P3", "P4", "P5", "Q1", "Q2", "Q3"];

    var AugerTransb = document.getElementById("AugerTransb");
    //get selected value
    var selected = AugerTransb.options[AugerTransb.selectedIndex].value;

    //clear AugerTransb
    AugerTransb.options.length = 0;
    var res = shellsArray.indexOf(AugerTransa.options[AugerTransa.selectedIndex].value);
    var match = false;
    for (var i = res+1 ; i < 9 ; i++) {
    	AugerTransb.options.add(new Option(shellsArray[i], shellsArray[i]));
	if (shellsArray[i] == selected) {
		AugerTransb.options[i-res-1].selected = true;
		match = true;
	}
    }
    if (match == false) {
        //select the first option if previously selected value is not found
	AugerTransb.options[0].selected = true;
    }
    AugerTransbChanged(AugerTransb);
} 

function AugerTransbChanged(AugerTransb) {
    var shellsArray = ["K", "L1", "L2", "L3", "M1", "M2", "M3", "M4", "M5", "N1", "N2", "N3", "N4", "N5", "N6", "N7", "O1", "O2", "O3", "O4", "O5", "O6", "O7", "P1", "P2", "P3", "P4", "P5", "Q1", "Q2", "Q3"];

    var AugerTransc = document.getElementById("AugerTransc");
    //get selected value
    var selected = AugerTransc.options[AugerTransc.selectedIndex].value;

    //clear AugerTransb
    AugerTransc.options.length = 0;
    var res = shellsArray.indexOf(AugerTransb.options[AugerTransb.selectedIndex].value);
    var match = false;
    for (var i = res ; i < shellsArray.length ; i++) {
    	AugerTransc.options.add(new Option(shellsArray[i], shellsArray[i]));
	if (shellsArray[i] == selected) {
		AugerTransc.options[i-res].selected = true;
		match = true;
	}
    }
    if (match == false) {
        //select the first option if previously selected value is not found
	AugerTransc.options[0].selected = true;
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
      selectedValue === "FluorYield" ||
      selectedValue === "AugerYield" ||
      selectedValue === "AtomicLevelWidth" ||
      selectedValue === "ElectronConfig") {
	document.getElementById("element").style.display= "block";
	document.getElementById("shell").style.display= "block";
    } else if (selectedValue === "CS_Photo_Partial") {
	document.getElementById("element").style.display= "block";
	document.getElementById("shell").style.display= "block";
	document.getElementById("energy").style.display= "block";
    } else if (selectedValue === "CS_FluorLine_Kissel_Cascade" ||
      selectedValue === "CS_FluorLine_Kissel_Nonradiative_Cascade" ||
      selectedValue === "CS_FluorLine_Kissel_Radiative_Cascade" ||
      selectedValue === "CS_FluorLine_Kissel_no_Cascade"
    ) {
	document.getElementById("element").style.display= "block";
	document.getElementById("linetype").style.display= "block";
	document.getElementById("energy").style.display= "block";
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
	document.getElementById("elementOrCompound").style.display= "block";
    } else if (selectedValue === "Fi" ||
      selectedValue === "Fii") {
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
	document.getElementById("elementOrCompound").style.display= "block";
	document.getElementById("phi").style.display= "block";
    } else if (selectedValue === "FF_Rayl" ||
      selectedValue === "SF_Compt") {
	document.getElementById("momentumtransfer").style.display= "block";
	document.getElementById("element").style.display= "block";
    } else if (selectedValue === "CosKronTransProb") {
	document.getElementById("element").style.display= "block";
	document.getElementById("cktrans").style.display= "block";
    } else if (selectedValue === "Refractive_Index") {
	document.getElementById("energy").style.display= "block";
	document.getElementById("elementOrCompound").style.display= "block";
	document.getElementById("density").style.display= "block";
    } else if (selectedValue === "ComptonProfile") {
	document.getElementById("element").style.display= "block";
	document.getElementById("pz").style.display= "block";
    } else if (selectedValue === "ComptonProfile_Partial") {
	document.getElementById("element").style.display= "block";
	document.getElementById("shell").style.display= "block";
	document.getElementById("pz").style.display= "block";
    } else if (selectedValue === "GetCompoundDataNISTList" ||
      selectedValue === "GetRadioNuclideDataList") {
	/* do nothing */       
    } else if (selectedValue === "AugerRate") {
	document.getElementById("element").style.display= "block";
	document.getElementById("augertrans").style.display= "block";
    } else if (selectedValue === "CompoundParser") {
	document.getElementById("compound").style.display= "block";
    } else if (selectedValue === "GetCompoundDataNISTByName") {
	document.getElementById("nistcompound").style.display= "block";
    } else if (selectedValue === "GetRadioNuclideDataByName") {
	document.getElementById("radionuclide").style.display= "block";
    }
}

</script>
<footer>
<address>
Maintained by <a href="mailto:Tom.Schoonjans@gmail.com">Tom Schoonjans</a><br/>
Thanks to Prof. Laszlo Vincze of Ghent University for providing the webspace.<br/>
Built using xraylib <?php echo XRAYLIB_MAJOR.".".XRAYLIB_MINOR.".".XRAYLIB_MICRO ?>.
Development occurs at the <a href="http://github.com/tschoonj/xraylib-web"><i>xraylib-web Github repository</i></a>
</address>
</footer>
</body>
</html>

