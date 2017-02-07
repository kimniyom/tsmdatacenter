<html>
    <head>
        <meta charset="utf-8"/>

        <title>Login</title>
        <script type="text/javascript">
            function clear_text() {
                $("#username").val('');
                $("#password").val('');
            }
            function show(){
                var user = $("#username").val();
                var pass = $("#password").val();
                alert(pass);
            }
            
            function checklogin() {
                
                var url = "<?php echo Yii::app()->createUrl('//User/Checklogin') ?>";
               
                var user = $("#username").val();
                var pass = $("#password").val();
                var data = {user: user, pass: pass};

                if(user == ''){
                    alert('Username is Null');
                    $("#username").focus();
                }else if(pass == ''){
                    alert('Password is Null');
                    $("#password").focus();
                }

                $.post(url, data, function(success) {
                    alert("ลบข้อมูลเสร็จเรียบร้อย...");
                    window.location.reload();
                });
            }
            

        </script>
        <style>
            .panel-heading {
                padding: 5px 15px;
            }

            .panel-footer {
                padding: 1px 15px;
                color: #A0A0A0;
            }

            .profile-img {
                width: 96px;
                height: 96px;
                margin: 0 auto 10px;
                display: block;
                -moz-border-radius: 50%;
                -webkit-border-radius: 50%;
                border-radius: 50%;
            }
        </style>
    </head>
    <body>
    <center>
        <div style="width: 60%;">
            <?php // if (Yii::app()->session['name'] == '') { ?>

            </div>
            <!--  -->
            <div class="container" style="margin-top:40px">
                <div class="row">
                    <div class="col-sm-6 col-md-4 col-md-offset-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong> Login to continue</strong>
                            </div>
                            <div class="panel-body">
                                <form role="form" action="#" method="POST">
                                    <fieldset>
                                        <div class="row">
                                            <div class="center-block">
                                                <img class="profile-img"
                                                     src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" alt="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="glyphicon glyphicon-user"></i>
                                                        </span> 
                                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" autofocus>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="glyphicon glyphicon-lock"></i>
                                                        </span>
                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-lg btn-info btn-block" onclick="checklogin();">Sign in</button>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="panel-footer ">
                                <!-- Don't have an account! <a href="#" onClick=""> Sign Up Here </a> -->
                                กรุณาลงชื่อเข้าใช้งานระบบ
                            </div>
                        </div>
                    </div>
                </div>
            <?php // } else { ?>
                <?php //echo Yii::app()->session['name']; ?>
            <?php //} ?>
    </center>
</body>
</html>