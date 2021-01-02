<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            font-family: Verdana;
        }
        body {
            padding: 30px;
        }
        form {
            width: 100%;
        }
        table {
            border-collapse: collapse;
            margin-top: 40px;
            width: 100%;
        }
        input {
            padding: 8px;
            display: block;
            margin: 8px 0;
            width: 100%;
        }
        .delete-btn, .edit-btn {
            color: white;
            border: 0;
        }
        .delete-btn{
            background: red;
        }
        .edit-btn{
            background: green;
        }
        tr, th, td {
            border: 1px solid black;
            padding: 5px 15px;
        }
        th {
            background: black;
            color: white;
        }
        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
            flex-direction: column;
            width: 50%;
            margin: 0 auto;
        }
        #table-data {
            width: 100%;
        }
        .fname, .lname {
            width: 90%;
        }
    </style>
</head>
<body>
    <?php 
        require "config.php"
    ?>

        <div class="wrapper">
    <form id="form">
    <h3>Search</h3>
    <input type="text" placeholder= "Enter a keyword! 🔍" id="search">
    <hr>
    <h3>Add a user</h3>
    <input type="text" placeholder="First Name 👈🏻" id="fname">
    <input type="text" placeholder="Second Name 👈🏻" id="lname">
    <button type="submit" id="submit">Submit</button>
    </form>

        <div class="container" id="table-data">
        </div>
        
        </div>
    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
           function loadData() {
            $.ajax({
                url: "load-data.php", 
                type:  "POST", 
                success: function (result) {
                    $("#table-data").html(result);
                }
            });
           }
           loadData();

           $("#submit").on("click", function(e) {
               e.preventDefault();
                let fName = $("#fname").val();
                let lName = $("#lname").val();
            if(!fName == "" || !lName == "") {
                    $.ajax({
                    url: "insert-data.php", 
                    type:  "POST", 
                    data: {
                        fname: fName,  
                        lname: lName
                    },
                    success: function(result) {
                        if(result == 1) {
                            loadData();
                            $("#form").trigger("reset");
                        } else {
                            alert("Something went wrong");
                        }
                    }
                })
                } else {
                    alert("All fields are required.");
                }
           })

           $(document).on("click", ".delete-btn", function() {
               let button = $(this);
               let userId = button.data("user-id");
               $.ajax({
                    url: "delete-data.php",
                    type: "POST", 
                    data: {
                        user_id: userId
                    },
                    success: function(result) {
                            if(result == 1) {
                                $(button).closest("tr").hide("fast");
                            } else {
                                alert("Something went wrong")
                            }
                    }
               })
           })

           let update = false;
           $(document).on("click", ".edit-btn", function() {
                    let editBtn = $(this);
                    let fullNameField = editBtn.parent().prev();
                    let fullNameFieldText = fullNameField.text();
                    let id = editBtn.data("user-id");
                    
                    if(!update) {
                        editBtn.val("Update");
                            $.ajax({
                            url: "load-update-data.php",
                            type: "POST",
                            data: {
                                user_id: id, 
                                first_name: $(fullNameField).find(".fname").val(),
                                second_name: $(fullNameField).find(".lname").val()
                            },
                            success: function(result) {
                                fullNameField.html(result);
                            }
                        })
                        update = true;
                    } else {
                        if(editBtn.val() != "Update") {
                        editBtn.removeEventListener("click");
                    }
                        $.ajax({
                            url: "update-data.php", 
                            type: "POST", 
                            data: {
                                user_id: id, 
                                first_name: $(fullNameField).find(".fname").val(),
                                last_name: $(fullNameField).find(".lname").val()
                            }, 
                            success: function(result) {
                                if(result == 1) {
                                    editBtn.val("Edit");
                                    loadData();
                                    update = false;
                                } else {
                                    alert("Something went wrong.");
                                }
                            }
                        })
                    }
           })
           $("#search").on("input", function() {
               if($("#search").val().length > 0) {
                   $.ajax({
                       url: "search.php", 
                       data: {
                           query: $("#search").val()
                       },
                       success: function(result) {
                           $("#table-data").html(result);
                       }
                   })
               } else {
                   loadData();
               }
           })
        })
    </script>
</body>
</html>