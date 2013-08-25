<?php

namespace Artifact\Storage;


Interface StorageInterface {

	public function create();

	public function destroy();

	public function get( $key );

	public function set( $key, $value );

	public function clear();

	public function freeze();

}


?>