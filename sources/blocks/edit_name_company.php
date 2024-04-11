<form id="form_edit_name_company" class="form_wrapper modal" action="/server/server/php></form" POST="POST" enctype="multipart/form-data">
  <div class="inner">
    <a class="link_undo" onclick="hideModalWrapper()">
      <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path class="change" d="M12 1.21286L10.7871 0L6 4.78714L1.21286 0L0 1.21286L4.78714 6L0 10.7871L1.21286 12L6 7.21286L10.7871 12L12 10.7871L7.21286 6L12 1.21286Z" fill="#A5A5A5"/>
      </svg>
    </a>
    <h1 class="form_heading">Редактировать</h1>
    <div class="text_description">Изменить название компании</div>
    <div class="inputs">
    	<div class="line"></div>
      <input id="name_company" class="" type="text" name="name_company" placeholder="Название компании" required>
      <button class="submit" type="submit">Отправить</button>
    </div>
</form>