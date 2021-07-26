<?php
class Template
{
	var $template_data = array();

	function set($name, $value)
	{
		$this->template_data[$name] = $value;
	}

	function load($template = '', $view = '', $view_data = array(), $return = FALSE)
	{
		$this->ci = &get_instance();
		$this->set('contents', $this->ci->load->view($view, $view_data, TRUE));
		return $this->ci->load->view($template, $this->template_data, $return);
	}
}
