--TEST--

search_db() function

--FILE--

<?php

include 'trendzy.php';

$table = 'Users';

$attr = 'username';

$item = 'bajo';

var_dump(search_db($table,$attr,$item));

?>

--EXPECT--

string(1) "1"



--TEST--

redirect_to() function

--FILE--

<?php

include 'trendzy.php';

$link = 'http://127.0.0.1/Trendzy/public/log_in.php';

var_dump(redirect_to($link));

?>

--EXPECT--

string(1) "http://127.0.0.1/Trendzy/public/log_in.php"





--TEST--

insert_Users() function

--FILE--

<?php

include 'trendzy.php';

$username = 'bajo';

$email = 'aboodz@live.com';

$firstname = 'aboodz';

$lastname = 'bajo'

$password = '  '

var_dump(insert_Users($username,$email,$filename,$lastname,$password);

?>

--EXPECT--