/* object literal wrapper to avoid namespace conflicts */
var ErrorTracking = {};
var org = '<?php echo $_SESSION["OrgID"]; ?>';

/* URL of your server-side error recording script */
ErrorTracking.errorReportingURL = "http://104.131.195.41:9091/seterrors.php";



ErrorTracking.encodeValue = function(val)
{

  var encodedVal;

  if (!encodeURIComponent)
  {
    encodedVal = escape(val);

    /* fix the omissions */
    encodedVal = encodedVal.replace(/@/g, '%40');

    encodedVal = encodedVal.replace(/\//g, '%2F');

    encodedVal = encodedVal.replace(/\+/g, '%2B');
  }
  else
  {
    encodedVal = encodeURIComponent(val);

    /* fix the omissions */
    encodedVal = encodedVal.replace(/~/g, '%7E');

    encodedVal = encodedVal.replace(/!/g, '%21');

    encodedVal = encodedVal.replace(/\(/g, '%28');

    encodedVal = encodedVal.replace(/\)/g, '%29');

    encodedVal = encodedVal.replace(/'/g, '%27');
  }

 /* clean up the spaces and return */
 return encodedVal.replace(/\%20/g,'+'); 
}	


ErrorTracking.reportJSError = function (errorMessage,url,lineNumber)
{
  function sendRequest(url,payload)
  {
    var img = new Image();

    img.src = url+"?"+payload;
  }

  /* form payload string with error data */
  var payload = "url=" + ErrorTracking.encodeValue(url);

  payload += "&message=" + ErrorTracking.encodeValue(errorMessage);

  payload += "&line=" + ErrorTracking.encodeValue(lineNumber);

  payload += "&orgID=" + orgid;

  /* submit error message  */
  sendRequest(ErrorTracking.errorReportingURL,payload);

  alert("JavaScript Error Encountered.  \nSite Administrators have been notified.");

  return true; // suppress normal JS errors since we handled
}



ErrorTracking.registerErrorHandler = function () 
{	
  if (window.onerror) // then one exists
  {
    var oldError = window.onerror;

    var newErrorHandler = function (errorMessage, url, lineNumber){ 
      ErrorTracking.reportJSError(errorMessage,url,lineNumber); 
      oldError(errorMessage,url,lineNumber); 
    }

    window.onerror = newErrorHandler;
  } 
  else   
    window.onerror = ErrorTracking.reportJSError;
}

/* bind the error handler */
ErrorTracking.registerErrorHandler();

