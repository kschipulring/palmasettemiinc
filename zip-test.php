<?php
//$unzip = new ZipArchive;

//$zip = new ZipArchive;
/*if ($zip->open('readme.zip') === TRUE) {
    //$zip->extractTo('/my/destination/dir/');
    //$zip->close();
    echo 'ok';
} else {
    echo 'failed';
}*/

/*
try {
    $zip->open('readme.zip');
    //$zip->extractTo('./');

    var_dump( $zip );


    $zip->close();


} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}*/

//system("unzip readme.zip");


//$last_line = system('ls', $retval);
$last_line = system('unzip readme.zip', $retval);

// Printing additional info
echo '
</pre>
<hr />Last line of the output: ' . $last_line . '
<hr />Return value: ' . $retval;
