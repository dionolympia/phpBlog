<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Header</title>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <style media="screen">

      body {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
      }
      main {
        flex: 1 0 auto;
        margin-top:10px;
      }
      .beige-color{
        background: #E3D1B3 !important;
      }
      .beige-text{
        color: #E3D1B3 !important;
      }
      form{
        max-width: 500px;
        text-align: center;
        margin: 25px auto;
        padding: 25px;
      }
      label{
        font-weight: bold !important;
      }


    </style>
  </head>
  <body>
    <nav class="z-depth-0">
      <div class="nav-wrapper white">
        <a href="#" class="brand-logo beige-text center">Templating a Header & Footer</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a href="#" class="btn beige-color">ADD POST</a></li>
        </ul>
      </div>
    </nav>
  </body>
</html>
