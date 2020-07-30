<div class="container">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<form action="{{ route('admin.post.store')}}" method="post" class="my_form" id="my_form">
  @csrf

  <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-left">
        <h4 class="modal-title w-100 font-weight-bold">New Post</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input id="title" type="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required>
          <label data-error="wrong" data-success="right" for="defaultForm-email">{{ __('Title') }}</label>
          @if ($errors->has('title'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('title') }}</strong>
          </span>
          @endif
        </div>

        <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input id="des" type="des" class="form-control{{ $errors->has('des') ? ' is-invalid' : '' }}" name="des" value="{{ old('des') }}" required>
          <label data-error="wrong" data-success="right" for="defaultForm-email">{{ __('Description') }}</label>
          @if ($errors->has('des'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('des') }}</strong>
          </span>
          @endif
        </div>


        <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <select id="category_id" type="category_id" name="category_id" class="browser-default custom-select">
            @foreach(App\Category::all() as $category)
           <option value="{{$category->id}}">{{$category->name}}</option>
           @endforeach
         </select>
         <label data-error="wrong" data-success="right" for="defaultForm-email">{{ __('Category') }}</label>
       </div>

     </div>
     <div class="modal-footer d-flex justify-content-center">
      <button class="btn btn-default">Post</button>
    </div>
  </div>
</div>
</div>
</div>
</form>
 


</div>
</div>