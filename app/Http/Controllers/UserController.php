<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DataTables;
use DB;

/* 

UserController : Use for user related CRUD operations

*/

class UserController extends Controller
{
	/* 
		Used to fetch the users details list with provided pagination and filters
	*/
    public function index(Request $request)
    {
        if ($request->ajax()) {

		    $params = [
		        'limit' => request()->input('length'),
		        'offset' => request()->input('start'),
		        'query' => request()->input('search')['value']
		    ];

		    $totalUsers = DB::table('users')->count();

		    if(!empty($request->input('search.value'))) {
		    	$search = $request->input('search.value');
			    $data = DB::table('users')
					    	->Where('name', 'LIKE',"%{$search}%")
					    	->orWhere('email', 'LIKE',"%{$search}%")
			                ->offset($params['offset'])
			                ->limit($params['limit'])
			                ->orderBy('updated_at', 'DESC')
			                ->orderBy('id', 'DESC')
			                ->get();
		    	$totalUsers = DB::table('users')
					    	->Where('name', 'LIKE',"%{$search}%")
					    	->orWhere('email', 'LIKE',"%{$search}%")
					    	->count();
		    } else {
			    $data = DB::table('users')
			                ->offset($params['offset'])
			                ->limit($params['limit'])
			                ->orderBy('updated_at', 'DESC')
			                ->orderBy('id', 'DESC')
			                ->get();
		    }

		    $datatable = Datatables::of($data)
		        ->setOffset(request()->input('start'))
		        ->setTotalRecords($totalUsers)
		        ->setFilteredRecords($totalUsers);
		    $datatable = $datatable->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="javascript:void(0)" class="view btn btn-primary btn-sm" id="'.$row->id.'">View</a>';
     
                            return $btn;
                    })
                    ->rawColumns(['action']);
		    return $datatable->make(true);
        }
      
        return view('userlist');
    }

    /*
		Used to fetch specific user details by user id
    */
    public function getUserDetails($id) {
    	$response = array();
	    $data = User::select('id', 'name', 'email')
	                ->where('id', $id)
	                ->first();
        if(!empty($data)) {
            $response['status'] = 200;
        } else {
        	$response['status'] = 404;
        }
		$response['data'] = $data;
		return json_encode($response);
    }

}
