<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Cart;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function numcategory()
    {
        $array = array( 0 => 'عطارة',
                        1=> "أعشاب",
                        2 => 'بقوليات',
                        3 => "حلواني",
                        4 => "مستحضرات",
                    );
            return $array;
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
}
