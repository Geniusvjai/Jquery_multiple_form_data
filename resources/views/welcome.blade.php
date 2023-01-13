<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="shortcut icon" href="{{ asset('css/favicon.ico')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- custom styling -->
    {{-- <link rel="stylesheet" type="text/css" href="style.css"> --}}


    <!-- <script src="static/js/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</head>

<body>

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add language</h5>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="edit">
                    Add
                </button>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <form action="">
                            <div class="col-md-12 form_field_outer p-0">

                                <div class="row form_field_outer_row">
                                    {{-- dynamic filds --}}
                                </div>

                            </div>
                        </form>
                        <div class="row ml-0 bg-light mt-3 border py-3">
                            <div class="col-md-12">


                                <button class="btn btn-outline-lite py-0 add_new_frm_field_btn"><i
                                        class="fas fa-plus add_icon"></i> Add New
                                    field row</button>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-submit">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#edit').click(function(){
            $.ajax({
           url: '{{ route("get_language") }}',
           type: 'get',
           dataType: 'json',
           success: function(data){
            createRows(data);
              

           }
         });
        });
    </script>

    <script type="text/javascript">
        $(".btn-submit").click(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: "{{ route('ajax.data') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    details: $("form").serializeArray(),

                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        alert(data.success);
                        location.reload();

                    }
                }
            });

        });
    </script>

    {{-- scripts --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("click", ".add_new_frm_field_btn", function() {

                var index = $(".form_field_outer").find(".form_field_outer_row").length++;
                $(".form_field_outer").append(`
          <div class="row form_field_outer_row">
              <div class="form-group col-md-6">
                <input type="text" class="form-control w_90" name="language${index}" placeholder="Enter Lanugage" />
              </div>
              <div class="form-check">
                            <input class="form-check-input" type="radio" name="type${index}"
                                value="Basic" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Basic
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type${index}"
                                value="Intermediate">
                            <label class="form-check-label" for="exampleRadios2">
                                Intermediate
                            </label>
                        </div>
                        <div class="form-check disabled">
                            <input class="form-check-input" type="radio" name="type${index}"
                                value="FLuent">
                            <label class="form-check-label" for="exampleRadios3">
                                Fluent
                            </label>
                        </div>
              <div class="form-group col-md-2 add_del_btn_outer">
                <button class="btn_round add_node_btn_frm_field" title="Copy or clone this row">
                  <i class="fas fa-copy"></i>
                </button>

                <button class="btn_round remove_node_btn_frm_field" disabled>
                  <i class="fas fa-trash-alt"></i>
                </button>
              </div>
            </div>
        `);

                $(".form_field_outer").find(".remove_node_btn_frm_field:not(:first)").prop("disabled",
                    false);
                $(".form_field_outer").find(".remove_node_btn_frm_field").first().prop("disabled", true);
            });
        });


        $('.add_new_frm_field_btn').click(function() {
            var count = 0;
            $(".form_field_outer_row").each(function() {

                count += 1;
                if (count >= 5) {
                    $('.add_new_frm_field_btn').hide();
                }
            });
        })



        ///======Clone method
        $(document).ready(function() {
            $("body").on("click", ".add_node_btn_frm_field", function(e) {
                var index = $(e.target).closest(".form_field_outer").find(".form_field_outer_row").length +
                    1;
                var cloned_el = $(e.target).closest(".form_field_outer_row").clone(true);

                $(e.target).closest(".form_field_outer").last().append(cloned_el).find(
                    ".remove_node_btn_frm_field:not(:first)").prop("disabled", false);

                $(e.target).closest(".form_field_outer").find(".remove_node_btn_frm_field").first().prop(
                    "disabled", true);


                //change id
                $(e.target).closest(".form_field_outer").find(".form_field_outer_row").last().find(
                    "input[type='text']").attr("id", "mobileb_no_" + index);

                $(e.target).closest(".form_field_outer").find(".form_field_outer_row").last().find("select")
                    .attr("id", "no_type_" + index);

                console.log(cloned_el);
                //count++;
            });
        });

        $(document).ready(function() {
            //===== delete the form fieed row
            $("body").on("click", ".remove_node_btn_frm_field", function() {
                $(this).closest(".form_field_outer_row").remove();
                console.log("success");
            });
        });
    </script>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>

</body>

</html>
