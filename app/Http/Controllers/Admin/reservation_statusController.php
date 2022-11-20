<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\reservation_status;
use Illuminate\Http\Request;

class reservation_statusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $reservation_status = reservation_status::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $reservation_status = reservation_status::latest()->paginate($perPage);
        }

        return view('admin.reservation_status.index', compact('reservation_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.reservation_status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        reservation_status::create($requestData);

        return redirect('admin/reservation_status')->with('flash_message', 'reservation_status added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $reservation_status = reservation_status::findOrFail($id);

        return view('admin.reservation_status.show', compact('reservation_status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $reservation_status = reservation_status::findOrFail($id);

        return view('admin.reservation_status.edit', compact('reservation_status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $reservation_status = reservation_status::findOrFail($id);
        $reservation_status->update($requestData);

        return redirect('admin/reservation_status')->with('flash_message', 'reservation_status updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        reservation_status::destroy($id);

        return redirect('admin/reservation_status')->with('flash_message', 'reservation_status deleted!');
    }
}
