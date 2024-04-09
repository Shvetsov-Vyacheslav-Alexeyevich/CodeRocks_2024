"use strict"
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
            <input id="second_name" type="text" name="second_name" placeholder="Фамилия" required>
            <input id="first_name" type="text" name="first_name" placeholder="Имя" required>
          </div>
          <input id="third_name" type="text" name="third_name" placeholder="Отчество" required>
          <input id="email" type="text" name="email" placeholder="E-mail" required>
          <div class="double">
            <input id="password" type="password" name="password" placeholder="Пароль" required>
            <input id="next_password" type="password" name="next_password" placeholder="Повтор пароля" required>
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
          <input id="email" type="text" name="email" placeholder="E-mail" required>
          <div class="double">
            <input id="password" type="password" name="password" placeholder="Пароль" required>
            <input id="next_password" type="password" name="next_password" placeholder="Повтор пароля" required>
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
      formData.set("user_type", "maker")
    } else {
      formData.set("user_type", "buyer");
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

// Форма восстановления пароля
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