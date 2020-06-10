<?php

require 'vendor/autoload.php';

$urls = [
  'http://www.apple.com',
  'http://php.net',
  'http://asdfjkljasf.org',
];

$scanner = new Xaedon\Scanner\Scanner($urls);

print_r($scanner->getInvalidUrls());

