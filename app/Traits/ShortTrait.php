<?php

namespace App\Traits;

trait ShortTrait{

    private function random_string(int $length = 8):string{
        $random_func = function_exists('mt_rand') ? 'mt_rand' : 'rand';
        $chars = 'qwertyuiopasdfghjklzxcvbnm';
        $chars .= strtoupper($chars);
        $chars .= '0123456789';
        $random_string = '';
        for ($i = 0; $i < $length; $i++){
            $random_string .= $chars[ $random_func(0, (strlen($chars) - 1) ) ];
        }
        return $random_string;
    }

    public function generate_short_id($length = 8):string {
        $short_id = $this->random_string($length);
        if ($this->where('short_id', '=', $short_id)->first()){
            return $this->generate_short_id($length++);
        }
        return $short_id;
    }

    /**
     * Повертає шлях з повної адреси utl (path)
     * @param $url string
     * @return string
     */
    public function getPathFromUrl(string $url):string{
        return preg_replace('#^(http|https)\:\/\/[^\/]+?\/(.*?)#si','\\2', $url);
    }

    /**
     * Перевіряє чи посилання вже скорочене
     * @param $url string
     * @return bool
     */
    public function isShorted(string $url):bool {
         $domain = str_replace(['https://', 'http://', '/'], '', url('/'));
         return (bool)strpos($url, $domain);
    }
}
