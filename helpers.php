<?php
    if (!function_exists('teamspeak')) {

        function teamspeak(bool $host = false)
        {
            $query = new \Tivet\Query\Query();

            if ($query::$factory) {
                return $host ? $query->getHost() : $query->getSelectedServer();
            }
        }
    }