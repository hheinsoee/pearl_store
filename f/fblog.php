<!DOCTYPE html>
<html>
<head>
	<title></title>

	<script src="https://sdk.accountkit.com/en_US/sdk.js"></script>
	<script>
  // initialize Account Kit with CSRF protection
  AccountKit_OnInteractive = function(){
    AccountKit.init(
      {
        appId:"358979421551505", 
        state:"csrf", 
        version:"v1.1",
        fbAppEventsEnabled:true
      }
    );
  };

  // login callback
  function loginCallback(response) {
    if (response.status === "PARTIALLY_AUTHENTICATED") {
      var code = response.code;
      var csrf = response.state;
      // Send code to server to exchange for access token
    }
    else if (response.status === "NOT_AUTHENTICATED") {
      // handle authentication failure
    }
    else if (response.status === "BAD_PARAMS") {
      // handle bad parameters
    }
  }

  // phone form submission handler
  function smsLogin() {
    var countryCode = document.getElementById("country_code").value;
    var phoneNumber = document.getElementById("phone_number").value;
    AccountKit.login(
      'PHONE', 
      {countryCode: countryCode, phoneNumber: phoneNumber}, // will use default values if not specified
      loginCallback
    );
  }
</script>

</head>
<body>
	<div>
		<div>
			<input type="hidden" value="+95" id="country_code" />
			<input placeholder="phone number" id="phone_number" value="9252152447" />
			<button onclick="smsLogin();">Verify</button>
		</div>
	</div>


<form id="login_success" method="post" action="f/login_success.php">
  <input id="csrf" type="hidden" name="csrf" />
  <input id="code" type="hidden" name="code" />
</form>

<script>
  function loginCallback(response) {
    if (response.status === "PARTIALLY_AUTHENTICATED") {
      document.getElementById("code").value = response.code;
      document.getElementById("csrf").value = response.state;
      document.getElementById("login_success").submit();
    }
  }
</script>

    
</body>
</html>