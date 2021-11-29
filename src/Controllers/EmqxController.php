<?php
  namespace SamirEltabal\EmqxAuth\Controllers;
  use App\Http\Controllers\Controller;
  use Illuminate\Http\Request;
  use App\Models\User;
  use SamirEltabal\EmqxAuth\Middlewares\setHeader;

  class EmqxController extends Controller {

    public function __construct() {
        $this->middleware([setHeader::class,'auth:api'])->except('acl');
        $this->middleware([setHeader::class,'auth:api','role:admin'])->only('super_user');
    }
    
    public function authenticate (Request $request)  {
      $user = \Auth::user();
      // return $request->uuid;
      if($user->uuid == $request->input('uuid') && $user->email == $request->input('client_id')) {
        return response()->json([
          'message' => 'ok'
        ], 200);
      } else {
        return response()->json([
          'message' => 'not authenticated'
        ], 401);
      } 
    }

    public function super_user(Request $request) {
      return response()->json(
        ['message' => 'ok']
        ,200);
    }

    public function acl(Request $request) {
      $uuid = $request->input('uuid');
      $user = User::Uuid($uuid)->firstOrFail();
      if($user) {
        return response()->json('ok', 200);
      } else {
        return response()->json(['message' => 'not authorised'], 200);
      }
    }

  }
