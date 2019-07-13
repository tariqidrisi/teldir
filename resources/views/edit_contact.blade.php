@extends('layouts.app')

@section('content')
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="col-md-6 col-sm-12 col-xs-12">
     <h1>Contact details 
        <small>with preview</small>
        <a href="/contact">All Contacts</a>
     </h1>

     @include('includes.notify')

    <form action="{{route('contact.update', $data->id)}}" method="post" id="addContact" name="addContact" role="form" enctype="multipart/form-data">
      @method('PATCH')
      @csrf    
     <div class="avatar-upload">
        <div class="avatar-edit">
            <input type="hidden" name="id" value="{{ $data->id }}">
            <input type='file' id="imageUpload" name="file" accept=".png, .jpg, .jpeg" />
            <input type="hidden" name="edit_img_path" value="{{ $data->photo }}" id="edit_img_path">
            <label for="imageUpload" class="glyphicon glyphicon-pencil"></label>
        </div>
        <div class="">
           <?php 
              if(empty($data->photo)) {
                $path = URL::to('/img/avatar.png');
              } else {
                $path = Storage::url($data->photo);                
              } 
           ?> 
           <img src="{{ $path }}" name="img" id="img-tag" width="200px" style="display: block" />
        </div>
     </div>

     <!-- row 1 -->
     <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-12">
           <div class="form-group">
              <input type="text" class="form-control input-lg" id="fname" name="fname" placeholder="First Name" value="{{ $data->fname }}" required="">
           </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
           <div class="form-group">
              <input type="text" class="form-control input-lg" id="mname" name="mname" placeholder="Middle Name" value="{{ $data->mname }}">
           </div>
        </div>
     </div>

     <!-- row 2 -->
     <div class="col-md-12">
        <div class="col-md-6 col-sm-6 col-xs-12">
           <div class="form-group">
              <input type="text" class="form-control input-lg" id="lname" name="lname" placeholder="Last Name" value="{{ $data->lname }}">
           </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
           <div class="form-group">
              <input type="email" class="form-control input-lg" id="email" name="email" placeholder="Email" value="{{ $data->email }}">
           </div>
        </div>
     </div>

     <!-- row 3 -->
     <div class="col-md-12">
        <div class="col-md-6 col-sm-6 col-xs-12">
           <div class="form-group">
              <input type="text" class="form-control input-lg" id="mobile" name="mobile" placeholder="Mobile" value="{{ $data->mobile }}" required="" minlength="10" maxlength="15"> 
           </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
           <div class="form-group">
              <input type="text" class="form-control input-lg" id="landline" name="landline" placeholder="Landline" value="{{ $data->landline }}">
           </div>
        </div>
     </div>

     <!-- row 4 -->
      <div class="col-md-12 col-sm-12 col-xs-12 fix">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                  <select name="type" id="type" class="form-control input-lg">
                    <?php 
                      $type = $data->type;
                      $prsel = "";
                      $pusel = "";
                      if($type == "private") {
                        $prsel = "selected=''";
                        $pusel = "";
                      } else {
                        $prsel = "";
                        $pusel = "selected=''";
                      }

                    ?>
                      <option value="private" {{ $prsel }}>Private</option>
                      <option value="public" {{ $pusel }}>Public</option>
                  </select>
              </div>
          </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12 fix">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                  <textarea class="form-control" name="notes" id="notes">{{ $data->notes }}</textarea>
              </div>
          </div>
      </div>

      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="col-md-6 col-sm-6 col-xs-6">
              <button type="submit" class="btn btn-success">Update</button>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-6">
              <button type="button" data-toggle="modal" data-target="#deleteContact" class="btn btn-danger">Delete</button>
          </div>
      </div>
    </form>
    
   <!-- delete confirmation modal --> 
   <div class="modal fade" id="deleteContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
              </button>
           </div>
           <div class="modal-body">Select "Yes" below if you want to delete this record from database.</div>
           <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <form action="{{ route('contact.destroy', $data->id)}}" method="post" name="deleteContact">
                 @csrf
                 @method('DELETE')
                 <button type="submit" class="btn btn-danger" >Yes</a>
              </form>
           </div>
        </div>
      </div>
    </div>

    </div>

    <!-- bar graph of view count -->
    <div class="col-md-6 col-sm-12 col-xs-12">
      {!! $chart->html() !!}      
    </div>

  </div>
  
@endsection
@section('scripts')
  <script>
    $(document).ready(function(){
        $("#imageUpload").change(function(){
            readURL(this);
        });
    });
    function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function (e) {
              $('#img-tag').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
      }
    }
  </script>

  {!! Charts::scripts() !!}
  {!! $chart->script() !!}
@endsection