<?php

namespace App\Http\Controllers;

use Auth;
use App\Setting;
use Request;
use App\Http\Requests\CreateSettingRequest;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class SettingsController extends Controller
{
  
   //
    public function __construct() {
        $this->middleware('auth');

     
    }

  public function index() {
//     $promotions = Promotion::latest()->get();
//          return view('promotions.index')->with("promotions",$promotions);
// // return $promotions;
  }    
     
     
public function edit($id) {
//return "edit";
$edit_shop = Setting::findOrFail($id);

if(Auth::user()->id == $edit_shop->user_id) { 
 
return view("settings.edit")->with("edit_shop",$edit_shop);
} else {
  return view("403");
}

}
public function update($id, CreateSettingRequest $request) { 
$update_shop = Setting::findOrFail($id);

$update_shop->update($request->all());

return redirect("settings/".$update_shop->id."/edit");

}


public function store(CreateSettingRequest $request) {

$setting = new Setting($request->all());
    Auth::user()->setting()->save($setting);
   
  
return redirect("settings/".$setting->user_id."/edit");
 
}

public function customersmanage() { 

  $customermanage = Setting::latest()->paginate(10);
  return view('settings.customersmanage')->with('customersmanage',$customermanage);
}

}
 