<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Charts;
use Redirect;
use App\Contact;
use App\ContactViewCounter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get logged in user id
        $id = Auth::user()->id;
        // dd($id);

        $data['all'] = Contact::Where('user_id', $id)->orWhere('type', 'public')->orderBy('fname')->get();
        $data['auto_search'] = $this->makeAutocompleteSearch($data['all']);
        
        return view("contacts", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("add_contact", compact(""));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        $file = $request->file;
        
        // handle null
        if(!is_null($file)){            
            $photo = $this->saveProduct($file, $request);
        } else {
            $photo = "";
        }

        $ValidateFname = request('fname');
        $validate = $this->existOrNot($ValidateFname);
        
        if($validate == true) {
            $msg['msg'] = "error";
            $msg['msg_content'] = "Already Exist.";
        } else {
            // initialization
            $contact = new Contact;
            $contact->photo = $photo;        
            $contact->fname = $ValidateFname;
            $contact->mname = request('mname');
            $contact->lname = request('lname');
            $contact->email = request('email');
            $contact->mobile = request('mobile');
            $contact->landline = request('landline');
            $contact->type = request('type');
            $contact->notes = request('notes');
            $contact->save();
            
            if($contact) {
                $msg['msg'] = "added";
                $msg['msg_content'] = "Contact added successfully.";
            } else {
                $msg['msg'] = "error";
                $msg['msg_content'] = "Something went wrong. Please contact your administrator";
            }
    
        }

        
        return Redirect::back()->with($msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // add view count to table
        $viewCount = new ContactViewCounter;
        $viewCount->contact_id = $id;
        $viewCount->save();

        $data = Contact::where('id', $id)->first();
        $ContactViewCounter = ContactViewCounter::where('contact_id', $id)->where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
                    ->get();

        $chart = Charts::database($ContactViewCounter, 'bar', 'highcharts')
                  ->title("Monthly views")
                  ->elementLabel("Total view count")
                  ->dimensions(1000, 500)
                  ->responsive(true)
                  ->groupByMonth(date('Y'), true);
 
        return view("edit_contact")->with(compact('data', 'chart'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);

        if (array_key_exists("file",$request->all())){
            $photo = $request->file;
            $photo = $this->saveProduct($photo, $request);
        } else {
            $img = request('edit_img_path');
            $photo = $img;
        }
        // dd($photo);

        $ValidateFname = request('fname');
        $validate = $this->existOrNot($ValidateFname);
        
        if($validate == true) {
            $msg['msg'] = "error";
            $msg['msg_content'] = "Already Exist.";
        } else {

            $contact = Contact::find($id);
            $contact->photo = $photo;
            $contact->fname = $ValidateFname;
            $contact->mname = $request->get('mname');
            $contact->lname = $request->get('lname');
            $contact->email = $request->get('email');
            $contact->mobile = $request->get('mobile');
            $contact->landline = $request->get('landline');
            $contact->type = $request->get('type');
            $contact->notes = $request->get('notes');
            $contact->save();

            if($contact) {
                $msg['msg'] = "updated";
                $msg['msg_content'] = "Contact Updated Successfully.";
            } else {
                $msg['msg'] = "error";
                $msg['msg_content'] = "Something went wrong. Please contact your administrator";
            }
        }
        return Redirect::back()->with($msg); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();

        if($contact) { 
            $ms['msg'] = "delete";
            $msg['msg_content'] = "Contact Deleted Successfully.";
        } else {
            $msg['msg'] = "error";
            $msg['msg_content'] = "Something went wrong. Please contact your administrator";
        }

        return Redirect::to(route('contact.create'))->with($msg);
    }


    public function saveProduct($img, $request) {
        // save product image to storage
        
        $extension = $img->getClientOriginalExtension();
        
        if ($request->hasFile('file')) {
            $image =  $request->file('file')->store('public/profile');
        } else {
            $image = "";
        }
        return $image;        
    }

    /**
    *   array to filter contact
    *
    */
    public function makeAutocompleteSearch($data) {
        $arr = [];
        foreach ($data as $key => $value) {
            $arr[] = $value->fname;
        }

        $autocomplete = json_encode($arr);
        // dd($autocomplete);
        return $autocomplete;
    }

    public function search(Request $request) {

        // text to search for in table
        $text = request('text');
        $id = Auth::user()->id;

        if(!empty($text)) {

            $data['all'] = Contact::Where('user_id', $id)->Where('fname', 'like', $text . '%')->orderBy('fname')->get();
        } else {
            $data['all'] = Contact::Where('user_id', $id)->orWhere('type', 'public')->orderBy('fname')->get();

        }
        $data['auto_search'] = $this->makeAutocompleteSearch($data['all']);
        
        return view("partials.list", compact("data"));
    }

    public function existOrNot(String $name) {
        $result = Contact::where('fname', $name)->count();
        
        if($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function sorting(Request $request) {
        $order = request('order');
        $col = request('col');
        $id = Auth::user()->id;

        $data['all'] = Contact::Where('user_id', $id)->orWhere('type', 'public')->orderBy($col, $order)->get();
    
        $data['auto_search'] = $this->makeAutocompleteSearch($data['all']);

        return view("partials.list", compact("data"));
    }
}
