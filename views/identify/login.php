<style>
    #login{
        margin:auto;
        width:450px;
        padding:50px;
    }


</style>


<form method="POST" id="login">
    <h1>Login</h1>
    <label>Username</label><input type="text" name="username" class="form-control" required>
    <label>Password</label><input type="password" name="passwd" class="form-control" required>
    <input type="hidden" name="controller" value="identify"> 
    </br>
    <button type="submit" name="action" value="login" class="btn btn-success btn-block">Login</button> 
    </br>
</form>