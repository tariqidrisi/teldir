@extends('layouts.app')

@section('content')
  <div class="container contact-container">
   <h1>Contact details 
      <small>with preview</small>
      <a href="/contact">All Contacts</a>
   </h1>

   @include('includes.notify')

   <form action="{{route('contact.store')}}" method="post" id="addContact" name="addContact" role="form" enctype="multipart/form-data">
    @csrf
   <div class="avatar-upload">
      <div class="avatar-edit">
         <input type='file' id="imageUpload" name="file" accept=".png, .jpg, .jpeg" />
         <input type="hidden" name="edit_img_path" value="" id="edit_img_path">
         <label for="imageUpload" class="glyphicon glyphicon-pencil"></label>
      </div>
      <div class="">
         <img src="{{ URL::to('/img/avatar.png') }}" name="img" id="img-tag" width="200px" style="display: block" />
      </div>
   </div>

   <!-- row 1 -->
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="col-md-6 col-sm-6 col-xs-12">
         <div class="form-group">
            <input type="text" class="form-control input-lg" id="fname" name="fname" placeholder="First Name" required="">
         </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
         <div class="form-group">
            <input type="text" class="form-control input-lg" id="mname" name="mname" placeholder="Middle Name">
         </div>
      </div>
   </div>

   <!-- row 2 -->
   <div class="col-md-12">
      <div class="col-md-6 col-sm-6 col-xs-12">
         <div class="form-group">
            <input type="text" class="form-control input-lg" id="lname" name="lname" placeholder="Last Name">
         </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
         <div class="form-group">
            <input type="email" class="form-control input-lg" id="email" name="email" placeholder="Email">
         </div>
      </div>
   </div>

   <!-- row 3 -->
   <div class="col-md-12">
      <div class="col-md-6 col-sm-6 col-xs-12">
         <div class="form-group">
            <input type="text" class="form-control input-lg" id="mobile" name="mobile" placeholder="Mobile" required="" minlength="10" maxlength="15"> 
         </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
         <div class="form-group">
            <input type="text" class="form-control input-lg" id="landline" name="landline" placeholder="Landline">
         </div>
      </div>
   </div>

   <!-- row 4 -->
    <div class="col-md-12 col-sm-12 col-xs-12 fix">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <select name="type" id="type" class="form-control input-lg">
                    <option value="private">Private</option>
                    <option value="public">Public</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 fix">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <textarea class="form-control" name="notes" id="notes"></textarea>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <button type="submit" class="btn btn-success">Save</button>
        </div>        
    </div>

  </form>
    
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
@endsection