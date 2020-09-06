<?php

namespace App\Traits;

trait ShortLogTrait{
    /**
     * Getting correct user ip.
     * @param - none
     * @return  string (ip user)
     */
    public function getIp():string {
        $keys = [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'REMOTE_ADDR'
        ];
        foreach ($keys as $key) {
            if (!empty($_SERVER[$key])) {
                $ip_list = explode(',', $_SERVER[$key]);
                $ip = trim(end($ip_list));
                if (filter_var($ip, FILTER_VALIDATE_IP)) {
                    return $ip;
                }
            }
        }
        return 'None';
    }

    /**
     * Поаертає рядок з полем User Agent
     * @return string (або None)
     */
    public function getUserAgent():string{
        if (array_key_exists('HTTP_USER_AGENT', $_SERVER)){
            return filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_STRING);
        }else{
            return 'None';
        }
    }

}
