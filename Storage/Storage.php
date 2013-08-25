<?php

namespace Artifact\Storage;

use \Artifact\Common\Pattern\Adaptable;



class Storage extends Adaptable {

	/**
	 * Create a new Storage Object
	 * @param  string  $name Name of the Storage
	 * @param  int $ttl  time to live, default is 0, 0 is unlimited
	 * @return AbstractStorage     Storage object
	 */
	public static function init( $name, $ttl = 0 ){

		self::add_adapter(
				array(
					'session' => array(
						'class' => '\\Artifact\\Storage\\Adapter\\Session',
						'config' => array(
								'name' => $name,
								'ttl' => $ttl,
							)
					)
				)
			);
	}





}



?>