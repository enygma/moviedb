Proof of Concept: Movie DB Actor Search
================

This repository is a proof-of-concept for an Actor search on the [MovieDB](http://themoviedb.org) via
their REST API. It returns the results of the search and has clickable movie titles to provide
more information on each film.

### Setup

To set the application up in your environment, you'll need a VirtualHost like:

```
<VirtualHost *:8888>
    DocumentRoot /var/www/moviedb/public
    ServerName moviedb.localhost
    ErrorLog /var/www/moviedb-error_log
    SetEnv API_KEY "api-key-here"
</VirtualHost>
```

In place of `api-key-here` you'll need to put in your own API key from the MovieDB site. You'll obviously
need to change the paths to match the ones on your system as well.

If you don't already have an API key, you can get one by logging into your account, going to the "API"
link on the sidebar and creating one. Additonally, you can find full documenatation of their
API [here](http://www.themoviedb.org/documentation/api).
