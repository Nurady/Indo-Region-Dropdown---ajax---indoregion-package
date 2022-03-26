<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Indoregion</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row mt-5 d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card p-3">
                    <div class="form-group">
                        <label for="provinces">Provinsi</label>
                        <select name="provinces" id="provinces" class="form-control">
                            <option value="" readonly>Pilih Provinsi</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="regencies">Kabupaten</label>
                        <select name="regencies" id="regencies" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        <label for="districts">Kecamatan</label>
                        <select name="districts" id="districts" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        <label for="villages">Kelurahan/Desa</label>
                        <select name="villages" id="villages" class="form-control"></select>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>   
    
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        $(function() {
            $('#provinces').on('change', function() {
                let provinceId = $('#provinces').val();

                // Send ID to Controller
                $.ajax({
                    type: 'POST',
                    url: "{{ route('getRegency') }}",
                    data: {provinceId: provinceId},
                    cache: false,
                    success: function(msg) {
                        $('#regencies').html(msg);
                        $('#districts').html('');
                        $('#villages').html('');
                    },
                    error: function(err) {
                        console.log('error: ', err);
                    },
                });
            });
        });

        $(function() {
            $('#regencies').on('change', function() {
                let regencyId = $('#regencies').val();

                // Send ID to Controller
                $.ajax({
                    type: 'POST',
                    url: "{{ route('getDistrict') }}",
                    data: {regencyId: regencyId},
                    cache: false,
                    success: function(msg) {
                        $('#districts').html(msg);
                        $('#villages').html('');
                    },
                    error: function(err) {
                        console.log('error: ', err);
                    },
                });
            });
        });

        $(function() {
            $('#districts').on('change', function() {
                let districtId = $('#districts').val();

                // Send ID to Controller
                $.ajax({
                    type: 'POST',
                    url: "{{ route('getVillage') }}",
                    data: {districtId: districtId},
                    cache: false,
                    success: function(msg) {
                        $('#villages').html(msg);
                    },
                    error: function(err) {
                        console.log('error: ', err);
                    },
                });
            });
        });
    </script>
</body>
</html>