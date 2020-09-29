<?php

namespace App\Http\Controllers;

use App\Configs;
use App\Http\Requests\ConfigsNewRequest;
use App\Http\Requests\ConfigsRequest;
use App\Http\Resources\ConfigsResource;
use App\Traits\PostTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfigsController extends Controller
{
    use PostTrait;
    /**
     * Показує всі простори імен конфігурацій
     */
    function show_namespaces(){
        $data = Configs::select( 'namespace', DB::raw('COUNT(namespace) as `count`'))
            ->groupBy('namespace')
            ->paginate(25);
        return view('admin.pages.configs.list', ['data' => $data]);
    }

    function page_create(){
        return view('admin.pages.configs.create');
    }

    /**
     * Показує конфігурації для простору імен
     * @param string $namespace - простір імен
     */
    function show_config(string $namespace){
        $namespace = $this->getAliasFromString($namespace);
        $data = Configs::where('namespace', $namespace)->paginate(25);
        return view('admin.pages.configs.update', ['namespace' => $namespace, 'data' => $data]);
    }

    /**
     * Оновлює налаштування конфігурацій
     * @param ConfigsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function set_configs_action(ConfigsRequest $request){
        $Configs = new Configs();
        $r = $Configs->updateFromRequestArray($request->all());
        return redirect()
            ->route('configs.namespace', ['namespace' => $request->input('namespace')])
            ->with('status', 'Збережено!');
    }

    function create_config(ConfigsNewRequest $request){
        $Configs = new Configs();
        $Configs->setConf(
            $request->input('key'),
            $request->input('value'),
            $request->input('name'),
            $request->input('description'),
            $request->input('namespace')
        );
        return redirect()
            ->route('configs.namespace', ['namespace' =>  $request->input('namespace')])
            ->with('status', 'Створено конфігурацію');
    }

    function ajax_get_all_namespace(){
        return new ConfigsResource(Configs::select( 'namespace', DB::raw('COUNT(namespace) as `count`'))
            ->groupBy('namespace')->get());
    }
}
