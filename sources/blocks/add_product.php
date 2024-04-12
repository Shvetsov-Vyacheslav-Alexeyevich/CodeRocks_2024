<form id="form_add_product" class="form_wrapper modal" action="/server/server/php></form" POST="POST" enctype="multipart/form-data">
  <div class="inner">
    <a class="link_undo" onclick="hideModalWrapper()">
      <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path class="change" d="M12 1.21286L10.7871 0L6 4.78714L1.21286 0L0 1.21286L4.78714 6L0 10.7871L1.21286 12L6 7.21286L10.7871 12L12 10.7871L7.21286 6L12 1.21286Z" fill="#A5A5A5"/>
      </svg>
    </a>
    <h1 class="form_heading">Создать товар</h1>
    <div class="line"></div>
    <input id="file" class="file_inputs" type="file" accept="image/png, image/jpeg" name="picture[]" multiple>
    <label for="file" class="style_file">
      <div .icon>
        <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M2.34783 2.28571V0H3.91304V2.28571H6.26087V3.80952H3.91304V6.09524H2.34783V3.80952H0V2.28571H2.34783ZM4.69565 6.85714V4.57143H7.04348V2.28571H12.5217L13.9539 3.80952H16.4348C17.2957 3.80952 18 4.49524 18 5.33333V14.4762C18 15.3143 17.2957 16 16.4348 16H3.91304C3.05217 16 2.34783 15.3143 2.34783 14.4762V6.85714H4.69565ZM10.1739 13.7143C12.3339 13.7143 14.087 12.0076 14.087 9.90476C14.087 7.8019 12.3339 6.09524 10.1739 6.09524C8.01391 6.09524 6.26087 7.8019 6.26087 9.90476C6.26087 12.0076 8.01391 13.7143 10.1739 13.7143ZM7.66957 9.90476C7.66957 11.2533 8.7887 12.3429 10.1739 12.3429C11.5591 12.3429 12.6783 11.2533 12.6783 9.90476C12.6783 8.55619 11.5591 7.46667 10.1739 7.46667C8.7887 7.46667 7.66957 8.55619 7.66957 9.90476Z" fill="#F36767"/>
        </svg>
      </div>
      <div>Добавить фото</div>
    </label>
    <div class="line"></div>
    <div class="inputs">
      <input id="product_name" class="text_left" type="text" maxlength="100" name="product_name" placeholder="Название" required>
      <div class="double">
        <input id="price" class="text_left" type="number" min="1"  max="99999" name="product_price" placeholder="Стоимость" required>
        <input id="weight" class="text_left" type="number" min="1" max="1000" step="0.01" name="product_weight" placeholder="Масса (кг)" required>
      </div>
      <div class="trible">
        <input id="width" class="text_left" type="number" min="1" name="product_length" placeholder="Ширина" required>
        <input id="lenght" class="text_left" type="number" min="1" name="product_width" placeholder="Длина" required>
        <input id="height" class="text_left" type="number" min="1" name="product_height" placeholder="Высота" required>
      </div>

      <select id="category_input" class="select_input_style text_left" name="product_category" required>
        <option value="0" hidden>Категория</option>
        <?
          $categories = [];
          $db = new MysqlModel;

          $categories = $db->goResult("SELECT * FROM PRODUCT_CATEGORIES");

          foreach ($categories as $category):
        ?>
          <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
        <? endforeach ?>
      </select>

      <textarea id="description" class="textarea" name="product_description" maxlength="1024" placeholder="Описание" required></textarea>
      <button class="submit" type="submit">Создать</button>
      <div class="line"></div>
      <div class="radio_zone">
        <div class="variant_1 active">Открыть доступ</div>
        <label class="switch">
          <input id="visible" class="switch_input" type="checkbox" name="open_access">
          <span class="switch_slider"></span>
        </label>
        <div class="variant_2">Скрыть доступ</div>
      </div>
      
      <div class="append_stock_save">
        <div class="double" style="margin: 14px 0px 0px;">

          <select id="stock_input" class="select_input_style text_left" style="width: 208px;" name="storage_warehouse">
            <option value="0" hidden>Склад</option>
            <?
              $warehouses = [];
              $db = new MysqlModel;

              $warehouses = $db->goResult("SELECT * FROM STORES");
                    
              foreach ($warehouses as $stock):
            ?>
              <option value="<?= $stock['id'] ?>"><?= $stock['name'] ?></option>
            <? endforeach ?>
          </select>
          <input id="count_pr" class="text_left" type="number" min="1" name="product_quantity" placeholder="Колличество" style="width: 130px;">

        </div>
        <a class="button_link add">Добавить</a>
        <div class="line"></div>
        <div class="stocks">
        </div>
      </div>
    </div>
</form>