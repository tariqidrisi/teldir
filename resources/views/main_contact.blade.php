@extends('layouts.app')

@section('content')
  <div class="container">
   <h1>Contact details 
      <small>with preview</small>
   </h1>
   <form >
   <div class="avatar-upload">
      <div class="avatar-edit">
         <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
         <label for="imageUpload" class="glyphicon glyphicon-pencil"></label>
      </div>
      <div class="avatar-preview">
         <div id="imagePreview" style="background-image: url({{ URL::to('/img/avatar.png') }});">
         </div>
      </div>
   </div>

   <!-- row 1 -->
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="col-md-6 col-sm-6 col-xs-12">
         <div class="form-group">
            <input type="text" class="form-control input-lg" id="fname" name="fname" placeholder="First Name">
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
            <input type="text" class="form-control input-lg" id="email" name="email" placeholder="Email">
         </div>
      </div>
   </div>

   <!-- row 3 -->
   <div class="col-md-12">
      <div class="col-md-6 col-sm-6 col-xs-12">
         <div class="form-group">
            <input type="text" class="form-control input-lg" id="mobile" name="mobile" placeholder="Mobile">
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
        <div class="col-md-6 col-sm-6 col-xs-6">
            <button type="button" class="btn btn-success">Save</button>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
            <button type="button" data-toggle="modal" data-target="#deleteContact" class="btn btn-danger">Delete</button>
        </div>
    </div>


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
            <form action="" method="post">
               @csrf
               @method('DELETE')
               <button type="submit" class="btn btn-danger" >Yes</a>
            </form>
         </div>
      </div>
    </div>
    </div>
  </form>
    
</div>
@endsection
@section('scripts')
  <script>

  </script>
@endsection