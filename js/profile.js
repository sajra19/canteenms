var Profile = {
  get_profile: function (id) {
    RestClient.get(
      "profile?id=" + id,
      function (data) {
        $("#profile_form input[name=id]").val(data.id);
        $("#profile_form input[name=fname]").val(data.name);
        $("#profile_form input[name=lname]").val(data.surname);
        $("#profile_form input[name=user_email]").val(data.email);
        $("#profile_form input[name=phone]").val(data.phone);
      },
      function (data) {
        toastr.error(data.responseText);
      }
    );
  },
};
