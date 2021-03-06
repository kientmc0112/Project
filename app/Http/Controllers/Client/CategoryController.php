<?php

namespace App\Http\Controllers\Client;

use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CategoryController extends Controller
{
    protected $categoryRepository;
    protected $courseRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository, CourseRepositoryInterface $courseRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->courseRepository = $courseRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        /*
        Tạo collection query từ 2 bảng:
        $category = Category::where('id', $id)
            ->orWhere('parent_id', $id)
            ->with('courses')
            ->get();
        $courses = collect();
        foreach($category as $a) {
            foreach($a->courses as $b) {
                $courses->push($b);
            }
        }
         */


        $category = $this->categoryRepository->getIdCategorySameKind($id);
        $courses = $this->courseRepository->getCourseByCategory($category);
        // $courses = Course::whereIn('category_id', $category)->paginate(config('course.PagePaginate'));

        $categories = $this->categoryRepository->getParentCategory();

        return view('client.course.index', compact('courses', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function tree() {
        $i = 0;
        $data = array();
        $categories = $this->categoryRepository->getParentCategory();
        foreach ($categories as $parentCategory) {
            $data['text'][$i++] = $parentCategory->name;
            $j = 0;
            foreach ($parentCategory->categories as $childCategory) {
                $data['nodes']['text'][$j++] = $childCategory->name;
            }
        }
        dd($data);
    }
}
