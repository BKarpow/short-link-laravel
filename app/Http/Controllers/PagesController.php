<?php

namespace App\Http\Controllers;



use App\Traits\PostTrait;
use Illuminate\Http\Request;
use App\Http\Requests\PagesRequest;
use App\Pages;



class PagesController extends Controller
{

    use PostTrait;
    private Pages $Pages;

    public function __construct()
    {
        $this->Pages = new Pages();
    }

    function create(){
        return view('admin.pages.page.create');
    }

    function create_action(PagesRequest $request){
        $alias = $request->input('alias');

        $this->Pages->addNew(
            $request->input('title'),
            $alias,
            $request->input('page'),
        );
        return redirect()->route('create-page')->with('status', 'Сторінку додано!');
    }

    function ajax_is_unique(Request $request){
        $alias = $request->input('alias');
        $alias_transit = $this->getAliasFromString($alias);
        if ($alias){
            return response()->json([
                'alias' => $alias_transit,
                'unique' => $this->Pages->isUniqueAlias(
                    $alias
                )
            ]);
        }else{
            return response()->json(['unique'=>false, 'alias' => $alias]);
        }

    }

    function show_list(){
        $posts = $this->Pages
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.pages.page.list', ['data'=>$posts]);
    }

    function show($alias){
        $alias = $this->getAliasFromString($alias);
        $page = $this->Pages->where('alias', $alias)->first();
        if (!$page){
            abort(404);
        }
        $page->increment('previews');
        return view('pages.page.page', ['data' => $page]);
    }
}
