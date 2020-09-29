<?php

namespace App;

use App\Traits\PostTrait;
use Illuminate\Database\Eloquent\Model;

class Configs extends Model
{
    use PostTrait;
    const CONF_TYPE_STRING = 1;

    protected string $config_namespace = 'global';

    /**
     * Встановлює простір імен для конфігураціїї
     * @param string $namespace
     */
    public function set_namespace(string $namespace):void
    {
        $this->config_namespace = $this->getAliasFromString($namespace) ;
    }


    /**
     * Поаертає згачення конфігурації по ключу
     * @param string $key_config
     * @return array
     */
    public function getConf(string $key_config):array
    {
        return $this->where('key', $key_config)->get()->toArray();
    }

    /**
     * Створює, вбо оновлює конфігурацію в базі
     * @param string $key
     * @param string $value
     * @param string $name
     * @param string $description
     * @param string $namespace
     * @param int $type_value
     * @return bool
     */
    public function setConf(string $key,
                            string $value,
                            string $name = 'options',
                            string $description = 'description options',
                            string $namespace = '',
                            int $type_value = 1):bool
    {
        if (empty($namespace)) $namespace = $this->config_namespace;
        return (bool) $this->updateOrInsert(
            ['namespace' => $this->getAliasFromString($namespace), 'key' => $key],
            [
                'value' => $value,
                'name' => $name,
                'description' => $description,
                'updated_at' => now()
            ]
        );
    }

    /**
     * Оновлює конфігурацію в базі
     * @param string $key
     * @param string $value
     * @param string $namespace
     * @return bool
     */
    public function updateConf(string $key, string $value, string $namespace = ''):bool
    {
        if (empty($namespace)) $namespace = $this->config_namespace;
        return (bool) $this->where([['key', '=', $key], ['namespace', '=', $this->getAliasFromString($namespace)]])
            ->update(['value' => $value]);
    }

    /**
     * Оновлює конфігурації в базі по масиву із запмту $request->all()
     * @param array $requestAll
     * @return bool
     */
    public function updateFromRequestArray(array $requestAll):bool
    {
        $namespace = $requestAll['namespace'];
        foreach ($requestAll as $key => $item) {
            if ($key === '_token' || $key === 'namespace')
                continue;
            if (!$this->updateConf($key, $item, $namespace))
                return false;
        }
        return true;
    }
}
