<?php namespace Hybrid;

use Laravel\HTML as Laravel_HTML;

class HTML extends Laravel_HTML 
{
	/**
	 * Generate a HTML element
	 *
	 * @static
	 * @access public
	 * @param  string $tag
	 * @param  mixed  $value
	 * @param  array  $attributes
	 * @return string
	 */
	public static function create($tag = 'div', $value = null, $attributes = array())
	{
		if (is_array($value))
		{
			$attributes = $value;
			$value      = null;
		}

		$content = '<'.$tag.static::attributes($attributes).'>';

		if ( ! is_null($value))
		{
			$content .= static::entities($value).'</'.$tag.'>';
		}
		
		return $content;
	}

	/**
	 * Build a list of HTML attributes from one or two array.
	 *
	 * @param  array   $attributes
	 * @return array
	 */
	public static function pre_attributes($attributes, $defaults = null)
	{
		// Special consideration to class, where we need to merge both string from
		// $attributes and $defaults and take union of both.
		$class1 = isset($defaults['class']) ? $defaults['class'] : '';
		$class2 = isset($attributes['class']) ? $attributes['class'] : '';
		$class  = trim($class1 .' '.$class2);

		$classes = explode(' ', $class);
		$class   = implode(' ', array_unique($classes));

		$attributes = array_merge($defaults, $attributes);

		if ($class !== '') $attributes['class'] = $class;

		return $attributes;
	}
}