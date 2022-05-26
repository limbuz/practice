<html lang="ru">

<head>
  <title>Обратная связь</title>
  <style>
      <?php include 'style.css'; ?>
  </style>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php session_start(); if(isset($_SESSION['login']) && !empty($_SESSION['login']))
print('
  <div class="container" id="form1">
      <br>
      <div class="row">
          <form action="receive.php" method="post" class="col">
              <div class="form-group">
                  <label for="title"><h5>Заголовок:</h5></label>
                  <input type="text" name="title" class="form-control-plaintext col rounded" id="text" required>
              </div>
              <div class="form-group">
                  <label for="editor1"><h5>Отзыв:</h5></label>
                  <textarea class="form-control-plaintext col rounded" rows="5" name="editor1" id="text"></textarea>
              </div>
              <hr>
              <div class="form-group">
                  <h5>Столкнулись ли вы с проблемами?</h5>
                  <input type="radio" name="problem" value="yes" checked> Да<br>
                  <input type="radio" name="problem" value="no"> Нет
              </div>
              <hr>
              <div class="form-group">
                  <h5>Типичные проблемы:</h5>
                  <input type="checkbox" name="problems[]" value="1"> Class aptent taciti sociosqu ad<br>
                  <input type="checkbox" name="problems[]" value="2"> Orci varius natoque penatibus et magnis<br>
                  <input type="checkbox" name="problems[]" value="3"> Etiam tristique pharetra est a euismod. Duis quis ante mi. Pellentesque<br>
                  <input type="checkbox" name="problems[]" value="4"> Nulla nulla nibh<br>
              </div>
              <hr>
              <div class="form-group">
                  <h5>Выберите вариант:</h5>
                  <select name="select" size="1">
                      <option selected value="s1">Nulla nulla nibh</option>
                      <option value="s2">Vestibulum maximus purus vitae</option>
                      <option value="s3">Curabitur posuere convallis purus</option>
                      <option value="s4">Integer faucibus ex sed</option>
                  </select>
              </div>
              <div style="text-align: center">
                <button type="submit" class="button rounded">Отправить</button>
                <button type="reset" class="button rounded">Сброс</button>
              </div>
          </form>
      </div>
  </div>');
else {
  print('<h1 id="denied"> Access denied! </h1>');
  header("Location: index.php");
}
?>
</body>
