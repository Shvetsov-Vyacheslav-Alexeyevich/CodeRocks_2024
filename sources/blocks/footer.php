        </div>
      </div>
    </main>
    <footer id="footer">
      <div class="container">
        <div class="inner">
          <?php
            if (!(basename($_SERVER['PHP_SELF']) == "authorization.php" or basename($_SERVER['PHP_SELF']) == "recovery.php")) {
          ?>
          <!-- Футер -->
          <div class="wrapper">
            <div class="left">
              <h3 class="contacts_heading">Для связи с нами:</h3>
              <ul class="list">
                <li>
                  <div class="icon">
                    <svg width="12" height="10" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M10.8 0H1.2C0.537 0 0.00599999 0.559375 0.00599999 1.25L0 8.75C0 9.44063 0.537 10 1.2 10H10.8C11.463 10 12 9.44063 12 8.75V1.25C12 0.559375 11.463 0 10.8 0ZM10.8 2.5L6 5.625L1.2 2.5V1.25L6 4.375L10.8 1.25V2.5Z" fill="#333333"/>
                    </svg>
                  </div>
                  <div>BlitzCompany@gmail.com</div>
                </li>
                <li>
                  <div class="icon">
                    <svg width="10" height="14" viewBox="0 0 10 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M5 0C2.23929 0 0 2.1945 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 2.1945 7.76071 0 5 0ZM5 6.65C4.01429 6.65 3.21429 5.866 3.21429 4.9C3.21429 3.934 4.01429 3.15 5 3.15C5.98571 3.15 6.78571 3.934 6.78571 4.9C6.78571 5.866 5.98571 6.65 5 6.65Z" fill="#333333"/>
                    </svg>
                  </div>
                  <div>г. Кемерово., ул. Павленко., 1а</div>
                </li>
              </ul>
            </div>
            <div class="right">
              <ul class="list socials">
                <li class="item">
                  <a class="block" href="#">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M21.3415 3.64583C18.9895 1.30208 15.8537 0 12.5436 0C5.66202 0 0.0871067 5.55555 0.0871067 12.4132C0.0871067 14.5833 0.696864 16.7535 1.74216 18.5764L0 25L6.62021 23.2639C8.44948 24.2188 10.453 24.7396 12.5436 24.7396C19.4251 24.7396 25 19.184 25 12.3264C24.9129 9.11458 23.6934 5.98958 21.3415 3.64583ZM18.554 16.8403C18.2927 17.5347 17.0732 18.2292 16.4634 18.316C15.9408 18.4028 15.2439 18.4028 14.547 18.2292C14.1115 18.0556 13.5017 17.8819 12.8049 17.5347C9.66899 16.2326 7.66551 13.1076 7.49129 12.8472C7.31707 12.6736 6.18467 11.1979 6.18467 9.63542C6.18467 8.07292 6.96864 7.37847 7.22996 7.03125C7.49129 6.68403 7.83972 6.68403 8.10104 6.68403C8.27526 6.68403 8.53658 6.68403 8.7108 6.68403C8.88501 6.68403 9.14634 6.59722 9.40766 7.20486C9.66899 7.8125 10.2787 9.375 10.3659 9.46181C10.453 9.63542 10.453 9.80903 10.3659 9.98264C10.2787 10.1562 10.1916 10.3299 10.0174 10.5035C9.8432 10.6771 9.66899 10.9375 9.58188 11.0243C9.40766 11.1979 9.23345 11.3715 9.40766 11.6319C9.58188 11.9792 10.1916 12.934 11.1498 13.8021C12.3693 14.8437 13.3275 15.191 13.676 15.3646C14.0244 15.5382 14.1986 15.4514 14.3728 15.2778C14.547 15.1042 15.1568 14.4097 15.331 14.0625C15.5052 13.7153 15.7665 13.8021 16.0279 13.8889C16.2892 13.9757 17.8571 14.7569 18.1185 14.9306C18.4669 15.1042 18.6411 15.191 18.7282 15.2778C18.8153 15.5382 18.8153 16.1458 18.554 16.8403Z" fill="#669EF2"/>
                    </svg>
                  </a>
                </li>
                <li class="item">
                  <a class="block" href="#">
                    <svg width="31" height="25" viewBox="0 0 31 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M27.3484 3.94197C28.6769 3.15347 29.6709 1.91189 30.1449 0.449048C28.8966 1.18442 27.5307 1.70244 26.1065 1.9807C24.1319 -0.0930951 21.0033 -0.597762 18.469 0.748692C15.9346 2.09515 14.6219 4.95938 15.2644 7.74094C10.151 7.48606 5.38694 5.08801 2.15776 1.14351C0.472513 4.0294 1.33371 7.71855 4.12582 9.57421C3.11617 9.54198 2.1289 9.27058 1.24634 8.78263C1.24634 8.80912 1.24634 8.8356 1.24634 8.86209C1.24693 11.8682 3.38094 14.4577 6.34879 15.0534C5.41228 15.3064 4.42994 15.3436 3.47672 15.1623C4.31137 17.7331 6.69787 19.4943 9.41797 19.5468C7.16511 21.3023 4.38291 22.2543 1.51903 22.2497C1.01141 22.2504 0.504184 22.2214 0 22.1629C2.90822 24.0182 6.29302 25.003 9.74993 24.9996C14.5593 25.0324 19.1813 23.15 22.582 19.7735C25.9827 16.3969 27.8783 11.808 27.8449 7.03323C27.8449 6.75956 27.8384 6.48737 27.8256 6.21664C29.0711 5.32296 30.1461 4.21586 31 2.94736C29.8396 3.458 28.6088 3.79326 27.3484 3.94197Z" fill="#669EF2"/>
                    </svg>
                  </a>
                </li>
                <li class="item">
                  <a class="block" href="#">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M0 12.5261C0 19.0561 4.99662 24.419 11.3751 25.0001H13.6772C19.6763 24.4535 24.4531 19.6769 25 13.6779V11.3744C24.4186 4.99626 19.0558 0 12.5261 0C5.60814 0 0 5.60814 0 12.5261ZM19.9082 7.90372C20.4563 7.90372 20.5801 8.18659 20.4563 8.57555C20.2632 9.46696 18.6593 11.8316 18.1625 12.5639C18.0681 12.7031 18.0137 12.7833 18.0165 12.7833C17.822 13.1016 17.7513 13.243 18.0165 13.5966C18.1124 13.7273 18.3157 13.9268 18.548 14.1548C18.7869 14.3893 19.0566 14.6539 19.2718 14.9049C20.0497 15.7889 20.6508 16.5314 20.8099 17.0442C20.9513 17.5569 20.7038 17.8221 20.1734 17.8221H18.3524C17.8698 17.8221 17.6211 17.5449 17.0909 16.9543C16.8636 16.701 16.5846 16.3901 16.2132 16.0187C15.1347 14.9756 14.6573 14.8342 14.3922 14.8342C14.0209 14.8342 13.9148 14.9226 13.9148 15.453V17.0972C13.9148 17.5392 13.7734 17.8044 12.6065 17.8044C10.6794 17.8044 8.54014 16.6375 7.03736 14.4629C4.77435 11.2806 4.15556 8.87611 4.15556 8.39875C4.15556 8.13355 4.24396 7.88604 4.77435 7.88604H6.61305C7.07272 7.88604 7.24952 8.08052 7.42632 8.59323C8.32799 11.1922 9.83077 13.4728 10.4496 13.4728C10.6794 13.4728 10.7855 13.3668 10.7855 12.7833V10.096C10.7418 9.33217 10.4759 8.99936 10.2787 8.75257C10.1565 8.59952 10.0606 8.47955 10.0606 8.31035C10.0606 8.0982 10.2374 7.88604 10.5203 7.88604H13.3844C13.7734 7.88604 13.9148 8.0982 13.9148 8.55787V12.1822C13.9148 12.5712 14.0739 12.7126 14.1977 12.7126C14.4275 12.7126 14.622 12.5712 15.0463 12.1469C16.3546 10.6794 17.2916 8.41643 17.2916 8.41643C17.4154 8.15124 17.6275 7.90372 18.0872 7.90372H19.9082Z" fill="#669EF2"/>
                    </svg>
                  </a>
                </li>
                <li class="item">
                  <a class="block" href="#">
                    <svg width="29" height="25" viewBox="0 0 29 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.508517 11.9998L7.17576 14.4567L9.77483 22.7207C9.88783 23.2791 10.5659 23.3908 11.0179 23.0558L14.747 20.0405C15.086 19.7055 15.651 19.7055 16.103 20.0405L22.7703 24.8426C23.2223 25.1776 23.9003 24.9543 24.0133 24.3959L28.9855 0.943833C29.0985 0.385451 28.5334 -0.172926 27.9684 0.050427L0.508517 10.548C-0.169506 10.7714 -0.169506 11.7764 0.508517 11.9998ZM9.43583 13.2282L22.5442 5.29922C22.7702 5.18754 22.9963 5.52257 22.7703 5.63425L12.0349 15.5735C11.6959 15.9085 11.3569 16.3552 11.3569 16.9136L11.0179 19.5938C11.0179 19.9288 10.4529 20.0405 10.3398 19.5938L8.98379 14.68C8.64478 14.1217 8.87082 13.4516 9.43583 13.2282Z" fill="#669EF2"/>
                    </svg>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <?php
            }
          ?>
        </div>
      </div>
    </footer>
    <script defer src="/sources/scripts/script.js"></script>
  </body>
</html>