<form id="add_path" class="form_wrapper modal" action="/server/server/php>" POST="POST" enctype="multipart/form-data">
  <div class="inner">
    <a class="link_undo" onclick="hideModalWrapper()">
      <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path class="change" d="M12 1.21286L10.7871 0L6 4.78714L1.21286 0L0 1.21286L4.78714 6L0 10.7871L1.21286 12L6 7.21286L10.7871 12L12 10.7871L7.21286 6L12 1.21286Z" fill="#A5A5A5"/>
      </svg>
    </a>
    <h1 class="form_heading">Добавить путь</h1>
    <div class="inputs">
      <select id="pointer" class="select_input_style text_left nodo" name="pointer">
        <option value="0" hidden>Пункт выдачи</option>
        <!-- Сюда через цикл вводишь все пункты -->
        <option value="1">1</option>
      </select>
      <select id="stock" class="select_input_style text_left nado" name="stoke">
        <option value="0" hidden>Склад</option>
        <!-- Сюда через цикл вводишь все склады -->
        <option value="1">1</option>
      </select>
      <div class="line"></div>

      <div class="description_text">
        Склад (город) - Пункт выдачи (город)
      </div>

      <select id="paths" class="select_input_style text_left" name="paths">
        <option value="0" hidden>Маршрут</option>
        <!-- Сюда через цикл вводишь все маршруты -->
        <option value="1">1</option>
      </select>
      <button class="submit" type="submit">Добавить</button>
      <div class="line"></div>
      <div class="pick-up_point_contaner">
        <div class="pick-up_point">

          <div class="pick_point">
            <div class="double" style="color: var(--text_color);">
              <div class="left">
                Пункт выдачи №1
              </div>
              <div class="right">
                <div class="line"></div>
                Хабаровск
              </div>
            </div>
            <div class="double" style="">
              <div class="left">
                Город №1 - Город №2
              </div>
              <div class="right">
                240км., 6ч. 3000₽
              </div>
            </div>
          </div>

          <div class="pick_point">
            <div class="double" style="color: var(--text_color);">
              <div class="left">
                Пункт выдачи №1
              </div>
              <div class="right">
                <div class="line"></div>
                Хабаровск
              </div>
            </div>
            <div class="double" style="">
              <div class="left">
                Город №1 - Город №2
              </div>
              <div class="right">
                240км., 6ч. 3000₽
              </div>
            </div>
          </div>

          <div class="pick_point">
            <div class="double" style="color: var(--text_color);">
              <div class="left">
                Пункт выдачи №1
              </div>
              <div class="right">
                <div class="line"></div>
                Хабаровск
              </div>
            </div>
            <div class="double" style="">
              <div class="left">
                Город №1 - Город №2
              </div>
              <div class="right">
                240км., 6ч. 3000₽
              </div>
            </div>
          </div>

          <div class="pick_point">
            <div class="double" style="color: var(--text_color);">
              <div class="left">
                Пункт выдачи №1
              </div>
              <div class="right">
                <div class="line"></div>
                Хабаровск
              </div>
            </div>
            <div class="double" style="">
              <div class="left">
                Город №1 - Город №2
              </div>
              <div class="right">
                240км., 6ч. 3000₽
              </div>
            </div>
          </div>

          <div class="pick_point">
            <div class="double" style="color: var(--text_color);">
              <div class="left">
                Пункт выдачи №1
              </div>
              <div class="right">
                <div class="line"></div>
                Хабаровск
              </div>
            </div>
            <div class="double" style="">
              <div class="left">
                Город №1 - Город №2
              </div>
              <div class="right">
                240км., 6ч. 3000₽
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
</form>