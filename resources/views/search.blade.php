<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="search-box">
        <input type="text" id="search-input">
        <button type="button" id="search-button">Cari</button>
    </div>
    <div id="h-searching"></div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            function displayMahasiswaName(name) {
                $('#h-searching').empty();

                if (Array.isArray(name) && name.length > 0) {
                    for (var i = 0; i < name.length; i++) {
                        var namaMahasiswa = name[i];
                        var h2 = `<h2>${namaMahasiswa.nama_mahasiswa}</h2>`
                        $('#h-searching').append(h2);
                    }
                } else {
                    $('#h-searching').html('<p>Data not found</p>');
                }
            }


            function loadAllNamaMahasiswa() {
                $.ajax({
                    type: "get",
                    url: "api/getall",
                    dataType: "json",
                    success: function(data) {
                        displayMahasiswaName(data.data);
                    }
                });


            }

            loadAllNamaMahasiswa();

            $('#search-button').click(function() {
                let keyword = $('#search-input').val();
                if (keyword === "") {
                    loadAllNamaMahasiswa();
                } else {
                    let redirectUrl = '/book?keyword=' + encodeURIComponent(keyword);
                    window.location.href = redirectUrl;
                }
            });

        });
    </script>
</body>

</html>
