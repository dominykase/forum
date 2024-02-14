<?php

declare(strict_types=1);

namespace App\Services;

class PaginationService
{
    private const DEFAULT_PAGE = 1;
    private const ELLIPSIS = '...';
    private const MIDDLE_COUNT = 3;

    /**
     * @return array<int, mixed>
     */
    public function getPageSwitcherNumbers(
        int $currentPage,
        int $totalPosts,
        int $perPage = 10,
        int $siblingCount = 1
    ): array {
        $pageSwitcherNumbers = [];

        $totalPageCount = intval(ceil($totalPosts / $perPage));

        $totalPageNumbers = $siblingCount + 5;

        if ($totalPageNumbers >= $totalPageCount) {
            for ($i = 1; $i <= $totalPageCount; $i++) {
                $pageSwitcherNumbers[] = $i;
            }
        }

        $leftSiblingIndex = max($currentPage - $siblingCount, 1);
        $rightSiblingIndex = min($currentPage + $siblingCount, $totalPageCount);

        $shouldShowLeftDots = $leftSiblingIndex > 2;
        $shouldShowRightDots = $rightSiblingIndex < $totalPageCount - 2;

        $lastPageIndex = $totalPageCount;

        if (!$shouldShowLeftDots && $shouldShowRightDots) {
            $leftItemCount = 3 + 2 * $siblingCount;

            $leftRange = [];

            for ($i = 1; $i <= $leftItemCount; $i++) {
                $leftRange[] = $i;
            }

            return array_values([...$leftRange, self::ELLIPSIS, $totalPageCount]);
        }

        if ($shouldShowLeftDots && !$shouldShowRightDots) {
            $rightItemCount = 3 + 2 * $siblingCount;
            $rightRange = [];

            for ($i = $totalPageCount - $rightItemCount + 1; $i <= $totalPageCount; $i++) {
                $rightRange[] = $i;
            }

            return array_values([self::DEFAULT_PAGE, self::ELLIPSIS, ...$rightRange]);
        }

        if ($shouldShowLeftDots && $shouldShowRightDots) {
            $middleRange = [];

            for ($i = $leftSiblingIndex; $i <= $rightSiblingIndex; $i++) {
                $middleRange[] = $i;
            }

            return array_values([self::DEFAULT_PAGE, self::ELLIPSIS, ...$middleRange, self::ELLIPSIS, $lastPageIndex]);
        }

        return $pageSwitcherNumbers;
    }
}
