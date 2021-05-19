@extends('backend.layouts.master')
@section('content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Categories</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Categories</li>
                        <li class="breadcrumb-item active">Add New Category</li>
                    </ul>
                </div>
                <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>Add New Category</h2>
                    </div>
                    <div class="body">
                        <form action="{{route('category.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" value="{{old('title')}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Summary</label>
                                <textarea id="description" name="summary" class="form-control">{{old('summary')}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Is Parent: </label>
                                <input id="is_parent" type="checkbox" name="is_parent" value="1" checked> YES
                            </div>

                            <div class="form-group d-none" id="parent_cat_div">
                                <div class="col col-md-3">
                                    <label for="select" class=" form-control-label">Parent</label>
                                </div>
                                <div class="col-12 col-md-12">
                                    <select class="form-control" name="parent_id">
                                        <option value="">-- Parent Category --</option>
                                        @foreach($parent_cats as $pcats)
                                        <option value="{{$pcats->id}}" {{old('parent_id')==$pcats->id ? 'selected' : ''}}>{{$pcats->title}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class=" form-control-label">Photo</label>
                                <div class="input-group">
                                      <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                           <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                      </span>
                                    <input id="thumbnail" class="form-control" type="text" name="photo">
                                </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                            </div>

                            <div class="form-group">
                                <div class="col col-md-3">
                                    <label for="select" class=" form-control-label">Status</label>
                                </div>
                                <div class="col-12 col-md-12">
                                    <select class="form-control" name="status">
                                        <option value="">-- Status --</option>
                                        <option value="active" {{old('status')=='active' ? 'selected' : ''}}>Active</option>
                                        <option value="inactive" {{old('status')=='inactive' ? 'selected' : ''}}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="submit" class="btn btn-outline-secondary">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>

    <script>
        $(document).ready(function() {
            $('#description').summernote();
        });
    </script>

    <script>
        $('#is_parent').change(function(e){
            e.preventDefault();
            var is_checked = $('#is_parent').prop('checked');
            if(is_checked){
                $('#parent_cat_div').addClass('d-none');
                $('#parent_cat_div').val('');
            }else{
                $('#parent_cat_div').removeClass('d-none');
            }
        });
    </script>
@endsection
