"use strict"
// Функция get-запроса на сервер
async function get_request(url) {
  try {
      const response = await fetch(url);
      const data = await response.json();
      return data;
  }
  catch(error) {
      console.log(error);
  }
};

let arr_card_html = [];
if (document.getElementById("products") != null) {
  document.querySelectorAll("#all_cards .card").forEach(element => {
    arr_card_html.push(element); 
  });
}

// Ремонт фильтра вроде тут)
let card_click_id_main;
document.querySelectorAll("#all_cards .card").forEach(element => {
  element.querySelector(".button_link").addEventListener("click", (event) => {
    showModalWrapper()
    document.getElementById("product_order_form").style.display = "block";
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
  document.querySelectorAll(".modal").forEach(element => {
    element.style.display = "none";
  });
  document.querySelector(".modal_wrapper").style.display = "none";
  location.reload()
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
          <a class="button_link" href="/index.php">Закрыть</a>
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
        count_products = document.getElementById("count_products").value;
        formData.set("card_id", card_click_id_main);
        // Запрос на отправку
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
        console.log(data);
        document.querySelector(".next_fetch").style.display = "block";
        document.querySelector("#product_order_form .submit").classList.remove("disable")
        document.querySelector("#product_order_form .stock").innerHTML = data["response"]["stock"];
        document.querySelector("#product_order_form .delivery_cost").innerHTML = data["response"]["cost_delivery"];
        document.querySelector("#product_order_form .cost_product").innerHTML = data["response"]["cost_product"];
        document.querySelector("#product_order_form .count_products").innerHTML = count_products + " ₽";
        document.querySelector("#product_order_form .total").innerHTML = data["response"]["total"];
        
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

if (document.getElementById("product_order_form") != null) {
  // Отправка данных на сервер
  document.getElementById("product_order_form").addEventListener("submit", (event) => {
    event.preventDefault();
    if (document.getElementById("count_products").value >= 1 && document.getElementById("pick_point").value != 0 && document.getElementById("delivery_method").value != 0) {
      let formData = new FormData(document.getElementById("product_order_form"));
      formData.set("form_type", "new_order");
      formData.set("card_id", card_click_id_main);
      // Запрос на отправку
      fetch("/server/server.php", {
        method: "POST",
        body: formData
      })
      .then((response) => response.json())
      .then((data) => succesfull_status(data));
    } else {
      alert("Заполните данные полей!")
    }

    // Вывод сообщения об успехе
    function succesfull_status(data) {
      if (data["status"] == true) {
        hideModalWrapper();
        alert("Ваш заказ успешно сделан!")
        location.reload()
      }
    }
  });
}

var arr_stocks = {};
function remove_stock(el) {
  let index = ((el.parentNode).parentNode).getAttribute("index");
  delete arr_stocks[index];
  document.querySelector(".stocks").innerHTML = "";
  for(let i in arr_stocks) {
    document.querySelector(".stocks").innerHTML += (`
      <div class="row" index="${i}" style="display: flex; align-items: center; justify-content: space-between; color: #333333">
        <div class="left">${i}</div>
        <div class="right" style="display: flex; align-items: center; gap: 10px;">
          <div class="count_on_stocks">${arr_stocks[i]} шт.</div>
          <div class="remove" onclick="remove_stock(this)" style="width: 16px; height: 2px; background: #669EF2; cursor: pointer; margin-bottom: 6px;"></div>
        </div>
      </div>
    `);
  }
}

document.querySelectorAll(".add").forEach(element => {
  element.addEventListener("click", () => {
    const value_1 = document.querySelector("#stock_input").value;
    const value_2 = document.querySelector("#count_pr").value;
    arr_stocks[String(value_1)] = String(value_2);
    document.querySelector(".stocks").innerHTML = "";
    for(let i in arr_stocks) {
      document.querySelector(".stocks").innerHTML += (`
        <div class="row" index="${i}" style="display: flex; align-items: center; justify-content: space-between; color: #333333">
          <div class="left">${i}</div>
          <div class="right" style="display: flex; align-items: center; gap: 10px;">
            <div class="count_on_stocks">${arr_stocks[i]} шт.</div>
            <div class="remove" onclick="remove_stock(this)" style="width: 16px; height: 2px; background: #669EF2; cursor: pointer; margin-bottom: 6px;"></div>
          </div>
        </div>
      `);
    }
    document.querySelector("#stock_input").value = "0";
    document.querySelector("#count_pr").value = "";
  });
});

function open_add_product(clicked) {
  showModalWrapper();
  document.getElementById("form_add_product").style.display = "block";

}
if (document.getElementById("form_add_product") != null) {
  document.getElementById("form_add_product").addEventListener("submit", (event) => {
    event.preventDefault();
    let formData = new FormData(document.getElementById("form_add_product"));
    formData.set("form_type", "add_product");
    formData.set("stocks", JSON.stringify(arr_stocks));
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
        hideModalWrapper();
        alert("Вы успешно создали карточку!");
        console.log(data["response"]);
        location.reload()
      }
    }
  });
}

var click_elem;
function open_edit_product(clicked) {
  showModalWrapper();
  document.getElementById("form_edit_product").style.display = "block";
  click_elem = clicked;
}

arr_stocks = get_arr_stocks()
document.querySelectorAll("stocks .remove").forEach(element => {
  element.addEventListener("click", () => {
    console.log("Hello")
    let index = ((this.parentNode).parentNode).getAttribute("index");
    delete arr_stocks[index];
  });
  document.querySelector(".stocks").innerHTML = "";
  for(let i in arr_stocks) {
    document.querySelector(".stocks").innerHTML += (`
      <div class="row" index="${i}" style="display: flex; align-items: center; justify-content: space-between; color: #333333">
        <div class="left">${i}</div>
        <div class="right" style="display: flex; align-items: center; gap: 10px;">
          <div class="count_on_stocks"><span class="c">${arr_stocks[i]}</span> шт.</div>
          <div class="remove" style="width: 16px; height: 2px; background: #669EF2; cursor: pointer; margin-bottom: 6px;"></div>
        </div>
      </div>
    `);
  }
});

function get_arr_stocks() {
  let arr_stocks = {};
  document.querySelectorAll(".stocks .row").forEach(element => {
    arr_stocks[element.getAttribute("index")] = element.querySelector(".c").innerHTML; 
  });
  return arr_stocks;
}

if (document.getElementById("form_edit_product") != null) {
  document.getElementById("form_edit_product").addEventListener("submit", (event) => {
    event.preventDefault();
    let formData = new FormData(document.getElementById("form_edit_product"));
    formData.set("card_id", click_elem.getAttribute("card_id"));
    formData.set("form_type", "edit_product");
    formData.set("stocks", JSON.stringify(arr_stocks));
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
        hideModalWrapper();
        alert("Вы успешно изменили карточку!");
        location.reload()
      }
    }
  });
}

