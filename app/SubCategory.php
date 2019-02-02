<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'tbl_subcategory';

    protected $primaryKey = 'subCategoryID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'categoryID', 'type', 'typeEN'
    ];
}
