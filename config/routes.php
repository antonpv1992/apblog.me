<?php

/** more specific routes */
tools\core\Router::add('^post/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'Post']);
tools\core\Router::add('^post/(?P<alias>[a-z-0-9]+)$', ['controller' => 'Post', 'action' => 'index']);
tools\core\Router::add('^posts/(?P<alias>\bphp\b|\bcss\b|\bhtml\b|\bjs\b|\bsearch\b)$', ['controller' => 'Posts', 'action' => 'index']);
tools\core\Router::add('^profile/(?P<alias>[a-z-]+)$', ['controller' => 'Profile', 'action' => 'index']);

/** default routes */
tools\core\Router::add('^$', ['controller' => 'Posts', 'action' => 'index']);
tools\core\Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');