function open_add_stock(clicked) {
  showModalWrapper();
  document.getElementById("form_add_stock").style.display = "block";

}
if (document.getElementById("form_add_stock") != null) {
  document.getElementById("form_add_stock").addEventListener("submit", (event) => {
    event.preventDefault();
    let formData = new FormData(document.getElementById("form_add_stock"));
    formData.set("form_type", "add_product");
    formData.set("stocks", arr_stocks);
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
        hideModalWrapper();
        alert(data["response"]);
        console.log(data["response"]);
        location.reload()
      }
    }
  });
}

function open_add_pick_point(clicked) {
  showModalWrapper();
  document.getElementById("form_add_pick_point").style.display = "block";

}

if (document.getElementById("form_add_pick_point") != null) {
  document.getElementById("form_add_pick_point").addEventListener("submit", (event) => {
    event.preventDefault();
    let formData = new FormData(document.getElementById("form_add_pick_point"));
    formData.set("form_type", "add_product");
    formData.set("stocks", arr_stocks);
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
        hideModalWrapper();
        alert(data["response"]);
        console.log(data["response"]);
        // location.reload()
      }
    }
  });
}

// ADD PATH
function remove_path(element) {
  console.log("start");
  return (((element.parentNode).parentNode).parentNode).getAttribute("index");
}

// Открытие формы
function open_add_path(element) {
  showModalWrapper();
  document.getElementById("add_path").style.display = "block";
}

