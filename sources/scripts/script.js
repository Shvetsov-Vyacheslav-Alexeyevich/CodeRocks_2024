"use strict"
let arr_card_html = [];
if (document.getElementById("products") != null) {
  document.querySelectorAll("#all_cards .card").forEach(element => {
    arr_card_html.push(element); 
  });
}

let card_click_id_main;
document.querySelectorAll("#all_cards .card").forEach(element => {
  // console.log(element);
  element.querySelector(".button_link").addEventListener("click", (event) => {
    card_click_id_main = element.getAttribute("card_id");
  });
});

// Функции
function showModalWrapper() {
  document.body.style.overflow = "hidden";
  document.querySelector(".modal_wrapper").style.display = "block";
}

function hideModalWrapper() {
  document.body.style.overflow = "auto";
  document.querySelector(".modal_wrapper").style.display = "none";
}

// Форма регистрации
if (document.getElementById("form_registration") != null) {
  // Флаг значения свича
  let flag_switch = false;
  // Проверяем событие - нажатие на свич
  document.querySelectorAll(".form_wrapper .switch_slider").forEach(element => {
    element.addEventListener("click", () => {
      if (flag_switch) {
        flag_switch = false;
        document.querySelectorAll(".form_wrapper .radio_zone .variant_1").forEach(element => {
          element.classList.add("active");
        });
        document.querySelectorAll(".form_wrapper .radio_zone .variant_2").forEach(element => {
          element.classList.remove("active");
        });

        document.querySelector("#form_registration.form_wrapper .inputs").innerHTML = (`      
          <div class="double">
            <input id="second_name" type="text" name="firstname" placeholder="Фамилия" required>
            <input id="first_name" type="text" name="name" placeholder="Имя" required>
          </div>
          <input id="third_name" type="text" name="surname" placeholder="Отчество" required>
          <input id="email" type="email" name="email" placeholder="E-mail" required>
          <div class="double">
            <input id="password" type="password" name="password" placeholder="Пароль" required>
            <input id="next_password" type="password" name="repeat_password" placeholder="Повтор пароля" required>
          </div>
        `);
      } else {
        flag_switch = true;
        document.querySelectorAll(".form_wrapper .radio_zone .variant_2").forEach(element => {
          element.classList.add("active");
        });
        document.querySelectorAll(".form_wrapper .radio_zone .variant_1").forEach(element => {
          element.classList.remove("active");
        });
        document.querySelector("#form_registration.form_wrapper .inputs").innerHTML = (`      
          <input id="company_name" type="text" name="company_name" placeholder="Название организации" required>
          <input id="email" type="email" name="email" placeholder="E-mail" required>
          <div class="double">
            <input id="password" type="password" name="password" placeholder="Пароль" required>
            <input id="next_password" type="password" name="repeat_password" placeholder="Повтор пароля" required>
          </div>
        `);
      }
    });
  });

  // Отправка данных на сервер
  document.getElementById("form_registration").addEventListener("submit", (event) => {
    event.preventDefault();
    let formData = new FormData(document.getElementById("form_registration"));
    if (flag_switch) {
      formData.set("is_vendor", "1")
    } else {
      formData.set("is_vendor", "0");
    }
    formData.set("form_type", "registration");

    // Запрос на отправку
    fetch("/server/server.php", {
      method: "POST",
      body: formData
    })
    .then((response) => response.json())
    .then((data) => succesfull_status(data));

    // Вывод сообщения об успехе
    function succesfull_status(data) {
      if (data["status"] == true) {
        document.querySelector("#form_registration .inner").innerHTML = (`
          <h1 class="form_heading">Успешно!</h1>
          <div class="line"></div>
          <p class="text">Вы успешно зарегистрировались :)</p>
          <a href="/pages/authorization.php?form=log" class="button_link">Войти</a>
        `);
      }
    }
  });
}

// Форма авторизации
if (document.getElementById("form_login") != null) {
  // Отправка данных на сервер
  document.getElementById("form_login").addEventListener("submit", (event) => {
    event.preventDefault();
    let formData = new FormData(document.getElementById("form_login"));
    formData.set("form_type", "login");

    // Запрос на отправку
     fetch("/server/server.php", {
      method: "POST",
      body: formData
    })
    .then((response) => response.json())
    .then((data) => succesfull_status(data));

    // Вывод сообщения об успехе
    function succesfull_status(data) {
      if (data["status"] == true) {
        document.querySelector("#form_login .inner").innerHTML = (`
          <h1 class="form_heading">Успешно!</h1>
          <div class="line"></div>
          <p class="text">Вы успешно авторизировались :)</p>
          <a href="/index.php" class="button_link">На главную</a>
        `);
      }
    }
  });
}

// Форма восстановления
if (document.getElementById("form_recovery") != null) {
  // Отправка данных на сервер
  document.getElementById("form_recovery").addEventListener("submit", (event) => {
    event.preventDefault();
    let formData = new FormData(document.getElementById("form_recovery"));
    formData.set("form_type", "recovery_get");
    // Запрос на отправку
    fetch("/server/server.php", {
      method: "POST",
      body: formData
    })
    .then((response) => response.json())
    .then((data) => succesfull_status(data));

    // Вывод сообщения об успехе
    function succesfull_status(data) {
      if (data["status"] == true) {
        document.querySelector("#form_recovery .inner").innerHTML = (`
          <h1 class="form_heading">Откройте письмо</h1>
          <div class="line"></div>
          <p class="text">Перейтите по ссылке в письме, чтобы продолжить.</p>
          <a class="button_link" href="#">Закрыть</a>
        `);
      }
    }
  });
}

