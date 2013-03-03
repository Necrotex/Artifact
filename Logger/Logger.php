<?php

namespace Artifact\Logger;

use \Artifact\Common\Pattern\Adaptable;

class Logger extends Adaptable {

	public static function init(){
		
		self::add_adapter(
			array(
					'file' => array(
							'class' => '\\Artifact\\Logger\\Adapter\\File',
							'config' => array( 
									'file' => 'tst.log',
									'timestamp' => 'Y-m-d H:i:s',
									'format' => "{:timestamp} [{:level}] {:message}\n",
								 ),
						),
				)
			);

		self::add_adapter( 
				array( 
					'firephp' => array(
							'class' => '\\Artifact\\Logger\\Adapter\\FirePHP',
							'config' => array(
									'format' => "{:size} | [ {:meta} , {:body} ] |"
								)
						)
					)
			);
	}

}

?>