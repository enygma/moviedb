$(document).ready(function(){

    /**
     * Make the call to get the movie data by ID
     * @param  {integer} movieId Unique movie ID (from API)
     */
    function getMovieById(movieId)
    {
        // pop up the modal and load it with movie goodness
        $.ajax({
            url: '/query.php',
            data: {type:'movie', query:movieId},
            dataType: 'json',
            success: function(data) {
                $('#modal-movie-title').html(data.title);
                $('#modal-movie-desc').html(
                    data.tagline+'<br/>'+data.overview+'<br/>'+data.release_date
                );
            }
        });
    }

    /**
     * When "Search" is pressed, run the request
     */
    $('#search-btn').click(function(e) {
        $('#loader-img').toggle();
        e.preventDefault();
        $.ajax({
            url: '/query.php',
            data: $('#search-form').serialize(),
            dataType: 'json',
            success: function(data) {
                $('#msg').html('');
                $('#actor-results tbody').html('');

                if (data.length == 0) {
                    // No data found - let the user know
                    var row = '<tr><td colspan="3">No Results Found</td></tr>';
                    $('#actor-results tbody').append(row);
                    $('#loader-img').toggle();
                    return true;
                }

                // see if the first object is a movie or actor
                if (typeof data[0].title == 'undefined') {
                    var errorMsg = '<div class="alert alert-error">Too many results for '
                        +'that actor name ('+data.length+'). Please refine your search!';
                    $('#msg').append(errorMsg);
                    $('#loader-img').toggle();
                    return true;
                }

                $.each(data, function(k, v) {
                    var release_date = (v.release_date == null) ? 'N/A' : v.release_date;
                    var row = '<tr>';
                    row += '<td><a href="#myModal" id="'+v.id+'" data-toggle="modal"'
                        +' class="movie-title">'+v.title+'</td>';
                    row += '<td>'+v.character+'</td>';
                    row += '<td>'+release_date+'</td>';
                    row += '</tr>';
                    $('#actor-results tbody').append(row);
                });

                // Assign click events to the links
                $('.movie-title').click(function(e) {
                    var movieId = $(this).attr('id');
                    getMovieById(movieId);
                });
                $('#loader-img').toggle();
            }
        });
    });

    $('#clear-btn').click(function(e) {
        e.preventDefault();
        $('#query').val('');
        $('#actor-results tbody').html('');
    });
});