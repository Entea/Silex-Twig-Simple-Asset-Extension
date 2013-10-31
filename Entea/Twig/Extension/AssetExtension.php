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
    
    /**
     * Asset directory
     * @var string
     */
    private $directory;

    /**
     * Asset version
     * @var string
     */
    private $version = NULL;
    
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
        
        $this->directory = $this->app['request']->getBasePath();
        if(isset($this->options['asset.directory']))
            $this->directory = $this->options['asset.directory'];
        
        if(isset($this->options['asset.version']))
            $this->version = $this->options['asset.version'];
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
        $versionToUse = $this->version;
        if($version !== NULL)
            $versionToUse = $version;
        
        $assetPath = $this->directory.'/'.ltrim($url, '/');
        $assetPath.= $versionToUse !== NULL ? '?v='.$versionToUse : '';
        return $assetPath;
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
