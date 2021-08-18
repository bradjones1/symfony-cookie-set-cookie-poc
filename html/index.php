<?php

include __DIR__ . '/../vendor/autoload.php';

$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
$sessionName = 'SESS49960de5880e8c687434170f6476605b';
$storage = (new \Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorageFactory([
  'cache_limiter' => '',
  'cache_expire' => 0,
  'use_cookies' => 1,
  'lazy_write' => 1,
  'use_strict_mode' => 1,
  'gc_probability' => 1,
  'gc_divisor' => 100,
  'gc_maxlifetime' => 200000,
  'cookie_lifetime' => 2000000,
  'cookie_samesite' => 'Strict',
  'sid_length' => 48,
  'sid_bits_per_character' => 6,
  'cookie_domain' => '',
  'cookie_secure' => false,
  'name' => $sessionName,
]))
  ->createStorage($request);
$session = new \Symfony\Component\HttpFoundation\Session\Session($storage);
$sessionId = $request->cookies->get($sessionName);
$session->start();
$time = 'unset';
if (!$time = $session->get('requested')) {
  $session->set('requested', time());
}
$session->save();
$response = new \Symfony\Component\HttpFoundation\Response("Time: $time, Session: $sessionName:$sessionId");
$session = new \Symfony\Component\HttpFoundation\Session\Session($storage);
$session->start();
$response->send();
$session->save();
