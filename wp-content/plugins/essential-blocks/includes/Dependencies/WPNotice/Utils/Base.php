<?php

namespace EssentialBlocks\Dependencies\WPNotice\Utils;

abstract class Base {
	/**
	 * Holds the plugin instance.
	 *
	 * @since 2.0.0
	 * @access protected
	 * @static
	 *
	 * @var Base
	 */
	private static $instances = array();

	/**
	 * Sets up a single instance of the plugin.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @return static An instance of the class.
	 */
	public static function get_instance( ...$args ) {
		$module    = get_called_class();
		$module_id = $module;

		if ( $module === 'EssentialBlocks\Dependencies\WPNotice\Notice' || $module === 'EssentialBlocks\Dependencies\WPNotice\Dismiss' ) {
			$module_id = $module . '::' . $args[0];
		}

		if ( ! isset( self::$instances[ $module_id ] ) ) {
			self::$instances[ $module_id ] = new $module( ...$args );
		}

		return self::$instances[ $module_id ];
	}

	protected function database( $args = null ) {
		return new Storage( $args );
	}
}
