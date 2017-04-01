<?php namespace Modules\Employee\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Employee\Entities\Employee;
use Modules\Employee\Repositories\CategoryRepository;
use Modules\Employee\Repositories\EmployeeRepository;
use Breadcrumbs;

class PublicController extends BasePublicController
{
    /**
     * @var EmployeeRepository
     */
    private $employee;
    /**
     * @var Application
     */
    private $app;
    /**
     * @var CategoryRepository
     */
    private $category;

    public function __construct(
        EmployeeRepository $employee,
        CategoryRepository $category,
        Application $app
    )
    {
        parent::__construct();
        $this->employee = $employee;
        $this->app = $app;
        $this->category = $category;

        /* Start Default Breadcrumbs */
        if(!app()->runningInConsole()) {
            Breadcrumbs::register('employee.index', function ($breadcrumbs) {
                $breadcrumbs->push(trans('themes::employee.title'), route('employee.index'));
            });
        }
        /* End Default Breadcrumbs */
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $employees = $this->employee->all();

        /* Start Seo */
        $title = trans('themes::employee.title');
        $url   = route('employee.index');

        $this->setUrl($url)
            ->addMeta('robots', "follow, index")
            ->addAlternates($this->getAlternateLanguages('employee::routes.employee.index'));

        $this->setTitle($title)
            ->setDescription($employees->map(function($employee) {
                return $employee->fullname;
            })->implode(','));
        /* End Seo */

        return view('employee::index', compact('employees'));
    }

    /**
     * @param Employee $employee
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($slug)
    {
        $employee = $this->employee->findBySlug($slug);

        if(is_null($employee)) $this->app->abort(404);

        /* Start Seo */
        $title = $employee->meta_title ? $employee->meta_title : $employee->fullname;
        $url   = route('employee.view', [$employee->slug]);

        $this->setTitle($title)
            ->setDescription($employee->meta_description);

        $this->setUrl($employee->url)
            ->addMeta('robots', "follow, index")
            ->addAlternates($employee->present()->languages);;

        $this->seoGraph()->setTitle($title)
            ->setDescription($employee->description)
            ->setUrl($employee->url);

        $this->seoCard()->setTitle($title)
            ->setType('app')
            ->setDescription($employee->meta_description);

        /* Start Breadcrumbs */
        Breadcrumbs::register('employee.view', function($breadcrumbs) use ($employee) {
            $breadcrumbs->parent('employee.index');
            $breadcrumbs->push($employee->category->name, $employee->category->url);
            $breadcrumbs->push($employee->fullname, $employee->url);
        });
        /* End Breadcrumbs */

        return view('employee::view', compact('employee'));
    }

    public function category($slug)
    {
        $category = $this->category->findBySlug($slug);

        if(is_null($category)) $this->app->abort(404);

        /* Start Seo */
        $title = $category->meta_title ? $category->meta_title : $category->name;
        $url   = route('employee.category', [$category->slug]);

        $this->setTitle($title)
            ->setDescription($category->meta_description);

        $this->setUrl($url)
            ->addMeta('robots', "follow, index")
            ->addAlternates($category->present()->languages);

        $this->seoGraph()->setTitle($title)
            ->setDescription($category->description)
            ->setUrl($url);

        $this->seoCard()->setTitle($title)
            ->setType('app')
            ->setDescription($category->meta_description);

        /* Start Breadcrumbs */
        Breadcrumbs::register('employee.category', function($breadcrumbs) use ($category) {
            $breadcrumbs->parent('employee.index');
            $breadcrumbs->push($category->name, $category->url);
        });
        /* End Breadcrumbs */

        return view('employee::category', compact('category'));
    }
}
