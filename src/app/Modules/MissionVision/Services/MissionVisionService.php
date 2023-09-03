<?php

namespace App\Modules\MissionVision\Services;

use App\Modules\MissionVision\Models\MissionVision;

class MissionVisionService
{

    public function getById(Int $id): MissionVision|null
    {
        return MissionVision::where('id', $id)->first();
    }

    public function createOrUpdate(array $data): MissionVision
    {
        $missionVision = MissionVision::updateOrCreate(
            ['id' => 1],
            [...$data]
        );

        $missionVision->user_id = auth()->user()->id;
        $missionVision->save();

        return $missionVision;
    }

}
