<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Services\PaginationService;
use Tests\TestCase;

class PaginationServiceTest extends TestCase
{
    public function testGetPageSwitcherNumbers(): void
    {
        $paginationService = new PaginationService();

        $this->assertSame([1], $paginationService->getPageSwitcherNumbers(1, 1));

        $this->assertSame([1, 2], $paginationService->getPageSwitcherNumbers(1, 2));
        $this->assertSame([1, 2], $paginationService->getPageSwitcherNumbers(2, 2));

        $this->assertSame([1, 2, 3], $paginationService->getPageSwitcherNumbers(1, 3));
        $this->assertSame([1, 2, 3], $paginationService->getPageSwitcherNumbers(2, 3));
        $this->assertSame([1, 2, 3], $paginationService->getPageSwitcherNumbers(3, 3));

        $this->assertSame([1, 2, 3, 4], $paginationService->getPageSwitcherNumbers(1, 4));
        $this->assertSame([1, 2, 3, 4], $paginationService->getPageSwitcherNumbers(2, 4));
        $this->assertSame([1, 2, 3, 4], $paginationService->getPageSwitcherNumbers(3, 4));
        $this->assertSame([1, 2, 3, 4], $paginationService->getPageSwitcherNumbers(4, 4));

        $this->assertSame([1, 2, 3, '...', 5], $paginationService->getPageSwitcherNumbers(1, 5));
        $this->assertSame([1, 2, 3, '...', 5], $paginationService->getPageSwitcherNumbers(2, 5));
        $this->assertSame([1, 2, 3, 4, 5], $paginationService->getPageSwitcherNumbers(3, 5));
        $this->assertSame([1, '...', 3, 4, 5], $paginationService->getPageSwitcherNumbers(4, 5));
        $this->assertSame([1, '...', 3, 4, 5], $paginationService->getPageSwitcherNumbers(5, 5));

        $this->assertSame([1, '...', 4, 5, 6], $paginationService->getPageSwitcherNumbers(5, 6));
        $this->assertSame([1, '...', 4, 5, 6], $paginationService->getPageSwitcherNumbers(4, 6));
        $this->assertSame([1, 2, 3, 4, '...', 6], $paginationService->getPageSwitcherNumbers(3, 6));
        $this->assertSame([1, 2, 3, 4, '...', 6], $paginationService->getPageSwitcherNumbers(2, 6));
        $this->assertSame([1, 2, 3, 4, 5, 6], $paginationService->getPageSwitcherNumbers(1, 6));
    }
}
