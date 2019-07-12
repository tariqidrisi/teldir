@foreach($data['all'] as $contact) 
  <tr>
    <th scope="row" colspan="4" title="Click to view"><a href="{{route('contact.edit', $contact->id)}}" name="edit">{{$contact->fname}}</a></th>
  </tr>
@endforeach