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

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});

//Ruta de demostración, para validar que se recibe dato y se 
$app->post('/enviarDato', function (Request $request) use ($app){
  return $request;
});

$app -> post('/modificarDato', funcion(Request $request) use ($app){
      $DatoCorrecto = $request->get('DatoCorrecto');
      $DatoCorrecto = (int)$DatoCorecto + 10;
      return $DatoCorrecto;

});

$app->run();
