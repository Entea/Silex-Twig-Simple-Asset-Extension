This is a simple twig extension for silex to create asset links

Usage
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