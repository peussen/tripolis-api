<?php
/**
 * Created by PhpStorm.
 * User: petereussen
 * Date: 22/08/14
 * Time: 15:36
 */

namespace MartyBel\Tripolis\Service;


use MartyBel\Tripolis\Request;
use MartyBel\Tripolis\TripolisProvider;

abstract class AbstractService
{
	protected $serviceURI;

	/**
	 * @var \MartyBel\Tripolis\TripolisProvider
	 */
	protected $provider;
	protected $client = null;
	protected $module = null;
	protected $service = null;

	public function __construct(TripolisProvider $provider)
	{
		$class          = get_class($this);
		$this->provider = $provider;
		$this->setServiceName(substr($class,strrpos($class,'\\')+1));
		$this->setServiceURI('/api2/soap/' . $this->getServiceName() . '?wsdl');
	}

	protected function setModule($module)
	{
		$this->module = $module;
	}

	public function getServiceURI()
	{
		return $this->serviceURI;
	}

	protected function setServiceURI($uri)
	{
		$this->serviceURI = $uri;
	}

	protected function getRequest($protected = true)
	{
		return new Request($this->provider,$this, $protected);
	}

	public function getServiceName()
	{
		return $this->service;
	}

	public function setServiceName($name)
	{
		$this->service = $name;
		return $this;
	}

	public function __call($method,$args)
	{
		return $this->invoke($method,(array)$args);
	}

	protected function invoke($method, $content,$protected = true)
	{
		$request = $this->getRequest($protected);
		$body    = array(
			array(
				$method => array(
						$method . 'Request' => $content
				)
			)
		);

		return $this->execute($request,$method,$body);
	}

	protected function execute(Request $request,$method,$args)
	{
		if ( is_array($args)) {
			return call_user_func_array(array($request,$method),$args);
		} else {
			return call_user_func(array($request,$method));
		}
	}

	/**
	 *
	 * @return WPTripolis\Tripolis\Response
	 */
	public function info()
	{
		return $this->invoke('getServiceInfo',array(),false);
	}

	/**
	 * Returns the cache provider
	 *
	 * @return \Desarrolla2\Cache\Cache
	 */
	public function cache()
	{
		return $this->provider->getCache();
	}

	/**
	 * Stores a response of a method
	 *
	 * @param string $func
	 * @param mixed  $args
	 * @return bool|mixed
	 */
	public function getMethodCache($func,$args)
	{
		$key 	= $this->getMethodCacheKey($func,$args);
		$cache	= $this->cache();

		if ($cache->has($key)) {
			return $cache->get($key);
		}
		return false;
	}

	/**
	 * Stores a response of a method in cache
	 *
	 * @param string $func
	 * @param mixed  $args
	 * @param mixed  $value
	 * @param int    $ttl
	 * @return mixed
	 */
	public function setMethodCache($func,$args,$value,$ttl = 3600)
	{
		$key 	= $this->getMethodCacheKey($func,$args);
		$cache	= $this->cache();

		$cache->set($key,$value,$ttl);
		return $value;
	}

	/**
	 * Generates a cache key based on the method name and the arguments
	 *
	 * @param $method
	 * @param $args
	 * @return string
	 */
	protected function getMethodCacheKey($method,$args)
	{
		return $method . '_' . md5(json_encode($args));
	}
}