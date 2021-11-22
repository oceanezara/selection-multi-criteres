<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/dt-1.10.20/r-2.2.3/datatables.min.css" />


    <title>Sélection multicritères</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <h1 class="text-center">Sélection multicritères</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Type</label>
                            </div>
                            <select class="custom-select" id="type">
                                <option value="">Sélectionner...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Adultes</label>
                            </div>
                            <select class="custom-select" id="adult">
                                <option value="">Sélectionner...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Animaux</label>
                            </div>
                            <select class="custom-select" id="adult">
                                <option value="">Sélectionner...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Enfants</label>
                            </div>
                            <select class="custom-select" id="adult">
                                <option value="">Sélectionner...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Prix</label>
                            </div>
                            <select class="custom-select" id="adult">
                                <option value="">Sélectionner...</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div>
                    <button id="filter" class="btn btn-sm btn-outline-info">Filtre</button>
                    <button id="reset" class="btn btn-sm btn-outline-warning">Reset</button>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-3 mb-3">
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-borderless" id="record_table">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Adultes</th>
                                        <th>Animaux</th>
                                        <th>Prix</th>
                                        <th>Enfants</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
   

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/r-2.2.3/datatables.min.js"></script>

    <!-- Moment Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <script>
    // Fetch Standard

    function fetch_std() {
        $.ajax({
            url: "fetch_std.php",
            type: "post",
            dataType: "json",
            success: function(data) {
                var stdBody = "";
                for (var key in data) {
                    stdBody += `<option value="${data[key]['type']}">${data[key]['type']}</option>`;
                }
                $("#type").append(stdBody);
            }
        });
    }
    fetch_std();

    // Fetch Result

    function fetch_res() {
        $.ajax({
            url: "fetch_res.php",
            type: "post",
            dataType: "json",
            success: function(data) {
                var resBody = "";
                for (var key in data) {
                    resBody += `<option value="${data[key]['adult']}">${data[key]['adult']}</option>`;
                }
                $("#adult").append(resBody);
            }
        });
    }
    fetch_res();

    // Fetch Records

    function fetch(std, res) {
        $.ajax({
            url: "records.php",
            type: "post",
            data: {
                std: std,
                res: res
            },
            dataType: "json",
            success: function(data) {
                var i = 1;
                $('#record_table').DataTable({
                    "data": data,
                    "responsive": true,
                    "columns": [
                        {
                            "data": "type"
                        },
                        
                        {
                            "data": "adult"
                        },
                        {
                            "data": "pet"
                        },
                        {
                            "data": "price"
                        },
                        {
                            "data": "child"
                        },
                    ],
                    
                });
            }
        });
    }
    fetch();

    // Filter

    $(document).on("click", "#filter", function(e) {
        e.preventDefault();

        var std = $("#type").val();
        var res = $("#adult").val();

        if (std !== "" && res !== "") {
            $('#record_table').DataTable().destroy();
            fetch(std, res);
        } else if (std !== "" && res == "") {
            $('#record_table').DataTable().destroy();
            fetch(std, '');
        } else if (std == "" && res !== "") {
            $('#record_table').DataTable().destroy();
            fetch('', res);
        } else {
            $('#record_table').DataTable().destroy();
            fetch();
        }
    });

    // Reset

    $(document).on("click", "#reset", function(e) {
        e.preventDefault();

        $("#type").html(`<option value="">Sélectionner...</option>`);
        $("#adult").html(`<option value="">Sélectionner...</option>`);

        $('#record_table').DataTable().destroy();
        fetch();
        fetch_std();
        fetch_res();
    });
    </script>

    
</body>

</html>