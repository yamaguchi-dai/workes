<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserToken extends Model {
    /**
     * @return Model|\Illuminate\Database\Eloquent\Relations\BelongsTo|object|null
     */
    function user() {
        return $this->belongsTo(User::class)->first();
    }
}
