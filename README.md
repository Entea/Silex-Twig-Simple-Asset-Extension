## Simple twig extension for Silex, for creating links to assets

### Usage
```
require_once __DIR__ . '/silex.phar';

$app = new Silex\Application();
$app['debug'] = true;
$app['autoloader']->registerNamespaces(array('Entea'   => __DIR__.'/src'));
$app->register(
    new Silex\Provider\TwigServiceProvider(),
    array(
         'twig.path' => __DIR__ . '/views',
         'twig.class_path' => __DIR__ . '/vendor/twig/lib',
    )
);

/* @var Twig_Environment $twig */
$twig = $app['twig'];
$twig->addExtension(new \Entea\Twig\Extension\AssetExtension($app));

$app->get('/', function() use (&$app)
    {
        return $app['twig']->render('index.html.twig', array());
    });

$app->run();
```

And then, in your twig file:
```
{{asset('/style/hello.css')}}
```
or with a specific version which overrides the global version
```
{{asset('/style/hello.css', '1.2')}}
```

### Properties
 - **asset.directory**: Your asset directory
 - **asset.version**: Your asset global version (default: 1.0)

### Installation

#### Via composer:
```
require: "entea/silex-twig-simple-asset-extension": "dev-master"
```
or 
```
require: "entea/silex-twig-simple-asset-extension": "v1.0.1"
```

Or simply **checkout this repo** :)
