<?php

namespace Panday;

use Panday\Config\Loader;
use Panday\Exception\PandayInvalidRendererException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\DelegatingLoader;
use Symfony\Component\Config\Loader\LoaderResolver;

class Config
{
    /**
     * Potential search locations for a config file
     *
     * @var array
     */
    protected $configDirectories = [
        './',
        './config',
        './app/config',
        './config',
        './vendor/danhanly/panday/config'
    ];

    /**
     * Array of parsed and sorted configuration values
     *
     * @var array
     */
    protected $configuration;

    /**
     * The loaded Configuration File
     *
     * @var string
     */
    protected $loadedConfigurationFile;

    public function __construct($searchDirectory = '')
    {
        // If $searchDirectory is specified, add it to the top of the $configDirectories
        if (false === empty($searchDirectory)) {
            array_unshift($this->configDirectories, $searchDirectory);
        }

        $locator = new FileLocator($this->configDirectories);
        $filePath = $locator->locate('.panday.yml', null, true);

        $loader = new Loader($locator);
        $loaderResolver = new LoaderResolver([$loader]);
        $delegatingLoader = new DelegatingLoader($loaderResolver);

        $configuration = $delegatingLoader->load($filePath);

        $this->loadedConfigurationFile = $filePath;
        $this->configuration = $configuration;

        return $this;
    }

    /**
     * Gets all configuration values
     *
     * @return array
     */
    public function getAllConfiguration()
    {
        return $this->configuration;
    }

    /**
     * Identifies the storage driver from the config
     *
     * @return string
     */
    public function getDriver()
    {
        return $this->configuration['driver'];
    }

    /**
     * Gets the configured renderer
     *
     * @return string
     */
    public function getRenderer()
    {
        return $this->configuration['renderer'];
    }

    /**
     * Retrieve all configuration directories
     *
     * @return array
     */
    public function getConfigDirectories()
    {
        return $this->configDirectories;
    }

    /**
     * @return string
     */
    public function getLoadedConfigurationFile()
    {
        return $this->loadedConfigurationFile;
    }
}