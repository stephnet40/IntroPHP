

// This is a 'generic' function that will add a value or cookie to the document
// It uses name-value pairs as input parameters to the function
// 'tag' is the name of the data that you wish to store
// 'value' contains the contents that are associated with the name of the data

  function addCookie(tag, value) {
    var expireDate = new Date()
    var expireString = ""
    expireDate.setTime(expireDate.getTime() + (1000 * 60 * 60 * 24 * 365) )
    expireString = "expires="+ expireDate.toGMTString()
    document.cookie = tag + "=" + escape(value) + ";" + expireString + ";"
  }


// This is a 'generic' function that will look for a specific piece of information 
// in a cookie and return its value.  
// The 'name' of the function is passed to the function using the 'tag' parameter
// 'tag' contains the name of the name-value pair that you wish to find
// This function will return the value associated with the name requested.

  function getCookie(tag) {
    var value = null
    var myCookie = document.cookie + ";"
    var findTag = tag + "="
    var endPos
    if (myCookie.length > 0 ) {
      var beginPos = myCookie.indexOf(findTag)
      if (beginPos != -1) {
        beginPos = beginPos + findTag.length
        endPos = myCookie.indexOf(";", beginPos)
        if (endPos == -1)
          endPos = myCookie.length
        value = unescape(myCookie.substring(beginPos, endPos))
      }
    } 
   return value   
  } 


// This is a 'generic' function tht will delete the cookie.  This is done by setting 
// the expiration date of the cookie to yesterday.
// 'tag' contains the name of the cookie element that you wish to delete.

  function deleteCookie(tag) {
    var Yesterday = 24 * 60 * 60 * 1000
    var expireDate = new Date()
    expireDate.setTime (expireDate.getTime() - Yesterday)
//  Replace FIELDNAME with the cookie element name that you wish to delete
    document.cookie = tag + "=nothing; expires=" + expireDate.toGMTString()

//  Example statements
//   document.cookie = "StudentName=nothing; expires="+ expireDate.toGMTString()
//   document.cookie = "HitCounter=nothing; expires="+ expireDate.toGMTString()

  }

// This function will display the contents of the entire cookie

  function displayCookie() {

    alert("Contents of Cookie: " + document.cookie)

  }
