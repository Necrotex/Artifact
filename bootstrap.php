<?php

namespace Artifact;

include __DIR__ . DIRECTORY_SEPARATOR . 'third-party' . DIRECTORY_SEPARATOR . 'php_error.php';

\php_error\reportErrors( array( 'background_text' => 'Artifact' ) );


include __DIR__ . DIRECTORY_SEPARATOR . 'Common' . DIRECTORY_SEPARATOR . 'Manager.php';

$manager = \Artifact\Common\Manager::get_instance();

// Arguments are Base Namesapce and Rootdir
$manager::add( __NAMESPACE__, __DIR__ );


?>