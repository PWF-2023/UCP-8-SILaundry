<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('created_at', 'desc')
            ->get();
        return view('service.index', compact('services'));
    }

    public function store(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|max:255',
            'harga' => 'required|numeric',
        ]);
        $service = Service::create([
            'title' => ucfirst($request->title),
            'harga' => $request->harga,
            'user_id' => auth()->user()->id,
        ]);
        return redirect()->route('service.index')->with('success', 'Service created successfully!');
    }

    public function create()
    {
        $services = Service::all();
        return view('service.create', compact('services'));
    }

    public function edit(Service $service)
    {
        if (auth()->user()->id == $service->user_id) {
            return view('service.edit', compact('service'));
        } else {
            return redirect()->route('service.index')->with('danger', 'You are not authorized to edit this service!');
        }
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|max:255',
            'harga' => 'required|numeric',
        ]);
        $service->update([
            'title' => ucfirst($request->title),
            'harga' => $request->harga,
        ]);
        return redirect()->route('service.index')->with('success', 'Service updated successfully!');
    }

    public function destroy(Service $service)
    {
        if (auth()->user()->is_admin) {
            $service->delete();
            return redirect()->route('service.index')->with('success', 'Service deleted successfully!');
        } else {
            return redirect()->route('service.index')->with('danger', 'You are not authorized to delete this service!');
        }
    }
}