// Проверяем изменения первых полей и их отправка
if (document.getElementById("add_path") != null) {
  
  document.querySelectorAll("#add_path .nado").forEach(element => {
    element.addEventListener("change", () => {
      if (document.getElementById("pointer").value != 0 && document.getElementById("stock").value != 0) {
        // Отправляем данные при заполнении первой части
        document.querySelector("#add_path .hideBlock").style.display = "none";
        let formData = new FormData(document.getElementById("add_path"));
        formData.set("form_type", "get_paths");
        // Запрос на отправку
        fetch("/server/server.php", {
          method: "POST",
          body: formData
        })
        .then((response) => response.json())
        .then((data) => succesfull_status(data));
      }
  
      function succesfull_status(data) {
        if (data["status"] == true) {
          // Показываем другую часть формы
          document.querySelector("#add_path .hideBlock").style.display = "block";
          (async function() {
            //Запись на выбор всех возможных маршрутов
            console.log(data["response"])
            document.querySelector("#add_path #paths").innerHTML = "";
            for (let i in data["response"]) {
              document.querySelector("#add_path #paths").innerHTML += (`
                <option value="${i}">${data["response"][i]}</option>
              `)
            }

            // Запись всех маршрутов пользователя в html
            let response = await get_request("/server/please_me.php?add_path=give"); 
            let j = 0;
            document.querySelector("#add_path .pick-up_point").innerHTML = "";
            for (let i of response) {
              j++;
              document.querySelector("#add_path .pick-up_point").innerHTML += (`
                <div index="${j}" class="pick_point">
                  <div class="double" style="color: var(--text_color);">
                    <div class="left">
                      ${i[0]}
                    </div>
                    <div class="right">
                      <div class="line remove_path"></div>
                      ${i[2]}
                    </div>
                  </div>
                  <div class="double" style="">
                    <div class="left">
                      ${i[1]}
                    </div>
                    <div class="right">
                      ${i[3]}., ${i[4]}. ${i[5]}₽
                    </div>
                  </div>
                </div>
              `)
            }

            // Добавление путей


            // Удаление путей
            remove_path(document.querySelector(".remove_path"));
              // Проверяем событие - нажатие на кнопку удалить
            document.querySelectorAll(".remove_path").forEach(element => {
              element.addEventListener("click", () => {
                let formData = new FormData();
                formData.set("index", remove_path(element));
                formData.set("form_type", "remove_path");
                // Запрос на отправку
                fetch("/server/server.php", {
                  method: "POST",
                  body: formData
                })
                .then((response) => response.json())
                .then((data) => succesfull_status(data));

                function succesfull_status(data) {
                  console.log(data["test"])
                  if (data["status"] == true) {
                    fetch("/server/please_me.php?add_path=give2", {
                      method: "GET",
                    })
                    .then((response) => response.json())
                    .then((data) => succesfull_status(data));

                    function succesfull_status(data) {
                      console.log(data);
                      document.querySelector("#add_path .pick-up_point").innerHTML = "";
                      for (let i of data) {
                        j++;
                        document.querySelector("#add_path .pick-up_point").innerHTML += (`
                          <div index="${j}" class="pick_point">
                            <div class="double" style="color: var(--text_color);">
                              <div class="left">
                                ${i[0]}
                              </div>
                              <div class="right">
                                <div class="line remove_path"></div>
                                ${i[2]}
                              </div>
                            </div>
                            <div class="double" style="">
                              <div class="left">
                                ${i[1]}
                              </div>
                              <div class="right">
                                ${i[3]}., ${i[4]}. ${i[5]}₽
                              </div>
                            </div>
                          </div>
                        `)
                      }
                    }
                  }
                }
              });
            });
          })();
        }
      }
    });
  });
}

// Проверяем изменения всех полей и их отправка для добавления нового пути в БД
document.querySelector("#add_path .submit").addEventListener("click", (event) => {
  event.preventDefault();
  if (document.getElementById("pointer").value != 0 && document.getElementById("stock").value != 0 && document.getElementById("paths").value != 0) {
    // Отправляем данные при заполнении всей части для добавления нового элемента
    let formData = new FormData(document.getElementById("add_path"));
    formData.set("form_type", "add_paths");
    // Запрос на отправку
    fetch("/server/server.php", {
      method: "POST",
      body: formData
    })
    .then((response) => response.json())
    .then((data) => succesfull_status(data));
  }

  function succesfull_status(data) {
    if (data["status"] == true) {
      console.log("Новый элемент добавлен!")
      let formData = new FormData(document.getElementById("add_path"));
      formData.set("form_type", "add_paths");
      // Запрос на отправку
      fetch("/server/server.php", {
        method: "GET",
      })
      .then((response) => response.json())
      .then((data) => succesfull_status(data));
    }
  }
});


function open_del_product(clicked) {
  showModalWrapper();
  document.getElementById("form_del_product").style.display = "block";
}

if (document.getElementById("form_del_product") != null) {
  document.getElementById("form_del_product").addEventListener("submit", (event) => {
    event.preventDefault();
    let formData = new FormData(document.getElementById("form_del_product"));
    formData.set("form_type", "add_product");
    formData.set("stocks", arr_stocks);
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
        hideModalWrapper();
        alert(data["response"]);
        console.log(data["response"]);
        // location.reload()
      }
    }
  });
}

function open_add_punct(clicked) {
  showModalWrapper();
  document.getElementById("form_add_punct").style.display = "block";

}

if (document.getElementById("form_add_punct") != null) {
  document.getElementById("form_add_punct").addEventListener("submit", (event) => {
    event.preventDefault();
    let formData = new FormData(document.getElementById("form_add_punct"));
    formData.set("form_type", "add_product");
    formData.set("stocks", arr_stocks);
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
        hideModalWrapper();
        alert(data["response"]);
        console.log(data["response"]);
        // location.reload()
      }
    }
  });
}

function open_edit_name_company(clicked) {
  showModalWrapper();
  document.getElementById("form_edit_name_company").style.display = "block";

}

function open_edit_fio(clicked) {
  showModalWrapper();
  document.getElementById("form_edit_fio").style.display = "block";
}


