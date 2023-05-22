<?php

function appendUrlParameter($parameter, $value)
{
    $url = $_SERVER['REQUEST_URI'];
    $url_data = parse_url($url);
    parse_str($url_data['query'] ?? '', $params);
    $params[$parameter] = $value;
    $url_data['query'] = http_build_query($params);
    return $url_data['path'] . '?' . $url_data['query'];
}

function removeUrlParameter($parameter)
{
    $url = $_SERVER['REQUEST_URI'];
    $url_data = parse_url($url);
    parse_str($url_data['query'] ?? '', $params);
    unset($params[$parameter]);
    $url_data['query'] = http_build_query($params);
    return $url_data['path'] . '?' . $url_data['query'];
}

function checkUrlParameter($parameter, $value = false)
{
    $url = $_SERVER['REQUEST_URI'];
    $url_data = parse_url($url);
    parse_str($url_data['query'] ?? '', $params);
    if ($value) {
        return isset($params[$parameter]) && $params[$parameter] == $value;
    } else {
        return isset($params[$parameter]);
    }
}