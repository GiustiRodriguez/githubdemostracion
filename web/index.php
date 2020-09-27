<?php

require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Our web handlers

$app->get('/{dato}', function($dato) use($app){
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig', array(
      'dato' => $dato,
      ));
)};


$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});

$app->post('/modificarDato', function(Request $request) use ($app){
      $DatoCorrecto = $request->get('DatoCorrecto');
      $DatoCorrecto = (int)$DatoCorecto + 10;
      return $DatoCorrecto;

});

$app->run();
