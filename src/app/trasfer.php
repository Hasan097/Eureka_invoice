<?php
$dbconn = pg_connect("host=localhost dbname=Eureka user=postgres password=password1 port=5300")
or die('Could not connect: ' . pg_last_error());

$insert = "INSERT INTO 
            invoice_details (comp_code, div_code, dept_code, inv_origin,  invoice_no, inv_date, customer_no, item_code, qty, unit_price, net_amount, salesperson_code, wh_code, loc_code) 
            VALUES('$_POST[compCode]','$_POST[divCode]','$_POST[depCode]','$_POST[ori]','$_POST[invoiceNo]','$_POST[invoiceDate]','$_POST[customerNo]','10110','25','375','$_POST[netAmount]','$_POST[salesPersonCode]','$_POST[whCode]','$_POST[locCode]')";

if (!mysql_query($insert, $dbconn)){ 
   die('Error: ' . mysql_error()); 
}
echo "Info was added to the database";

$query = 'SELECT * FROM Invoice_Details';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
echo($result);

echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";
?>