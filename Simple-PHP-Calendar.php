<?php
define("ADAY", (60*60*24));
if (!checkdate(@$_POST['month'], 1, @$_POST['year'])) {
	$nowArray = getdate();
	$month = $nowArray['mon'];
	$year = $nowArray['year'];
} else {
	$month = $_POST['month'];
	$year = $_POST['year'];
}
$start = mktime (12, 0, 0, $month, 1, $year);
$firstDayArray = getdate($start);
?>
<html>
<head>
<title><?php echo "Calendar: ".$firstDayArray['month']." ".$firstDayArray['year'] ?>
</title>
<head>
<body>
<h3>Select a Month/Year Combination</h3>
<form method="post" action="<?php echo "$_SERVER[PHP_SELF]"; ?>">
<select name="month">
<?php
$months = Array("January", "February", "March", "April", "May", 
 "June", "July", "August", "September", "October", "November", "December");
for ($x=1; $x <= count($months); $x++) {
	echo"<option value=\"$x\"";
	if ($x == $month) {
		echo " SELECTED";
	}
		echo ">".$months[$x-1]."";
}
?>
</select>
<select name="year">
<?php
for ($x=1980; $x<=2018; $x++) {
	echo "<option";
	if ($x == $year) {
		echo " SELECTED";
	}
	echo ">$x";
}
?>
</select>
<input type="submit" value="Go!">
</form>
<br>
<?php
$days = Array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
echo "<TABLE BORDER=1 CELLPADDING=5><tr>\n";
foreach ($days as $day) {
   echo "<TD BGCOLOR=\"#CCCCCC\" ALIGN=CENTER>
          <strong>$day</strong></td>\n";
}
for ($count=0; $count < (6*6); $count++) {
    $dayArray = getdate($start);
    if (($count % 7) == 0) {
 	if ($dayArray['mon'] != $month) {
                        break;
	} else {
	     echo "</tr><tr>\n";
	}
       }
       if ($count < $firstDayArray['wday'] || $dayArray['mon'] != $month) {
	echo "<td>&nbsp;</td>\n";
       } else {
       echo "<td>".$dayArray['mday']." &nbsp;&nbsp; </td>\n";
	$start += ADAY;
      }
}
echo "</tr></table>";
?>
</body>
</html>

