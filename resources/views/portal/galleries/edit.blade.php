@extends('portal.layouts.main')
@section('title', 'Images')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ trans('messages.gallery.label.edit') }}</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
        @endif
        <div class="panel panel-default">
            
            {{-- {{ Session::get('type') ? 'active' : '' }} --}}
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="{{ !Session::get('type') ? 'active' : '' }}">
                        <a href="#tab1" data-toggle="tab" aria-expanded="false">{{ trans('messages.gallery.label.info') }}</a>
                    </li>
                    <li class="{{ Session::get('type') ? 'active' : '' }}">
                        <a href="#tab2" data-toggle="tab" aria-expanded="false">{{ trans('messages.gallery.label.upload') }}</a>
                    </li>
                </ul>
                <br />
                <div class="tab-content">
                    <div class="tab-pane fade {{ !Session::get('type') ? 'in active' : '' }}" id="tab1">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form" name="user-form" class="form-transparent clearfix" enctype="multipart/form-data" method="POST" action="{{ route('galleries.update', $gallery->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label>{{ trans('messages.gallery.label.title') }}</label>
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#title" data-toggle="tab" aria-expanded="false">Vietnamese</a>
                                            </li>
                                            <li class="">
                                                <a href="#title_en" data-toggle="tab" aria-expanded="false">English</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="title">
                                                <input class="form-control" name="title" placeholder="{{ trans('messages.gallery.label.title') }} ....." value="{{ $gallery->title }}">
                                            </div>
                                            <div class="tab-pane fade" id="title_en">
                                                <input class="form-control" name="title_en" placeholder="{{ trans('messages.gallery.label.title') }} ....." value="{{ $gallery->title_en }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ trans('messages.post.label.thumbnail') }}</label>
                                        <div class="drop-region" onclick="document.getElementById('uploadImage').click()" style="background-image: url('{{ asset($gallery->thumbnail_url) }}')">
                                            <input name="thumbnail_url" id="uploadImage" type="file" style="display: none">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-default">Submit</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade {{ Session::get('type') ? 'in active' : '' }}" id="tab2">
                        <div class="row">
                            <div class="col-lg-12">
                                <form method="post" action="{{ route('galleries.upload', $gallery->id) }}" enctype="multipart/form-data" class="dropzone" id="dropzone">
                                    @csrf
                                    <div class="dz-default dz-message"><h4>Drop files here or click to upload</h4></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#uploadImage").val(null);
        
        $('#uploadImage').on('change', function () {
            if (this.files && this.files[0]) {
                var image = $(this).parents(".drop-region");
                image.children('h4').remove();
                var reader = new FileReader();
                reader.onload = function (e) {
                    image.css('background-image', "url(" + e.target.result + ")");
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
    Dropzone.options.dropzone =
        {
            maxFilesize: 1000,
            acceptedFiles: ".jpeg,.jpg,.png",
            resizeMethod: "contain",
            addRemoveLinks: true,
            timeout: 50000,
            init: function () {
                // Get images
                var myDropzone = this;
                $.ajax({
                    url: "{{ route('galleries.getList', $gallery->id) }}",
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        console.log(myDropzone);
                        $.each(data, function (key, value) {
                            var file = {name: value.name, size: value.size};
                            myDropzone.options.addedfile.call(myDropzone, file);
                            myDropzone.options.thumbnail.call(myDropzone, file, value.path);
                            myDropzone.emit("complete", file);
                        });
                    }
                });
            },
            removedfile: function (file) {
				if (this.options.dictRemoveFile) {
                    if (file.previewElement.id != ""){
                        var name = file.previewElement.id;
                    } else {
                        var name = file.name;
                    }
                    Swal.fire({
                        title: 'Are you sure?',
                        // text: 'Are You Sure to ' + this.options.dictRemoveFile,
                        text: 'Bạn có muốn xóa ảnh ' + name,
                        icon: 'question',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!',
                        showCancelButton: true,
                    }).then((res) => {
                        if (res.isConfirmed) {
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'DELETE',
                                url: "{{ route('galleries.remove', $gallery->id) }}",
                                data: {filename: name},
                                success: function (data){
                                    Swal.fire(
                                        'Deleted!',
                                        // 'Image ' + data.success + ' has been successfully removed!',
                                        'Ảnh ' + data.success + ' đã được xóa thành công!',
                                        'success'
                                    );
                                    var fileRef;
                                    return (fileRef = file.previewElement) != null ? 
                                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
                                },
                                error: function(e) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Lỗi đã xảy ra!'
                                        // text: 'Something went wrong!'
                                    })
                                }
                            });
                        }
                    });
			    }		
            },
            success: function (file, response) {
                file.previewElement.id = response.success;
				// set new images names in dropzone’s preview box.
                var olddatadzname = file.previewElement.querySelector("[data-dz-name]");   
				file.previewElement.querySelector("img").alt = response.success;
				olddatadzname.innerHTML = response.success;
            },
            error: function (file, response) {
                if ($.type(response) === "string") {
					var message = response; //dropzone sends it's own error messages in string
                } else {
					var message = response.error;
                }
				file.previewElement.classList.add("dz-error");
				refs = file.previewElement.querySelectorAll("[data-dz-errormessage]");
				results = [];
				for (i = 0; i < refs.length; i++) {
					node = refs[i];
					results.push(node.textContent = message);
				}

				return results;
            }
        };
</script>
<style>
    .drop-region {
        width: 400px;
        height: 250px;
        border: 2px dashed #028AF4 !important; 
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
    }
    .swal2-popup {
        font-size: 14px !important;
    }

    .dz-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .dropzone.dz-started .dz-message {
        display: block !important;
    }

    .dropzone {
        border: 2px dashed #028AF4 !important;
    }

    .dropzone .dz-preview.dz-complete .dz-success-mark {
        opacity: 1;
    }

    .dropzone .dz-preview.dz-error .dz-success-mark {
        opacity: 0;
    }

    .dropzone .dz-preview .dz-error-message {
        top: 144px;
    }
</style>
@endsection