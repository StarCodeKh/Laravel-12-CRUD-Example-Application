<?php

function matches($route) {
    $current = Request::path();
    return Str::is($route, $current);
}

function set_active($routes) {
    foreach ((array)$routes as $route) {
        if (matches($route)) return 'active';
    }
    return '';
}

function set_show($routes) {
    foreach ((array)$routes as $route) {
        if (matches($route)) return 'show';
    }
    return '';
}

function set_expanded($routes) {
    foreach ((array)$routes as $route) {
        if (matches($route)) return 'true';
    }
    return 'false';
}
