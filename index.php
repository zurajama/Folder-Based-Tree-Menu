<?php
$submenu='files';//Base Folder Name
if (isset($_GET["submenu"])) 		{$submenu=$_GET["submenu"];}//link name for iteration subfolders
function GetTreeMenu ($submenutree) {
	setlocale(LC_ALL,'C.UTF-8');////local encoding
	$explodedpass=explode("/",$submenutree);//scan folder
	global $horizontalmenu;
//სხვა ვარიანტები
	$directoryes=array();
	foreach ($explodedpass as $stepkey=>$passbystep) {
		if (isset($passbystepori)) {
			$passbystep=$passbystepori."/".$passbystep;
			} 
		else 
			{
			$passebystep=$passbystep;
			}
	//$fname=basename($passbystep);//Get onli folder (file) name
	$directoryes[$passbystep]=(glob ("$passbystep/*"));		
	$passbystepori=$passbystep;
		}////გადავაქციოთ $submenu - მასივად სადაც მოქცეული იქნება value - დირექტორიის მისამართი
	$revdir=array_reverse($directoryes);
	$block="";	
foreach ($revdir as $arrayname=>$subarray) {
$blockori="";
	if (!isset($arraynameori) and is_dir($arrayname)) {$flag=$arrayname;}
	foreach ($subarray as $link) {
//////დავამუშაოთ ლინკის სტილი
$ext = pathinfo($link, PATHINFO_EXTENSION);///get file extension
$openfolder="<img src=\"treeimg/folderopen.png\" width=\"18\" height=\"18\" />";
$closedfolder="<img src=\"treeimg/folder.png\" width=\"18\" height=\"18\" />";
$filepic="<img src=\"treeimg/$ext.png\" width=\"16\" height=\"16\" /> ";

	if (is_dir($link)) {
					$pic=$closedfolder;
					}
				else {
					$pic=$filepic;
					}

if ($submenutree==$link) {
$linkadress="\t\t<li><a href=\"".$_SERVER['PHP_SELF']."?horizontalmenu=$horizontalmenu&submenu=$link\">$pic<span class=\"treemenuselected\">".
basename($link)."</span></a></li>\n";
	}
else {
$linkadress="\t\t<li><a href=\"".$_SERVER['PHP_SELF']."?horizontalmenu=$horizontalmenu&submenu=$link\">$pic".
basename($link)."</a></li>\n";	
	}		
		if (isset($arraynameori) and $arraynameori!==$arrayname) {
		
		if ($link==$flag) {
$block=$blockori.
"\t\t<li><a href=\"".$_SERVER['PHP_SELF']."?horizontalmenu=$horizontalmenu&submenu=$arrayname\">".$openfolder."".basename($link)."</a>\n"."\t\t<ul>\n"
.$block."\t\t</ul>\n\t\t</li>\n";
				$blockori="";
				$flag=$arrayname;
				}
		else if ($link!==$flag) {
			$block=$block;
			$blockori=$blockori.$linkadress;
				}	
			}
		else {
			$block=$block.$linkadress;
			}		
		}
$block=$block.$blockori;
///
if (is_dir($arrayname)) {$arraynameori=$arrayname;}	
	}

echo ("\t<ul>\n".$block."\t</ul>\n");	
	
}///End of function
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Folder Based Tree Menu</title>
<link href="folbasedcss.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="treemenu">
		<?php        
        GetTreeMenu ($submenu);
        ?>
    </div><!--End of Treemenu-->
</body>
</html>