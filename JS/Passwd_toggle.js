function togglepass() {
    var pwdField = document.querySelectorAll(".pwd");

    pwdField.forEach(field => {
        if (field.type == "password"){
            field.type = "text";
        } else {
            field.type = "password";
        }
    });
}
