<?php namespace Modules\Employee\Http\Controllers;

use Modules\Employee\Repositories\CategoryRepository;
use Modules\Employee\Repositories\EmployeeRepository;
use Modules\Sitemap\Http\Controllers\BaseSitemapController;

class SitemapController extends BaseSitemapController
{
    /**
     * @var EmployeeRepository
     */
    private $employee;
    /**
     * @var CategoryRepository
     */
    private $category;

    public function __construct(EmployeeRepository $employee, CategoryRepository $category)
    {
        parent::__construct();
        $this->employee = $employee;
        $this->category = $category;
        $this->sitemap->setCache('laravel.employee.sitemap', $this->sitemapCachePeriod);
    }

    public function index()
    {
        foreach ($this->category->all() as $category)
        {
            $this->sitemap->add(
                $category->url,
                $category->updated_at,
                0.9,
                'weekly',
                [],
                null,
                $category->present()->languages('language')
            );
            if($category->employees()->exists())
            {
                foreach ($category->employees()->get() as $employee) {
                    $images = [];
                    if(isset($employee->thumbnail))
                    {
                        $images[] = ['url' => $employee->thumbnail, 'title' => $employee->fullname];
                    }
                    $this->sitemap->add(
                        $employee->url,
                        $employee->updated_at,
                        0.9,
                        'weekly',
                        $images,
                        null,
                        $employee->present()->languages('language')
                    );
                }
            }
        }
        return $this->sitemap->render('xml');
    }
}
