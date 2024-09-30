<?php

namespace App\Modules\Client\Models;

use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ClientDocument extends Model
{
    use HasFactory;

    protected $table = 'client_documents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'document',
        'client_id',
        'created_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $document_path = 'documents';

    protected $appends = ['document_link'];

    protected function document(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => 'storage/'.$this->document_path.'/'.$value,
        );
    }

    protected function documentLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset($this->document),
        );
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by')->withDefault();
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id')->withDefault();
    }

}
