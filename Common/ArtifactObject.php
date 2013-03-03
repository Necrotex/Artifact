<?php

namespace Artifact\Common;

abstract class ArtifactObject {

	protected $_class;

	public function __construct() {
		$this->_class = get_called_class();

		if( method_exists( $this, 'init' ) )
			call_user_func_array( array( $this , 'init' ), func_get_args() );
		
	}
}

?>