<?php

namespace Artifact\Utils:

use \Artifact\Common\ArtifactObject;

class Session extends ArtifactObject {

	protected $_namespace;

	public function init( $namespace ){
		$this->namespace = $namespace;

		session_start()

	}
		
}

?>	