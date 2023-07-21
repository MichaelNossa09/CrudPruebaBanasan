<?php

namespace App\Models;

use Carbon\Carbon;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'publicaciones';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function typeVote()
    {
        return $this->votes()->where('user_id', auth()->id())->pluck('type_vote')->first() ?? -1;
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'id_publicacion');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'publicacion_id');
    }

    public function calcularVotos()
    {
        return $this->votes()->sum('type_vote');
    }
}
