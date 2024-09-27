<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantDocument extends Model
{
    use HasFactory;

    protected $table = 'merchant_documents';

    protected $fillable = [
        'title',
        'document',
        'date_expiry',
        'merchant_id',
        'previous_doc_id',
        'time_created',
        'document_type',
        'added_by',
        'emailed',
        'status'
    ];

    // Relationship with the Merchant model
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    // Relationship with the User model (for the added_by field)
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    // Relationship with the previous document in the Document model
    public function previousDocument()
    {
        return $this->belongsTo(Document::class, 'previous_doc_id');
    }
}
