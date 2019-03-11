<div class="reg_log">
    <div class="materialContainer">
        <form action="/account/login" method="post">
            <div class="box">

                <div class="title">LOGIN</div>

                <div class="input">
                    <label for="logname">Username</label>
                    <input type="text" name="logname" id="logname">
                    <span class="spin"></span>
                </div>

                <div class="input">
                    <label for="logpass">Password</label>
                    <input type="password" name="logpass" id="logpass">
                    <span class="spin"></span>
                </div>

                <div class="button login">
                    <button type="submit"><span>GO</span> <i class="fa fa-check"></i></button>
                </div>

                <a href="" class="pass-forgot">Forgot your password?</a>

            </div>
        </form>

        <form action="/account/register" method="post">
            <div class="overbox">
                <div class="material-button alt-2"><span class="shape"></span></div>

                <div class="title">REGISTER</div>

                <div class="input">
                    <label for="regname">Username</label>
                    <input type="text" name="regname" id="regname">
                    <span class="spin"></span>
                </div>

                <div class="input">
                    <label for="regemail">Email</label>
                    <input type="email" name="regemail" id="regemail">
                    <span class="spin"></span>
                </div>

                <div class="input">
                    <label for="regpass">Password</label>
                    <input type="password" name="regpass" id="regpass">
                    <span class="spin"></span>
                </div>

                <div class="button">
                    <button type="submit"><span>NEXT</span></button>
                </div>
            </div>
        </form>
    </div>
</div>