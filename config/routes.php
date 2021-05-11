<?php

/** more specific routes*/
tools\core\Router::add('^post/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'Post']);
tools\core\Router::add('^post/(?P<alias>[a-z-]+)$', ['controller' => 'Post', 'action' => 'view']);

/** default routes */
tools\core\Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
tools\core\Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');