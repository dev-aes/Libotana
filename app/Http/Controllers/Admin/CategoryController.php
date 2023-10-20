<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Category\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(Category::all())
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' href='javascript:void(0)' onclick='c_edit(`#m_category`, `.category_form :input`, [`#m_category_title`, `Edit Category`], [`.btn_add_category`, `.btn_update_category`], $row)'>Edit</a>

                                <a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($row->id,`admin.categories.destroy`,`.category_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.category.index');
    }

    public function store(CategoryRequest $request)
    {
       Category::create($request->validated());

       return $this->res(['success' => 'Category Added Successfully']);
    }

    public function update(CategoryRequest $request, Category $category)
    {
       $category->update($request->validated());

       return $this->res(['success' => 'Category Updated Successfully']);
    }

    public function destroy(Category $category)
    {
        $category->delete();

       return $this->res(['success' => 'Category Deleted Successfully']);
    }
}