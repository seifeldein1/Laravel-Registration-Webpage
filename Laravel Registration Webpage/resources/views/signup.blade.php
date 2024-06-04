<!DOCTYPE html>

<html>
<head>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function() {
  $("#myForm").submit(function(e) {
    e.preventDefault();
    var form = $(this);
    var formData = new FormData(form[0]);
    $.ajax({
      url: "/signup",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        if (response.status === 'success') {
          alert(response.message);
          form.trigger("reset");
        } else {
          alert(response.message);
        }
      },
      error: function(jqXHR, textStatus, errorMessage) {
        alert(errorMessage);
      }
    });
  });
});
</script>

    <title>Signup</title>
</head>
<body>
@include('header')
<div id="box">
    
<form id="myForm" method="post" action="/signup" enctype="multipart/form-data" class="my-form" onsubmit="validateForm()">
@csrf
            
<div class="form-group">
    <label for="full_name">{{ Lang::get('messages.full_name_label') }}</label>
    <input type="text" name="full_name" id="full_name" placeholder="{{ Lang::get('messages.full_name_placeholder') }}" required>
</div>

<div class="form-group">
    <label for="user_name">{{ Lang::get('messages.user_name_label') }}</label>
    <input type="text" name="user_name" id="user_name" placeholder="{{ Lang::get('messages.user_name_placeholder') }}" required>
</div>

<div class="form-group">
    <label for="birthday">{{ Lang::get('messages.birthday_label') }}</label>
    <input type="date" name="birthday" id="birthday" placeholder="{{ Lang::get('messages.birthday_placeholder') }}" required>
    <button type="button" id="get-actors-button" onclick="listActors()">{{ Lang::get('messages.get_actors_button_label') }}</button>
</div>

<div id="container"> </div>


<div class="form-group">
    <label for="phone">{{ Lang::get('messages.phone_label') }}</label>
    <input type="tel" name="phone" id="phone" placeholder="{{ Lang::get('messages.phone_placeholder') }}" required>
</div>

<div class="form-group">
    <label for="address">{{ Lang::get('messages.address_label') }}</label>
    <input type="text" name="address" id="address" placeholder="{{ Lang::get('messages.address_placeholder') }}" required>
</div>

<div class="form-group">
    <label for="password">{{ Lang::get('messages.password_label') }}</label>
    <input type="password" name="password" id="password" placeholder="{{ Lang::get('messages.password_placeholder') }}" required>
</div>

<div class="form-group">
    <label for="confirm_password">{{ Lang::get('messages.confirm_password_label') }}</label>
    <input type="password" name="confirm_password" id="confirm_password" placeholder="{{ Lang::get('messages.confirm_password_placeholder') }}">
</div>

<div class="form-group">
    <label for="email">{{ Lang::get('messages.email_label') }}</label>
    <input type="email" name="email" id="email" placeholder="{{ Lang::get('messages.email_placeholder') }}" required>
</div>

<div class="form-group">
    <label for="photo">{{ Lang::get('messages.photo_label') }}</label>
    <input type="file" name="photo" id="photo" required>
</div>
  <button type="submit" class="btn-submit" id=submit value="Add" >{{ Lang::get('messages.sub') }}</button>
</form>
</div>
@include('footer')

<script>

function switchLanguage(lang) {
  let baseURL = window.location.origin;
  if (lang == "en") {
    window.location.href = baseURL + "/en"
  } else {
    window.location.href = baseURL + "/ar"  
  }
}

</script>
    <script src="{{ asset('js/Api.js') }}"></script> 
    <script src="{{ asset('js/Rej.js') }}"></script>
</body>
</html>
