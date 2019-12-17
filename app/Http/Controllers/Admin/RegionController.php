<?php

namespace App\Http\Controllers\Admin;

use App\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    public $timestamps = false;
    public function index()
    {
        return view('admin.region.index', [
            'regions' => Region::paginate(10)
        ]);
    }

    public function create()
    {
        return view('admin.region.create', [
          'region'   => [],
          'regions' => Region::get(),
          'delimiter'  => ''
        ]);
    }

    public function store(Request $request)
    {
        Region::create($request->all());
        return redirect()->route('admin.region.index');
    }

    public function show(Region $region){}

    public function edit(Region $region)
    {
        return view('admin.region.edit', [
          'region'   => $region,
          'regions' => Region::get(),
          'delimiter'  => ''
        ]);
    }

    public function update(Request $request, Region $region)
    {
        $region->update($request->except('id'));
        return redirect()->route('admin.region.index');
    }

    public function destroy(Region $region)
    {
        $region->delete();
        return redirect()->route('admin.region.index');
    }
}
