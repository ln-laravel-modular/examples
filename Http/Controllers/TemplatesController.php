<?php

namespace Modules\Templates\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Nwidart\Modules\Laravel\Module;

class TemplatesController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('templates::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('templates::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('templates::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('templates::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function view_index(Request $request)
    {
        $return = [
            'view' => "templates::templates.index",
            'templates' => app('files')->directories(module_path(Module::currentConfig('name'), config('modules.paths.generator.views.path') . '\\templates')),
        ];
        return self::view($return['view'], $return);
    }
    public function view_templates(Request $request, $path)
    {
        $return = [
            'view' => "templates::templates.index",
            'templates' => app('files')->directories(module_path(Module::currentConfig('name'), config('modules.paths.generator.views.path') . '\\templates')),
            'path' => $path,
            'slug' => explode('/', $path)[0]
        ];
        $return['template_view'] = $template_view = module_path(Module::currentConfig('name'), config('modules.paths.generator.views.path'))  . '\\templates' . '\\' . $path;
        // var_dump(app('files')->exists($template_view));
        // var_dump($template_view);
        if (app('files')->isDirectory($template_view) && app('files')->isFile($template_view . '\\index.blade.php')) {
            $return['isDirectory'] = true;
            $return['view'] = "templates::templates." . str_replace(["/"], ["."], $path) . ".index";
        } else if (app('files')->isFile($template_view . '.blade.php')) {
            $return['isFile'] = true;
            $return['view'] = "templates::templates." . str_replace(["/"], ["."], $path);
        } else {
            abort(404);
        }
        return self::view($return['view'], $return);
    }
}
