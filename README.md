Test API
========

Installation
------------

.. code-block:: bash

    git clone https://github.com/LBCgilles/API.git
    composer install

Documentation
-------------

You can find the documentation on the homepage of the project (assuming you setup your vhost)

cURL Request
------------

curl -H "Content-Type: application/json" -X POST -d '{"utilisateur":"1", "categorie":"2", "titre":"title", "contenu":"content", "prix":"123"}' http://yourdomain.dev/index.php/ad/