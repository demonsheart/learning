<?php
class employee
{
    var $name;
    var $employee_id;
}

$this_emp = new employee;
$this_emp->name = 'Fred';
$this_emp->employee_id = 5324;
//test for serialize
$serial_ob = serialize($this_emp);

var_dump($serial_ob);

echo '<br />';
//test for unserialize
$new_ob = unserialize($serial_ob);

var_dump($new_ob);
//get_current_user()
echo '<br />' . get_current_user() . '<br />';
// getlastmod()
date_default_timezone_set('PRC');
echo date('g:i a, j M Y', getlastmod()) . '<br />';
