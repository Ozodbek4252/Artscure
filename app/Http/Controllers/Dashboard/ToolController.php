<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ToolRequest;
use App\Models\Tool;
use App\Models\Type;
use App\Services\ToolService;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::orderBy('updated_at', 'desc')->paginate(20);
        return view('dashboard.tool.index', ['tools'=>$tools]);
    }

    public function create()
    {
        $types = Type::orderBy('updated_at', 'desc')->get();
        return view('dashboard.tool.create', ['types'=>$types]);
    }

    public function store(ToolRequest $request)
    {
        try {
            $category = (new ToolService($request))->store();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('tools.index');
    }

    public function edit($id)
    {
        $tool = Tool::find($id);
        $types = Type::all();
        return view('dashboard.tool.edit', [
            'tool'=>$tool,
            'types'=>$types
        ]);
    }

    public function update(ToolRequest $request, $id)
    {
        try {
            $tool = Tool::find($id);
            (new ToolService($request, $tool))->update();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('tools.index');
    }

    public function destroy($id)
    {
        try {
            $tool = Tool::findOrFail($id);
            $tool = (new ToolService())->delete($tool);
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->back();
    }
}
