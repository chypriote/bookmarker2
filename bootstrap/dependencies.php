<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

$capsule = new Capsule;
$capsule->addConnection($settings);

$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->bootEloquent();