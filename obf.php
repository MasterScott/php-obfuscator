<?php
/**InsideHeartz **/
error_reporting(0);
// Warna Terminl
$biru = "\e[34m";
$kuning = "\e[33m";
$cyan = "\e[96m";
$magenta = "\e[35m";
$hijau = "\e[92m";
$merah = "\e[91m";
echo "$cyan + //////////////////////////////+\n";
echo "$cyan ___           _     _
|_ _|_ __  ___(_) __| | ___
 | || '_ \/ __| |/ _` |/ _ \
 | || | | \__ \ | (_| |  __/
|___|_| |_|___/_|\__,_|\___|\n";
echo "_   _                 _
| | | | ___  __ _ _ __| |_ ____
| |_| |/ _ \/ _` | '__| __|_  /
|  _  |  __/ (_| | |  | |_ / /
|_| |_|\___|\__,_|_|   \__/___|\n\n";

echo " \n";
echo " ~~~~~~ PHP OBFUSCATOR ~~~~~\n  ";
echo ' Nama file: ';
$input = trim(fgets(STDIN));
echo ' Nama file hasil: ';
$output = trim(fgets(STDIN));


echo PHP_EOL;
if(empty($input) && empty($output))
{
	echo 'Mana file nya ?';
	exit;
}
function strToHex($string){
 $field=bin2hex($string);
$field=chunk_split($field,2,"\x");
$field= "\x" . substr($field,0,-2);
return $field;
}
function RandomString()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i <=5; $i++) {
        @$randstring.= $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}

function obfuscate($text)
{
	$var = RandomString();
	$var2 = RandomString();

	$res = ucwords(base64_encode($text));

	$content='$'.$var.'="\x73\x74\x72\x5f\x72\x6f\x74\x31\x33";$'.$var2.'="\x62\x61\x73\x65\x36\x34\x5f\x64\x65\x63\x6f\x64\x65";@eval($'.$var2.'($'.$var.'("'.$res.'")));';
	$hex=strToHex($content);
	return $content;
}

function create_result($result,$output)
{
	$var = "InsideHeartz_".RandomString();
	$content ='<?php 
/* Obfuscate By InsideHeartz 
*/
/* https://insideheartz.id */ ';
	$result = strToHex($result);
	$content.= '$'.$var.'="'.$result.'";@eval($'.$var.'); ?>';
	return file_put_contents($output,$content);
}
function cleanInput($text)
{
	$x=str_replace(['<?php','?>'],"",$text);
	return $x;
}
$input = cleanInput(file_get_contents($input));
$obs = obfuscate($input);
if(create_result($obs,$output))
{
	echo "DONE => $output \n";
}else{
	echo "FAILED !!\n";
}
