<form id="add_path" class="form_wrapper modal" action="/server/server/php>" POST="POST" enctype="multipart/form-data">
  <div class="inner">
    <a class="link_undo" onclick="hideModalWrapper()">
      <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path class="change" d="M12 1.21286L10.7871 0L6 4.78714L1.21286 0L0 1.21286L4.78714 6L0 10.7871L1.21286 12L6 7.21286L10.7871 12L12 10.7871L7.21286 6L12 1.21286Z" fill="#A5A5A5"/>
      </svg>
    </a>
    <h1 class="form_heading">Добавить путь</h1>
    <div class="inputs">
      <select id="pointer" class="select_input_style text_left nado" name="pointer">
        <option value="0" hidden>Пункт выдачи</option>
        <!-- Сюда через цикл вводишь все пункты -->
        <div>
          <option value="1">1</option>
          <option value="2">2</option>
        </div>
      </select>
      <select id="stock" class="select_input_style text_left nado" name="stock">
        <option value="0" hidden>Склад</option>
        <!-- Сюда через цикл вводишь все склады -->
        <div>
          <option value="1">1</option>
          <option value="2">2</option>
        </div>
      </select>
      <div class="hideBlock">
      <div class="line"></div>
      <div class="description_text">
        Склад (город) - Пункт выдачи (город)
      </div>

      <select id="paths" class="select_input_style text_left" name="paths">
        <option value="0" hidden>Маршрут</option>
        <!-- Сюда через цикл вводятся все маршруты, через JS и ответ с сервера, не тронь -->
        <div class="div_container"></div>
      </select>
      <button class="submit" type="submit">Добавить</button>
      <div class="line"></div>
      <div class="pick-up_point_contaner">
        <div class="pick-up_point">
          <!-- Сюда всё подгружается с JS, можно не париться -->
        </div>
      </div>

      </div>
    </div>
</form>