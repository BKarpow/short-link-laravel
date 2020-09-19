<?php

namespace App\Http\Controllers;



use App\Traits\PostTrait;
use Illuminate\Http\Request;
use App\Http\Requests\PagesRequest;
use App\Pages;
use Illuminate\Validation\ValidationException;


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

    function update($alias){
        $alias = $this->getAliasFromString($alias);
        return view('admin.pages.page.create', ['data' => $this->Pages->where('alias', $alias)->first()]);
    }

    function update_action(Request $request){
        try {
            $this->validate($request, [
                'title' => 'required|max:249|min:5',
                'page' => 'required|min:10',
                'alias' => 'required'
            ]);
        } catch (ValidationException $e) {
           $err = $e->getMessage();
           return redirect()->route('list-all-page')->with('status', 'Error: '. $err);
        }
        $alias = $this->getAliasFromString($request->input('alias'));
        $page = $this->Pages->where('alias', $alias)
            ->update([
                'title' => $request->input('title'),
                'page' => $request->input('page')
            ]);
        return redirect()->route('list-all-page')->with('status', 'Оновлено '.$alias);
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

    function delete_page($alias){
        $alias = $this->getAliasFromString($alias);
        $this->Pages->where('alias', $alias)->delete();
        return redirect()->route('list-all-page')->with('status', 'Видалено '.$alias);
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
