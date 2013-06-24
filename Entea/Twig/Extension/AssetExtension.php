<?php
/**
 * User: entea
 * Date: 11/19/11
 * Time: 11:12 PM
 */

namespace Entea\Twig\Extension;

class AssetExtension extends  \Twig_Extension 
{
    private $app;
    private $options;

    function __construct(\Silex\Application $app, array $options = array())
    {
        $this->app = $app;
        $this->options = $options;
    }

    public function getFunctions()
    {
        return array(
            'asset' => new \Twig_Function_Method($this, 'asset'),
        );
    }

    public function asset($url) 
    {
        $assetDir = isset($this->options['asset.directory']) ? 
            $this->options['asset.directory'] : 
            $this->app['request']->getBasePath();
		
		if(strpos($assetDir, '/') !== 0)
			$assetDir = '/'.$assetDir;
		
        return sprintf('%s/%s', $assetDir, ltrim($url, '/'));
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
