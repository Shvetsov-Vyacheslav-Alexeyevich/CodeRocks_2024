<form id="form_add_punct" class="form_wrapper modal" action="/server/server/php></form" POST="POST" enctype="multipart/form-data">
  <div class="inner">
    <a class="link_undo" onclick="hideModalWrapper()">
      <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path class="change" d="M12 1.21286L10.7871 0L6 4.78714L1.21286 0L0 1.21286L4.78714 6L0 10.7871L1.21286 12L6 7.21286L10.7871 12L12 10.7871L7.21286 6L12 1.21286Z" fill="#A5A5A5"/>
      </svg>
    </a>
    <h1 class="form_heading">Добавить пункт</h1>
    <div class="inputs">
      <input id="name_point" class="text_left" type="text" name="name_point" placeholder="Пункт выдачи" required>
      <select id="city" class="select_input_style text_left" name="city" required>
        <option value="0" hidden>Город</option>
        <option value="1">1</option>
      </select>
      <button class="submit" type="submit">Добавить</button>
      <div class="line"></div>
      <div class="rows">
      <!-- Тут ебашит JS, Get запросом пиздит данные, не трогать :) -->
        <div class="row" index="0" style="display: flex; align-items: center; justify-content: space-between; color: #333333">
            <div class="left">Название склада №1</div>
            <div class="right" style="display: flex; align-items: center; gap: 10px;">
              <div class="count_on_stocks">Хабаровск</div>
              <div class="remove" onclick="remove_stock(this)" style="width: 16px; height: 2px; background: #669EF2; cursor: pointer;"></div>
            </div>
        </div>
      </div>
    </div>
</form>