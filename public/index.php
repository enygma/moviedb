<?php
session_start();
require_once '../vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Search The Movie Database</title>
        <script src="/assets/js/jquery-1.9.1.min.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
        <script src="/assets/js/search.js"></script>
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css"/>
        <style>
        #actor-results thead td { font-weight: bold; }
        </style>
        <script>
        
        </script>
    </head>
    <body>
        <div class="container">
            <?php
            // see if we need the user to authorize the session
            $session = new \MovieDb\Session(
                new \Guzzle\Http\Client('http://api.themoviedb.org'),
                array('api_key' => $_ENV['API_KEY'])
            );

            if ($session->getToken() === null): ?>
                <div class="alert alert-error">
                    <b>Oops!</b> You need to say it's okay for us to use your account
                    for the API - <a href="/authenticate.php" target="_new">click here</a> 
                    to authorize.
                </div>
            <?php endif; ?>

            <h3>Search</h3>
            <p>Use the form below to search The Movie Database:</p>

            <form class="form-inline" id="search-form">
                <fieldset>
                    <label><b>Query:</b></label>
                    <input type="text" name="query" id="query">
                    <select name="type" id="search-type">
                        <option value="actor">Actor</option>
                    </select>
                    <button class="btn btn-primary" id="search-btn">Search</button>
                    <img src="/assets/img/loader.gif" style="display:none" id="loader-img"/>
                </fieldset>
            </form>
            <br/>
            <div id="msg"></div>
            <h3>Actor Search Results</h3>
            <p>
                Click on movie title for more information.
            </p>
            <table id="actor-results" class="table table-striped">
                <thead>
                    <tr>
                        <td>Movie Name</td>
                        <td>Role</td>
                        <td>Date Released</td>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

        <div id="myModal" class="modal hide fade" role="dialog">
            <div class="modal-header">
                <h3 id="modal-movie-title"></h3>
            </div>
            <div class="modal-body">
                <p id="modal-movie-desc"></p>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
        </div>
    </body>
</html>
