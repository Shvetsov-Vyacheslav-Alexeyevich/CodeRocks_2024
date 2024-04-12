<?
  $server_path = $_SERVER['DOCUMENT_ROOT'];
  require_once("$server_path/server/db_model.php");

  $db = new MysqlModel();
  $products = $db->goResult("
    SELECT
      *
    FROM
      PRODUCTS
  ");

  $product_photos = $db->goResult("
    SELECT
      *
    FROM
      PRODUCT_PHOTOS
  ");

  $product_rates = $db->goResult("
    SELECT
      product_id,
      rate
    FROM
      REVIEWS
  ");

  for ($i = 0; $i < count($products); $i++)
  {
    $avg_rate = 0;
    $review_count = 0;

    for ($j = 0; $j < count($product_photos); $j++)
    {
      if ($product_photos[$j]['product_id'] == $products[$i]['id'])
      {
        $products[$i]['photos'][] = $product_photos[$j]['photo_path'];
      }
    }

    for ($j = 0; $j < count($product_rates); $j++)
    {
      if ($product_rates[$j]['product_id'] == $products[$i]['id'])
      {
        $avg_rate += $product_rates[$j]['rate'];
        $review_count++;
      }
    }

    if ($review_count > 0)
      $avg_rate /= $review_count;

      $products[$i]['rate'] = $avg_rate;
  }
?>
<section id="products">
  <form id="filter_main" action="/server/server.php" method="POST">
    <div class="left">
      <select id="category_input" name="category">
        <option value="0" hidden>Категория</option>
        <option value="1">2</option>
        <option value="2">3</option>
      </select>
      <select id="rating_input" name="rating">
        <option value="0">По рейтингу</option>
        <option value="1">По возрастанию цены</option>
        <option value="2">По убыванию цены</option>
        <option value="3">Больше отзывов</option>
      </select>
      <div>
        <input id="start_cost" type="number" min="0" placeholder="От ₽" name="start_cost">
        <div class="line"></div>
        <input id="back_cost" type="number" min="0" placeholder="До ₽" name="back_cost">
      </div>
    </div>
    <div class="right">
      <button class="submit" type="submit">Сортировать</button>
    </div>
  </form>

  <div id="all_cards">
    <div class="inner">
      <? foreach ($products as $product): ?>
        <? if ($product['is_hidden'] == 1) continue ?>
        <!-- Карточка -->
        <div class="card" card_id="<?= $product['id'] ?>">
          <a class="block" href="#">
            <div class="image" style="background: url(<?= (array_key_exists("photos", $product)) ? "/data/products/{$product['id']}/{$product['photos'][0]}" : "/sources/images/photo.png" ?>) no-repeat center;"></div>
            <p class="description">
              <?= $product['name'] ?>
            </p>
          </a>
          <div class="double">
            <div class="price">
              <div class="icon">
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0.4425 7.185L7.18875 0.43875C7.45875 0.16875 7.83375 0 8.25 0H13.5C14.3288 0 15 0.67125 15 1.5V6.75C15 7.16625 14.8313 7.54125 14.5575 7.81125L7.8075 14.5613C7.5375 14.8313 7.1625 15 6.75 15C6.33375 15 5.95875 14.8313 5.68875 14.5613L0.438749 9.31125C0.168749 9.0375 0 8.6625 0 8.25C0 7.83375 0.16875 7.45875 0.4425 7.185ZM12.375 3.75C12.9975 3.75 13.5 3.2475 13.5 2.625C13.5 2.0025 12.9975 1.5 12.375 1.5C11.7525 1.5 11.25 2.0025 11.25 2.625C11.25 3.2475 11.7525 3.75 12.375 3.75ZM3.5475 9.9525L6.75 13.155L9.9525 9.9525C10.29 9.61125 10.5 9.1425 10.5 8.625C10.5 7.59 9.66 6.75 8.625 6.75C8.1075 6.75 7.635 6.96 7.2975 7.30125L6.75 7.84875L6.2025 7.30125C5.86125 6.96 5.3925 6.75 4.875 6.75C3.84 6.75 3 7.59 3 8.625C3 9.1425 3.21 9.61125 3.5475 9.9525Z" fill="#669EF2"/>
                </svg>
              </div>
              <div class="text" onclick="open_add_product(this)"><?= round($product['price']) ?> ₽</div>
            </div>
            <div class="rating">
              <div><?= (float) $product['rate'] ?></div>
              <div class="icon">
                <? for ($i = 0; $i < 5; $i++): ?>
                  <? if ($i < round($product['rate'])):?>
                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M6.40098 11.3656C6.71825 11.1747 7.11508 11.1747 7.43235 11.3656L9.7804 12.7789C10.538 13.2349 11.4712 12.5554 11.2698 11.6943L10.6486 9.03904C10.5639 8.6769 10.6872 8.29766 10.9686 8.05453L13.0358 6.26869C13.7058 5.6899 13.3486 4.59017 12.4664 4.51553L9.74161 4.285C9.3723 4.25376 9.05055 4.02081 8.90558 3.67971L7.83699 1.16544C7.49197 0.353631 6.34136 0.353631 5.99634 1.16544L4.92775 3.67971C4.78278 4.02081 4.46104 4.25376 4.09173 4.285L1.36698 4.51553C0.48477 4.59017 0.127576 5.6899 0.797552 6.2687L2.86473 8.05453C3.14616 8.29766 3.26942 8.6769 3.1847 9.03904L2.56354 11.6943C2.36211 12.5554 3.29531 13.2349 4.05293 12.7789L6.40098 11.3656Z" fill="#669EF2"/>
                    </svg>
                  <? else: ?>
                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M6.40098 11.3656C6.71825 11.1747 7.11508 11.1747 7.43235 11.3656L9.7804 12.7789C10.538 13.2349 11.4712 12.5554 11.2698 11.6943L10.6486 9.03904C10.5639 8.6769 10.6872 8.29766 10.9686 8.05453L13.0358 6.26869C13.7058 5.6899 13.3486 4.59017 12.4664 4.51553L9.74161 4.285C9.3723 4.25376 9.05055 4.02081 8.90558 3.67971L7.83699 1.16544C7.49197 0.353631 6.34136 0.353631 5.99634 1.16544L4.92775 3.67971C4.78278 4.02081 4.46104 4.25376 4.09173 4.285L1.36698 4.51553C0.48477 4.59017 0.127576 5.6899 0.797552 6.2687L2.86473 8.05453C3.14616 8.29766 3.26942 8.6769 3.1847 9.03904L2.56354 11.6943C2.36211 12.5554 3.29531 13.2349 4.05293 12.7789L6.40098 11.3656Z" fill="#A5A5A5"/>
                    </svg>
                  <? endif ?>
                <? endfor ?>
              </div>
            </div>
          </div>
          <a class="button_link">
            <div class="icon">
              <svg width="11" height="13" viewBox="0 0 11 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.77778 3.09524H8.55556C8.55556 1.38667 7.18667 0 5.5 0C3.81333 0 2.44444 1.38667 2.44444 3.09524H1.22222C0.546944 3.09524 0.00611111 3.64929 0.00611111 4.33333L0 11.7619C0 12.446 0.546944 13 1.22222 13H9.77778C10.4531 13 11 12.446 11 11.7619V4.33333C11 3.64929 10.4531 3.09524 9.77778 3.09524ZM5.5 1.2381C6.51139 1.2381 7.33333 2.07071 7.33333 3.09524H3.66667C3.66667 2.07071 4.48861 1.2381 5.5 1.2381ZM5.5 7.42857C3.81333 7.42857 2.44444 6.0419 2.44444 4.33333H3.66667C3.66667 5.35786 4.48861 6.19048 5.5 6.19048C6.51139 6.19048 7.33333 5.35786 7.33333 4.33333H8.55556C8.55556 6.0419 7.18667 7.42857 5.5 7.42857Z" fill="white"/>
              </svg>
            </div>
            <div>Заказать</div>
          </a>
        </div>
      <? endforeach ?>
    </div>
  </div>
</section>

<!-- Форма заказа товара -->
<form id="product_order_form" class="form_wrapper modal" action="/server/server.php">
  <div class="inner">
    <a class="link_undo" onclick="hideModalWrapper()">
      <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path class="change" d="M12 1.21286L10.7871 0L6 4.78714L1.21286 0L0 1.21286L4.78714 6L0 10.7871L1.21286 12L6 7.21286L10.7871 12L12 10.7871L7.21286 6L12 1.21286Z" fill="#A5A5A5"/>
      </svg>
    </a>
    <h1 class="form_heading">Оформить заказ</h1>
    <div class="inputs">
      <input id="count_products" class="inputs_product_order" type="number" min="1" name="count_products" placeholder="Количество товара" required>
      <select id="pick_point" class="inputs_product_order" name="pick_point">
        <option value="0" hidden>Выбрать пункт выдачи</option>
        <option value="1">1</option>
        <option value="2">2</option>
      </select>
      <select id="delivery_method" class="inputs_product_order" name="delivery_method">
        <option value="0" hidden>Способ доставки</option>
        <option value="1">Самый быстрый</option>
        <option value="2">Самый дешёвый</option>
      </select>
    </div>
    <div class="next_fetch">
      <div class="icons">
        <div>
          <svg width="27" height="25" viewBox="0 0 27 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M13.5 5.55556V0H0V25H27V5.55556H13.5ZM5.4 22.2222H2.7V19.4444H5.4V22.2222ZM5.4 16.6667H2.7V13.8889H5.4V16.6667ZM5.4 11.1111H2.7V8.33333H5.4V11.1111ZM5.4 5.55556H2.7V2.77778H5.4V5.55556ZM10.8 22.2222H8.1V19.4444H10.8V22.2222ZM10.8 16.6667H8.1V13.8889H10.8V16.6667ZM10.8 11.1111H8.1V8.33333H10.8V11.1111ZM10.8 5.55556H8.1V2.77778H10.8V5.55556ZM24.3 22.2222H13.5V19.4444H16.2V16.6667H13.5V13.8889H16.2V11.1111H13.5V8.33333H24.3V22.2222ZM21.6 11.1111H18.9V13.8889H21.6V11.1111ZM21.6 16.6667H18.9V19.4444H21.6V16.6667Z" fill="#F36767"/>
          </svg>
        </div>
        <div>
          <svg width="27" height="19" viewBox="0 0 27 19" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M23.3182 4.75H19.6364V0H2.45455C1.09841 0 0 1.06281 0 2.375V15.4375H2.45455C2.45455 17.4028 4.10523 19 6.13636 19C8.1675 19 9.81818 17.4028 9.81818 15.4375H17.1818C17.1818 17.4028 18.8325 19 20.8636 19C22.8948 19 24.5455 17.4028 24.5455 15.4375H27V9.5L23.3182 4.75ZM6.13636 17.2188C5.11773 17.2188 4.29545 16.4231 4.29545 15.4375C4.29545 14.4519 5.11773 13.6562 6.13636 13.6562C7.155 13.6562 7.97727 14.4519 7.97727 15.4375C7.97727 16.4231 7.155 17.2188 6.13636 17.2188ZM22.7045 6.53125L25.1161 9.5H19.6364V6.53125H22.7045ZM20.8636 17.2188C19.845 17.2188 19.0227 16.4231 19.0227 15.4375C19.0227 14.4519 19.845 13.6562 20.8636 13.6562C21.8823 13.6562 22.7045 14.4519 22.7045 15.4375C22.7045 16.4231 21.8823 17.2188 20.8636 17.2188Z" fill="#F36767"/>
          </svg>
        </div>
        <div>
          <svg width="27" height="24" viewBox="0 0 27 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M25.5 0H1.5V3H25.5V0ZM27 15V12L25.5 4.5H1.5L0 12V15H1.5V24H16.5V15H22.5V24H25.5V15H27ZM13.5 21H4.5V15H13.5V21Z" fill="#F36767"/>
          </svg>
        </div>
      </div>
      <div class="line"></div>
      <div class="text stock"></div>
      <div class="paths">
        <div class="inner">
        </div>
      </div>
      <div class="line"></div>
      <div class="result">
        <div class="double">
          <div class="left">Стоимость доставки:</div>
          <div class="right">
            <div class="icon">
              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.6461 1.73056L12.5689 0.423889C12.3511 0.167222 12.0283 0 11.6667 0H2.33333C1.97167 0 1.64889 0.167222 1.435 0.423889L0.357778 1.73056C0.132222 2.00278 0 2.345 0 2.72222V12.4444C0 13.3039 0.696111 14 1.55556 14H12.4444C13.3039 14 14 13.3039 14 12.4444V2.72222C14 2.345 13.8678 2.00278 13.6461 1.73056ZM7 11.2778L2.72222 7H5.44444V5.44444H8.55556V7H11.2778L7 11.2778ZM1.65278 1.55556L2.28667 0.777778H11.62L12.3472 1.55556H1.65278Z" fill="#669EF2"/>
              </svg>
            </div>
            <div class="price delivery_cost"></div>
          </div>
        </div>
        <div class="double">
          <div class="left">Стоимость товара (шт):</div>
          <div class="right">
            <div class="icon">
              <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.4425 7.185L7.18875 0.43875C7.45875 0.16875 7.83375 0 8.25 0H13.5C14.3288 0 15 0.67125 15 1.5V6.75C15 7.16625 14.8313 7.54125 14.5575 7.81125L7.8075 14.5613C7.5375 14.8313 7.1625 15 6.75 15C6.33375 15 5.95875 14.8313 5.68875 14.5613L0.438749 9.31125C0.168749 9.0375 0 8.6625 0 8.25C0 7.83375 0.16875 7.45875 0.4425 7.185ZM12.375 3.75C12.9975 3.75 13.5 3.2475 13.5 2.625C13.5 2.0025 12.9975 1.5 12.375 1.5C11.7525 1.5 11.25 2.0025 11.25 2.625C11.25 3.2475 11.7525 3.75 12.375 3.75ZM3.5475 9.9525L6.75 13.155L9.9525 9.9525C10.29 9.61125 10.5 9.1425 10.5 8.625C10.5 7.59 9.66 6.75 8.625 6.75C8.1075 6.75 7.635 6.96 7.2975 7.30125L6.75 7.84875L6.2025 7.30125C5.86125 6.96 5.3925 6.75 4.875 6.75C3.84 6.75 3 7.59 3 8.625C3 9.1425 3.21 9.61125 3.5475 9.9525Z" fill="#669EF2"/>
              </svg>
            </div>
            <div class="price cost_product"></div>
          </div>
        </div>
        <div class="double">
          <div class="left">Количество товара:</div>
          <div class="right count_products"></div>
        </div>
        <div class="line"></div>
        <div class="double">
          <div class="left">Итоговая стоимость:</div>
          <div class="right">
            <div class="icon">
              <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.3095 11.25H2.2619V9.75H11.3095V11.25ZM11.3095 8.25H2.2619V6.75H11.3095V8.25ZM11.3095 5.25H2.2619V3.75H11.3095V5.25ZM0 15L1.13095 13.875L2.2619 15L3.39286 13.875L4.52381 15L5.65476 13.875L6.78571 15L7.91667 13.875L9.04762 15L10.1786 13.875L11.3095 15L12.4405 13.875L13.5714 15V0L12.4405 1.125L11.3095 0L10.1786 1.125L9.04762 0L7.91667 1.125L6.78571 0L5.65476 1.125L4.52381 0L3.39286 1.125L2.2619 0L1.13095 1.125L0 0V15Z" fill="#669EF2"/>
              </svg>
            </div>
            <div class="price total"></div>
          </div>
        </div>
        <div class="line"></div>
      </div>
    </div>
    <button class="submit disable" type="submit">Сделать заказ</button>
  </div>
</form>