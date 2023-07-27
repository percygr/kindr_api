<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
    
 <?php



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


echo '<p>Hello Adie</p>';

// prints e.g. 'Current PHP version: 4.1.1'
echo 'Current PHP version: ' . phpversion();

// prints e.g. '2.0' or nothing if the extension isn't enabled
echo phpversion('tidy');

echo '<br><br>';

echo phpinfo(INFO_MODULES);

echo '<br><br>';




if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
    echo 'We don\'t have mysqli!!!';
} else {
    echo 'Phew we have mysqli!';
}
?>

 </body>
</html>