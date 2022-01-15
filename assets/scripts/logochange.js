let myImage = document.querySelector('img');

visualViewport.onresize = function() {
  let mySrc = myImage.getAttribute('src');
  if(mySrc === 'asset/images/favicon-1.PNG' && window.innerWidth > 992) {
    myImage.setAttribute('src','asset/images/Citibuilda white-icon.PNG');
  } else {
    myImage.setAttribute('src','asset/images/favicon-1.PNG');
  }
}