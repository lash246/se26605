<?php
function randC() /* Generates Ranadom Colors */
{
    $rd = rand(0,255);
    $gn = rand(0,255);
    $be = rand(0,255);
    
    return sprintf('%02X%02X%02X', $rd, $gn, $be); /*sprintf is used for length-padding & hexideciimal output */
}

$table='';
for ($i=0; $i<10; $i++) {
		$table .= "<tr>";
	
	for ($j=0; $j<10; $j++) {
        $c = randC();
        $table .= "<td style='background-color:#$c'>$c<br><span class='textcolor'>$c</span></td>";
    }
		$table .= '</tr>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Multiplication Table</title>
	
<style type='text/css'>
table {
    border-collapse: collapse; /*Each cell block shares borders*/
}
td {
	height: 90px;
    width: 90px;
	font-size: 8pt;
	text-align: center;
    font-family: Times New Roman;
}
.textcolor {
    color: white;
}
</style>

</head>

<body>
<table border='5'> /* Thickness of the border outler layer */
    <?=$table?>
</table>
</body>

</html>
