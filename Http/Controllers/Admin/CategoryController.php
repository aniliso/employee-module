<?php

namespace Modules\Employee\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Employee\Entities\Category;
use Modules\Employee\Http\Requests\CreateCategoryRequest;
use Modules\Employee\Http\Requests\UpdateCategoryRequest;
use Modules\Employee\Repositories\CategoryRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CategoryController extends AdminBaseController
{
    /**
     * @var CategoryRepository
     */
    private $category;

    public function __construct(CategoryRepository $category)
    {
        parent::__construct();

        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = $this->category->all();

        return view('employee::admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('employee::admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $this->category->create($request->all());

        return redirect()->route('admin.employee.category.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('employee::categories.title.categories')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        return view('employee::admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Category $category
     * @param  Request $request
     * @return Response
     */
    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $this->category->update($category, $request->all());

        return redirect()->route('admin.employee.category.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('employee::categories.title.categories')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return Response
     */
    public function destroy(Category $category)
    {
        $this->category->destroy($category);

        return redirect()->route('admin.employee.category.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('employee::categories.title.categories')]));
    }
}
