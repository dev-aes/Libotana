<?php

namespace App\Http\Controllers\Admin;

use App\Models\Destination;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use App\Http\Requests\Destination\DestinationRequest;
use App\Http\Resources\Destination\DestinationResource;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        if(request()->ajax())
        {
            $destinations = DestinationResource::collection(Destination::query()
                ->with('media')
                ->get()
            );

            return DataTables::of($destinations)
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $new_row = collect($row);

                    $route_show = route('admin.destinations.show', $new_row['id']);
                    $route_edit = route('admin.destinations.edit', $new_row['id']);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' href='$route_show'>View</a>
                                <a class='dropdown-item' href='$route_edit'>Edit</a>

                                <a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($new_row[id],`admin.destinations.destroy`,`.destination_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.destination.index');
    }

    public function create()
    {
        return view('admin.destination.create');
    }

    public function store(DestinationRequest $request, ImageUploadService $service)
    {
        $destination = Destination::create($request->validated());

        if($request->featured_photo) 
        {
            $service->handleImageUpload(model:$destination, images: $request->featured_photo, collection:'featured_photo', conversion_name:'card', action:'create');
        }

        if($request->image) 
        {
            $service->handleImageUpload(model:$destination, images: $request->image, collection:'other_featured_photos', conversion_name:'card', action:'create');
        }
        
        return to_route('admin.destinations.index')->with(['success' => 'Tourist Destination Added Successfully']);
    }

    public function show(Destination $destination)
    {
        return view('admin.destination.show', [
            'destination' => $destination->load('vehicles'),
        ]);
    }

    public function edit(Destination $destination)
    {
        return view('admin.destination.edit', [
            'destination' => $destination,
        ]);
    }

    public function update(DestinationRequest $request, ImageUploadService $service, Destination $destination)
    {
       $destination->update($request->validated());

       if($request->featured_photo) 
       {
           $service->handleImageUpload(model:$destination, images: $request->featured_photo, collection:'featured_photo', conversion_name:'card', action:'update');
       }

       if($request->image) 
       {
           $service->handleImageUpload(model:$destination, images: $request->image, collection:'other_featured_photos', conversion_name:'card', action:'update');
       }

       return to_route('admin.destinations.index')->with(['success' => 'Tourist Destination Updated Successfully']);
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();

       return $this->res(['success' => 'Tourist Destination Deleted Successfully']);
    }
}