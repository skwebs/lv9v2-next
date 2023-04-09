@extends('layouts.student_layout')
@section('js')
    <!-- jQuery -->
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/toastify-js.js') }}"></script>
    <!-- cropperjs  -->
    <script src="{{ asset('/js/cropper.min.js') }}"></script>
@endsection
@php
    $ratio = 4 / 5;
    $width = 200;
    $height = $width / $ratio;
@endphp
@section('css')
    <!-- cropper -->
    <link rel="stylesheet" href="{{ asset('/css/cropper.min.css') }}" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('/css/toastify.min.css') }}" />

    <style>
        .label {
            cursor: pointer;
        }

        .progress {
            display: none;
            margin-bottom: 1rem;
        }


        .img-container img {
            max-width: 100%;
        }

        .image_wrapper {
            width: {{ $width }}px;
            height: {{ $height }}px;
        }

        .image_wrapper img {
            width: 100%;
        }

        .croppingPreview {
            width: 50px;
            height: 50px;
            overflow: hidden;
        }
    </style>
@endsection

@section('content')
    <div class=" px-2 pt-5" style="overflow:hidden;">
        <div>
            <div>
                <div style="max-width: 600px" class=" mx-auto">
                    @if ($message = session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <div class="text-center h3"><strong>Success!</strong></div>
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="card-title">Crop & upload image</p>
                                <a class="btn btn-primary" href="{{ route('admitCard.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                                        <path
                                            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                        <path
                                            d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                                    </svg> &nbsp;
                                    Student List
                                </a>
                            </div>
                        </div>

                        {{-- <div class="croppingPreview border"></div> --}}
                        <div class="px-2 text-center d-md-none"><span><strong>Name:</strong>
                                {{ $admitCard->name }}</span>&nbsp;&nbsp;&nbsp;<span><strong>Father's Name:
                                </strong>{{ $admitCard->father }}</span></div>
                        <div class="d-flex justify-content-center">
                            <div style="width:250px" class="p-2 pr-0">
                                <div class="collapse show " id="preview">
                                    <div class="card card-body">
                                        <div class="image_wrapper border">
                                            <label class="label" data-toggle="tooltip" title="Change image">
                                                <img id="avatar"
                                                    src="@if ($admitCard->image == null) {{ asset('images/static/select-an-image.webp') }} @else {{ asset('uploads/images/students/' . $admitCard->image) }} @endif"
                                                    alt="crop image">
                                                <!--<img id="avatar" src="https://skwebs.github.io/cropper-and-php/assets/img/select-an-image.jpg" alt="crop image" >-->
                                                <input type="file" class="visually-hidden" id="input" name="image"
                                                    accept="image/png,image/jpeg,">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse" id="cropSec">
                                    <div class="card card-body">
                                        <div class="image_wrapper border">
                                            <img id="image"
                                                src="https://skwebs.github.io/cropper-and-php/assets/img/select-an-image.jpg"
                                                alt="crop image">
                                        </div>
                                        <div class="d-flex justify-content-between mt-3">
                                            <button type="button" id="cropCancelBtn"
                                                class="btn btn-secondary">Cancel</button>
                                            <button type="button" class="btn btn-primary" id="crop">Crop</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 d-md-block d-none">
                                <h3>Image preview</h3>
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $admitCard->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Father's Name</th>
                                        <td>{{ $admitCard->father }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mother's Name</th>
                                        <td>{{ $admitCard->mother }}</td>
                                    </tr>
                                    <tr>
                                        <th>Class</th>
                                        <td>{{ $admitCard->class }}</td>
                                    </tr>
                                    <tr>
                                        <th>Roll</th>
                                        <td>{{ $admitCard->roll }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0"
                aria-valuemin="0" aria-valuemax="100">0%</div>
        </div>
        <div>

            <a class="btn btn-primary mt-4" href="{{ route('admitCard.create') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                    <path fill-rule="evenodd"
                        d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                </svg> &nbsp;
                Add New Student</a>
        </div>
    </div>
    <script type="module">
  "use strict";
  /*if (!window.console) console = {};
  const console_out = document.getElementById("console_out");
  console.log = function(message) {
	  console_out.innerHTML += message + " < br / > ";
	  console_out.scrollTop = console_out.scrollHeight;
  };*/

  // "use strict";
  window.addEventListener('DOMContentLoaded', function() {
    const avatar = document.getElementById('avatar');
    const image = document.getElementById('image');
    const input = document.getElementById('input');
    const $progress = $('.progress');
    const $progressBar = $('.progress-bar');
    const $alert = $('.alert');
    const $preview = $("#preview");
    const $cropSec = $("#cropSec");
    const $cropCancelBtn = $("#cropCancelBtn");
    let cropper;
    let mimeType;
    $('[data-toggle="tooltip"]').tooltip();
    input.addEventListener('change', function(e) {
      let files = e.target.files;
      const done = function(url) {
        input.value = '';
        image.src = url;
        $alert.hide();
        $cropSec.collapse('show')
      };
      let reader;
      let file;
      let url;
      if (files && files.length > 0) {
        file = files[0];
        getMimeType(file);
        if (URL) {
          done(URL.createObjectURL(file));
        } else if (FileReader) {
          reader = new FileReader();
          reader.onload = function(e) {
            done(reader.result);
          };
          reader.readAsDataURL(file);
        }
      }
    });
    $cropSec.on('show.bs.collapse', function() {
      cropper = new Cropper(image, {
        aspectRatio: 4 / 5,
        dragMode: 'move',
        preview: '.croppingPreview',
        autoCropArea: 1,
        restore: !1,
        modal: !1,
        highlight: !1,
        cropBoxMovable: !1,
        cropBoxResizable: !1,
        toggleDragModeOnDblclick: !1,
        viewMode: 3
      });
    }).on('hidden.bs.collapse', function() {
      cropper.destroy();
      cropper = null;
    });
    document.getElementById('crop').addEventListener('click', function() {
      console.time('crop time');
      let initialAvatarURL;
      let canvas;
      $cropSec.collapse("hide")
      if (cropper) {
        canvas = cropper.getCroppedCanvas({
          width: {{$width*1.5}},
          height: {{$height*1.5}}
        });
        initialAvatarURL = avatar.src;
        avatar.src = canvas.toDataURL();
        $progress.show();
        $alert.removeClass('alert-success alert-warning');
        canvas.toBlob(function(blob) {
          const formData = new FormData();
          formData.append('image', blob, 'avatar.' + mimeType.slice(6));
          formData.append('fileExt', mimeType.slice(6));
          formData.append('id', '{{$admitCard->id}}');
          formData.append('_token', '{{csrf_token()}}');
          $.ajax('{{route("admitCard.save_image", $admitCard->id)}}', {
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            xhr: function() {
              const xhr = new XMLHttpRequest();
              xhr.upload.onprogress = function(e) {
                let percent = '0';
                let percentage = '0%';
                if (e.lengthComputable) {
                  percent = Math.round((e.loaded / e.total) * 100);
                  percentage = percent + '%';
                  $progressBar.width(percentage).attr('aria-valuenow', percent).text(percentage);
                }
              };
              return xhr;
            },
            success: function(res) {
              //alert(res)
              if (res.success) {
                toastMsg("Image saved successfully.");
                //$alert.show().addClass('alert-success').text(JSON.stringify(res));
                console.timeEnd('crop time');
                console.log(res);
                window.location.replace("{{ route('admitCard.index')}}");
              } else {
                toastMsg("Something goes wrong..");
                //$alert.show().addClass('alert-danger').text(JSON.stringify(res.errors));
                console.log(res)
                console.log(res.errors)
              }
            },
            error: function(err) {
              alert(JSON.stringify(err));
              toastMsg("Error(s)..");
              avatar.src = initialAvatarURL;
              //$alert.show().addClass('alert-warning').text('Upload error');
            },
            complete: function() {
              $progress.hide();
            },
          });
        }, mimeType);
      }
    });
    // check mime type
    function getMimeType(file) {
      const fileReaderForArrayBuffer = new FileReader();
      fileReaderForArrayBuffer.onloadend = function(evt) {
        if (evt.target.readyState === FileReader.DONE) {
          const uInt8Array = new Uint8Array(evt.target.result);
          let bytes = [];
          uInt8Array.forEach((byte) => {
            bytes.push(byte.toString(16))
          });
          const hex = bytes.join('').toUpperCase();
          mimeType = checkMimeType(hex);
          console.log(mimeType)
        }
      };
      const BLOB = file.slice(0, 4);
      fileReaderForArrayBuffer.readAsArrayBuffer(BLOB)
    }
    const checkMimeType = (signature) => {
      switch (signature) {
        case '89504E47':
          return 'image/png';
        case '47494638':
          return 'image/gif';
        case '25504446':
          return 'application/pdf';
        case 'FFD8FFDB':
        case 'FFD8FFE0':
        case 'FFD8FFE1':
          return 'image/jpeg';
        case '504B0304':
          return 'application/zip';
        default:
          return 'Unknown filetype'
      }
    };
    $cropSec.on("show.bs.collapse", () => {
      $preview.collapse('hide');
      $('[data-toggle="tooltip"]').tooltip('hide');
    })
    $cropSec.on("hide.bs.collapse", () => {
      $preview.collapse('show');
    })
    $cropCancelBtn.on("click", () => {
      $cropSec.collapse('hide')
    })

    function toastMsg(msg, bg = "#000") {
      Toastify({
        text: msg,
        gravity: "bottom",
        backgroundColor: bg,
        position: "center",
        duration: 4000
      }).showToast();
    }
  });
</script>
@endsection
