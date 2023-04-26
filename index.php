    <!DOCTYPE html>
<html>
<head>
<style>
@import url('https://fonts.googleapis.com/css?family=VT323');
body {
  background-color: #ffffff;
  display: table;
}

.div1 {
  height: 100%;
  width: 100%;
  display: table;
  position: absolute;
  top: 0;
  left: 0;
}

.div2 {
  text-align: center;
  display: table-cell;
  vertical-align: middle;
  font-family: VT323;
  font-size: 25px;
  color: #656262;
}

.box {
  text-align: center;
  font-size: 20px;
  font-family: VT323;
  outline: none;
  width: 250px;
  height: 35px;
  border: none;
  border-bottom: 2px solid #656262;
}

.confirm {
  border: none;
  font-size: 20px;
  font-family: VT323;
  margin-top: 10px;
  color: #656262;
  background-color: rgba(0, 0, 0, 0);
  cursor: pointer;
}
</style>
    <title>Login page</title>
</head>
<body>
  <div class="div1"> 
    <div class="div2">
      
      
    <form>
        <label for="pswd">Enter password: </label>
      </br>
        <input type="password" id="pswd" class="box">
      </br>
        <input type="button" value="Submit" onclick="checkPswd();"                              class="confirm" />
    </form>
    </div>
  </div>
<!--Function to check password the already set password is admin-->
<script type="text/javascript">
    function checkPswd() {
        var confirmPassword = "Erfolg_100%";
        var password = document.getElementById("pswd").value;
        if (password == confirmPassword) {
             window.location="https://www.speedquizzing.com";
        window.location="main.php";
        }
        else{
            alert("Passwords do not match.");
        }
    }
</script>
      
   
</body>
</html
  

  
