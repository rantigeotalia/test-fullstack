<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Belajar CRUD dengan ajax di laravel">
    <meta name="Author" content="zai.web.id">
    <meta name="Keywords" content="CRUD dengan ajax di laravel" />

    <!-- Title -->
    <title>@yield('title','CRUD ajax laravel')</title>

    <!--- Favicon --->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

    <!--- CDN CSS bootstrap --->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

     <!--- CDN Jquery --->
     <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
     
    <!--- CDN Jquery bootstrap --->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5 mb-5">
                    <div class="card-header">
                        Data Customer
                    </div>
                    <div class="card-body">
                        
                        <div class="pull-left mb-3">
                            <button class="btn btn-primary" onclick="input()">Tambah data</button>
                            <button class="btn btn-secondary" onclick="reload_table()">Refresh</button>
                        </div>
                        
                        <div class="table-responsive" id="area_tabel"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" tabindex="-1" id="mdl_modal_form" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div id="content_modal_form"></div>
            </div>
        </div>
    </div>

    <script>    
    $(window).on("load", function() { 
		reload_table(); 
	});

    $(function() { 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    window.reload_table = function() {
        var url = "{{ route('customer.data') }}";
        var param = {};
        $.ajax({
            type: "GET",
            dataType: "json",
            data: param,
            url: url,
            beforeSend: function() {
                $("#area_tabel").html("<div class='text-center pt-4 pb-4'>Mohon Tunggu...</div>");
            },
            success: function(val) {
                $("#area_tabel").html(val['data']);
            }
        });
    }

    window.input = function() {
        $("#mdl_modal_form").modal({backdrop: 'static',keyboard: false});
        var url = "{{ route('customer.input') }}";
        var param = {};
        $.ajax({
            type: "GET",
            dataType: "json",
            data: param,
            url: url,
            beforeSend: function() {
                $("#content_modal_form").html("<div class='text-center pt-4 pb-4'>Mohon Tunggu...</div>");
            },
            success: function(val) {
                $("#content_modal_form").html(val['data']);
            }
        });
    }


    //fungsi untuk insert atau update
    window.formSubmit = function(id){
        var param = $("#" + id).serialize();
        var url = $("#" + id).attr("url");
        $.ajax({
            type: "POST",
            dataType: "json",
            data: param,
            url: url,
            beforeSend: function() {
                $('#msg_'+id+'').addClass('fa fa-spinner fa-spin');
            },
            success: function(val) {
                const name = document.getElementById('name').value;
                    const email = document.getElementById('email').value;
                    const no_telp = document.getElementById('no_telp').value;
                    document.cookie = "Name=" +name;
                    document.cookie = "Email=" +email;
                    document.cookie = "No Telpon=" +no_telp;
                $('#msg_'+id+'').removeClass('fa fa-spinner fa-spin');
                if (val["status"] == false) {
                    document.cookie = "Status=Gagal";
                    alert(val['info']);
                }else{
                    document.cookie = "Status=Berhasil";
                    $("#" + id)[0].reset();
                    alert(val['info']);
                    reload_table();
                    $("#mdl_modal_form").modal("hide");
                    $("body").removeClass("modal-open");
                    $(".modal-backdrop").remove();
                }
            }
        });
    }

    </script> 


    @stack('costum-script')
</body>
</html>