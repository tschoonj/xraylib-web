<!DOCTYPE html>

<html lang=en>
<head>
<title>xraylib online calculator</title>

</head>
<body>

<?php
include("xraylib.php");
include("xraylib_aux.php");
include("geshi.php");
//error_reporting(E_WARNING);
//init
$xrlFunction="LineEnergy";
$Element="26";
$Linename="KL3_LINE";
$Shell="K_SHELL";
$Energy="10.0";
$Theta=1.5707964;
$Phi=3.14159;
$result="";
$command="";
$unit="";
$ElementStyle="display:block";
$LinetypeStyle="display:block";
$ShellStyle="display:none";
$EnergyStyle="display:none";
$ThetaStyle="display:none";
$PhiStyle="display:none";
$Language="C";

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
		$command = expand_entity($xrlFunction, XRL_FUNCTION, $Language)."(".$Element.", ".expand_entity($Linename, XRL_MACRO, $Language).")";
	}
	else {
		$result = $xrlFunction(SymbolToAtomicNumber($Element), $realLinename);
		$command = expand_entity($xrlFunction, XRL_FUNCTION, $Language)."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, $Language)."(".stringify($Element,$Language)."), ".expand_entity($Linename, XRL_MACRO, $Language).")";
	}
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	$unit=" keV";
	display_none_all();
	$ElementStyle="display:block";
	$LinetypeStyle="display:block";
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
		$command = expand_entity($xrlFunction, XRL_FUNCTION, $Language)."(".$Element.", ".expand_entity($Shell, XRL_MACRO, $Language).")";
	}
	else {
		$result = $xrlFunction(SymbolToAtomicNumber($Element), $realShell);
		$command = expand_entity($xrlFunction, XRL_FUNCTION, $Language)."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, $Language)."(".stringify($Element,$Language)."), ".expand_entity($Shell, XRL_MACRO, $Language).")";
	}
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	$unit=" keV";
	display_none_all();
	$ElementStyle="display:block";
	$ShellStyle="display:block";
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "AtomicWeight" || $xrlFunction == "ElementDensity")) {
	if (is_numeric($Element)) {
		$result = $xrlFunction($Element);
		$command = expand_entity($xrlFunction, XRL_FUNCTION, $Language)."(".$Element.")";
	}
	else {
		$result = $xrlFunction(SymbolToAtomicNumber($Element));
		$command = expand_entity($xrlFunction, XRL_FUNCTION, $Language)."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, $Language)."(".stringify($Element,$Language)."))";
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
		$command = expand_entity($xrlFunction, XRL_FUNCTION, $Language)."(".$Element.", ".$Energy.")";
	}
	else {
		$result = $xrlFunction(SymbolToAtomicNumber($Element), $Energy);
		$command = expand_entity($xrlFunction, XRL_FUNCTION, $Language)."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, $Language)."(".stringify($Element,$Language)."), ".$Energy.")";
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

}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "CS_KN")) {
	if (!is_numeric($Energy) || $Energy <= 0.0 || $Energy >= 100.0) {
		$result=0.0;
		goto error;
	}
	$result = $xrlFunction($Energy);
	$command = expand_entity($xrlFunction, XRL_FUNCTION, $Language)."(".$Energy.")";
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	$unit=" cm<sup>2</sup>/g";
	display_none_all();
	$EnergyStyle="display:block";
}
elseif (isset($_GET['xrlFunction']) && ($xrlFunction == "DCS_Thoms")) {
	if (!is_numeric($Theta) || $Theta < 0.0 || $Theta > PI) {
		$result=0.0;
		goto error;
	}
	$result = $xrlFunction($Theta);
	$command = expand_entity($xrlFunction, XRL_FUNCTION, $Language)."(".$Theta.")";
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	$unit=" cm<sup>2</sup>/g/sterad";
	display_none_all();
	$ThetaStyle="display:block";
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
	$command = expand_entity($xrlFunction, XRL_FUNCTION, $Language)."(".$Energy.", ".$Theta.")";
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	$unit=" cm<sup>2</sup>/g/sterad";
	display_none_all();
	$EnergyStyle="display:block";
	$ThetaStyle="display:block";
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
		$command = expand_entity($xrlFunction, XRL_FUNCTION, $Language)."(".$Element.", ".$Energy.", ".$Theta.")";
	}
	else {
		$result = $xrlFunction(SymbolToAtomicNumber($Element), $Energy, $Theta);
		$command = expand_entity($xrlFunction, XRL_FUNCTION, $Language)."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, $Language)."(".stringify($Element,$Language)."), ".$Energy.", ".$Theta.")";
	}
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	if (substr($xrlFunction,0,4) == "DCSb"){
		$unit=" barns/atom/sterad";
	}
	else {
		$unit=" cm<sup>2</sup>/g/sterad";
	}
	display_none_all();
	$EnergyStyle="display:block";
	$ThetaStyle="display:block";
	$ElementStyle="display:block";
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
	$command = expand_entity($xrlFunction, XRL_FUNCTION, $Language)."(".$Theta.", ".$Phi.")";
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	$unit=" cm<sup>2</sup>/g/sterad";
	display_none_all();
	$ThetaStyle="display:block";
	$PhiStyle="display:block";
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
	$command = expand_entity($xrlFunction, XRL_FUNCTION, $Language)."(".$Energy.", ".$Theta.", ".$Phi.")";
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	$unit=" cm<sup>2</sup>/g/sterad";
	display_none_all();
	$EnergyStyle="display:block";
	$ThetaStyle="display:block";
	$PhiStyle="display:block";
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
		$command = expand_entity($xrlFunction, XRL_FUNCTION, $Language)."(".$Element.", ".$Energy.", ".$Theta.", ".$Phi.")";
	}
	else {
		$result = $xrlFunction(SymbolToAtomicNumber($Element), $Energy, $Theta, $Phi);
		$command = expand_entity($xrlFunction, XRL_FUNCTION, $Language)."(".expand_entity("SymbolToAtomicNumber", XRL_FUNCTION, $Language)."(".stringify($Element,$Language)."), ".$Energy.", ".$Theta.", ".$Phi.")";
	}
	if ($result != 0.0) {
		$result = sprintf("%g", $result);
	}
	if (substr($xrlFunction,0,5) == "DCSPb"){
		$unit=" barns/atom/sterad";
	}
	else {
		$unit=" cm<sup>2</sup>/g/sterad";
	}
	display_none_all();
	$EnergyStyle="display:block";
	$ThetaStyle="display:block";
	$ElementStyle="display:block";
	$PhiStyle="display:block";
}


