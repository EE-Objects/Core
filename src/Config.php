<?php

namespace EeObjects;

use EeObjects\Exceptions\Config\ConfigFileNotFoundException;

class Config
{
    /**
     * The config file data
     * @var array
     */
    protected $_config = [];

    /**
     * Config constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->_config = $config;
    }

    /**
     * Determines if the config value is available
     * @param $key
     * @return bool
     */
    public function has(string $key, string $group = ''): bool
    {
        if (!$group) {
            return isset($this->_config[$key]);
        }

        return isset($this->_config[$group][$key]);
    }

    /**
     * @param $key
     * @return bool
     */
    public function isCallable(string $key, string $group = ''): bool
    {
        if (!$group) {
            return is_callable($this->_config[$key]);
        }

        return is_callable($this->_config[$group][$key]);
    }

    /**
     * @param $key
     * @param false $group
     * @return mixed
     */
    public function call(string $key, string $group = '')
    {
        if (!$group) {
            return $this->_config[$key]();
        }

        return $this->_config[$group][$key]();
    }

    /**
     * @param $key
     * @param false $group
     * @return mixed
     */
    public function get(string $key, string $group)
    {
        if($this->has($key, $group)) {
            if (!$group) {
                return $this->_config[$key];
            }

            return $this->_config[$group][$key];
        }
    }

    /**
     * @param string $file
     * @param string $domain
     * @param string $sub
     * @return $this
     * @throws ConfigFileNotFoundException
     */
    public function load(string $file, string $domain = '', string $sub = ''): Config
    {
        $filename = SYSPATH . 'user/config/'.$file.'.php';
        if (!file_exists($filename)) {
            throw new ConfigFileNotFoundException("Can't find your Config file at location: $filename");
        }

        ee()->config->load($file, true);
        $config = ee()->config->item($file);

        if (empty($config[$domain]) || empty($config[$domain][$sub])) {
            $config[$domain][$sub] = [];
        }

        $this->_config = $config[$domain][$sub];
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->_config;
    }
}
