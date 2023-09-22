<?php

namespace App\Modules\Course\BranchDetail\Services;

use App\Modules\Course\BranchDetail\Models\BranchDetail;

class BranchDetailService
{

    public function getByCourseIdAndBranchId(Int $course_id, Int $branch_id): BranchDetail|null
    {
        return BranchDetail::with(['branch', 'course'])->where('course_id', $course_id)->where('branch_id', $branch_id)->first();
    }

    public function createOrUpdate(array $data, Int $course_id, Int $branch_id): BranchDetail
    {
        $main = BranchDetail::updateOrCreate(
            [
                'course_id' => $course_id,
                'branch_id' => $branch_id,
            ],
            [...$data]
        );

        return $main;
    }

    public function delete(BranchDetail $branch_detail): bool|null
    {
        return $branch_detail->delete();
    }

}