//error handling
error:
if (isset($_GET['xrlFunction']) && $result == 0.0) {
	$result = $xrlFunction.": Invalid input";
	$unit = "";
	$command = "";
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
Function: <select onchange="optionCheck(this)" name="xrlFunction" id="xrlFunction">
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
<p>Call in <select name="Language" id="Language">
  <option <?php if (isset($_GET['Language']) && $_GET['Language'] == 'C') { ?>selected="true" <?php }; ?>value="C" selected="selected">C/C++/Objective-C</option>
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
<?php
if ($command != "") {
$geshi = new GeSHi($command,strtolower($Language));
echo $geshi->parse_code();
echo "Enable support for xraylib in your program using:<br/>";
$geshi = new GeSHi(xraylib_enable($Language),strtolower($Language));
echo $geshi->parse_code();
}
?>
</p>
</form>


<script type="text/javascript">
function display_none_all() {
	document.getElementById("element").style.display= "none";
	document.getElementById("linetype").style.display= "none";
	document.getElementById("shell").style.display= "none";
	document.getElementById("energy").style.display= "none";
	document.getElementById("theta").style.display= "none";
	document.getElementById("phi").style.display= "none";
}
function optionCheck(combo) {
    /*jslint browser:true */
    var selectedValue = combo.options[combo.selectedIndex].value;

    if (selectedValue === "LineEnergy") {
    	display_none_all();
	document.getElementById("element").style.display= "block";
	document.getElementById("linetype").style.display= "block";
    } else if (selectedValue === "EdgeEnergy") {
    	display_none_all();
	document.getElementById("element").style.display= "block";
	document.getElementById("shell").style.display= "block";
    } else if (selectedValue === "AtomicWeight" || selectedValue === "ElementDensity") {
    	display_none_all();
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
	display_none_all();
	document.getElementById("energy").style.display= "block";
	document.getElementById("element").style.display= "block";
    } else if (selectedValue === "CS_KN") {
    	display_none_all();
	document.getElementById("energy").style.display= "block";
    } else if (selectedValue === "DCS_Thoms") {
    	display_none_all();
	document.getElementById("theta").style.display= "block";
    } else if (selectedValue === "DCS_KN") {
    	display_none_all();
	document.getElementById("energy").style.display= "block";
	document.getElementById("theta").style.display= "block";
    } else if (selectedValue === "DCS_Rayl" ||
      selectedValue === "DCS_Compt" ||
      selectedValue === "DCSb_Rayl" ||
      selectedValue === "DCSb_Compt") {
	display_none_all();
	document.getElementById("theta").style.display= "block";
	document.getElementById("energy").style.display= "block";
	document.getElementById("element").style.display= "block";
    } else if (selectedValue === "DCSP_Thoms") {
    	display_none_all();
	document.getElementById("theta").style.display= "block";
	document.getElementById("phi").style.display= "block";
    } else if (selectedValue === "DCSP_KN") {
    	display_none_all();
	document.getElementById("energy").style.display= "block";
	document.getElementById("theta").style.display= "block";
	document.getElementById("phi").style.display= "block";
    } else if (selectedValue === "DCSP_Rayl" ||
      selectedValue === "DCSP_Compt" ||
      selectedValue === "DCSPb_Rayl" ||
      selectedValue === "DCSPb_Compt") {
	display_none_all();
	document.getElementById("theta").style.display= "block";
	document.getElementById("energy").style.display= "block";
	document.getElementById("element").style.display= "block";
	document.getElementById("phi").style.display= "block";
    }

}
</script>
<footer>
<address>
Maintained by <a href="mailto:Tom.Schoonjans@gmail.com">Tom Schoonjans</a><br/>
Thanks to Prof. Laszlo Vincze of Ghent University for providing the webspace.
</address>
</footer>
</body>
</html>