// Форма фильтра
if (document.getElementById("filter_main") != null) {
  // Отправка данных на сервер
  document.getElementById("filter_main").addEventListener("submit", (event) => {
    event.preventDefault();
    let formData = new FormData(document.getElementById("filter_main"));
    formData.set("form_type", "filter_request");
    // Запрос на отправку
    fetch("/server/server.php", {
      method: "POST",
      body: formData
    })
    .then((response) => response.json())
    .then((data) => succesfull_status(data));

    // Вывод карточек из ответа сервера
    function succesfull_status(data) {
      console.log(data);
      if (data["status"] == true) {
        let response_server = data["response"]
        document.querySelector("#products .inner").innerHTML = ""
        for (let i of response_server ) {
          document.querySelector("#products .inner").innerHTML += arr_card_html[Number(i) - 1].outerHTML;
        }
      }
    }
  });
}

// Изменение пароля
if (document.getElementById("form_recovery_change") != null) {
  // Отправка данных на сервер
  document.getElementById("form_recovery_change").addEventListener("submit", (event) => {
    event.preventDefault();
    const params = new URLSearchParams(window.location.search);
    let formData = new FormData(document.getElementById("form_recovery_change"));
    formData.set("form_type", "recovery_change");
    formData.set("user_id", params.get("user_id"));
    formData.set("user_password", params.get("user_password"));
    // Запрос на отправку
    fetch("/server/server.php", {
      method: "POST",
      body: formData
    })
    .then((response) => response.json())
    .then((data) => succesfull_status(data));

    // Вывод сообщения об успехе
    function succesfull_status(data) {
      if (data["status"] == true) {
        document.querySelector("#form_recovery_change .inner").innerHTML = (`
          <h1 class="form_heading">Успешно!</h1>
          <div class="line"></div>
          <p class="text">Ваш пароль был успешно изменён.</p>
          <a class="button_link" href="/pages/authorization.php?form=log">Войти</a>
        `);
      }
    }
  });
}

// Заказ товара
let count_products = 0;
if (document.getElementById("product_order_form") != null) {
  // Отправка данных на сервер
  document.querySelectorAll("#product_order_form .inputs_product_order").forEach(element => {
    element.addEventListener("change", (event) => {
      if (document.getElementById("count_products").value >= 1 && document.getElementById("pick_point").value != 0 && document.getElementById("delivery_method").value != 0) {
        let formData = new FormData(document.getElementById("product_order_form"));
        formData.set("form_type", "check_paths");
        formData.set("card_id", card_click_id_main);
        // Запрос на отправку
        console.log("Пошло");
        fetch("/server/server.php", {
          method: "POST",
          body: formData
        })
        .then((response) => response.json())
        .then((data) => succesfull_status(data));
      }
    });
  });

    // Вставка данных в форму
    function succesfull_status(data) {
      if (data["status"] == true) {
        document.querySelector(".next_fetch").style.display = "block";
        document.querySelector("#product_order_form .submit").classList.remove("disable")
        for (let i = 0; i < data["response"]["path"].length; i++) {
          console.log(i);
          if (i == 0) {
            document.querySelector(".next_fetch .paths .inner").innerHTML = (`
              <div class="path">
                <div class="icon">
                  <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 0C1.79143 0 0 1.881 0 4.2C0 7.35 4 12 4 12C4 12 8 7.35 8 4.2C8 1.881 6.20857 0 4 0ZM4 5.7C3.21143 5.7 2.57143 5.028 2.57143 4.2C2.57143 3.372 3.21143 2.7 4 2.7C4.78857 2.7 5.42857 3.372 5.42857 4.2C5.42857 5.028 4.78857 5.7 4 5.7Z" fill="#A5A5A5"/>
                  </svg>
                </div>
                <div class="text">Склад, ${data["response"]["path"][i]}</div>
              </div>
              <div class="line"></div>
            `);
            console.log("first")
          } 
          else if (i == data["response"]["path"].length - 1) {
            document.querySelector(".next_fetch .paths .inner").innerHTML += (`
              <div class="path">
                <div class="icon">
                  <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 0C1.79143 0 0 1.881 0 4.2C0 7.35 4 12 4 12C4 12 8 7.35 8 4.2C8 1.881 6.20857 0 4 0ZM4 5.7C3.21143 5.7 2.57143 5.028 2.57143 4.2C2.57143 3.372 3.21143 2.7 4 2.7C4.78857 2.7 5.42857 3.372 5.42857 4.2C5.42857 5.028 4.78857 5.7 4 5.7Z" fill="#A5A5A5"/>
                  </svg>
                </div>
                <div class="text">Пункт выдачи, ${data["response"]["path"][i]}</div>
              </div>
            `);
          } 
          else {
            document.querySelector(".next_fetch .paths .inner").innerHTML += (`
              <div class="path">
                <div class="icon">
                  <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 0C1.79143 0 0 1.881 0 4.2C0 7.35 4 12 4 12C4 12 8 7.35 8 4.2C8 1.881 6.20857 0 4 0ZM4 5.7C3.21143 5.7 2.57143 5.028 2.57143 4.2C2.57143 3.372 3.21143 2.7 4 2.7C4.78857 2.7 5.42857 3.372 5.42857 4.2C5.42857 5.028 4.78857 5.7 4 5.7Z" fill="#A5A5A5"/>
                  </svg>
                </div>
                <div class="text">${data["response"]["path"][i]}</div>
              </div>
              <div class="line"></div>
            `);
          }
        } 
      }
    }
}


