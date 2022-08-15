$(document).ready(function () {
    $("button").click(function () {
        let pass = $("#password").val()
        let repass = $("#repassword").val()

        let checkSpace = [];
        for (let i = 0; i < username.length; i++) {
            checkSpace.push(username[i])
        }

        if (pass !== repass) {
            alert("The passwords entered do not match. Please try again.")
            return false
        }
    })

    $(document).keyup(function (e) {
        if (e.which == 13) {
            let pass = $("#password").val()
            let repass = $("#repassword").val()

            let checkSpace = [];
            for (let i = 0; i < username.length; i++) {
                checkSpace.push(username[i])
            }

            if (pass !== repass) {
                alert("The passwords entered do not match. Please try again.")
                return false
            }
        }
    })

    setInterval(() => {
        $(".alert").delay(5000).fadeOut("slow")
    }, 100);
})