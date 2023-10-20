<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicle;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use App\Http\Requests\Vehicle\VehicleRequest;
use App\Http\Resources\Vehicle\VehicleResource;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        if(request()->ajax())
        {
            $vehicles = VehicleResource::collection(Vehicle::query()
                ->when($request->filled('category'), fn($query) => $query->where('category_id', $request->category))
                ->with('media')
                ->get()
            );

            return DataTables::of($vehicles)
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $new_row = collect($row);

                    $route_show = route('admin.vehicles.show', $new_row['id']);
                    $route_edit = route('admin.vehicles.edit', $new_row['id']);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' href='$route_show'>View</a>
                                <a class='dropdown-item' href='$route_edit'>Edit</a>

                                <a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($new_row[id],`admin.vehicles.destroy`,`.vehicle_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.vehicle.index', [
            'categories' => Category::pluck('name', 'id'),
        ]);
    }

    public function create()
    {
        return view('admin.vehicle.create', [
            'categories' => Category::pluck('name', 'id'),
        ]);
    }

    public function store(VehicleRequest $request, ImageUploadService $service)
    {
        $vehicle = Vehicle::create($request->validated());

        if($request->featured_photo) 
        {
            $service->handleImageUpload(model:$vehicle, images: $request->featured_photo, collection:'featured_photo', conversion_name:'card', action:'create');
        }
        
        return to_route('admin.vehicles.index')->with(['success' => 'Vehicle Added Successfully']);
    }

    public function show(Vehicle $vehicle)
    {
        return view('admin.vehicle.show', [
            'vehicle' => $vehicle->load('category', 'destinations'),
        ]);
    }

    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicle.edit', [
            'vehicle' => $vehicle,
            'categories' => Category::pluck('name', 'id'),
        ]);
    }

    public function update(VehicleRequest $request, ImageUploadService $service, Vehicle $vehicle)
    {
       $vehicle->update($request->validated());

       if($request->featured_photo) 
       {
           $service->handleImageUpload(model:$vehicle, images: $request->featured_photo, collection:'featured_photo', conversion_name:'card', action:'update');
       }

       return to_route('admin.vehicles.index')->with(['success' => 'Vehicle Updated Successfully']);
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

       return $this->res(['success' => 'Vehicle Deleted Successfully']);
    }
}