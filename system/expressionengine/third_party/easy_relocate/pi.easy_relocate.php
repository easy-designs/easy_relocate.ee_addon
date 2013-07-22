<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Easy_relocate Class
 *
 * @package			ExpressionEngine
 * @category		Plugin
 * @author			Aaron Gustafson
 * @copyright		Copyright (c) Easy! Designs, LLC
 * @link			http://www.easy-designs.net/
 */

$plugin_info = array(
	'pi_name'			=> 'Easy Relocate',
	'pi_version'		=> '1.0',
	'pi_author'			=> 'Aaron Gustafson',
	'pi_author_url'		=> 'http://easy-designs.net/',
	'pi_description'	=> 'Allows you to move content from one template to another',
	'pi_usage'			=> Easy_relocate::usage()
);

class Easy_relocate {

	var $return_data;
  	var $cache;

	/**
	* PHP4 Constructor
	*
	* @see	__construct()
	*/
	function Easy_relocate()
	{
		$this->__construct();
	} # end Easy_relocate constructor

	// --------------------------------------------------------------------

	/**
	* PHP5 Constructor
	*
	* @return	void
	*/
	function __construct()
	{
		$this->EE =& get_instance();
		
		# make sure we have our own segment
		if ( !isset($this->EE->session->cache[__CLASS__]) ) $this->EE->session->cache[__CLASS__] = array();
		
		$this->cache =& $this->EE->session->cache[__CLASS__];
	} # end Easy_relocate constructor

	// --------------------------------------------------------------------

	/**
	* Easy_relocate::capture
	* Collects $content and stores it in the global array for processing
	* 
	* @param str $key - the key to store the content under
	* @param str $content - the content to store
	*/
	function capture($key=FALSE,$content=FALSE)
	{
		# get the key & content
		if ( $temp = $this->EE->TMPL->fetch_param('key') ) $key = $temp;
		if ( $temp = $this->EE->TMPL->tagdata ) $content = $temp;
		if ( empty($key) ) return; # it's ok if the content is empty
		
		# if the key doesn't exist, create it
		if ( ! isset($this->cache[$key]) ) $this->cache[$key] = '';
		
		# add the content
		$this->cache[$key] .= $content;
		
		# wipe out the contents
		$this->return_data = '';
		return $this->return_data;
	} # end Easy_relocate::capture
	
	// --------------------------------------------------------------------

	/**
	* Easy_relocate::insert
	* Collects $content and stores it in the global array for processing
	* 
	* @param str $key - the key to store the content under
	* @param str $content - the content to store
	*/
	function insert($key=FALSE)
	{
		# get the key & content
		if ( $temp = $this->EE->TMPL->fetch_param('key') ) $key = $temp;
		if ( empty($key) ) return;
		
		$this->return_data = '';
		if ( isset( $this->cache[$key] ) )
		{
			$this->return_data = $this->cache[$key];
		}
		
		# return the contents
		return $this->return_data;
	} # end Easy_relocate::insert

	// --------------------------------------------------------------------

	/**
	* Easy_relocate::usage()
	* Describes how the plugin is used
	*/
	function usage()
	{
		ob_start(); ?>
To move content from one template to another, first establish what is being moved and define a key to store it under using {exp:easy_relocate:capture}:

	{exp:easy_relocate:capture key="scripts"}
		<script src="http://connect.facebook.net/en_US/all.js#xfbml=1" type="text/javascript"></script>
		<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
	{/exp:easy_relocate:capture}

Then use {exp:easy_relocate:insert} to drop it somewhere else:

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
	<script type="text/javascript" src="/j/main.js"></script>
	{exp:easy_relocate:insert key="scripts"}
<?php
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	} # end Easy_relocate::usage()

} # end Easy_relocate

/* End of file pi.easy_relocate.php */ 
/* Location: ./system/expressionengine/third_party/easy_relocate/pi.easy_relocate.php */