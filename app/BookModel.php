<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class BookModel extends Model  {

 protected $table = 'tblbooks';

 protected $fillable = [ 'bookname', 'yearpublish' ];

 protected $primaryKey = 'id';

}
