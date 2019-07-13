@extends('layouts.app')

@section('content')
<div class="contact-container container">
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col" class="table-head glyphicon glyphicon-phone-alt"> Contacts</th>
        <th colspan="3">
          <div class="addCont">
            <div class="">
              <a href="{{ route('contact.create') }}" class="btn btn-success glyphicon glyphicon-plus"></a>
            </div>
          </div>
        </th>
      </tr>
      <tr>
        <th colspan="4">
          <div class="autocomplete" >
            <div class="form-group">
              <input type="text" name="search" class="form-control search-txt" id="search" placeholder="Search">
              <select name="sort_name" id="sort_name" >
                <option>Sort by name</option>
                <option value="ASC">ASC</option>
                <option value="DESC">DESC</option>
              </select>

              <select name="sort_date" id="sort_date" class="sort_date">
                <option>Sort by date</option>
                <option value="ASC">ASC</option>
                <option value="DESC">DESC</option>
              </select>
            </div>
          </div>
        </th>
      </tr>
    </thead>
    <tbody id="searchResult">
      @include('partials.list')    
    </tbody>
  </table>
</div>

@endsection

@section('scripts')
  @include('includes.autocomplete')  
@endsection