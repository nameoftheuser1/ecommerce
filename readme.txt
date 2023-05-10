to use the select functions from the php

1st place the mysql conditions from a variable
2nd make a variable for the result of the query (example $result = mysql_query(connection to php, mysql condition))
3rd fetch the result as an array (example $furniture = mysqli_fetch_all($result, MYSQLI_ASSOC))
4th print_r

