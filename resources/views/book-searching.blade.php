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
    <h2>Rizki disini</h2>
    <div class="search-box">
        <input type="text" id="search-input">
        <!-- Ganti type button dengan type submit -->
        <button type="submit" id="search-button">Cari</button>
    </div>
    <div id="h-searching"></div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            function getData(results) {
                $('#h-searching').empty();

                if (Array.isArray(results) && results.length > 0) {
                    for (var i = 0; i < results.length; i++) {
                        var namaMahasiswa = results[i].nama_mahasiswa;
                        var h2 = `<h2>${namaMahasiswa}</h2>`;
                        $('#h-searching').append(h2);
                    }
                } else {
                    $('#h-searching').html('<p>Data not found</p>');
                }
            }

            function getKeywoardFromUrl() {
                const urlParams = new URLSearchParams(window.location.search);
                const keyword = urlParams.get('keyword');
                if (keyword) {
                    $.ajax({
                        url: '/api/searching?keyword=' + encodeURIComponent(keyword),
                        type: 'GET',
                        success: function(response) {
                            console.log(response);
                            getData(response.data);
                        }
                    });
                    $('#search-input').val(keyword);
                } else {
                    $('#h-searching').html('<p>Data not found</p>');
                }
            }

            function handleSearch() {
                const keyword = $('#search-input').val();
                if (keyword === "") {
                    window.location.href = '/searching2';
                } else {
                    const newUrl = '/searching?keyword=' + encodeURIComponent(keyword);
                    window.history.pushState({
                        path: newUrl
                    }, '', newUrl);
                    $.ajax({
                        url: '/api/searching?keyword=' + encodeURIComponent(keyword),
                        type: 'GET',
                        success: function(response) {
                            console.log(response);
                            getData(response.data);
                        }
                    });
                }
            }

            getKeywoardFromUrl();

            $('#search-button').click(function() {
                handleSearch();
            });

            $('#search-input').keyup(function(event) {
                if (event.keyCode === 13) {
                    handleSearch();
                }
            });
        });
    </script>

</body>

</html>
