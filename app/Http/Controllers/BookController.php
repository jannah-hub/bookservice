<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\BookModel;
use App\Model;
use DB;

class BookController extends Controller
{
    use ApiResponser;
    private $request;
    
     
    public function __construct(Request $request)
    {
        $this->request = $request;
        
    }


    public function getBooks()
    {
        $books =  DB::connection('mysql')
        ->select("Select * from tblbooks");

        return $this->successResponse($books);
    }


    public function index()
    {
        $books = BookModel::all();

        return $this->successResponse($books);
    }


    public function add(Request $request)
    {
        $rules = [

            'bookname' => 'required|max:20',
            'yearpublish' => 'required|numeric|min:1|not_in:0',
            //'gender' => 'required|in:Male,Female',

        ];


        $this->validate($request, $rules);
        $books = BookModel::create($request->all());
        return $this->successResponse($books, Response::HTTP_CREATED);
    }

    /**
        * Obtains and show one book
        * @return Illuminate\Http\Response
        */


    public function show($id)
    {
        $books = BookModel::where('id', $id)->first();
        if($books){
            return $this->successResponse($books);
        }
    
        {
            return $this->errorResponse('Book ID Does Not Exist', Response::HTTP_NOT_FOUND);

        }

    }

    /**
        * Update an existing author
        * @return Illuminate\Http\Response
        */
    
    public function update(Request $request, $id)
    {

        $rules = [

            'bookname' => 'max:20',
            'yearpublish' => 'numeric|min:1|not_in:0',
            //'gender' => 'in:Male,Female',

        ];

        $this->validate($request, $rules);

        $books = BookModel::findOrFail($id);

        $books->fill($request->all());
        
        $books->save();
        if($books){
            return $this->successResponse($books);
        }
    
        {
            return $this->errorResponse('Book ID Does Not Exist', Response::HTTP_NOT_FOUND);

        }
    }

    public function delete($id)
    {
        $books = BookModel::where('id', $id)->first();
        if($books){
            $books->delete();
            return $this->successResponse($books);
        }
    
        {
            return $this->errorResponse('Book ID Does Not Exist', Response::HTTP_NOT_FOUND);

        }

    }    
}

?>