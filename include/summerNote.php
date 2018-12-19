<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>
  </head>
  <body>
      <textarea id="summernote" name="text" value=<?php if(!empty($row['text'])){echo "$row[text]";}?>></textarea>
    <script>
      $('#summernote').summernote({
        placeholder: 'Straipsnio tekstas',
        tabsize: 2,
        height: 500
      });
      $(document).ready(function() {
        $(".dropdown-toggle").dropdown();
      });
    </script>
  </body>
</html>
