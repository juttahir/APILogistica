<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Integrations extends Model {
    use HasFactory;

    protected $table = "integrations";

    protected $fillable = ['partner_id','name','driver','url','user','password','token','filters'];

    public function partner() {
        return $this->belongsTo(Partners::class,'partner_id','id');
    }
}
