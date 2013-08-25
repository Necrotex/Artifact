<?php

namespace Artifact\Form;

use \Artifact\Common\ArtifactObject;
use \Artifact\Utils\String;

class Form extends ArtifactStaticObject {

	protected $_options = array( );

	protected $_type = NULL;
	protected $_form = NULL;

	public function init( array $options ) {

		
		return $this;
	}


	public function add_filed( $type, array $options = array() ) {

		return $this;
	}

	public function add_options( array $options ) {

		return $this;
	}




}

?>