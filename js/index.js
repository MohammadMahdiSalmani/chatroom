// jQuery Document
$(document).ready(function () {
    // Include nav
    $(function () {
        $("nav").load("nav.html");
    });

    $("label").click(function () {

        setInterval(() => {
            let filename = $("#image").val().replace(/C:\\fakepath\\/i, " ")
            $(this).children("strong").text(filename);
        }, 1000);
    })


    //Send Message & Press Shift and Enter for a new line
    $('#usermsg').keypress(function (e) {
        // Get the code of pressed key
        const keyCode = e.which || e.keyCode;

        // 13 represents the Enter key
        if (keyCode === 13 && !e.shiftKey) {
            // Don't generate a new line
            e.preventDefault();

            let text = $("#usermsg").val();
            let image = $("#image").val();

            if (text !== "" || image !== "") {
                $.ajax({
                    url: "post.php",
                    type: "POST",
                    data: { text, image }
                })

                $("#usermsg").val("");
                $("#image").val("");
            }
        }
    });


    //Auto scrolling to latest message
    setInterval(function () {
        let oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request

        $.ajax({
            url: "log.html",
            cache: false,
            success: function (html) {
                $("#chatbox").html(html); //Insert chat log into the #chatbox div

                //Auto-scroll
                let newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height after the request
                if (newscrollHeight > oldscrollHeight) {
                    $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                }
            }
        });
    }, 1000);

    //Manual scrolling to latest message
    setInterval(() => {
        let newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height after the request
        if ($("#chatbox")[0].scrollTop >= newscrollHeight - 700) {
            $("#latest-messages").addClass("hidden")
        }
        else {
            $("#latest-messages").removeClass("hidden")
        }
    }, 500);
    $(".message-button").click(function () {
        let newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height after the request
        $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
    })


    // Exiting room 
    $("#exit").click(function () {
        let exit = confirm("Are you sure you want to end the session?");
        if (exit == true) {
            window.location = "index.php?logout=true";
        }
    });

    // New private room code
    let oddnum = [1, 3, 5, 7, 9, 11, 13, 15, 17, 19]
    let str1 = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k"]
    let evennum = [2, 4, 6, 8, 0, 10, 12, 14, 16, 18]
    let str2 = ["l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v"]
    let sym = ["$", "&", "%", "@"]

    let randoddnum = oddnum[Math.floor(Math.random() * oddnum.length)]
    let randstr1 = str1[Math.floor(Math.random() * str1.length)]
    let randevennum = evennum[Math.floor(Math.random() * evennum.length)]
    let randstr2 = str2[Math.floor(Math.random() * str2.length)]
    let randsym = sym[Math.floor(Math.random() * sym.length)]

    let pvroomcode = (randoddnum * evennum[Math.floor(Math.random() * evennum.length)]) + randstr1 + randsym + (randevennum * oddnum[Math.floor(Math.random() * oddnum.length)]) + randstr2 + sym[Math.floor(Math.random() * sym.length)]
    let pvroompassword = (randoddnum * evennum[Math.floor(Math.random() * evennum.length)]) + str1[Math.floor(Math.random() * str1.length)] + (randevennum * oddnum[Math.floor(Math.random() * oddnum.length)]) + str2[Math.floor(Math.random() * str2.length)]

    $("#your-privateroom-code").text(pvroomcode)
    $("#your-privateroom-password").text(pvroompassword)

    $.ajax({
        url: "index.php",
        type: "POST",
        data: { pvroomcode, pvroompassword }
    })


    // Check the private room fileds
    setInterval(() => {
        if($("#privateroom").prop("checked") === true) {
            $("#privateform").children("input").prop("required", true)
        }
        else {
            $("#privateform").children("input").prop("required", false)
        }
    }, 1000);


    setInterval(() => {
        $(".alert").delay(7000).fadeOut("slow")
    }, 100);
})