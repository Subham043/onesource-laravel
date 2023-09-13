<?php

namespace App\Modules\AdmissionForm\Models;

use App\Enums\AdmissionBatchEnum;
use App\Enums\AdmissionCenterEnum;
use App\Enums\AdmissionEnum;
use App\Enums\AdmissionSiblingEnum;
use App\Enums\Branch;
use App\Enums\RequestType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Casts\Attribute;

class AdmissionForm extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'admissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'admission_for',
        'name',
        'school_name',
        'class',
        'father_name',
        'father_phone',
        'father_occupation',
        'mother_name',
        'mother_phone',
        'mother_occupation',
        'center',
        'aadhar',
        'address',
        'batch',
        'percentage',
        'marks',
        'sibling',
        'no_of_sibling',
        'sibling_occupation',
        'sibling_school',
        'sibling_class',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'no_of_sibling' => 'int',
        'admission_for' => AdmissionEnum::class,
        'center' => AdmissionCenterEnum::class,
        'batch' => AdmissionBatchEnum::class,
        'sibling' => AdmissionSiblingEnum::class,
    ];

    protected $attributes = [
        'admission_for' => AdmissionEnum::NOT_PUC,
        'center' => AdmissionCenterEnum::HEBBAL,
        'batch' => AdmissionBatchEnum::BOARD_BATCH,
        'sibling' => AdmissionSiblingEnum::NO,
    ];

    public $image_path = 'admissions';

    protected $appends = ['marks_link'];

    protected function marks(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => 'storage/'.$this->image_path.'/'.$value,
        );
    }

    protected function marksLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset($this->image),
        );
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('admissions')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Admission with user name ".$this->name." has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
