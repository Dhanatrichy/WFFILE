<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    use HasFactory;
    protected $fillable = ['page_name','file_path', 'description','page_size','page_orientation','file_name','upload_date','uploader_name'];
}
