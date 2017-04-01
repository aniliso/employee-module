<?php

namespace Modules\Employee\Repositories\Cache;

use Modules\Employee\Repositories\CategoryRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCategoryDecorator extends BaseCacheDecorator implements CategoryRepository
{
    public function __construct(CategoryRepository $category)
    {
        parent::__construct();
        $this->entityName = 'employee.categories';
        $this->repository = $category;
    }
}
