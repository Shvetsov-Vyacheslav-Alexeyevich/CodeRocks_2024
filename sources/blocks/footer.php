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
                  <div>me@blitz.ru</div>
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