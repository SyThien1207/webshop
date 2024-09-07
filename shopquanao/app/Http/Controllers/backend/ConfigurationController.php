<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function index()
    {
        $configuration = Configuration::first();
        return view('backend.configuration.index', compact('configuration'));
    }

    public function edit($id)
    {
        $configuration = Configuration::findOrFail($id);
        return view('backend.configuration.index', compact('configuration'));
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token', 'logo', 'favicon']);

        if ($request->hasFile('logo')) {
            if (in_array($request->logo->extension(), ["jpg", "png", "gif", "webp"])) {
                $fileName = 'logo.' . $request->logo->extension();
                $request->logo->move(public_path('images/configuration'), $fileName);
                $data['logo'] = $fileName;
            }
        }

        if ($request->hasFile('favicon')) {
            if (in_array($request->favicon->extension(), ["jpg", "png", "gif", "webp"])) {
                $fileName = 'favicon.' . $request->favicon->extension();
                $request->favicon->move(public_path('images/configuration'), $fileName);
                $data['favicon'] = $fileName;
            }
        }

        Configuration::create($data);

        return redirect()->route('admin.configuration.index')->with('success', 'Thêm câú hình thành công.');
    }

    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', '_method', 'logo', 'favicon']);
        $configuration = Configuration::findOrFail($id);

        if ($request->hasFile('logo')) {
            if (in_array($request->logo->extension(), ["jpg", "png", "gif", "webp"])) {
                $fileName = 'logo.' . $request->logo->extension();
                $request->logo->move(public_path('images/configuration'), $fileName);
                $data['logo'] = $fileName;
            }
        }

        if ($request->hasFile('favicon')) {
            if (in_array($request->favicon->extension(), ["jpg", "png", "gif", "webp"])) {
                $fileName = 'favicon.' . $request->favicon->extension();
                $request->favicon->move(public_path('images/configuration'), $fileName);
                $data['favicon'] = $fileName;
            }
        }

        $configuration->update($data);

        return redirect()->route('admin.configuration.index')->with('success', 'Cập nhật cấu hình thành công');
    }
}