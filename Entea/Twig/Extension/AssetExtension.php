<?php
/**
 * User: entea
 * Date: 11/19/11
 * Time: 11:12 PM
 */

namespace Entea\Twig\Extension;

class AssetExtension extends \Twig_Extension 
{
    private $app;
    private $options;
    
    private $_assetDirectory;
    private $_assetVersion;
    
    /**
     * Constructor 
     * 
     * @param \Silex\Application $app
     * @param array $options
     */
    function __construct(\Silex\Application $app, array $options = array())
    {
        $this->app = $app;
        $this->options = $options;
    }
    
    public function initRuntime(\Twig_Environment $environment) 
    {   
        parent::initRuntime($environment);
        
        $this->_assetDirectory = $this->app['request']->getBasePath();
        if(isset($this->options['asset.directory']))
            $this->_assetDirectory = $this->options['asset.directory'];
        
        $this->_assetVersion = '1.0';
        if(isset($this->options['asset.version']))
            $this->_assetVersion = $this->options['asset.version'];
    }
    
    public function getFunctions()
    {
        return array(
            'asset' => new \Twig_Function_Method($this, 'asset'),
        );
    }
    
    /**
     * Logic for the "asset" function of Twig 
     * 
     * @param type $url
     * @param type $version
     * @return type
     */
    public function asset($url, $version=NULL) 
    {
        if($version !== NULL)
            $this->_assetVersion = $version;
            
        return sprintf('%s/%s?v=%s', 
                $this->_assetDirectory, 
                ltrim($url, '/'),
                $this->_assetVersion);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'entea_asset';
    }
}
