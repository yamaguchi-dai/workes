<?php
/**
 * Created by dai.yamaguchi
 * DATE: 2020/03/05
 *
 */

namespace App\Models\Core;


use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {
    protected $guarded = ['id'];

}
